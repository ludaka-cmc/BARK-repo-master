<?php

namespace AKCBark\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use AKCBark\Http\Requests\NoteRequest as StoreRequest;
use AKCBark\Http\Requests\NoteRequest as UpdateRequest;
use Backpack\CRUD\CrudPanel;

/**
 * Class NoteCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class NoteCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('AKCBark\Models\Admin\NoteAdmin');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/note');
        $this->crud->setEntityNameStrings('note', 'notes');

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */

        $this->crud->setColumns([
            ['name' => 'title', 'label' => 'Title'],
            ['name' => 'body', 'label' => 'Body'],
            [  // 1-n relationship
                'label' => "Dog",
                'type' => 'select',
                'name' => 'dog', // the db column for the foreign key
                'entity' => 'dog', // the method that defines the relationship in your Model
                'attribute' => 'name', // foreign key attribute that is shown to user
                'model' => "AKCBark\\Models\\Dog" // foreign key model
            ],
            [  // 1-n relationship
                'label' => "Student",
                'type' => 'select',
                'name' => 'student', // the db column for the foreign key
                'entity' => 'student', // the method that defines the relationship in your Model
                'attribute' => 'name', // foreign key attribute that is shown to user
                'model' => "AKCBark\\Models\\Student" // foreign key model
            ],
        ]);

        $this->crud->addFields([
            [
                'name' => 'title',
                'label' => 'Title',
                'attributes' => [
                    'required' => true,
                ],
            ],
            [
                'name' => 'body',
                'label' => 'Body',
                'type' => 'textarea',
                'attributes' => [
                    'required' => true,
                ],
            ],
            [  // 1-n relationship
                'label' => "Dog",
                'type' => 'select2',
                'name' => 'dog_id', // the db column for the foreign key
                'entity' => 'dog', // the method that defines the relationship in your Model
                'attribute' => 'name', // foreign key attribute that is shown to user
                'model' => "AKCBark\\Models\\Dog" // foreign key model
            ],
            [  // 1-n relationship
                'label' => "Student",
                'type' => 'select2',
                'name' => 'student_id', // the db column for the foreign key
                'entity' => 'student', // the method that defines the relationship in your Model
                'attribute' => 'name', // foreign key attribute that is shown to user
                'model' => "AKCBark\\Models\\Student" // foreign key model
            ],
        ]);
    }

    public function store(StoreRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::storeCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::updateCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }
}
