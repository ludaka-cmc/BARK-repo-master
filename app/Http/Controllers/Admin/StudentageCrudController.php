<?php

namespace AKCBark\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use AKCBark\Http\Requests\StudentageRequest as StoreRequest;
use AKCBark\Http\Requests\StudentageRequest as UpdateRequest;
use Backpack\CRUD\CrudPanel;

/**
 * Class StudentageCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class StudentageCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('AKCBark\Models\Admin\StudentageAdmin');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/studentage');
        $this->crud->setEntityNameStrings('studentage', 'studentages');

        $this->crud->setColumns([
            ['name' => 'title', 'label' => 'Title'],
            ['name' => 'description', 'label' => 'Dropdown Label'],
            ['name' => 'age_min', 'label' => 'Age Min.'],
            ['name' => 'age_max', 'label' => 'Age Max.'],
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
                'name' => 'description',
                'label' => 'Dropdown Label',
                'attributes' => [
                    'required' => true,
                ],
            ],
            [
                'name' => 'age_min',
                'label' => 'Age Min. (please enter an integer)',
                'attributes' => [
                    'required' => true,
                ],
            ],
            [
                'name' => 'age_max',
                'label' => 'Age Max. (please enter an integer)',
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
