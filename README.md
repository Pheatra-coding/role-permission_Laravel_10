Laravel Role & Permission API

A Laravel 10 REST API with user authentication, roles & permissions (RBAC), user image upload, soft deletes, and route protection using Laravel Sanctum and Spatie Permission.

🔧 Features

+ User registration & login (Sanctum)
+ Role & permission management (Spatie)
+ Assign/remove roles & permissions
+ User CRUD with soft delete/restore
+ Upload profile images
+ Search & paginate users
+ Middleware protection via roles/permissions

🚀 Installation

1. Clone the repo
git clone https://github.com/yourusername/your-repo-name.git

2. Go to project folder
cd your-repo-name

3. Copy .env and configure DB
cp .env.example .env

4. Install dependencies
composer install

5. Generate app key
php artisan key:generate

6. Run migrations & seeders
php artisan migrate --seed

7. Link storage
php artisan storage:link

8. Start local server
php artisan serve