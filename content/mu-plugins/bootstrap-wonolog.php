<?php

#############################
# Wonolog Bootstrap Plugin
#############################
# 
# All Wonolog configurations have to be done in a MU plugin;

  if ( defined( 'Inpsyde\Wonolog\LOG' ) ) {
    Inpsyde\Wonolog\bootstrap();

    # Tell the default handler to use the given directory for logs.
    # Log location: /var/log/wonolog 
    
    putenv( 'WONOLOG_DEFAULT_HANDLER_ROOT_DIR=/var/log/wonolog' );
}


#############################
# Resources
#############################
# Must-Use Functions
# https://codex.wordpress.org/Must_Use_Plugins
# 
# Monolog-based logging package for WordPress.
# https://github.com/inpsyde/Wonolog
# 
# Safe Wonolog Bootstrapping
# https://github.com/inpsyde/Wonolog/blob/master/docs/05-wonolog-customization.md

?>