# ChapPress
ChapPress is a simple WordPress project initiated by the Web and Interactive Marketing team for Chapman University. It is intended to to model best practices for WordPress development. This repository will host the Wordpress model site with custom child themes and plugins.

## Table of Contents
1. [Goals](#goals)
2. [Requirements](#requirements)
3. [Installation](#installation)
4. [Debugging](#debugging)
5. [Automated Testing](#automated-testing)
6. [Troubleshooting](#troubleshooting)

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

## Automated Testing

This is a guide for setting up and using Codeception and WP-Browser. Codeception is an all-purpose testing framework for PHP.

### Table of Contents ###

1. [Introduction](#introduction)
2. [Requirements](#requirements)
3. [Installation](#installation)
4. [Usage](#usage)
5. [Directories](#directories)
6. [Testing Suites](#testing-suites)
7. [Database Dump](#database-dump)
8. [Resources](#resources)

### Introduction ###

**Codeception**

Codeception tests are written in the scenario driven manner and are very simple to write, read, and maintain. It can run acceptance, functional, unit tests, keeping all them inside one framework. As well, it is built on top of PHPUnit and is able to execute its tests.

**Wp-Browser**

WP-browser is a package built for using Codeception with WordPress. It uses a specific set of extensions to ease WordPress testing. This includes WordPress defined functions, constants, classes and methods in any test. See the [modules](https://github.com/lucatume/wp-browser#modules) for more specific information. 

### Requirements

* Composer (1.4.2)
* Wp-Browser (1.21)
* Codeception (2.3.4)


_**note:** Wp-Browser will install the latest Codeception._

### Installation

1. **Install Composer**

```
brew update
brew install composer
composer --version
```

Once Composer is installed, the WPBrowser package can be installed. This will install Codeception for you. Navigate to project folder root and simply use composer:

2. **Install Wp-browser**

`composer require lucatume/wp-browser --dev`

This package will generate the `vendor` folder with numerous packages and dependencies Codeception and WPBrowser uses.

3. **Create Database Dump** 

```
cd tests/_data/
mysqldump chappress_dev > dump.sql
```

4. **Verify Wordpress Info**

The Acceptance and Functional Suites should match your local settings.
Verify the admin username and password that you are using in Wordpress in:

```
tests/acceptance.suite.yml
tests/functional.suite.yml
```

5. **Verify Installation**

Installation is now complete.
 
`./vendor/bin/codecept --version`

### Usage ###

**Codeception is executed as:**

`./vendor/bin/codecept`

For brevity, you can create an **alias** that refers to that path:

``` 
alias codecept=./vendor/bin/codecept
codecept run
```

| Command | Description |
| --- | --- |
| `codecept run` | Run all tests |
| `codecept run acceptance` | Run a specific test |
| `codecept run dry-run acceptance` | Do a dry run of a specific test |
| `codecept run --steps` | Print a step-by-step execution |
| `codecept run --debug` | Print steps and debug information |
| `codecept run --html` | Prints a stylized html report |
| `codecept generate:cept functional "PostInsertion"` | Generate a functional test |
| `codecept generate:cest acceptance "UserTest"` | Generate an acceptance test |
| `codecept run --h` | General help |

See [Commands](http://codeception.com/docs/reference/Commands)

### Directories ###
 
For ease of use, the interactive setup has already been initiated and configured. The setup created the test folders and suite information related to your local WordPress setup.  A sample of each unit test has been included to demonstrate how Codeception for WordPress runs. This test scaffolding is already included in this repository:

```
|-- tests
    |-- _data
    |-- _output
    |-- _support
    |-- acceptance
    |-- functional
    |-- unit
    |-- wpunit
    `-- acceptance.suite.yml
    `-- functional.suite.yml
    `-- unit.suite.yml
    `-- wpunit.suite.yml  
```


This directory contains the main folders you will work with. These are the `unit`, `wpunit`, `functional` and `acceptance` folders. These are known as your test suites. Each suite contains a  configuration file ( `[testType].suite.yml` ) that already contains the necessary information such as MySQL database, localhost, and WordPress Path. Please verify the configuration settings in these files if there are any errors.


The other directories contain:

```
tests/_data    --> Fixture data and MySQL database backup
tests/_support --> Support code & helper functions
tests/_output  --> Output log & Reports
```

### Testing Suites ###

**[Acceptance Tests](http://codeception.com/docs/03-AcceptanceTests)** - Reproduces user's actions in a scenario in clear and direct syntax.

**[Functional Tests](http://codeception.com/docs/04-FunctionalTests)** - Handles end-to-end interactions with Wordpress based modules (WordPress & WPDb). [Functional]

**[Unit Tests](http://codeception.com/docs/05-UnitTests)** - Codeception uses PHPUnit as a backend for running its tests. Thus, any PHPUnit test can be added to a Codeception test suite and then executed.

**[WPUnit](http://codeception.com/for/wordpress)** - Wordpress Unit tests are integration tests that check how components work inside WordPress.  WPLoader is a module that  loads, installs and configures a fresh WordPress installation before each test method runs. This has been enabled and configured inside `wpunit.suite.yml` file. 

### Database Dump ###
A database dump for MySQL should be created in order for the development/source WordPress database to be reloaded after all tests have been done.  This way it can cleanup the database between tests by loading the database dump. This will automatically be done by the WPDb module and it is configured to do so. 

The directory for the dump is: `tests/_data/dump.sql`.


### Resources ###
* [Composer](https://getcomposer.org/)
* [Codeception](http://codeception.com/)
* [Codeception for Wordpress](http://codeception.com/for/wordpress)
* [Wp-browser](https://github.com/lucatume/wp-browser)  

## Troubleshooting

### MariaDB
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
