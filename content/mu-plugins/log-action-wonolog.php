<?php
#############################
# Wonolog Custom Log Plugin
#############################
# Wonolog is a monolog-based logging package for WordPress. Not to be used for the live site.      
# https://github.com/inpsyde/Wonolog
# 
# Logging in Wonolog is done via a WordPress function: do_action()
# The main hook to use for the scope is 'wonolog.log'.
# See the docs: https://github.com/inpsyde/Wonolog/tree/master/docs
#
# An example of logging with Wonolog:

do_action( 'wonolog.log', 'Some event happened in ' . $_SERVER['SCRIPT_NAME'] );

############################ 
# Note: 
# In the wp-config.php file, using a log while running the WP CLI will display an error: 
#    PHP Fatal error:  Uncaught Error: Call to undefined function do_action() in the wp-config file 
# 
# The wp-config.php is calling a WordPress function before WordPress has been 
# loaded to define it. PHP will fail out with a fatal error. 
# 
# The log will work but the WP CLI error will persist.
# 
# A temporary workaround to run the wp cli AND log in wp-config:
# 
# if ( ! defined( 'WP_CLI' ) && ! WP_CLI) {
#   do_action( 'wonolog.log', 'Some event happened in wp-config.php' );
# }
# 
# https://make.wordpress.org/cli/handbook/common-issues/#php-fatal-error-call-to-undefined-function
?>