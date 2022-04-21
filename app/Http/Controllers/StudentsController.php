<?php

namespace AKCBark\Http\Controllers;

use AKCBark\Helpers\DataHelper;
use AKCBark\Models\Guardian;
use AKCBark\Models\State;
use AKCBark\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StudentsController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     */
    public function show($id) {
        if ($student = Student::find($id)) {
            return $student->toJson();
        }

        return [];
    }

    public function create(Request $request) {
        $student = Student::create($request->all());
        return $student->toJson();
    }

    public function createStudentFromForm(Request $request, \AKCBark\Models\User $user = null) {
        $user = (!$user)
            ? $this->getUser()
            : $user;

        if (!$user) {
            return response()->json([
                'success' => false,
                'error_code' => $this->errorHelper->getErrorCode(
                    'user_not_found',
                    get_class($this))
            ], 400);
        }

        try {
            $has_guardian = false;
            $state_id = State::getStateIdFromStateTitle(
                json_decode($request->input('state', null), true)['value']
            );
            $guardian_id = null;

            if (json_decode($request->input('parentGuardian', null), true)) {
                $has_guardian = true;
                $guardian = Guardian::create([
                    'name' => json_decode($request->input('parentGuardian', null), true),
                    'relationship' => json_decode($request->input('parentGuardianRelationship', null), true),
                    'release_form' => '',
                    'program_id' => null,
                    'state_id' => $state_id
                ]);

                $guardian_id = $guardian->id;
            }

            $email = $has_guardian
                ? json_decode($request->input('parentGuardianEmail', null), true)
                : json_decode($request->input('email', null), true);

            $params = [
                'user_id' => $user->id,
                'guardian_id' => $guardian_id,
                'state_id' => $state_id,
                'name' => json_decode($request->input('name', null), true),
                'age' => DataHelper::getCurrentAgeFromBirthdate(
                    json_decode($request->input('birthday', null), true)
                ),
                'email' => $email,
                'address' => json_decode($request->input('address', null), true),
                'status' => 1
            ];

            $student = Student::create($params);
            return $student->toJson();
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
