# ChapPress
ChapPress is a simple WordPress project initiated by the Web and Interactive Marketing team for Chapman University. It is intended to model best practices for WordPress development. This repository will host the Wordpress model site with custom child themes and plugins.

## Table of Contents
1. [Goals](#goals)
1. [Requirements](#requirements)
1. [Installation](#installation)
1. [Testing](#testing)
1. [Development Server](#development-server)
1. [Ansible](#ansible)
1. [Capistrano](#capistrano)
1. [Debugging](#debugging)
1. [Upgrading Wordpress](https://github.com/chapmanu/chap-press/wiki)
1. [Troubleshooting](#troubleshooting)

## Goals
This WordPress project is intended to provide:
- A consistent local development environment
- Source control using standard Git workflow practices
- Modern automated tests
- Documentation for best practices and standards

## Requirements
- Homebrew (1.2.3)
  - MariaDB (10.0)
  - Wordpress Command Line (1.2.1)
  - Composer (1.4.2)
- Composer (1.4.2)
  - Codeception for Wordpress (Wp-Browser 1.21)
  - Wonolog (1.0.0)
- PHP 7
- Ansible (2.3.1.0) 
- Capistrano (3.9)


***

## Installation
Installation process for the setting up Wordpress on a local environment.

- **Create the MySQL user and databases using the MariaDB monitor**.

      mysql -uroot
      CREATE DATABASE chappress_dev;
      GRANT ALL PRIVILEGES ON chappress_dev.* TO "chappress"@"localhost" IDENTIFIED BY "chappress";

      CREATE DATABASE chappress_test;
      GRANT ALL PRIVILEGES ON chappress_test.* TO "chappress"@"localhost" IDENTIFIED BY "chappress";

      FLUSH PRIVILEGES;
      EXIT

- **Download Chap-Press Git with WordPress**

      git clone git@github.com:chapmanu/chap-press.git
      cd chap-press/public
      cp -v wp-config.php{-dist,}

      # The wp-config file already contains the database information to get started.
      # Usage is for local & staging development only.

- **Initialize Database for Local Server**

  While inside the `/public` folder:

      brew install wp-cli
      wp core install --url=http://localhost:8222/ --title=chap-press --admin_user=chappress --admin_password=password --admin_email=chappress@gmail.com
      wp theme activate chappress

- **Install Automated Test Suite**

  Navigate to project folder root: `/chap-press`

      composer install
      composer update
      # Installs dependency from composer.json

      echo "alias codecept=./vendor/bin/codecept" >> ~/.bash_profile
      # Creates an alias

      source ~/.bash_profile
      
      cp -v ./tests/_data/dump.sql{-dist,}
      # Codeception loads a database dump to cleanup the database between tests

      codecept --version

  Codeception executed as `codecept` or `./vendor/bin/codecept`

- **Install Testing Tools**

      brew update
      brew install selenium-server-standalone
      brew services start selenium-server-standalone

      brew install chromedriver
      brew services start chromedriver

      brew install phantomjs

***

## Testing

### Run Automated Tests

- **Execute in terminal**: `codecept run acceptance`

This command will run the acceptance test. Replace `acceptance` with `functional` or `unit` to run those suites. Due to WordPress dependency on globals and constants the suites should not be ran at the same time.

To run the entire set of suites the recommended method is:

`codecept run acceptance && codecept run functional && codecept run ...`

**Database Testing** - The WPDb module will cleanup the database between tests by loading a database dump.  

If the dump file needs to be updated, while in `/tests/_data` run: 

- `mysqldump chappress_test > dump.sql`

[Codeception for Wordpress](http://codeception.com/for/wordpress)  
[Wp-browser Github](https://github.com/lucatume/wp-browser)  
[Wiki - Automated Testing](https://github.com/chapmanu/chap-press/wiki/Automated-Testing)

***

## Development Server

To run the local development server:

    php -S localhost:8222 -t ./public

Site will be accessible at:

- http://localhost:8222

***

## Ansible

Server provisioning has been automated using Ansible.  
The staging server will be running at `https://chappress-staging.chapman.edu`

- **Install Ansible**

  Ansible will run a staging server to do WordPress testing.

      # install pip, if needed
      sudo easy_install pip

      sudo pip install ansible
      ansible --version

      ssh-copy-id wimops@chappress-staging.chapman.edu
      # copy SSH Public Key to Staging Server

      ansible all -m ping
      # verify success

- **Run the playbook** from the ansible directory:

      cd devops/ansible
      ansible-playbook provision.yml --ask-become-pass


***

## Capistrano

Capistrano will deploy this repo and WordPress to the staging server.

**Run Capistrano** from root folder `/chap-press`:

    cap staging deploy

[Wiki](https://github.com/chapmanu/chap-press/wiki/Capistrano)

***

## Debugging

### Wonolog

[Wonolog](https://github.com/inpsyde/Wonolog) is a logging package for WordPress (based off of [Monolog](https://github.com/Seldaek/monolog)). This package allows anything to be logged in a WordPress site. 
Wonolog comes with an easy bootstrap routine and some out-of-the-box configurations that make it possible to have a working and effective logging system with zero effort. It is included in the `composer.json` file. 

The standard log path: `content/wonolog`

**[MU plugins](https://codex.wordpress.org/Must_Use_Plugins)**  
For custom Wonolog configurations: `content/mu-plugins/bootstrap-wonolog.php`  
A general log: `content/mu-plugins/log-action-wonolog.php`

**Automatically logged events include:**

- PHP core notices, warnings and (fatal) errors
- uncaught exceptions
- WordPress errors and events (e.g., DB errors, HTTP API errors, wp_mail() errors, and 404 errors)

### Logging

The main hook to use for the scope is 'wonolog.log'. A bare-minimum example of logging with Wonolog could look like so:

    do_action( 'wonolog.log', 'Logged from wp-config.php' );

[See the Docs](https://github.com/inpsyde/Wonolog/tree/master/docs)

### WordPress Default Debug

What is actually logged depends on the value of `WP_DEBUG_LOG` constant. When `WP_DEBUG_LOG` is set to true, Wonolog will log everything.

| Command | Description |
| --- | --- |
| `define( 'WP_DEBUG', true );` | Enable WP_DEBUG mode |
| `define( 'WP_DEBUG_LOG', true );` | Enable Debug logging to `/wp-content/debug.log` |
| `define( 'WP_DEBUG_DISPLAY', false );` | Disable display of errors and warnings |
| `@ini_set( 'display_errors', 0 );` | Disable display of errors in the php.ini file  |
| `define( 'SCRIPT_DEBUG', true );` | Uses unminified versions of core JS and CSS files |

***

## Troubleshooting

[Capistrano - Github SSH access is denied](https://github.com/chapmanu/chap-press/issues/17)  
[Codeception - Can't connect to Webdriver](https://github.com/chapmanu/chap-press/issues/18)  
[MariaDB](https://github.com/chapmanu/chap-press/issues/19)  
[Wonolog - Staging Server](https://github.com/chapmanu/chap-press/issues/20)