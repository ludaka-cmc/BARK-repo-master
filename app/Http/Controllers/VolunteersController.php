<?php

namespace AKCBark\Http\Controllers;


use AKCBark\Helpers\AuthTokenHelper;
use AKCBark\Models\State;
use AKCBark\Models\Volunteer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class VolunteersController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     */
    public function show($id) {
        $user = AuthTokenHelper::getUser();

        if ($user && $volunteer = Volunteer::find($id)) {
            if ($user->admin || $user->id == $volunteer->user->id) {
                return $volunteer->toJson();
            }
        }

        return [];
    }

    public function showUserVolunteers($user_id) {
        $volunteers = [];
        $user = AuthTokenHelper::getUser();

        if ($user->id == $user_id) {
            $volunteers = Volunteer::orderby('id', 'asc')
                ->where('user_id', $user_id)
                ->get();
        }

        return $volunteers;
    }

    public function createOrUpdate(Request $request, $id = null) {
        if ($id && $volunteer = Volunteer::find($id)) {
            $volunteer->update($request->all());
            return $volunteer->toJson();
        } else {
            $volunteer = Volunteer::create($request->all());
            return $volunteer->toJson();
        }

        return [];
    }

    public function createOrUpdateVolunteerFromForm(Request $request) {
        $user = AuthTokenHelper::getUser();

        try {
            $params = [
                'address' => $request->input('address', null),
                'city' => $request->input('city', null),
                'email' => $user->email,
                'state_id' => State::getStateIdFromStateTitle(
                    $request->input('state', null)['value']
                ),
                'zip_code' => $request->input('zipCode', null),
                'affiliated_program' => $request->input('affiliatedProgram', null),
                'email_alert_public_education' => 0, // note: need this checkbox on form. see mockups,
                'canine_ambassador' => (int) $request->input('isCanineAmbassador', null)
            ];

            if ($image = $request->file('dogPhoto')) {
                if ($media = MediaHelper::handleImageUpload($image, $user_id)) {
                    $params['media_id'] = $media->id;
                }
            }

            if ($volunteer = $user->volunteer) {
                $volunteer->update($params);

                return response()->json([
                    'success' => true,
                    'data' => array_merge(
                        ['user_id' => $user->id],
                        ['volunteer_id' => $volunteer->id],
                        $params
                    )
                ], 200);
            } else {
                $params = array_merge(
                    ['user_id' => $user->id],
                    $params
                );
                $volunteer = Volunteer::create($params);

                return response()->json([
                    'success' => true,
                    'data' => array_merge(
                        ['volunteer_id' => $volunteer->id],
                        $params
                    )
                ], 200);
            }
        } catch (\ErrorException $e) {
            return response()->json([
                'success' => false,
                'error' => "Error: {$e->getMessage()}"
            ]);
        }
    }
}
