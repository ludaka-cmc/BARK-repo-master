<?php

namespace AKCBark\Models;

use AKCBark\Services\Auth\AuthService;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use DB;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, SoftDeletes;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'last_gigya_user_id',
        'admin',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'admin',
        'password',
        'shadow_id',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function state() {
        return $this->belongsTo('AKCBark\Models\State');
    }

    /**
     * Get Gigya Data
     *
     * Pull user information in Gigya for this User UID.
     * Does not save data in database.
     *
     * @throws Exception
     */
    public function getGigyaData() {
        $auth_service = resolve(AuthService::class);
        $auth_service->pullGigyaData($this);
    }

    public function gigyaUsers() {
        return $this->hasMany('AKCBark\Models\GigyaUser');
    }

    public function gigyaUser() {
        if ($this->last_gigya_user_id) {
            return $this->hasOne('AKCBark\Models\GigyaUser', 'id', 'last_gigya_user_id');
        } else {
            return $this->hasOne('AKCBark\Models\GigyaUser');
        }
    }

    public function log() {
        return $this->hasOne('AKCBark\Models\Log');
    }

    public function volunteer() {
        return $this->hasOne('AKCBark\Models\Volunteer');
    }

    public function totalHours() {
        $query = Log::query();
        $hours = $query->select(DB::raw("SUM(hours) as hourssum"))
            ->where('user_id', $this->id)
            ->get();

        return $this->total_hours = (float) $hours->toArray()[0]['hourssum'];
    }

    public function totalPages() {
        $query = Log::query();
        $pages = $query->select(DB::raw("SUM(pages) as pagessum"))
            ->where('user_id', $this->id)
            ->get();

        return $this->total_pages = (int) $pages->toArray()[0]['pagessum'];
    }
}
