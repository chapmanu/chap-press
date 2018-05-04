<?php

/*
Plugin Name: Wonolog Bootstrap Plugin
Plugin URI:  https://github.com/inpsyde/Wonolog
Description: Enable Wonolog via their bootstrap method.
Version:     1.0
Author:      Chapman SMC

All Wonolog configurations have to be done in a MU plugin

*/

  if ( defined( 'Inpsyde\Wonolog\LOG' ) ) {
    Inpsyde\Wonolog\bootstrap();

    // Uncomment to tell the default handler to use the given directory for logs.
    putenv( 'WONOLOG_DEFAULT_HANDLER_ROOT_DIR=/var/log/wonolog' );
}

?>
