<?php

namespace AKCBark\Models\Admin;

use AKCBark\Models\Volunteer;
use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class VolunteerAdmin extends Volunteer
{
    use CrudTrait;
}
