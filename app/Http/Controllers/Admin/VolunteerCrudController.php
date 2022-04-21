<?php

namespace AKCBark\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use AKCBark\Http\Requests\VolunteerRequest as StoreRequest;
use AKCBark\Http\Requests\VolunteerRequest as UpdateRequest;
use Backpack\CRUD\CrudPanel;

/**
 * Class VolunteerCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class VolunteerCrudController extends CrudController
{
    public function setup()
    {
        $this->crud->setModel('AKCBark\Models\Admin\VolunteerAdmin');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/volunteer');
        $this->crud->setEntityNameStrings('volunteer', 'volunteers');

        // Columns
        $this->crud->setColumns([
            ['name' => 'id', 'label' => '#'],
            ['name' => 'user_id', 'label' => 'user_id'],
            [  // 1-n relationship
                'label' => "Name",
                'type' => 'select',
                'name' => 'user', // the db column for the foreign key
                'entity' => 'user', // the method that defines the relationship in your Model
                'attribute' => 'name', // foreign key attribute that is shown to user
                'model' => "AKCBark\\Models\\User" // foreign key model
            ],
            ['name' => 'address', 'label' => 'Address'],
            ['name' => 'city', 'label' => 'City'],
            [  // 1-n relationship
                'label' => "State",
                'type' => 'select',
                'name' => 'state_id', // the db column for the foreign key
                'entity' => 'state', // the method that defines the relationship in your Model
                'attribute' => 'title', // foreign key attribute that is shown to user
                'model' => "AKCBark\\Models\\State" // foreign key model
            ],
            ['name' => 'zip_code', 'label' => 'Zip Code'],
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
            ['name' => 'affiliated_program', 'label' => 'Affil. Program'],
            ['name' => 'email_alert_public_education', 'label' => 'Public Ed (Opt In)'],
            ['name' => 'canine_ambassador', 'label' => 'Canine Ambassador?'],
        ]);

        // Edit Fields
        $this->crud->addFields([
            [  // 1-n relationship
                'label' => "user_id",
                'type' => 'select2',
                'name' => 'user_id', // the db column for the foreign key
                'entity' => 'user', // the method that defines the relationship in your Model
                'attribute' => 'id', // foreign key attribute that is shown to user
                'model' => "AKCBark\\Models\\User" // foreign key model
            ],
            [
                'name' => 'address',
                'label' => 'Address',
                'attributes' => [
                    'required' => true,
                ],
            ],
            [
                'name' => 'city',
                'label' => 'City',
                'attributes' => [
                    'required' => true,
                ],
            ],
            [  // 1-n relationship
                'label' => "State",
                'type' => 'select2',
                'name' => 'state_id', // the db column for the foreign key
                'entity' => 'state', // the method that defines the relationship in your Model
                'attribute' => 'title', // foreign key attribute that is shown to user
                'model' => "AKCBark\\Models\\State" // foreign key model
            ],
            [
                'name' => 'zip_code',
                'label' => 'Zip Code',
                'attributes' => [
                    'required' => true,
                ],
            ],
            [
                'name' => 'affiliated_program',
                'label' => 'Affiliated Program',
                'default' => 'n/a'
            ],
            [
                'name' => 'email_alert_public_education',
                'label' => 'Public Ed Email (Opt In)',
                'type' => 'select_from_array',
                'default' => 1,
                'options' => [0 => 'false', 1 => 'true'],
                'allows_null' => false,
                'allows_multiple' => false,
            ],
            [
                'name' => 'canine_ambassador',
                'label' => 'Is Canine Ambassador?',
                'type' => 'select_from_array',
                'default' => 1,
                'options' => [0 => 'false', 1 => 'true'],
                'allows_null' => false,
                'allows_multiple' => false,
            ],
        ]);

        // add asterisk for fields that are required in VolunteerRequest
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
