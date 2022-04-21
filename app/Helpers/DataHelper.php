<?php

namespace AKCBark\Helpers;

use Carbon\Carbon;

class DataHelper
{
    public static function getCurrentAgeFromBirthdate($birthdate) {
        if ($birthdate) {
            $birthdate = Carbon::parse($birthdate);
            $now = Carbon::now();

            return $birthdate->diffInYears($now);;
        }

        return null;
    }

    public static function getHoursFromTimeReadString($time_read) {
        if ($time_read) {
            return str_replace(' Hours', "", $time_read);
        }

        return null;
    }
}
