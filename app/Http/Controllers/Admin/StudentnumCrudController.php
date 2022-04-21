<?php

namespace AKCBark\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use AKCBark\Http\Requests\StudentnumRequest as StoreRequest;
use AKCBark\Http\Requests\StudentnumRequest as UpdateRequest;
use Backpack\CRUD\CrudPanel;

/**
 * Class StudentnumCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class StudentnumCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('AKCBark\Models\Admin\StudentnumAdmin');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/studentnum');
        $this->crud->setEntityNameStrings('studentnum', 'studentnums');

        $this->crud->setColumns([
            ['name' => 'title', 'label' => 'Title'],
            ['name' => 'description', 'label' => 'Dropdown Label'],
            ['name' => 'num_min', 'label' => '# Readers Min.'],
            ['name' => 'num_max', 'label' => '# Readers Max.'],
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
                'name' => 'num_min',
                'label' => '# Readers Min. (please enter an integer)',
                'attributes' => [
                    'required' => true,
                ],
            ],
            [
                'name' => 'num_max',
                'label' => '# Readers Max. (please enter an integer)',
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
