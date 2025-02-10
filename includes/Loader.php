<?php

namespace ReactBase\includes;

if (!defined('ABSPATH')) exit;


class Loader
{

    public function __construct()
    {

        add_action( 'init', function() {
            wp_set_script_translations( 'react-wp-app-script', 'reactbase' );
        } );
        add_action('plugins_loaded', [$this, 'DoRouting']);

        add_action('wp_enqueue_scripts', [ \ReactBase\includes\Scripts::class, 'React' ] );
        add_action('rest_api_init', [ \ReactBase\includes\Api::class, 'LoadApiRoutes' ] );

        add_filter( 'login_redirect', [ \ReactBase\includes\LoginRedirect::class, 'SubscriberRedirectToAccountPage' ], 10, 3 );
        add_action( 'admin_init', [ \ReactBase\includes\LoginRedirect::class, 'BlockWpAdminForSubscribers' ] );

    }


    public function DoRouting()
    {

        include_once(plugin_dir_path(__DIR__) . 'includes/Routing.php');

        add_filter('template_include', [Routing::class, 'MakeRoute']);
        add_filter('status_header', [Routing::class, 'NotFourOhFour'], 999, 4);

        //add_action('plugins_loaded', [\Routing::class, 'Rewrite']);
        //add_filter('template_include', [\Routing::class, 'Template']);

    }

}