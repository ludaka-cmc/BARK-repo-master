# AKC B.A.R.K. (Be a Reading Kid)

Repository for the AKC B.A.R.K. (https://reading.akc.org) Website

# Table of Contents

* [Setting up your local environment](#setting-up-your-local-environment)
   * [Requirements](#requirements)
   * [Localhost domain alias](#localhost-domain-alias)
   * [Steps for Docker](#steps-for-docker)

### Requirements

You can set it up via Docker, Laravel Homestead, or any LEMP+Node environment as long as it has:

- PHP 7.1
- MySQL 5.6

You will also need:

- Composer
- Node 6 or 8

### Localhost domain alias

Some services (like Gigya) are whitelisted by domain. In order to make sure all services work, set up your virtual host as `local.reading.akc.org`

No SSL is required on your local env.

### Steps for Docker

- Clone and cd into project:
```bash
$ git clone git@github.com:akc-org/BARK.git
$ cd BARK
```

- Build and up Docker environment:
```bash
$ docker-compose build
$ docker-compose up -d database
$ docker-compose up -d
```

- Enter to `bark_app` container (`docker exec -it bark_app_1 bash`):
```bash
$ cp .env.example .env             # and then fill in .env as needed
$ chmod 777 -R storage
$ chmod 777 -R bootstrap/cache
$ composer update
$ php artisan backpack:base:install
$ php artisan backpack:crud:install
$ exit
```

- on your local machine:
```bash
$ php artisan key:generate
$ php artisan migrate
$ php artisan db:seed
$ npm install
$ npm run dev # One time build
$ npm run hot # Changes to the assets are automatically rebuilt and your browser will be refreshed.
```

- For production builds:
```bash
$ npm run production
```

```bash
php artisan passport:install
```

- Finally, add in your `/etc/hosts` the `APP_URL` to match with your localhost:
```bash
127.0.0.1	local.reading.akc.org      # this is an example
```

- Test backend (API) routes:
http://local.reading.akc.org/api/dogs

- Test frontend (Web/React) routes:
http://local.reading.akc.org/dogs

### Development Notes

### Backpack Admin CRUD & Schema Generators
#### STEP 1. create migration
```bash
$ php artisan make:migration:schema create_testdogs_table --model=0 --schema="name:string, owner:string, breed:integer, reg_number:string:unique, certifications:string:nullable, state:char(2), status:enum(['new','active','disabled']):active"
```
Note: This will generate the following schema:
```
Schema::create('testdogs', function (Blueprint $table) {
    $table->increments('id');
    $table->string('name');
    $table->string('owner');
    $table->integer('breed');
    $table->string('reg_number')->unique();
    $table->string('certifications')->nullable();
    $table->char('state', 2);
    $table->enum('status', ['new', 'active', 'disabled'])->active();
    $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')); $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
});
```

#### STEP 2. Create a model, a request and a controller for the admin panel
```bash
php artisan backpack:crud testdog #use singular, not plural
```

#### STEP 3. Add route to routes/backpack/custom.php (under the admin prefix and auth middleware):
```bash
php artisan backpack:base:add-custom-route "CRUD::resource('testdog', 'TestdogCrudController');"
```

#### STEP 4. Add sidebar item
```bash
php artisan backpack:base:add-sidebar-content "<li><a href='{{ backpack_url('testdog') }}'><i class='fa fa-tag'></i> <span>Dogs</span></a></li>"
```

#### STEP 5. Re-run migration scripts
```bash
php artisan migrate
```

Notes:
* If a "The model does not exist." error appears, please check the newly created CRUD controller to ensure that the model's namespace is set correctly
* By default, Backpack will allow for open registration to admin if `APP_ENV` is set to 'local'

For additonal info, please see: https://backpackforlaravel.com/

#### Frontend

* The frontend is completely handled by [React](https://reactjs.org/), [React Router](https://reacttraining.com/react-router/), and [axios](https://github.com/axios/axios). Styling follows the pattern of CSS-in-JS using [Styled Components](https://www.styled-components.com/)
* The frontend strictly follows [StandardJS](https://standardjs.com/). All commits will be checked using a precommit hook
   * For a smoother frontend development experience, please install one of their [editor plugins](https://standardjs.com/#are-there-text-editor-plugins). StandardJS will run in your editor and lint as you code
