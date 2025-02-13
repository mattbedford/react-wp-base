<?php

namespace ReactBase\includes;

if (!defined('ABSPATH')) exit;


class Loader
{

    public function __construct()
    {

        add_action( 'init', function() {
            add_filter('acf/save_post' , [\ReactBase\includes\UserCustomerSync::class, 'AssignCustomerAsPostAuthor'], 100, 1 );

            //   \ReactBase\includes\Admin::create_clienti_cpt();
         //   \ReactBase\includes\Admin::create_categoria_taxonomy();
         //   \ReactBase\includes\Admin::Init();
            // TODO: Check if this is still in use. Think not...
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

    }

}