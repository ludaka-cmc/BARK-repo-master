<?php

namespace AKCBark\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use AKCBark\Http\Requests\LocationRequest as StoreRequest;
use AKCBark\Http\Requests\LocationRequest as UpdateRequest;
use Backpack\CRUD\CrudPanel;

/**
 * Class LocationCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class LocationCrudController extends CrudController
{
    public function setup()
    {
        // General
        $this->crud->setModel('AKCBark\Models\Admin\LocationAdmin');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/location');
        $this->crud->setEntityNameStrings('location', 'locations');

        // Columns
        $this->crud->setColumns([
            ['name' => 'id', 'label' => '#'],
            ['name' => 'title', 'label' => 'location_id'],
            ['name' => 'description', 'label' => 'Location Name'],
        ]);

        // Fields
        $this->crud->addFields([
            [
                'name' => 'title',
                'label' => 'location_id',
                'attributes' => [
                    'required' => true,
                ],
            ],
            [
                'name' => 'description',
                'label' => 'Location Name',
                'attributes' => [
                    'required' => true,
                ],
            ],
        ]);

        $this->crud->orderBy('id', 'asc');

        // add asterisk for fields that are required in LocationRequest
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
