<?php namespace moneal\GAECacheBuster;
/*
Plugin Name: Google App Engine Cache Buster
Description: Changes the default version string used for cache busting in WordPress to include the application version. This fixes the problem of load-styles.php returning a blank string after doing a git push to GAE
Plugin URI: http://github.com/moneal/gae-cache-buster
Author: Morgan O'Neal
Author URI: http://ghostbyte.com
*/
new Plugin;
class Plugin {
    
    function __construct(){ 
        add_filter( 'wp_default_styles',    array( $this, 'change_default_version') );
        add_filter( 'wp_default_scripts',   array( $this, 'change_default_version') );
    }

    /**
     * Change the default version to include the version of our instance
     * @param \WP_Dependencies $style_object
     */
    function change_default_version( \WP_Dependencies $object ) {
        if ( isset( $_SERVER['CURRENT_VERSION_ID'] ) ) {
            $object->default_version .= '-' . $_SERVER['CURRENT_VERSION_ID'];
        }
    }
}

