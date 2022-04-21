<?php
namespace AKCBark\Services\Auth;

use AKCBark\Exceptions\GigyaCustomException;
use AKCBark\Helpers\GigyaHelper;
use AKCBark\Models\GigyaUser;
use AKCBark\Models\User;
use Carbon\Carbon;
use Exception;

class AuthService
{
    /**
     * Update a gigya_users row or create a new one.
     * If the user with email passed does not exists, it is created too.
     *
     * @param $email
     * @param $gigya_uid
     * @param null $gigya_provider
     * @return $user|\Illuminate\Database\Eloquent\Model|null|static
     */
    public function updateOrCreateGigyaUserByGigyaInfoLogin(
        $gigya_uid,
        $gigya_provider = null,
        $email = null
    ) {
        $user = null;
        $gigya_user = GigyaUser::whereGigyaUid($gigya_uid)->first();

        if ($gigya_user) {
            if ( $gigya_user->email !== $email ) {
                $gigya_user->update([
                    'email' => $email
                ]);
            }
        } else {
            $gigya_user = [
                'gigya_uid' => $gigya_uid,
                'provider' => $gigya_provider,
                'email' => $email
            ];

            if ($email) {
                if (!$user = User::whereEmail($email)->first()) {
                    $user = User::create(['email' => $email]);
                } else {
                    GigyaUser::whereUserId($user->id)->update([
                        'deleted_at' => Carbon::now()
                    ]);
                }
            } else {
                $user = User::create();
            }

            $gigya_user['user_id'] = $user->id;
            $gigya_user = GigyaUser::create($gigya_user);
        }

        $gigya_user->user()->update(['last_gigya_user_id' => $gigya_user->id]);

        return $gigya_user;
    }

    /**
     * @param User $user
     * @throws GigyaCustomException
     */
    public function pullGigyaData(User $user) {
        $account_info = null;

        // If everything is ok
        try {
            $account_info = GigyaHelper::getUserInfo($user);
        } catch(Exception $e) {
            // Continue
        }

        // Check if I can find the user by Email of Email and Resource
        if (!$account_info) {
            try {
                $user->load('gigyaUser');

                if ($user->gigyaUser) {
                    $gigya_user = $user->gigyaUser;
                } else {
                    $gigya_user = $user->gigyaUsers()->withTrashed()->orderBy('id', 'desc')->first();
                }

                if ($gigya_user->provider) {
                    $account_info = GigyaHelper::getUserInfoBySocialMediaAndEmail($gigya_user->provider, $user->email);
                } else {
                    $account_info = GigyaHelper::getUserInfoByEmail($user->email);
                }

                $datetime = Carbon::now();

                GigyaUser::whereUserId($user->id)->update([
                    'deleted_at' => $datetime,
                    // 'gigya_unique_uid' => \DB::raw("concat(gigya_uid, '-', '{$datetime}')")
                ]);

                $results = $account_info->getArray('results');
                try {
                    $account_info = $results->getObject(0);
                } catch(Exception $e) {
                    throw new GigyaCustomException('Unauthorized user');
                }

                GigyaUser::create([
                    'gigya_uid' => $account_info->getString('UID'),
                    'provider' => $gigya_user->provider,
                    'email' => $account_info->getString('email'),
                    'user_id' => $user->id
                ]);

                $user->load('gigyaUser');

            } catch (GigyaCustomException $e) {
                throw $e;
            } catch (Exception $e) {
                throw $e;
            }
        }

        $profile = $account_info->getObject('profile');
        $profile_fields = $profile->getKeys();
        $user->name = $profile->getString('firstName') . ' ' . $profile->getString('lastName');

        if (in_array('email', $profile_fields) && $user->last_gigya_user_id && $user->gigyaUser) {
            $user->gigyaUser->update(['email' => $profile->getString('email')]);
            $user->email = $profile->getString('email');
        }

        $data = $account_info->getObject('data', null);
        $user->save();
    }
}
