# Laravel Admin Panel Project

## Admin Panel Title

Welcome to the Laravel Admin Panel Project! This project includes a simple admin panel.

## Prerequisites

Before you begin, ensure you have the following:

- [PHP](https://www.php.net/) (>= 7.4)
- [Composer](https://getcomposer.org/)
- [Node.js](https://nodejs.org/) (for Laravel Mix)
- [MySQL](https://www.mysql.com/) or [SQLite](https://www.sqlite.org/) or your preferred database

## Installation

1. Clone the repository:

    ```bash
    git clone https://github.com/JafarThwahrah/laravel-admin-panel.git
    ```

2. Navigate to the project directory:

    ```bash
    cd laravel-admin-panel
    ```

3. Install PHP dependencies:

    ```bash
    composer install
    ```

4. Install NPM dependencies:

    ```bash
    npm install
    ```

    or

    ```bash
    yarn
    ```

5. Copy `.env.example` to `.env` and configure your database settings:

    ```bash
    cp .env.example .env
    ```

6. Generate application key:

    ```bash
    php artisan key:generate
    ```

7. Run migrations:

    ```bash
    php artisan migrate
    ```

8. Seed the database:

    ```bash
    php artisan db:seed
    ```

    This will populate the database with sample data, including an admin user.

9. Run the development server:

    ```bash
    php artisan serve
    ```

    The application will be accessible at `http://localhost:8000`.

## Admin Panel Access

You can access the admin panel by visiting `http://localhost:8000/admin` and logging in with the following credentials:

- **Email:** admin@example.com
- **Password:** password

## Additional Information

- Laravel Documentation: [https://laravel.com/docs](https://laravel.com/docs)
- Laravel Mix Documentation: [https://laravel-mix.com/docs](https://laravel-mix.com/docs)
