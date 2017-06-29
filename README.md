# ChapPress
ChapPress is a simple WordPress project initiated by the Web and Interactive Marketing team for Chapman University. It is intended to to model best practices for WordPress development. This repository will host the Wordpress model site with custom child themes and plugins.

## Goals
This WordPress project is intended to provide:
- A consistent local development environment
- Source control using standard Git workflow practices
- Modern automated tests
- Documentation for best practices and standards

## Requirements
- Homebrew (1.2.3)
  - MySQL (5.7.18)
  - Wordpress Command Line (1.2.1)
- PHP (5.6.30)
- Xcode (8.3.3)

## Installation

  Installation process for the setting up Wordpress on a local environment.

  Create the MySQL database.

  ```
  mysql -u username -p
  CREATE DATABASE databasename;
  GRANT ALL PRIVILEGES ON databasename.* TO "wordpressusername"@"hostname" IDENTIFIED BY "password";
  FLUSH PRIVILEGES;
  EXIT
  ```
  Download WordPress and run the server.

  ```
  wp core download
  cd wordpress
  php -S localhost:8000
  ```

  Server should be running in the terminal displaying PHP version, port location, and document root.

  Go to your browser and enter the url port:
  ```
  http://localhost:8000
  ```

  Finish the final instructions through the WordPress installation.
  Enter the database information that was created earlier including database name
  and password.

  The WordPress admin panel should be displayed and the user should have full access
  to developing in a local environment.
