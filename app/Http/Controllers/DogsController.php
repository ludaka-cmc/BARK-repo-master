<?php

namespace AKCBark\Http\Controllers;

use AKCBark\Helpers\AuthTokenHelper;
use AKCBark\Helpers\ErrorHelper;
use AKCBark\Helpers\MediaHelper;
use AKCBark\Models\Dog;
use AKCBark\Models\User;
use AKCBark\Models\Volunteer;
use Illuminate\Http\Request;

class DogsController extends Controller
{
    public function __construct() {
        $this->errorHelper = new ErrorHelper();
        $this->user = AuthTokenHelper::getUser();
    }

    protected function additionalDogFields($dog) {
        $user = AuthTokenHelper::getUser();

        $dog->volunteer;

        if (
            ($user && $dog->volunteer) &&
            (
                ($dog->volunteer->user && $user->id == $dog->volunteer->user->id) ||
                $user->admin
            )
        ) {
            $dog->media;
        } else {
            unset($dog->registration_number);
            unset($dog->volunteer);
            unset($dog->volunteer_id);
            unset($dog->media);
            unset($dog->certifications);
        }

        return $dog;
    }

    /**
     * Display a listing of the resource.
     */
    public function index() {
        $dogs = Dog::orderby('id', 'asc')
            ->get();

        foreach ($dogs as $dog) {
            $dog = $this->additionalDogFields($dog);
        }

        return $dogs->toJson();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     */
    public function show($id) {
        if ($dog = Dog::find($id)) {
            $dog = $this->additionalDogFields($dog);

            return $dog->toJson();
        }

        return [];
    }

    public function create(Request $request) {
        $dog = Dog::create($request->all());
        return $dog->toJson();
    }

    public function createEntry(Request $request) {
        if (!$this->user) {
            return response()->json([
                'success' => false,
                'error_code' => $this->errorHelper->getErrorCode(
                    'user_not_found',
                    get_class($this))
            ], 400);
        }

        try {
            $user_id = $this->user->id;
            $volunteer = $this->user->volunteer;

            $params = [
                'name' => json_decode($request->input('name', null), true),
                'breed' => json_decode($request->input('breed', null), true)['label'],
                'registration_number' => json_decode($request->input('registrationNumber', null), true),
                'certifications' => $request->input('certifications', null),
                'volunteer_id' => $volunteer->id,
            ];

            if ($image = $request->file('dogPhoto')) {
                if ($media = MediaHelper::handleImageUpload($image, $user_id)) {
                    $params['media_id'] = $media->id;
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

        try {
            return response()->json([
                'success' => true,
                'data' => Dog::create($params)
            ], 200);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json([
                'success' => false,
                'error_code' => $this->errorHelper->getErrorCode(
                    $e->getMessage(),
                    get_class($this))
            ], 400);
        }
    }
}
