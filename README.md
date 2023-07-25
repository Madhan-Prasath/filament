# Filament Portal Laravel Backend

The Filament Portal Laravel Backend is a web application built on the Laravel framework, designed to provide a powerful and efficient backend for managing the Filament portal. This repository includes features like Google Login, Role-Based Access Control (RBAC), and allows you to update the client ID and secret in the `.env` file. Below you will find all the necessary information to set up and run the backend application.

## Table of Contents

- [About Laravel](#about-laravel)
- [Learning Laravel](#learning-laravel)
- [Features](#features)
- [Building](#building)
  - [Pre-requisites](#pre-requisites)
  - [Create a local Postgres database for development](#create-a-local-postgres-database-for-development)
  - [Configure Google Login](#configure-google-login)
  - [Install application dependencies and DB migration](#install-application-dependencies-and-db-migration)
  - [Update Client ID and Secret](#update-client-id-and-secret)

## About Laravel

Laravel is a web application framework known for its expressive and elegant syntax. It focuses on making the development process enjoyable and creative, while also easing common tasks in web projects. Key features of Laravel include:

- Simple, fast routing engine.
- Powerful dependency injection container.
- Support for multiple back-ends for session and cache storage.
- An expressive, intuitive database ORM (Object-Relational Mapping).
- Database agnostic schema migrations.
- Robust background job processing.
- Real-time event broadcasting.

With its accessibility and powerful features, Laravel provides the necessary tools for building large and robust applications.

## Learning Laravel

Laravel offers the most extensive and comprehensive documentation and video tutorial library among modern web application frameworks. This makes it easy for developers to get started with the framework. If reading is not your preferred method of learning, [Laracasts](https://laracasts.com) is a valuable resource. It contains over 2000 video tutorials covering various topics, including Laravel, modern PHP, unit testing, and JavaScript. You can enhance your skills by exploring their comprehensive video library.

## Features

This repository extends the basic Laravel features to include the following functionalities:

- Google Login: Allowing users to log in using their Google accounts.
- Role-Based Access Control (RBAC): Managing user roles and permissions for different sections of the portal.
- Updated Client ID and Secret: The `.env` file can be configured with the appropriate Google API client ID and secret.

## Building

### Pre-requisites:

Before you start building the Filament Portal Laravel Backend, ensure you have the following requirements installed on your system:

1. PHP 8.0+
2. Laravel v8.0+
3. Livewire v2.0+
4. Postgresql v14 server (using WSL2 or Docker Desktop)
5. Composer - Install Laravel using composer. For details, refer to: [Laravel Installation via Composer](https://laravel.com/docs/8.x/installation#installation-via-composer)
6. HeidiSQL - A tool for managing databases. Install HeidiSQL from: [Download HeidiSQL](https://www.heidisql.com/download.php)

### Create a local Postgres database for development

Before running the application, you need to set up a local Postgres database for development purposes. Follow these steps:

1. Create a new user and database for Filament development:

```sql
CREATE USER filament_dev WITH PASSWORD 'filament_dev';
CREATE DATABASE filament_dev OWNER filament_dev;
GRANT ALL PRIVILEGES ON DATABASE filament_dev TO filament_dev;
```

2. Postgres 14 and below require superuser privilege to install extensions. Therefore, connect to the `filament_dev` database as the `postgres` user and create the following extension:

```sql
CREATE EXTENSION IF NOT EXISTS citext;
```

### Configure Google Login

To enable Google Login, you need to set up the appropriate credentials. Follow these steps:

1. Go to the Google Developers Console: [Google Developers Console](https://console.developers.google.com/).

2. Create a new project and enable the Google+ API.

3. Navigate to the "Credentials" section and create new OAuth 2.0 credentials.

4. Add the appropriate redirect URI, typically `http://localhost:8000/login/google/callback`.

5. After creating the credentials, copy the Client ID and Secret.

### Install application dependencies and DB migration

Once the database is set up and Google Login credentials are obtained, follow these steps to install the application dependencies and run the database migration:

```sh
# Clone the Filament Portal Laravel Backend repository
git clone git@github.com:Madhan-Prasath/filament.git

# Navigate to the project directory
cd filament-laravel

# Create a copy of the .env.example file and rename it to .env
cp .env.example .env

# Install PHP dependencies using Composer
composer install

# Run the database migration
php artisan migrate

# Generate a unique application key
php artisan key:generate

# Create an admin user for the Laravel Filament backend
php artisan make:filament-resource User

# Add the admin user email to the .env file under SUPER_ADMIN_EMAIL

# Seed the database with initial data
php artisan db:seed

# Start the development server
php artisan serve

# Access Filament at http://localhost:8000/admin
```

### Update Client ID and Secret

To enable Google Login, update the `.env` file with the Google API Client ID and Secret obtained earlier:

```
GOOGLE_CLIENT_ID=YOUR_GOOGLE_CLIENT_ID
GOOGLE_CLIENT_SECRET=YOUR_GOOGLE_CLIENT_SECRET
GOOGLE_REDIRECT_URI=http://localhost:8000/auth/google/callback
```

Replace `YOUR_GOOGLE_CLIENT_ID` and `YOUR_GOOGLE_CLIENT_SECRET` with the respective values from the Google Developers Console.

With these steps completed, the Filament Portal Laravel Backend should be up and running, with Google Login and RBAC functionality. The backend is accessible at `http://localhost:8000/admin`.

Now you can begin managing the Filament portal efficiently using the powerful features provided by Laravel!
