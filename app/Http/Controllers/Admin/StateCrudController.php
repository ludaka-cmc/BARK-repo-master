<?php

namespace AKCBark\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use AKCBark\Http\Requests\StateRequest as StoreRequest;
use AKCBark\Http\Requests\StateRequest as UpdateRequest;
use Backpack\CRUD\CrudPanel;

/**
 * Class StateCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class StateCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('AKCBark\Models\Admin\StateAdmin');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/state');
        $this->crud->setEntityNameStrings('state', 'states');

        $this->crud->setColumns([
            ['name' => 'title', 'label' => 'State Code'],
            ['name' => 'description', 'label' => 'State Name'],
        ]);

        $this->crud->addFields([
            [
                'name' => 'title',
                'label' => 'State Code',
                'attributes' => [
                    'required' => true,
                ],
            ],
            [
                'name' => 'description',
                'label' => 'State Name',
                'attributes' => [
                    'required' => true,
                ],
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
