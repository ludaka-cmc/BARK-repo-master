<?php

namespace AKCBark\Helpers;

use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\ValidationData;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use AKCBark\Models\User;

use Exception;

class JWTTokenHelper
{
    /**
     * Generate a JWT token for a specific user
     *
     * @param User $user
     * @return string
     */
    public static function createTokenFromUser($user) {
        $signer = new Sha256();

        $time = time();
        $tokenObj = (new Builder())
            ->setIssuer(config('jwt.issuer'))
            ->setAudience(config('jwt.audience'))
            ->setId($user->id, true)
            ->setIssuedAt($time)
            ->setNotBefore($time + config('jwt.not_before'))
            ->setExpiration($time + config('jwt.expiration_time'))
            ->set('uid', 1)
            ->set('user_id', $user->id)
            ->set('user_email', $user->email)
            ->sign($signer, config('jwt.signature'))
            ->getToken();

        $token = (string) $tokenObj;

        return $token;
    }

    /**
     * Get a user from JWT Token
     *
     * @return User|null
    */
    public static function getUser() {
        $requestHead = request()->header('Authorization');

        if (!isset($requestHead)) {
            return null;
        }

        $headerParts = explode(' ', $requestHead);

        if (count($headerParts) < 2) {
            return null;
        }

        try {
            $token = (new Parser())->parse((string) $headerParts[1]);
        } catch (Exception $e) {
            return null;
        }

        $validation_data = new ValidationData();
        $validation_data->setCurrentTime(strtotime('-1 month'));

        $user = User::find($token->getClaim('jti'));

        return $user;
    }
}
