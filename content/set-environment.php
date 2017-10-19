<?php
# SET ENVIRONMENT
###################
# Included in wp-config.php to switch database based on environment.
# https://make.wordpress.org/cli/handbook/common-issues/#php-notice-undefined-index-on-_server-superglobal

if (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 8777) {
  # DB for Acceptance & Functional testing
  define('TESTING', true);
} else {
  # DB for Local & Staging server
  define('TESTING', false);
}

?>