# Learning Management System (LMS) with Laravel

This repository contains a basic Learning Management System (LMS) built using the Laravel framework. The application includes user registration and authentication, course management, and a contact form that sends emails.

## Features

-   **User Registration and Authentication**

    -   Users can register with their name, email, and password.
    -   Users can log in and log out.
    -   Authenticated users are redirected to a dashboard after logging in.

-   **Course Management**

    -   Authenticated users can create, read, update, and delete (CRUD) courses.
    -   Each course includes a title, description, start date, and end date.

-   **Contact Form**
    -   A contact form is provided with fields for name, email, and message.
    -   On submission, the form sends an email to a specified admin email address.

## Installation

Follow these steps to set up the application on your local machine:

### Prerequisites

-   PHP >= 8.0
-   Composer
-   MySQL
-   Node.js & npm

### Steps

1. **Clone the repository:**

    ```bash
    git clone https://github.com/SalmaYousry01/Learning_Management_System.git
    cd Learning_Management_System
    ```

2. **Install PHP dependencies:**

    ```bash
    composer install
    npm install
    npm run dev
    ```

3. **Environment Setup:**
   Copy the .env.example file to .env:

    ```bash
    cp .env.example .env
    ```

    Generate an application key:

    ```bash
    php artisan key:generate
    ```

    Update the necessary variables in your .env file, particularly the database and mail configuration:

    ```
    DB_CONNECTION
    DB_HOST
    DB_PORT
    DB_DATABASE
    DB_USERNAME
    DB_PASSWORD
    MAIL_MAILER
    MAIL_HOST
    MAIL_PORT
    MAIL_USERNAME
    MAIL_PASSWORD
    MAIL_ENCRYPTION
    MAIL_FROM_ADDRESS
    MAIL_FROM_NAME
    ```

4. **Generate Application Key:**

    ```bash
    php artisan key:generate
    ```

5. **Run Migrations:**

    ```bash
    php artisan migrate
    ```

6. **Serve the Application:**
    ```bash
    php artisan serve
    ```
    Open your browser and navigate to [http://localhost:8000](http://localhost:8000).

## Usage

### Authentication

-   **Register or Login**: Users can register a new account or log in with existing credentials.
-   **Authenticated Access**: Only authenticated users are allowed to manage courses.

### Courses Management

-   **List Courses**: Visit the Courses page to view all available courses.
-   **Create Course**: Use the "Add New Course" button to create a new course.
-   **Edit Course**: Click the "Edit" button next to a course to modify its details.
-   **Delete Course**: Click the "Delete" button next to a course to remove it from the list.

### Contact Form

-   **Access the Form**: Go to the Contact page.
-   **Fill Out the Form**: Enter your name, email, and message.
-   **Submit**: Send the completed form to dispatch an email to the admin.

## Directory Structure
```bash
├── app
│   ├── Http
│   │   ├── Controllers
│   │   │   ├── Contact
│   │   │   │   └── ContactController.php (Handles contact form submissions)
│   │   │   ├── Course
│   │   │   │   └── CourseController.php (Handles course CRUD operations)
│   │   │   └── Dashboard
│   │   │       └── DashboardController.php (Handles dashboard view)
│   ├── Mail
│   │   └── ContactMail.php (Defines the structure of the contact email)
│   └── Models
│       ├── User.php (Defines the User model)
│       └── Course.php (Defines the Course model)
├── resources
│   └── views
│       ├── contact
│       │   └── form.blade.php (Contact form view)
│       ├── courses
│       │   ├── index.blade.php (Courses list view)
│       │   ├── create.blade.php (Create course view)
│       │   ├── edit.blade.php (Edit course view)
│       │   └── show.blade.php (Show course details view)
│       ├── dashboard.blade.php (Dashboard view)
│       └── emails
│           └── contact.blade.php (Contact email view)
└── routes
    └── web.php (Contains the web routes for the application)
```


## Demo Video

You can watch the demo video for the Learning Management System below:
https://youtu.be/dqDoFQbG8LQ
## Contribution

Contributions are welcome! Please open an issue or submit a pull request for any improvements or bug fixes.

## License

This project is open-source and available under the MIT License.
