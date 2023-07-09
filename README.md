# Contact Manager App

This is a simple contact manager application built with Laravel and Vue.js. It allows you to store and manage contact details.

## Features

- Store contact details including first name, last name, email, and telephone number.
- List contacts with pagination and AJAX loading.
- Search contacts by name.
- Form validation for creating new contacts.
- Integration of Laravel backend and Vue.js frontend.

## Technologies Used

- Laravel 9 (PHP Framework)
- Vue.js 3 (JavaScript Framework)
- MySQL (Database System)
- HTML/CSS (Frontend Markup and Styling)

## Installation

1. Clone the repository: `git clone <repository_url>`
2. Navigate to the project directory: `cd contact-manager-app`
3. Install the dependencies: `composer install`
4. Create a copy of the .env file: `cp .env.example .env`
5. Generate an application key: `php artisan key:generate`
6. Set up your database in the .env file: `DB_DATABASE=your_database_name`
7. Run the database migrations: `php artisan migrate`
8. Run the Laravel mix compilation: `npx mix`
9. Start the development server: `php artisan serve`
10. Visit `http://localhost:8000` in your web browser.

## Usage

- Generate random 500 contacts using http://localhost:8000/generate.
- Use the search box to find contacts by name, email or phone.
- Contacts are displayed with pagination for better user experience.

## Contributing

Contributions are welcome! If you find any bugs or have suggestions for improvements, please open an issue or submit a pull request.

## License

This project is licensed under the [MIT License](LICENSE).

