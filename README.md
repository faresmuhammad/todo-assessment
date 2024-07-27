# To-Do App

### Development Environment

- **OS:** Ubuntu
- **PHP Version:** 8.2
- **XAMPP for linux:** 8.2.12

### Technologies Used

- **Backend:** Laravel 11
- **Frontend:**
    - VueJs
    - Vue Router
    - Bootstrap CSS Framework
    - Pinia for global state managemnet
    - Mitt event emitter for event handling globally

  
### Regular Installation

1. Clone the repository
```bash
git clone https://github.com/faresmuhammad/todo-assessment.git
```
or using github cli
```bash
gh repo clone faresmuhammad/todo-assessment
```
then
```bash
cd todo-assessment
```
2. Set Environment Variable and application key
```bash
cp .env.example .env 
```
```bash
php artisan key:generate
```
3. Install Backend & Frontend Dependencies
```bash
composer install

npm install
```
4. After running Apache server and MySQL, create a new database `todo`

5. Run Database Migrations
```bash
php artisan migrate:fresh --seed 
```
6. Start Development Server
```bash
php artisan serve

npm run dev 
```
### Laravel Sail Installation
> After Cloning the repository

1. Set Environment Variable and application key
```bash
cp .env.example .env 
```
```bash
php artisan key:generate
```

2. Install Backend & Frontend Dependencies
```bash
composer install

npm install
```
3. Install Laravel Sail
```bash
php artisan sail:install
```

4. Run the app by running `docker-compose.yml` file
```bash
./vendor/bin/sail up
```

5. Run Database Migrations & Seeding
```bash
./vendor/bin/sail artisan migrate:fresh --seed
```

6. Change the base url in `resources/js/constants.js` to be `http://0.0.0.0:80/api` as Laravel app is served on.
7. Start Frontend Server
```bash
./vendor/bin/sail npm run dev
```
### Usage
- Access the application at `http://127.0.0.1:8000` or for laravel sail at `http://0.0.0.0:80`
- Login using these credentials:
  - email: `test@example.com`
  - password: `password`
