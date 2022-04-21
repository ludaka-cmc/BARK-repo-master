<?php

namespace AKCBark\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use AKCBark\Http\Requests\GigyaUserRequest as StoreRequest;
use AKCBark\Http\Requests\GigyaUserRequest as UpdateRequest;
use Backpack\CRUD\CrudPanel;

/**
 * Class GigyaUserCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class GigyaUserCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('AKCBark\Models\Admin\GigyaUserAdmin');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/gigyauser');
        $this->crud->setEntityNameStrings('gigyauser', 'Users (Gigya)');

        // Columns
        $this->crud->setColumns([
            ['name' => 'user_id', 'label' => 'user_id'],
            ['name' => 'gigya_uid', 'label' => 'gigya_uid'],
            ['name' => 'email', 'label' => 'Email Address'],
            ['name' => 'provider', 'label' => 'Provider'],
            ['name' => 'created_at', 'label' => 'Created Date'],
        ]);

        // Edit Fields
        $this->crud->addFields([
            [
                'name' => 'gigya_uid',
                'label' => 'Gigya UID',
                'attributes' => [
                    'required' => true,
                ],
            ],
            [
                'name' => 'provider',
                'label' => 'Provider',
            ],
            [
                'name' => 'email',
                'label' => 'Email',
            ],
        ]);

        $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');
    }

    public function store(StoreRequest $request)
    {
        $redirect_location = parent::storeCrud($request);
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        $redirect_location = parent::updateCrud($request);
        return $redirect_location;
    }
}
