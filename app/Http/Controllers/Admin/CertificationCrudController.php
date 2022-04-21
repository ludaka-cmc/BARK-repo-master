<?php

namespace AKCBark\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use AKCBark\Http\Requests\CertificationRequest as StoreRequest;
use AKCBark\Http\Requests\CertificationRequest as UpdateRequest;
use Backpack\CRUD\CrudPanel;

/**
 * Class CertificationCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class CertificationCrudController extends CrudController
{
    public function setup()
    {
        // General
        $this->crud->setModel('AKCBark\Models\Admin\CertificationAdmin');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/certification');
        $this->crud->setEntityNameStrings('certification', 'certifications');

        // Columns
        $this->crud->setColumns([
            ['name' => 'title', 'label' => 'Cert. Name'],
            ['name' => 'description', 'label' => 'Cert. Description'],
            ['name' => 'url', 'label' => 'Tootltip URL'],
            ['name' => 'tooltip_text', 'label' => 'Tooltip Text'],
        ]);

        // Fields
        $this->crud->addFields([
            [
                'name' => 'title',
                'label' => 'Cert. Name',
                'attributes' => [
                    'required' => true,
                ],
            ],
            [
                'name' => 'description',
                'label' => 'Cert. Description',
                'attributes' => [
                    'required' => true,
                ],
            ],
            ['name' => 'url', 'label' => 'Tooltip URL'],
            ['name' => 'tooltip_text', 'label' => 'Tooltip Text', 'type' => 'wysiwyg',],
        ]);

        $this->crud->orderBy('title', 'asc');

        // add asterisk for fields that are required in CertificationRequest
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
