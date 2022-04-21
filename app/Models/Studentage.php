<?php

namespace AKCBark\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Studentage extends Model
{
    CONST MIN_AGE = 2;
    CONST MAX_AGE = 100;

    use SoftDeletes;

    protected $table = 'studentages';
    protected $fillable = [
        'title',
        'description',
        'age_min',
        'age_max'
    ];

    public static function getStudentageIdFromAgeValue($age = null) {
        if (!$age || $age < self::MIN_AGE && $age > self::MIN_AGE) {
            return Studentage::min('id');
        } elseif ($age > self::MAX_AGE) {
            return Studentage::max('id');
        }

        return Studentage::where('age_min', '<=',  $age)
            ->where('age_max', '>',  $age)->first()->id;
    }
}
