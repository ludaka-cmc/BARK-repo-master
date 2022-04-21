<?php

namespace AKCBark\Models;

use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use CrudTrait;

    protected $table = 'students';
    protected $fillable = [
        'user_id',
        'guardian_id',
        'state_id',
        'name',
        'age',
        'email',
        'address',
        'status'
    ];

    public function guardian() {
        return $this->belongsTo('AKCBark\Models\Guardian');
    }

    public function state() {
        return $this->belongsTo('AKCBark\Models\State');
    }

    public function user() {
        return $this->belongsTo('AKCBark\Models\User');
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
