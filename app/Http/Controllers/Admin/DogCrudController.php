<?php

namespace AKCBark\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use AKCBark\Http\Requests\DogRequest as StoreRequest;
use AKCBark\Http\Requests\DogRequest as UpdateRequest;
use AKCBark\Models\Breed;
use Backpack\CRUD\CrudPanel;
use Illuminate\Support\Facades\Auth;

/**
 * Class DogCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class DogCrudController extends CrudController
{
    public function setup()
    {
        $this->crud->setModel('AKCBark\Models\Admin\DogAdmin');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/dog');
        $this->crud->setEntityNameStrings('dog', 'dogs');

        // Columns
        $this->crud->setColumns([
            ['name' => 'name', 'label' => 'Name'],
            ['name' => 'breed', 'label' => 'Breed'],
            ['name' => 'registration_number', 'label' => 'Registration #'],
            [  // 1-n relationship
                'label' => "Volunteer ID#",
                'type' => 'select',
                'name' => 'volunteer', // the db column for the foreign key
                'entity' => 'volunteer', // the method that defines the relationship in your Model
                'attribute' => 'id', // foreign key attribute that is shown to user
                'model' => "AKCBark\\Models\\Volunteer" // foreign key model
            ],
            [  // 1-n relationship
                'label' => "Image",
                'type' => 'select',
                'name' => 'media', // the db column for the foreign key
                'entity' => 'media', // the method that defines the relationship in your Model
                'attribute' => 'url', // foreign key attribute that is shown to user
                'model' => "AKCBark\\Models\\Media" // foreign key model
            ],
            ['name' => 'active', 'label' => 'Active?'],
        ]);

        $breed = new Breed();
        $all_breeds = json_decode($breed->getBreeds(), true);
        $breed_dropdown = [];

        foreach ($all_breeds as $breed_data) {
            $breed_dropdown[$breed_data['breed_name_display']] = $breed_data['breed_name_display'];
        }

        // Edit Fields
        $this->crud->addFields([
            [
                'name' => 'name',
                'label' => 'Name',
                'attributes' => [
                    'required' => true,
                ],
            ],
            [
                'name' => 'breed',
                'label' => 'Breed',
                'attributes' => [
                    'required' => true,
                ],
            ],
            [
                'name' => 'breed',
                'label' => 'Breed',
                'type' => 'select_from_array',
                'options' => $breed_dropdown,
                'allows_null' => false,
                'allows_multiple' => false,
            ],
            ['name' => 'registration_number', 'label' => 'Registration #'],
            [  // 1-n relationship
                'label' => "volunteer_id",
                'type' => 'select2',
                'name' => 'volunteer_id', // the db column for the foreign key
                'entity' => 'volunteer', // the method that defines the relationship in your Model
                'attribute' => 'id', // foreign key attribute that is shown to user
                'model' => "AKCBark\\Models\\Volunteer" // foreign key model
            ],
            [
                'name' => 'active',
                'label' => 'Active?',
                'type' => 'select_from_array',
                'default' => 1,
                'options' => [0 => 'false', 1 => 'true'],
                'allows_null' => false,
                'allows_multiple' => false,
            ],
        ]);

        // add asterisk for fields that are required in DogRequest
        $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');
    }

    public function store(StoreRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::storeCrud($request);
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::updateCrud($request);
        return $redirect_location;
    }
}
