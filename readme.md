# Personal Blog

This is a simple personal blog application built with PHP and Laravel. It allows users to create, edit, and delete posts. The application is designed for educational purposes and can be customized for personal use.

## Features

- User Registration and Login
- Post Creation, Editing, and Deletion
- Categories for Posts
- User-Specific Posts
- Bootstrap-based UI for Responsive Design

## Installation

### Prerequisites

- PHP 7.4 or higher
- Composer
- MySQL or MariaDB
- Laravel 8.x (or compatible version)

### Steps to Install

1. Clone the repository to your local machine:

   ```bash
   git clone https://github.com/CodeByAbduqodir/personal-blog.git
   ```

2. Navigate to the project directory:

   ```bash
   cd personal-blog
   ```

3. Install the project dependencies using Composer:

   ```bash
   composer install
   ```

4. Copy the `.env.example` file to `.env`:

   ```bash
   cp .env.example .env
   ```

5. Generate the application key:

   ```bash
   php artisan key:generate
   ```

6. Set up the database. Open `.env` and update the following configuration with your database details:

   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database_name
   DB_USERNAME=your_database_username
   DB_PASSWORD=your_database_password
   ```

7. Run the migrations to set up the database schema:

   ```bash
   php artisan migrate
   ```

8. Optionally, you can seed the database with some sample posts:

   ```bash
   php artisan db:seed
   ```

9. Start the development server:

   ```bash
   php artisan serve
   ```

   The application will be available at `http://127.0.0.1:8000`.

## Usage

- **Registration**: Users can create an account by visiting the registration page.
- **Login**: After registering, users can log in with their credentials.
- **Create Posts**: Logged-in users can create new blog posts.
- **Edit and Delete Posts**: Users can edit or delete their own posts.
- **Categories**: Users can categorize their posts under predefined categories like 'Programming', 'Lifestyle', etc.

## Contributing

1. Fork the repository.
2. Create a new branch (`git checkout -b feature-name`).
3. Make your changes and commit them (`git commit -am 'Add new feature'`).
4. Push to the branch (`git push origin feature-name`).
5. Create a new pull request.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

---

**Author**: CodeByAbduqodir  
**GitHub**: [https://github.com/CodeByAbduqodir](https://github.com/CodeByAbduqodir)