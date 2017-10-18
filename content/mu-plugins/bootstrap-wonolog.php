<?php

#############################
# Wonolog Bootstrap Plugin
#############################
# 
# All Wonolog configurations have to be done in a MU plugin;

  if ( defined( 'Inpsyde\Wonolog\LOG' ) ) {
    Inpsyde\Wonolog\bootstrap();
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