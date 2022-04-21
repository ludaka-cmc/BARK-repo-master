<?php

namespace AKCBark\Models;

use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Volunteer extends Model
{
    use SoftDeletes;

    protected $table = 'volunteers';
    protected $fillable = [
        'user_id',
        'address',
        'city',
        'media_id',
        'state_id',
        'zip_code',
        'affiliated_program',
        'email_alert_public_education',
        'canine_ambassador'
    ];

    public function user() {
        return $this->belongsTo('AKCBark\Models\User');
    }

    public function state() {
        return $this->belongsTo('AKCBark\Models\State');
    }

    public function media() {
        return $this->belongsTo('AKCBark\Models\Media');
    }

    public function totalHours() {
        if ($this->user) {
            return $this->total_hours = $this->user->totalHours();
        }

        return 0;
    }

    public function totalPages() {
        if ($this->user) {
            return $this->total_pages = $this->user->totalPages();
        }

        return 0;
    }
}
