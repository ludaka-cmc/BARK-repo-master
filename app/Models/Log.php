<?php

namespace AKCBark\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Log extends Model
{
    use SoftDeletes;

    CONST LOG_READER = 'reader';
    CONST LOG_VOLUNTEER = 'volunteer';

    protected $table = 'logs';
    protected $fillable = [
        'user_id',
        'log_usertype',
        'student_name',
        'dog_id',
        'dog_name',
        'media_id',
        'location_id',
        'location_other',
        'studentnum_id',
        'studentage_id',
        'book_read',
        'hours',
        'pages',
        'log_date',
        'has_coppa'
    ];

    public function dog() {
        return $this->belongsTo('AKCBark\Models\Dog');
    }

    public function location() {
        return $this->belongsTo('AKCBark\Models\Location');
    }

    public function studentage() {
        return $this->belongsTo('AKCBark\Models\Studentage');
    }

    public function studentnum() {
        return $this->belongsTo('AKCBark\Models\Studentnum');
    }
}
