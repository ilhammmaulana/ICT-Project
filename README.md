# Project ICT - Laravel 10 Setup Guide
Build with love @kodikas.studio

## Requirements

Ensure the following dependencies are installed:

- **PHP**: Version 8.1.10 or higher
- **MySQL**: Latest stable version recommended
- **Node.js**: Version 18.20.4 (optional, for frontend assets)
- **NPM**: Version 8.19.3 (optional, for frontend assets)


## Setup Instructions

Follow these steps to set up and run the project locally:

1. ### Clone the Repository

   Clone the project repository from GitHub to your local machine:

   ```bash
   git clone https://github.com/ilhammmaulana/ICT-Project.git
   cd ICT-Project
   ```

2. ### Create a Copy of the .env File

   Copy the `.env.example` file to create your own `.env` file:

   ```bash
   cp .env.example .env
   ```

3. ### Configure Environment Variables

   Open the `.env` file and configure the necessary environment variables, including database settings, app name, and any other configurations specific to your setup.

4. ### Install PHP Dependencies

   Install the necessary PHP dependencies using Composer:

   ```bash
   composer install
   ```

5. ### Generate the Application Key

   Generate a unique application key for your Laravel project (stored in `.env`):

   ```bash
   php artisan key:generate
   ```

6. ### Set Up Database

   - **Create a new database** in MySQL.
   - **Update your `.env` file** with the database name, username, and password.
   - Run the migrations to set up the database structure:

     ```bash
     php artisan migrate
     ```

7. ### Install Frontend Dependencies (Optional)

   If your project requires frontend assets, install the Node.js packages and build the assets:

   ```bash
   npm install
   npm run build
   ```

8. ### Serve the Application

   Start the Laravel development server:

   ```bash
   php artisan serve
   ```

   By default, the application will be accessible at `http://127.0.0.1:8000`.


