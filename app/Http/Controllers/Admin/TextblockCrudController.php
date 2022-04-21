<?php

namespace AKCBark\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use AKCBark\Http\Requests\TextblockRequest as StoreRequest;
use AKCBark\Http\Requests\TextblockRequest as UpdateRequest;
use Backpack\CRUD\CrudPanel;

/**
 * Class TextblockCrudController
 * @package AKCBark\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class TextblockCrudController extends CrudController
{
    public function setup()
    {
        // General
        $this->crud->setModel('AKCBark\Models\Admin\TextblockAdmin');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/textblock');
        $this->crud->setEntityNameStrings('textblock', 'textblocks');

        // Columns
        $this->crud->setColumns([
            ['name' => 'title', 'label' => 'textblock_id'],
            [  // 1-n relationship
                'label' => "page_id",
                'type' => 'select',
                'name' => 'page', // the db column for the foreign key
                'entity' => 'page', // the method that defines the relationship in your Model
                'attribute' => 'title', // foreign key attribute that is shown to user
                'model' => "AKCBark\\Models\\Page" // foreign key model
            ],
            ['name' => 'description', 'label' => 'description'],
            ['name' => 'text', 'label' => 'textarea'],
            ['name' => 'weight', 'label' => 'weight'],
        ]);

        // Edit Fields
        $this->crud->addFields([
            [
                'name' => 'title',
                'label' => 'textblock_id',
                'attributes' => [
                    'required' => true,
                ],
            ],
            [  // Select2
                'label' => "page_id",
                'type' => 'select2',
                'name' => 'page_id', // the db column for the foreign key
                'entity' => 'page', // the method that defines the relationship in your Model
                'attribute' => 'title', // foreign key attribute that is shown to user
                'model' => "AKCBark\\Models\\Page" // foreign key model
            ],
            [
                'name' => 'description',
                'label' => 'description',
                'attributes' => [
                    'required' => true,
                ],
            ],
            [
                'name' => 'text',
                'label' => 'textarea',
                'type' => 'ckeditor',
                'attributes' => [
                    'required' => true,
                ],
            ],
            [
                'name' => 'weight',
                'label' => 'weight',
                'attributes' => [
                    'required' => true,
                ],
            ],
        ]);

        // add asterisk for fields that are required in TextblockRequest
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
