# Resume Website

A personal resume website built using **Laravel**, **Bootstrap**, **Sass**, and **MySQL** to showcase profile, skills, work experience, and projects. It also includes a contact form and a custom CMS with user-level access control.

## 🔧 Features

-   Clean, responsive design using Bootstrap and Sass
-   Display of:
    -   Personal profile
    -   Skills and expertise
    -   Work experience
    -   Project portfolio
    -   Contact form with form submission handling
-   Laravel authentication with three user roles:
    -   Admin: Full access
    -   Editor: Limited content editing
    -   Viewer: Read-only access
-   Custom CMS to manage:
    -   Resume & Portfolio document
    -   Projects
    -   User accounts
    -   Contact messages
-   SweetAlert integration for success and error session notifications

## 📦 Tech Stack

-   **Backend:** Laravel, MySQL
-   **Frontend:** Bootstrap, Sass, Blade templating
-   **Other:** SweetAlert

## 🚀 Getting Started

### Requirements

-   PHP >= 8.0
-   Composer
-   Node.js and NPM
-   MySQL

### Installation

1. Clone the repository:
    ```bash
    git clone https://github.com/your-username/resume-website.git
    cd resume-website
    ```
2. Install dependencies:
    ```composer install
    npm install && npm run dev
    ```
3. Create a .env file and configure your database:
    ```cp .env.example .env
    php artisan key:generate
    ```
4. Create database of resumeweb and run migrations:

    ```php artisan migrate

    ```

5. Serve the app locally and run npm run sass: watch to run sass changes
    ```php artisan serve
    npm run sass:watch
    ```

## 🌐 Live Site

-   Deployed using **Hostinger** with custom domain. You can view the live site here: https://auriweb.me/

## 📫 Contact

-   Feel free to reach out using the contact form on the site, or connect via LinkedIn.

## 📄 License

-   This project is open-source and available under the MIT License.
