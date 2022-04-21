<?php

namespace AKCBark\Helpers;

use AKCBark\Exceptions\GigyaCustomException;
use AKCBark\Models\User;
use Illuminate\Support\Facades\Log;

class GigyaHelper
{
    private static $API_KEY;
    private static $API_SECRET;

    public static function loadSettings()
    {
        self::$API_KEY    = config('gigya.api_key');
        self::$API_SECRET = config('gigya.api_secret');
    }

    /**
     * Request
     *
     * @param       $method
     * @param array $parameters
     * @return GSResponse
     */
    public static function request(
        $method,
        array $parameters,
        $https = false
    ) {
        if (!self::$API_KEY) {
            self::loadSettings();
        }

        $request = new \GSRequest(
            self::$API_KEY, // API Key
            self::$API_SECRET, // SECRET
            $method,
            null,
            $https
        );

        foreach ($parameters as $key => $value) {
            $request->setParam($key, $value);
        }

        return $request->send();
    }

    /**
     * Get User Info
     *
     * @param User $user
     * @return GSResponse
     * @throws \Exception
     */
    public static function getUserInfo(User $user)
    {
        $response = self::request(
            'accounts.getAccountInfo',
            [
                'UID' => $user->gigyaUser->gigya_uid
            ]
        );
        if (!$response->getErrorCode()) {
            return $response;
        }
        throw new GigyaCustomException($response->getErrorMessage());
    }

    /**
     * @param $gigya_uid
     * @return GSResponse
     * @throws GigyaCustomException
     */
    public static function getUserInfoByGigyaUid($gigya_uid) {
        $response = self::request(
            'accounts.getAccountInfo',
            [
                'UID' => $gigya_uid
            ]
        );

        if (!$response->getErrorCode()) {
            return $response;
        }

        throw new GigyaCustomException($response->getErrorMessage());
    }

    /**
     * @param $email
     * @return GSResponse
     * @throws GigyaCustomException
     */
    public static function getUserInfoByEmail($email) {
        $response = self::request(
            'accounts.search',
            [
                'query' => "SELECT * FROM emailAccounts WHERE profile.email = '{$email}';"
            ],
            true
        );
        if (!$response->getErrorCode()) {
            return $response;
        }

        throw new GigyaCustomException($response->getErrorMessage());
    }

    /**
     * @param $social_media
     * @param $email
     * @return GSResponse
     * @throws GigyaCustomException
     */
    public static function getUserInfoBySocialMediaAndEmail($social_media, $email) {
        $response = self::request(
            'accounts.search',
            [
                'query' => "select * from accounts
                      where socialProviders is not null
                      and socialProviders contains '{$social_media}'
                      and profile.email = '{$email}';"
            ],
            true
        );
        if (!$response->getErrorCode()) {
            return $response;
        }

        throw new GigyaCustomException($response->getErrorMessage());
    }

    /**
     * Validate User Signature
     *
     * @param $UID
     * @param $timestamp
     * @param $signature
     * @return bool
     */
    public static function validateUserSignature($UID, $timestamp, $signature)
    {
        if (!self::$API_KEY) {
            self::loadSettings();
        }

        return \SigUtils::validateUserSignature($UID, $timestamp, self::$API_SECRET, $signature);
    }

    /**
     * Set User Data
     * Add Gigya custom fields (data). It's a merge so it overwrites existing data.
     *
     * @param User  $user
     * @param array $data
     * @return GSResponse
     * @throws Exception
     */
    public static function setUserData(User $user, array $data = [])
    {
        $userInfo = self::getUserInfo($user);
        $userData = $userInfo->getObject('data');

        // Merge/overwrite custom data
        foreach ($data as $k => $v) {
            $userData->put($k, $v);
        }

        if ($userData->containsKey('storefront_classifieds')) {
            $userData->remove('storefront_classifieds');
        }

        // Update in Gigya
        $response = self::request(
            'accounts.setAccountInfo',
            [
                'UID'  => $user->gigyaUser->gigya_uid,
                'data' => $userData
            ]
        );

        if (!$response->getErrorCode()) {
            return $response;
        }

        \Log::warning('Could not update Gigya Custom Fields: ' . $response->getResponseText());
    }

    /**
     * @param User  $user
     * @param array $data
     * @param null  $photo
     * @return GSResponse
     * @throws \Exception
     */
    public static function setUserProfile(User $user, array $data = [], $photo = null)
    {
        $userInfo    = self::getUserInfo($user);
        $userProfile = $userInfo->getObject('profile');

        // Merge/overwrite custom data
        foreach ($data as $k => $v) {
            $userProfile->put($k, $v);
        }

        // Update in Gigya
        $response = self::request(
            'accounts.setAccountInfo',
            [
                'UID'     => $user->gigyaUser->gigya_uid,
                'profile' => $userProfile
            ]
        );

        if (isset($photo)) {
            self::setProfilePhoto($user, $photo);
        }

        if ($response->getErrorCode()) {
            throw new \Exception('Could not update Gigya user profile: ' . $response->getResponseText());
        }

        return $response;
    }

    /**
     * @param $user
     * @param $photo
     * @return GSResponse
     * @throws \Exception
     */
    public static function setProfilePhoto($user, $photo)
    {
        $encode_photo = explode(',', $photo);

        $response = self::request(
            'accounts.setProfilePhoto',
            [
                'UID'        => $user->gigyaUser->gigya_uid,
                'photoBytes' => end($encode_photo),
                'publish'    => true
            ],
            true
        );

        if ($response->getErrorCode()) {
            throw new \Exception('Could not update Gigya user profile photo: ' . $response->getResponseText());
        }
    }

    /**
     * Registration with two steps in Gigya.
     *
     * Registration: https://developers.gigya.com/display/GD/accounts.initRegistration+REST
     *
     * @param $first_name
     * @param $last_name
     * @param $email
     * @param $password
     * @return mixed
     * @throws \Exception
     */
    public static function createUser($first_name, $last_name, $email, $password)
    {
        // InitRegistration
        $response_init_registration = self::request('accounts.initRegistration', []);
        $reg_token = $response_init_registration->getData()->getString('regToken');

        // registration and finalizeRegistration
        $response = self::request(
            'accounts.register', [
                'email' => $email,
                'password' => $password,
                'regToken' => $reg_token,
                'finalizeRegistration' => true,
                'profile' => json_encode([
                    'firstName' => $first_name,
                    'lastName'  => $last_name
                ])
            ],
            true
        );

        return $response;
    }

    /**
     * @param User $user
     *
     * @return array ['status' => boolean, 'message' => string]
     */
    public static function deleteUser(User $user)
    {
        $response = self::request(
            'accounts.deleteAccount',
            [
                'UID' => $user->gigyaUser->gigya_uid,
            ],
            true
        );

        $success = true;
        $message = '';

        if($response->getErrorCode () != 0) {
            $success = false;
            $message = $response->getErrorMessage();
        }

        return [
            $success,
            $message
        ];
    }
}
