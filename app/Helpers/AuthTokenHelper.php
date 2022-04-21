<?php

namespace AKCBark\Helpers;

use AKCBark\Models\User;
use Carbon\Carbon;
use Laravel\Passport\Token;
use Lcobucci\JWT\Parser;
use Exception;

class AuthTokenHelper
{
    protected static function getToken() {
        $token_str = request()->bearerToken();

        try {
            $token_id = (new Parser())->parse($token_str)->getHeader('jti');

            return Token::find($token_id);
        } catch (\InvalidArgumentException $e) {

        }

        return null;
    }

    public static function getUser() {
        try {
            $token = self::getToken();

            if ($token && !$token->revoked && $token->expires_at > Carbon::now()) {
                return User::find($token->user_id);
            }
        } catch (\InvalidArgumentException $e) {

        }

        return null;
    }

    public static function getUserTokens($user_id) {
        $tokens = Token::orderby('created_at', 'desc')
            ->where('user_id', $user_id)
            ->where('revoked', 0)
            ->get();

        return $tokens;
    }

    public static function revokeUserTokens($user_id) {
        $tokens = Token::orderby('created_at', 'desc')
            ->where('user_id', $user_id)
            ->where('revoked', 0)
            ->update([
                'revoked' => 1,
                'updated_at' => Carbon::now()
            ]);
    }
}
