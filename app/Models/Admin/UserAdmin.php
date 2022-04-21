<?php

namespace AKCBark\Models\Admin;

use AKCBark\Models\User;
use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class UserAdmin extends User
{
    use CrudTrait;
}
