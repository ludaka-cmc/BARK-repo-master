<?php

namespace AKCBark\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use AKCBark\Http\Requests\MilestoneRequest as StoreRequest;
use AKCBark\Http\Requests\MilestoneRequest as UpdateRequest;
use Backpack\CRUD\CrudPanel;

/**
 * Class MilestoneCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class MilestoneCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('AKCBark\Models\Admin\MilestoneAdmin');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/milestone');
        $this->crud->setEntityNameStrings('milestone', 'milestones');

        $this->crud->setColumns([
            ['name' => 'title', 'label' => 'ID'],
            ['name' => 'description', 'label' => 'Display Text'],
            ['name' => 'num_hours', 'label' => '# Hours'],
        ]);

        $this->crud->addFields([
            ['name' => 'title', 'label' => 'ID', 'attributes' => ['required' => true,]],
            ['name' => 'description', 'label' => 'Display Text', 'attributes' => ['required' => true,]],
            ['name' => 'num_hours', 'label' => '# Hours', 'attributes' => ['required' => true,]],
        ]);

        // add asterisk for fields that are required in MilestoneRequest
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
