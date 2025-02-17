# Personal Blog

This is a simple personal blog application built with PHP. It allows users to create, edit, and delete posts. The application uses a MySQL database for storing posts and user information.

## Features

- User Registration and Login
- Create, Edit, and Delete Posts
- Categories for Posts
- Bootstrap-based Responsive UI

## Installation

### Prerequisites

- PHP 7.4 or higher
- MySQL or MariaDB

### Steps to Install

1. Clone the repository to your local machine:

   ```bash
   git clone https://github.com/CodeByAbduqodir/personal-blog.git
   ```

2. Navigate to the project directory:

   ```bash
   cd personal-blog
   ```

3. Set up your database:
   - Create a MySQL database for the project.
   - Open `.env` (или настрой файл конфигурации) и укажи свои данные для подключения к базе данных:

   ```env
   DB_HOST=localhost
   DB_USERNAME=your_database_username
   DB_PASSWORD=your_database_password
   DB_DATABASE=your_database_name
   ```

4. Import the database schema by running the SQL migration script in your MySQL client:

   ```sql
   CREATE TABLE posts (
     id INT AUTO_INCREMENT PRIMARY KEY,
     title VARCHAR(255) NOT NULL,
     content TEXT NOT NULL,
     category VARCHAR(100) NOT NULL,
     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
     updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
   );

   CREATE TABLE users (
     id INT AUTO_INCREMENT PRIMARY KEY,
     username VARCHAR(255) NOT NULL,
     password VARCHAR(255) NOT NULL,
     email VARCHAR(255) NOT NULL,
     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
   );
   ```

5. Настрой `.htaccess` для правильной маршрутизации (если используешь Apache):

   Создай файл `.htaccess` в корне проекта с таким содержанием:

   ```apache
   RewriteEngine On
   RewriteCond %{REQUEST_FILENAME} !-f
   RewriteRule ^(.*)$ index.php/$1 [QSA,L]
   ```

6. Запусти встроенный сервер PHP:

   ```bash
   php -S localhost:8000
   ```

   Приложение будет доступно по адресу `http://localhost:8000`.

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