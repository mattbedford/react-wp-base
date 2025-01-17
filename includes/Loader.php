<?php

namespace ReactBase\includes;

if (!defined('ABSPATH')) exit;


class Loader
{

    public function __construct()
    {

        add_action('plugins_loaded', [$this, 'DoRouting']);
        add_action('init', function() {
            add_filter('redirect_canonical', [Routes::class, 'UnknownRequest']);
        });

        add_action('wp_enqueue_scripts', [ \ReactBase\includes\Scripts::class, 'React' ] );
        add_action('rest_api_init', [ \ReactBase\includes\Api::class, 'LoadApiRoutes' ] );
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