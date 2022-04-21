<?php

namespace AKCBark\Models\Admin;

use AKCBark\Models\Milestone;
use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class MilestoneAdmin extends Milestone
{
    use CrudTrait;
}
