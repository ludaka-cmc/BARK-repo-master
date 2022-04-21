<?php

namespace AKCBark\Models\Admin;

use AKCBark\Models\Dog;
use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class DogAdmin extends Dog
{
    use CrudTrait;
}
