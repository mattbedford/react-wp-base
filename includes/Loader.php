<?php

namespace ReactBase\includes;

if (!defined('ABSPATH')) exit;


class Loader
{

    public function __construct()
    {
        add_action('wp_body_open', [ \ReactBase\includes\Html::class, 'EchoReactDiv'] );
        add_action('wp_enqueue_scripts', [ \ReactBase\includes\Scripts::class, 'React' ] );
        add_action('rest_api_init', [ \ReactBase\includes\Api::class, 'LoadApiRoutes' ] );
    }

}