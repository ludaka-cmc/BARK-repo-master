<?php

namespace AKCBark\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use AKCBark\Http\Requests\LogRequest as StoreRequest;
use AKCBark\Http\Requests\LogRequest as UpdateRequest;
use Backpack\CRUD\CrudPanel;

/**
 * Class LogCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class LogCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('AKCBark\Models\Admin\LogAdmin');

        $this->crud->setRoute(config('backpack.base.route_prefix') . '/log');
        $this->crud->setEntityNameStrings('log', 'logs');

        // Columns
        $this->crud->setColumns([
            [  // 1-n relationship
                'label' => "Location",
                'type' => 'select',
                'name' => 'location', // the db column for the foreign key
                'entity' => 'location', // the method that defines the relationship in your Model
                'attribute' => 'description', // foreign key attribute that is shown to user
                'model' => "AKCBark\\Models\\Location" // foreign key model
            ],
            [  // 1-n relationship
                'label' => "Num. Reader(s)",
                'type' => 'select',
                'name' => 'studentnum',
                'entity' => 'studentnum',
                'attribute' => 'description',
                'model' => "AKCBark\\Models\\Studentnum"
            ],
            [  // 1-n relationship
                'label' => "Age of Reader(s)",
                'type' => 'select',
                'name' => 'studentage',
                'entity' => 'studentage',
                'attribute' => 'description',
                'model' => "AKCBark\\Models\\Studentage"
            ],
            ['name' => 'log_usertype', 'label' => 'Reader/Volunteer?'],
            ['name' => 'hours', 'label' => '# Hours'],
            ['name' => 'pages', 'label' => '# Pages'],
            ['name' => 'book_read', 'label' => 'Book Title']
        ]);

        // Edit Fields
        $this->crud->addFields([
            [  // 1-n relationship
                'label' => "location_id",
                'type' => 'select2',
                'name' => 'location_id', // the db column for the foreign key
                'entity' => 'location', // the method that defines the relationship in your Model
                'attribute' => 'title', // foreign key attribute that is shown to user
                'model' => "AKCBark\\Models\\Location" // foreign key model
            ],
            [  // 1-n relationship
                'label' => "Num. Reader(s)",
                'type' => 'select2',
                'name' => 'studentnum_id',
                'entity' => 'studentnum',
                'attribute' => 'description',
                'model' => "AKCBark\\Models\\Studentnum"
            ],
            [  // 1-n relationship
                'label' => "Age of Reader(s)",
                'type' => 'select2',
                'name' => 'studentage_id',
                'entity' => 'studentage',
                'attribute' => 'description',
                'model' => "AKCBark\\Models\\Studentage"
            ],
            [
                'name' => 'log_usertype',
                'label' => 'Reader or Volunteer?',
                'type' => 'select_from_array',
                'options' => ['reader', 'volunteer'],
                'allows_null' => false,
                'allows_multiple' => false,
            ],
            ['name' => 'hours', 'label' => '# Hours'],
            ['name' => 'pages', 'label' => '# Pages'],
            ['name' => 'book_read', 'label' => 'Name of Book']
        ]);

        // add asterisk for fields that are required in LogRequest
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
