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
      # These are for local development only.

- **Initialize Database for Local Server**
  
  While inside `/public` folder
  
      brew install wp-cli
      wp core install --url=http://localhost:8222/ --title=chap-press --admin_user=chappress --admin_password=password --admin_email=chappress@gmail.com

- **Install Automated Test Suite**

  Navigate to project folder root: `/chap-press`

      composer install
      composer update
      #installs depedency from composer.json

      echo "alias codecept=./vendor/bin/codecept" >> ~/.bash_profile
      #creates an alias

      source ~/.bash_profile

      codecept --version

  Codeception executed as `codecept` or `./vendor/bin/codecept`

- **Install Testing Tools**

      brew install selenium-server-standalone
      brew services start selenium-server-standalone

      brew install chromedriver
      brew services start chromedriver

      brew install phantomjs

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

***

## Testing

### Run Automated Tests

- **Execute in terminal**: `codecept run`

This command will run all tests (acceptance, functional, unit, wpunit)

[See Table](#codeception-commands) below for more specific commands

*Note: Restart your selenium server via `brew services restart selenium-server-standalone` if you see the following error.*

    [ConnectionException] Can't connect to Webdriver at http://127.0.0.1:4444/wd/hub.  
    Please make sure that Selenium Server or PhantomJS is running.


<br/>

### Codeception Commands

| Command | Description |
| --- | --- |
| `codecept run` | Run all tests |
| `codecept run unit` | Run all the unit tests |
| `codecept run functional` | Run all the functional tests |
| `codecept run dry-run functional` | Do a dry run of a specific suite |
| `codecept run --steps` | Print a step-by-step execution |
| `codecept run --debug` | Print steps and debug information |
| `codecept run --html` | Prints a stylized html report |
| `codecept g:cept suite "Custom Name"` | Generates Cept (scenario-driven test) file |
| `codecept g:cest suite "Custom Name"` | Generates Cest (scenario-driven object-oriented test) file |
| `codecept g:test suite "Custom Name"` | Generates Unit test |
| `codecept run --h` | General help |

[Codeception Console Commands](http://codeception.com/docs/reference/Commands)

**Test Resources**

[Chappress Wiki - Create A Test](https://github.com/chapmanu/chap-press/wiki#create-a-test) - See a quick example of how to create a test.  
[Wordpress Methods](https://github.com/lucatume/wp-browser#methods) - WordPress methods to use when creating tests ($I->doSomething syntax).  
[General Test Methods](http://codeception.com/docs/modules/PhpBrowser) - General methods to use from Codeception.

**General**

[Chappress Wiki - Automated Testing](https://github.com/chapmanu/chap-press/wiki#automated-testing)

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

**Run the playbook** from the ansible directory:

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

The standard log path: `public/wp-content/wonolog`

An [MU plugin](https://codex.wordpress.org/Must_Use_Plugins) has been added for any custom configurations: `/public/wp-content/mu-plugins/wonolog_load.php`

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

### Capistrano
An RSA key is currently added to the GitHub repo.  
In case Github SSH access is denied, try:
- List the files in your .ssh directory, if they exist
  - `ls -al ~/.ssh`
- [Generate SSH](https://help.github.com/articles/generating-a-new-ssh-key-and-adding-it-to-the-ssh-agent/)
- [Add SSH to Github](https://help.github.com/articles/adding-a-new-ssh-key-to-your-github-account/)
- Test SSH connection to Github
  - `ssh -T git@github.com`

### MariaDB
-  If the MariaDB has not been used before, the MySQL database may have to be restarted or unlinked using Homebrew:

    brew services stop mysql
    brew services list
    brew unlink mysql
    brew link mariadb
    brew services start mariadb


- ERROR 1290 --skip-grant-tables option Error

If you see this error when trying to create or grant privileges to a MYSQL user:

    ERROR 1290 (HY000): The MySQL server is running with the --skip-grant-tables
    option so it cannot execute this statement

Run `FLUSH PRIVILEGES;` first then run the command.

[Skip-grant Source](https://unix.stackexchange.com/a/102916)

### Wonolog
If there is an issue with Wonolog on the staging server:
- Go to `/config/templates.wp-config.php.erb`
  - Verify the correct path file for `$autoload_path` variable. The path file is going up directories because of the Capistrano deploy release. Essentially, the require statement just needs the composer autoload file at `vendor/autoload.php`. 
- Check the permissions of the `wp-content` folder. This folder is symlinked from `/public/wp-content/` to `/content/`
  - Run:
     - `chown php-fpm:webadmin -R ./content`
     - `find ./content -type d -exec chmod 755 {} \;`
  - [Stack Overflow](https://stackoverflow.com/questions/18352682/correct-file-permissions-for-wordpress)
- Go to `/config/deploy.rb` and review the code for staging deployment. 
- [Wonolog Github](https://github.com/inpsyde/Wonolog)
- [require in php](https://stackoverflow.com/questions/35400672/difference-between-require-dir-file-php-and-requirefile-php) 