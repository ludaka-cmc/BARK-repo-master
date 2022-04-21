<?php

namespace AKCBark\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use AKCBark\Http\Requests\UserRequest as StoreRequest;
use AKCBark\Http\Requests\UserRequest as UpdateRequest;
use AKCBark\Models\State;
use Backpack\CRUD\CrudPanel;

/**
 * Class UserCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class UserCrudController extends CrudController
{
    public function setup()
    {
        $this->crud->setModel('AKCBark\Models\Admin\UserAdmin');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/user');
        $this->crud->setEntityNameStrings('user', 'users');

        $this->crud->setColumns([
            ['name' => 'id', 'label' => '#'],
            ['name' => 'name', 'label' => 'Name'],
            ['name' => 'email', 'label' => 'Email'],
            [  // 1-n relationship
                'label' => "State",
                'type' => 'select',
                'name' => 'state_id', // the db column for the foreign key
                'entity' => 'state', // the method that defines the relationship in your Model
                'attribute' => 'title', // foreign key attribute that is shown to user
                'model' => "AKCBark\\Models\\State" // foreign key model
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
            ['name' => 'created_at', 'label' => 'Created Date', 'attributes' => ['readonly' => 'readonly']],
            ['name' => 'admin', 'label' => 'Admin', 'type' => 'check'],
        ]);

        $this->crud->addFields([
            ['name' => 'id', 'label' => 'user_id', 'attributes' => ['readonly' => 'readonly']],
            ['name' => 'name', 'label' => 'Name'],
            ['name' => 'email', 'label' => 'Email', 'attributes' => ['readonly' => 'readonly']],
            [  // 1-n relationship
                'label' => "State",
                'type' => 'select',
                'name' => 'state_id', // the db column for the foreign key
                'entity' => 'state', // the method that defines the relationship in your Model
                'attribute' => 'title', // foreign key attribute that is shown to user
                'model' => "AKCBark\\Models\\State" // foreign key model
            ],
            ['name' => 'created_at', 'label' => 'Created Date', 'attributes' => ['readonly' => 'readonly']],
            ['name' => 'admin', 'label' => 'Admin', 'type' => 'checkbox'],
        ]);

        // add asterisk for fields that are required in UserRequest
        $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');

        $this->crud->removeButton('create');
        $this->crud->removeButton('delete');
    }

    public function store(StoreRequest $request)
    {
        $redirect_location = parent::storeCrud($request);

        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        $redirect_location = parent::updateCrud($request);

        return $redirect_location;
    }
}
