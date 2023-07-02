# SIPINJAM - Web-based Borrowing System

Sipinjam is a web-based borrowing system that allows users to manage the borrowing and usage of items within different units. It provides a convenient and efficient way to track item availability, submit booking requests, and manage item usages.

## Features

- User Roles: Administrator, Unit Admin, Borrower.
- Unit Management: Add, edit, and delete units (administrator).
- Category Management: Add, edit, and delete categories (administrator).
- Admin Unit Management: Add, edit, and delete admin units (administrator).
- Item Management: Add, edit, and delete items. Assign items to categories and units (unit admin).
- Booking Management: Submit, view, and cancel booking requests (borrower). Approve, reject, and expire booking requests (unit admin).
- Usage Management: Track item usages and returns (unit admin).
- Profile Management: User profiles for administrators, unit admins, and borrowers.
- Statistics and Reports: See reports on item usage, booking requests, and returns (unit admin).

## System Requirements

- PHP 7.4 or higher
- MySQL 5.7 or higher
- Laravel 8.x framework
- Composer (dependency management)
- Web server (Apache, Nginx)
- Browser compatibility: Chrome, Firefox, Safari, Edge

## Installation

1. Clone the repository:

   ```
   git clone https://github.com/alfikiafan/sipinjam.git
   ```

2. Navigate to the project directory:

   ```
   cd sipinjam
   ```

3. Install the dependencies:

   ```
   composer install
   ```

4. Create a copy of the `.env.example` file and rename it to `.env`:

   ```
   cp .env.example .env
   ```

5. Generate the application key:

   ```
   php artisan key:generate
   ```

6. Configure the database settings in the `.env` file:

   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database_name
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

7. Run the database migrations:

   ```
   php artisan migrate
   ```

8. Add an administrator account to the database:

    Open a MySQL client, such as phpMyAdmin or MySQL Workbench.

    Connect to your database.

    Execute the following SQL query to insert a new administrator account:

    ```sql
    INSERT INTO users (name, email, password, role) VALUES ('Admin', 'admin@example.com', 'your_password_hash', 'administrator');
    ```
    Replace 'your_password_hash' with the hashed password for the administrator account. You can generate a password hash using Laravel's bcrypt    function or a tool like bcrypt-generator.com.
9. Start the development server:

   ```
   php artisan serve
   ```

9. Access the application in your web browser at `http://127.0.0.1:8000/`.

## License

This project is licensed under the [Non-commercial License](LICENSE).

## Support

If you have any questions or need assistance, please open an issue in the [GitHub repository](https://github.com/your-username/sipinjam/issues).

## Acknowledgements

We would like to thank the following contributors for their valuable contributions to this project:

- Alfiki Diastama Afan Firdaus (https://github.com/alfikiafan)
- Dwi Sinta Anggraini (https://github.com/dwisintangrn)
- Haqqi Setiadjie (https://github.com/HaqqiEky)
- Farros Muhammad Iqbaal

## Credits

Sipinjam is built using several resources and libraries, including:

- [Laravel](https://laravel.com)
- [Faker](https://fakerphp.github.io)
- [Dompdf](https://github.com/dompdf/dompdf)
- [Soft UI Dashboard](https://www.creative-tim.com/product/soft-ui-dashboard)

## Disclaimer

This project is for demonstration purposes only and should not be used in production environments without proper testing and customization.


---
