<?php

namespace ReactBase\includes;

if (!defined('ABSPATH')) exit;


class Loader
{

    public function __construct()
    {

        add_action('wp', [$this, 'DoRouting']);
        add_action('wp_enqueue_scripts', [ \ReactBase\includes\Scripts::class, 'React' ] );
        add_action('rest_api_init', [ \ReactBase\includes\Api::class, 'LoadApiRoutes' ] );
    }


    public function DoRouting()
    {

        include_once(plugin_dir_path(__DIR__) . 'includes/Routing.php');

        add_filter('template_include', [Routing::class, 'MakeRoute']);

        // TO DO: Add back in the No404 function

        //add_filter('redirect_canonical', [Routes::class, 'UnknownRequest']);
        //add_action('plugins_loaded', [\Routing::class, 'Rewrite']);
        //add_filter('template_include', [\Routing::class, 'Template']);
        add_filter('status_header', [Routing::class, 'NotFourOhFour'], 100, 4);

    }

}