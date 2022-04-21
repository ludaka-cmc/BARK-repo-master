<?php

namespace AKCBark\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use AKCBark\Http\Requests\StudentRequest as StoreRequest;
use AKCBark\Http\Requests\StudentRequest as UpdateRequest;
use Backpack\CRUD\CrudPanel;

/**
 * Class StudentCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class StudentCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('AKCBark\Models\Admin\StudentAdmin');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/student');
        $this->crud->setEntityNameStrings('student', 'students');

        $this->crud->setColumns([
            ['name' => 'name', 'label' => 'Name'],
            ['name' => 'email', 'label' => 'Email Address'],
            ['name' => 'address', 'label' => 'Address'],
            ['name' => 'age', 'label' => 'Age'],
            [  // 1-n relationship
                'label' => "State",
                'type' => 'select',
                'name' => 'state_id', // the db column for the foreign key
                'entity' => 'state', // the method that defines the relationship in your Model
                'attribute' => 'title', // foreign key attribute that is shown to user
                'model' => "AKCBark\\Models\\State" // foreign key model
            ],
            [  // 1-n relationship
                'label' => "Guardian",
                'type' => 'select',
                'name' => 'guardian_id', // the db column for the foreign key
                'entity' => 'guardian', // the method that defines the relationship in your Model
                'attribute' => 'name', // foreign key attribute that is shown to user
                'model' => "AKCBark\\Models\\Guardian" // foreign key model
            ],
            [
                'label' => "Total Pages",
                'type' => 'model_function',
                'name' => 'pages',
                'function_name' => 'totalPages',
            ],
            [
                'label' => "Total Hours",
                'type' => 'model_function',
                'name' => 'hours',
                'function_name' => 'totalHours',
            ],
            ['name' => 'status', 'label' => 'Active'],
            ['name' => 'created_at', 'label' => 'Created Date'],
        ]);

        $this->crud->addFields([
            [
                'name' => 'name',
                'label' => 'Name',
                'attributes' => [
                    'required' => true,
                ],
            ],
            [
                'name' => 'email',
                'label' => 'Email Address',
                'attributes' => [
                    'required' => true,
                ],
            ],
            [
                'name' => 'address',
                'label' => 'Address',
                'attributes' => [
                    'required' => true,
                ],
            ],
            ['name' => 'age', 'label' => 'Age'],
            [  // 1-n relationship
                'label' => "State",
                'type' => 'select2',
                'name' => 'state_id', // the db column for the foreign key
                'entity' => 'state', // the method that defines the relationship in your Model
                'attribute' => 'title', // foreign key attribute that is shown to user
                'model' => "AKCBark\\Models\\State" // foreign key model
            ],
            [  // 1-n relationship
                'label' => "Guardian",
                'type' => 'select2',
                'name' => 'guardian_id', // the db column for the foreign key
                'entity' => 'guardian', // the method that defines the relationship in your Model
                'attribute' => 'id', // foreign key attribute that is shown to user
                'model' => "AKCBark\\Models\\Guardian" // foreign key model
            ],
            [
                'name' => 'status',
                'label' => 'Active',
                'attributes' => [
                    'required' => true,
                ],
            ]
        ]);

        // add asterisk for fields that are required in StudentRequest
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
