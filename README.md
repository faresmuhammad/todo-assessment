# To-Do App


### Installation

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

### Usage
- Access the application at `http://127.0.0.1:8000`
- Login using these credentials:
  - email: `test@example.com`
  - password: `password`
