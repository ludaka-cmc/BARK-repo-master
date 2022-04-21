<?php

namespace AKCBark\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use AKCBark\Http\Requests\GuardianRequest as StoreRequest;
use AKCBark\Http\Requests\GuardianRequest as UpdateRequest;
use Backpack\CRUD\CrudPanel;

/**
 * Class GuardianCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class GuardianCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('AKCBark\Models\Admin\GuardianAdmin');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/guardian');
        $this->crud->setEntityNameStrings('guardian', 'guardians');

        $this->crud->setColumns([
            ['name' => 'name', 'label' => 'Name'],
            ['name' => 'relationship', 'label' => 'Relationship'],
            ['name' => 'release_form', 'label' => 'Release Form'],
            [  // 1-n relationship
                'label' => "Program",
                'type' => 'select',
                'name' => 'program_id', // the db column for the foreign key
                'entity' => 'program', // the method that defines the relationship in your Model
                'attribute' => 'student_id', // foreign key attribute that is shown to user
                'model' => "AKCBark\\Models\\Program" // foreign key model
            ],
            [  // 1-n relationship
                'label' => "State",
                'type' => 'select',
                'name' => 'state_id', // the db column for the foreign key
                'entity' => 'state', // the method that defines the relationship in your Model
                'attribute' => 'title', // foreign key attribute that is shown to user
                'model' => "AKCBark\\Models\\State" // foreign key model
            ],
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
                'name' => 'relationship',
                'label' => 'Relationship',
                'attributes' => [
                    'required' => true,
                ],
            ],
            [
                'name' => 'release_form',
                'label' => 'Release Form',
                'attributes' => [
                    'required' => true,
                ],
            ],
            ['name' => 'program_id', 'label' => 'program_id'],
            [  // 1-n relationship
                'label' => "State",
                'type' => 'select2',
                'name' => 'state_id', // the db column for the foreign key
                'entity' => 'state', // the method that defines the relationship in your Model
                'attribute' => 'title', // foreign key attribute that is shown to user
                'model' => "AKCBark\\Models\\State" // foreign key model
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
