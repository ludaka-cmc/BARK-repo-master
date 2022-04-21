<?php

namespace AKCBark\Models\Admin;

use AKCBark\Models\Location;
use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class LocationAdmin extends Location
{
    use CrudTrait;
}
