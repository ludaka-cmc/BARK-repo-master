<?php

namespace AKCBark\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use AKCBark\Http\Requests\ProgramRequest as StoreRequest;
use AKCBark\Http\Requests\ProgramRequest as UpdateRequest;
use Backpack\CRUD\CrudPanel;

/**
 * Class ProgramCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class ProgramCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('AKCBark\Models\Admin\ProgramAdmin');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/program');
        $this->crud->setEntityNameStrings('program', 'programs');

        // Columns
        $this->crud->setColumns([
            [  // 1-n relationship
                'label' => "Student",
                'type' => 'select',
                'name' => 'student', // the db column for the foreign key
                'entity' => 'student', // the method that defines the relationship in your Model
                'attribute' => 'name', // foreign key attribute that is shown to user
                'model' => "AKCBark\\Models\\Student" // foreign key model
            ],
        ]);

        // Edit Fields
        $this->crud->addFields([
            [  // 1-n relationship
                'label' => "Student",
                'type' => 'select2',
                'name' => 'student_id', // the db column for the foreign key
                'entity' => 'student', // the method that defines the relationship in your Model
                'attribute' => 'name', // foreign key attribute that is shown to user
                'model' => "AKCBark\\Models\\Student" // foreign key model
            ],
        ]);

        // add asterisk for fields that are required in TextblockRequest
        $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');
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
