Running a Laravel Project with Vue and Laravel Modules
This document provides instructions on running a Laravel project that utilizes Vue and Laravel modules.

Requirements:

PHP 8.1+
Composer
Node.js and NPM
Git (optional)
Project Setup:

Clone the Project:
If you have the project URL, use git clone <[Repo Url](https://github.com/m-abdulmonem/simple-e-commerce.git)> to download the project.
If you have the project downloaded as a ZIP file, extract it to your desired location.
Install Dependencies:
Navigate to the project directory.
Run composer install to install the Laravel dependencies.
Run npm install to install the Vue and other frontend dependencies.
Configure Laravel Modules:
Run php artisan module:discover to discover and register all modules.
Run php artisan module:migrate to migrate the database for all modules.
Run php artisan module:seed to seed the database for all modules.
Build the Frontend Assets:
Run npm run dev to compile and watch for changes to the Vue components.
Run the Application:
Run php artisan serve to start the Laravel development server.
Open http://localhost:8000 in your browser to access the application.
Module Management:

Each module has its own directory within the modules directory.
Each module can have its own controllers, models, views, routes, and configurations.
You can enable/disable modules by updating the modules.json configuration file.
You can run specific module commands using the module:command Artisan command.
Additional Notes:

Make sure to configure your .env file with the appropriate database credentials and other environment variables.
You may need to adjust the build commands depending on your specific project setup and configurations.
Refer to the Laravel and Vue documentation for more information on their usage.
Resources:

Laravel documentation: https://laravel.com/docs/10.x/readme
Vue documentation: https://vuejs.org/
Laravel modules documentation: https://github.com/nWidart/laravel-modules
Contributing:

Feel free to contribute to this document by adding further instructions, troubleshooting tips, or other relevant information.

Feedback:

If you have any feedback or questions, please feel free to leave a comment below.
