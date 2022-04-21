<?php

namespace AKCBark\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Studentnum extends Model
{
    CONST MIN_NUM = 1;
    CONST MAX_NUM = 99;

    use SoftDeletes;

    protected $table = 'studentnums';
    protected $fillable = [
        'title',
        'description',
        'num_min',
        'num_max'
    ];

    public static function getStudentnumIdFromValue($count = null) {
        if (!$count || $count < self::MIN_NUM && $count > self::MIN_NUM) {
            return Studentnum::min('id');
        } elseif ($count > self::MAX_NUM) {
            return Studentnum::max('id');
        }

        return Studentnum::where('num_min', '<=',  $count)
            ->where('num_max', '>',  $count)->first()->id;
    }
}
