<?php

namespace AKCBark\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GigyaUser extends Model
{
    use SoftDeletes;
    use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

    protected $table = 'gigya_users';
    protected $hidden = ['gigya_uid'];
    protected $fillable = [
        'user_id',
        'gigya_uid',
        'provider',
        'email',
        'welcomeemail',
        'state_id'
    ];

    protected $softCascade = ['user'];

    public function user() {
        return $this->belongsTo('AKCBark\Models\User');
    }
}
