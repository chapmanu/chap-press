<?php

/* ############################################################ 
   * CHILD THEME STYLESHEET
   ############################################################ 
*/
  
/* The recommended code to to enqueue the parent and child theme stylesheets
   https://codex.wordpress.org/Child_Themes */

function my_theme_enqueue_styles() {

    $parent_style = 'twentyseventeen-style'; 

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );

/* ############################################################ 
   * CUSTOMIZED LOGIN 
   ############################################################ 
*/

/* Logo 
   ######################################################
   https://codex.wordpress.org/Customizing_the_Login_Form
*/

function my_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/assets/images/cu-logo.png);
            background-repeat: no-repeat;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );

/* Logo links to Chappress site
   ######################################################
   https://codex.wordpress.org/Customizing_the_Login_Form
*/

function my_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

function my_login_logo_url_title() {
    return 'chappress';
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );


/* Load Login stylesheet
   ############################################################ 
*/

function my_login_stylesheet() {
    wp_enqueue_style( 'custom-login', get_stylesheet_directory_uri() . '/style.css' );
}
add_action( 'login_enqueue_scripts', 'my_login_stylesheet' );

?>
