# ChapPress
ChapPress is a simple WordPress project initiated by the Web and Interactive Marketing team for Chapman University. It is intended to to model best practices for WordPress development. This repository will host the Wordpress model site with custom child themes and plugins.

## Table of Contents
1. [Goals](#goals)
2. [Requirements](#requirements)
3. [Installation](#installation)
4. [Debugging](#debugging)
5. [Troubleshooting](#troubleshooting)

## Goals
This WordPress project is intended to provide:
- A consistent local development environment
- Source control using standard Git workflow practices
- Modern automated tests
- Documentation for best practices and standards

## Requirements
- Homebrew (1.2.3)
  - MariaDB (10.0 or greater)
  - Wordpress Command Line (1.2.1)
- PHP 7

## Installation

  Installation process for the setting up Wordpress on a local environment.

- Create the MySQL user and database using the MariaDB monitor.

  ```
  mysql -uroot
  CREATE DATABASE chappress_dev;
  GRANT ALL PRIVILEGES ON chappress_dev.* TO "chappress"@"localhost" IDENTIFIED BY "chappress";
  FLUSH PRIVILEGES;
  EXIT
  ```

- Download WordPress and run the server.

  ```
  git clone git@github.com:chapmanu/chap-press.git
  cd chap-press/public
  cp -v wp-config.php{-dist,}

  # The wp-config file already contains the database information to get started.
  # These are for local development only.

  php -S localhost:8000
  ```

  Server should be running in the terminal displaying PHP version, port location, and document root.

  Go to your browser and enter the url port:
  ```
  http://localhost:8000
  ```

  Finish the final instructions through the WordPress installation. The WordPress admin panel should be displayed and the user should have full access to developing in a local environment.

## Debugging

  WordPress comes with specific debug systems designed to simplify the process.
  The following are meant only for local testing and staging installs.


  The following code is already set in the ```wp-config.php``` file.
  It will log all errors, notices, and warnings to a file called ```debug.log``` in the wp-content directory.
  It will also hide the errors so they do not interrupt page generation.

  Enable WP_DEBUG mode
  ```
  define( 'WP_DEBUG', true );
  ```

  Enable Debug logging to the /wp-content/debug.log file
  ```
  define( 'WP_DEBUG_LOG', true );
  ```

  Disable display of errors and warnings
  ```
  define( 'WP_DEBUG_DISPLAY', false );
  ```
  ```
  @ini_set( 'display_errors', 0 );
  ```

  Use dev versions of core JS and CSS files (only needed if you are modifying these core files)
  ```
  define( 'SCRIPT_DEBUG', true );
  ```

## Troubleshooting

- MariaDB
  -  If the MariaDB has not been used before, the MySQL database may have to be restarted or unlinked using Homebrew:

    ```
    brew services stop mysql
    brew services list
    brew unlink mysql
    brew link mariadb
    brew services start mariadb
    ```

  - ERROR 1290 --skip-grant-tables option Error

    If you see this error when trying to create or grant privileges to a MYSQL user:

        ERROR 1290 (HY000): The MySQL server is running with the --skip-grant-tables
        option so it cannot execute this statement

    Run `FLUSH PRIVILEGES;` first then run the command.

    Source: https://unix.stackexchange.com/a/102916
