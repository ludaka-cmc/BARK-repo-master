<?php

namespace AKCBark\Models\Admin;

use AKCBark\Models\Note;
use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class NoteAdmin extends Note
{
    use CrudTrait;
}
