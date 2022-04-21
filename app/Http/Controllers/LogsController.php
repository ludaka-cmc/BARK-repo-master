<?php

namespace AKCBark\Http\Controllers;

use AKCBark\Helpers\ErrorHelper;
use AKCBark\Models\Dog;
use AKCBark\Models\Log;
use AKCBark\Models\Media;
use AKCBark\Models\User;
use AKCBark\Models\Studentage;
use AKCBark\Models\Studentnum;
use AKCBark\Helpers\AuthTokenHelper;
use AKCBark\Helpers\DataHelper;
use AKCBark\Helpers\MediaHelper;
use AKCBark\Http\Controllers\StudentsController;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LogsController extends Controller
{
    public function __construct() {
        $this->errorHelper = new ErrorHelper();
        $this->user = $this->getUser();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $user = User::orderby('id', 'asc')
            ->first();

        $logs = Log::orderby('id', 'asc')
            ->get();

        return $logs->toJson();
    }

    protected function getUser() {
        $user = AuthTokenHelper::getUser() ?? null;

        return $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogsByTypeAndUserId($log_type, $user_id) {
        $logs = [];

        if (!$this->user) {
            return response()->json([
                'success' => false,
                'error_code' => $this->errorHelper->getErrorCode(
                    'user_not_found',
                    get_class($this))
            ], 400);
        }

        try {
            if ($user_id == $this->user->id) {
                if ($log_type == 'reader') {
                    $logs = Log::orderby('id', 'asc')
                        ->where('user_id', $user_id)
                        ->where('log_usertype', Log::LOG_READER)
                        ->get();
                } elseif ($log_type = 'volunteer') {
                    $logs = Log::orderby('id', 'asc')
                        ->where('user_id', $user_id)
                        ->where('log_usertype', Log::LOG_VOLUNTEER)
                        ->get();
                }

                foreach ($logs as $log) {
                    $log->dog;

                    if ($log->media_id > 0) {
                        $media = Media::find($log->media_id);
                        $log->media = [
                            'id' => $media->id,
                            'url' => $media->url
                        ];
                    } else {
                        $media = [];
                    }

                    if ($log->dog) {
                        $dog = Dog::find($log->dog->id);

                        if ($log->media && $dog->media_id) {
                            $log->media = Media::find($dog->media_id);
                        }
                    }

                    $log->location;
                    $log->studentage;
                    $log->studentnum;
                }
            }
        } catch (\ErrorException $e) {
            return response()->json([
                'success' => false,
                'error_code' => $this->errorHelper->getErrorCode(
                    $e->getMessage(),
                    get_class($this))
            ], 400);
        }

        return $logs;
    }

    public function createVolunteerLogEntry(Request $request) {
        if (!$this->user) {
            return response()->json([
                'success' => false,
                'error_code' => $this->errorHelper->getErrorCode(
                    'user_not_found',
                    get_class($this))
            ], 400);
        }

        try {
            $date = Carbon::parse(json_decode($request->input('date', true), true));
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error_code' => $this->errorHelper->getErrorCode(
                    'invalid_date',
                    get_class($this))
            ], 400);
        }

        $media = null;

        try {
            $params = [
                'name' => $request->input('name', null),
                'user_id' => $this->user->id,
                'dog_id' => json_decode($request->input('dog', null), true)['value'],
                'log_usertype' => Log::LOG_VOLUNTEER,
                'location_id' => (int) json_decode($request->input('location', null), true),
                'location_other' => json_decode($request->input('otherLocation', null), true),
                'studentnum_id' => (int) json_decode($request->input('numberOfReaders', null), true),
                'studentage_id' => (int) json_decode($request->input('ageOfReaders', null), true),
                'log_date' => $date
            ];

            if ($image = $request->file('dogPhoto')) {
                if ($media = MediaHelper::handleImageUpload($image, $this->user->id)) {
                    if ($media->id) {
                        $params['media_id'] = $media->id;
                        $media = [
                            'id' => $media->id,
                            'url' => $media->url
                        ];
                    }
                }
            }

            $log = Log::create($params);

            return response()->json([
                'success' => true,
                'data' => array_merge(
                    $log->toArray(),
                    ['media' => $media])
            ], 200);
        } catch (\ErrorException $e) {
            return response()->json([
                'success' => false,
                'error_code' => $this->errorHelper->getErrorCode(
                    $e->getMessage(),
                    get_class($this))
            ], 400);
        }
    }

    public function createReaderLogEntry(Request $request) {
        if (!$this->user) {
            return response()->json([
                'success' => false,
                'error_code' => $this->errorHelper->getErrorCode(
                    'user_not_found',
                    get_class($this))
            ], 400);
        }

        try {
            $date = Carbon::parse(json_decode($request->input('date', true), true));
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error_code' => $this->errorHelper->getErrorCode(
                    'invalid_date',
                    get_class($this))
            ], 400);
        }

        try {
            $birthdate = Carbon::parse(json_decode($request->input('birthday', true), true));
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error_code' => $this->errorHelper->getErrorCode(
                    'invalid_birthday_date',
                    get_class($this))
            ], 400);
        }

        $media = null;

        try {
            $studentController = new StudentsController();
            $student = $studentController->createStudentFromForm($request, $this->user);
            $user_id = $this->user->id;

            $params = [
                'student_name' => json_decode($request->input('name', true), true),
                'user_id' => $user_id,
                'dog_name' => json_decode($request->input('dog', null), true),
                'log_usertype' => Log::LOG_READER,
                'location_id' => (int) json_decode($request->input('location', true), true),
                'location_other' => json_decode($request->input('otherLocation', true), true),
                'book_read' => json_decode($request->input('bookRead', true), true)['label'],
                'studentnum_id' => Studentnum::getStudentnumIdFromValue(1),
                'studentage_id' => Studentage::getStudentageIdFromAgeValue(
                    DataHelper::getCurrentAgeFromBirthdate($birthdate)
                ),
                'pages' => json_decode($request->input('pagesRead', true), true),
                'hours' => DataHelper::getHoursFromTimeReadString(
                    json_decode($request->input('timeRead', null))
                ),
                'log_date' => $date,
                'has_coppa' => (int) json_decode($request->input('has_coppa', null), true)
            ];

            if ($image = $request->file('readerPhoto')) {
                if ($media = MediaHelper::handleImageUpload($image, $user_id)) {
                    if ($media->id) {
                        $params['media_id'] = $media->id;
                        $media = [
                            'id' => $media->id,
                            'url' => $media->url
                        ];
                    }
                }
            }

            $log = Log::create($params);

            return response()->json([
                'success' => true,
                'data' => array_merge(
                    $log->toArray(),
                    ['media' => $media])
            ], 200);
        } catch (\ErrorException $e) {
            return response()->json([
                'success' => false,
                'error_code' => $this->errorHelper->getErrorCode(
                    $e->getMessage(),
                    get_class($this))
            ], 400);
        }
    }
}
