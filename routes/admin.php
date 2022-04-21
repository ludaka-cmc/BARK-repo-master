<?php

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

// Route::group([
//     'prefix'     => config('backpack.base.route_prefix', 'admin'),
//     'middleware' => ['web', config('backpack.base.middleware_key', 'admin')],
//     'namespace'  => 'AKCBark\Http\Controllers\Admin',
// ], function () { // custom admin routes
    CRUD::resource('tag', 'TagCrudController');
    CRUD::resource('testdog', 'TestdogCrudController');
    CRUD::resource('page', 'PageCrudController');
    CRUD::resource('textblock', 'TextblockCrudController');
    CRUD::resource('certification', 'CertificationCrudController');
    CRUD::resource('dog', 'DogCrudController');
    CRUD::resource('studentnum', 'StudentnumCrudController');
    CRUD::resource('studentage', 'StudentageCrudController');
    CRUD::resource('log', 'LogCrudController');
    CRUD::resource('volunteer', 'VolunteerCrudController');
    CRUD::resource('student', 'StudentCrudController');
    CRUD::resource('guardian', 'GuardianCrudController');
    CRUD::resource('program', 'ProgramCrudController');
    CRUD::resource('state', 'StateCrudController');
    CRUD::resource('location', 'LocationCrudController');
    CRUD::resource('note', 'NoteCrudController');
    CRUD::resource('state', 'StateCrudController');
    CRUD::resource('volunteer', 'VolunteerCrudController');
    CRUD::resource('gigyauser', 'GigyaUserCrudController');
    CRUD::resource('user', 'UserCrudController');
    CRUD::resource('milestone', 'MilestoneCrudController');
// }); // this should be the absolute last line of this file