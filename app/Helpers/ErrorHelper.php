<?php

namespace AKCBark\Helpers;

use Illuminate\Support\Facades\Log;

class ErrorHelper {
    const ERROR_CODE_UNKNOWN = 'unknown_error';
    const ERROR_CODE_DUPLICATE_REG_NUM = 'duplicate_registration_code';
    const ERROR_CODE_USER_NOT_FOUND = 'user_not_found';
    const ERROR_CODE_USER_INVALID = 'invalid_user_signature';
    const ERROR_CODE_DATE_INVALID = 'invalid_date';
    const ERROR_CODE_BIRTHDAY_DATE_INVALID = 'invalid_birthday_date';

    public function getErrorCode($error_message, $classname = null) {
        Log::info([
            'classname' => $classname,
            'error_message' => $error_message
        ]);

        if (strpos($error_message, 'Integrity constraint violation') !== false) {
            if (strpos($error_message, 'registration_number') !== false) {
                return self::ERROR_CODE_DUPLICATE_REG_NUM;
            }
        }

        if (strpos($error_message, 'user_not_found') !== false) {
            return self::ERROR_CODE_USER_NOT_FOUND;
        }

        if (strpos($error_message, 'invalid_user_signature') !== false) {
            return self::ERROR_CODE_USER_INVALID;
        }

        if (strpos($error_message, 'invalid_date') !== false) {
            return self::ERROR_CODE_DATE_INVALID;
        }

        if (strpos($error_message, 'invalid_birthday_date') !== false) {
            return self::ERROR_CODE_BIRTHDAY_DATE_INVALID;
        }

        return self::ERROR_CODE_UNKNOWN;
    }
}
