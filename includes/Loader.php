<?php

namespace ReactBase\includes;

if (!defined('ABSPATH')) exit;


class Loader
{

    public function __construct()
    {

        $theme = wp_get_theme();
        if('bare-simplicity-custom' === $theme->name) {
            add_action('simplicity_custom_content', [ \ReactBase\includes\Html::class, 'EchoReactDiv'] );
        } else {
            add_action('wp_body_open', [ \ReactBase\includes\Html::class, 'EchoReactDiv'] );
        }
        add_action('wp_enqueue_scripts', [ \ReactBase\includes\Scripts::class, 'React' ] );
        add_action('rest_api_init', [ \ReactBase\includes\Api::class, 'LoadApiRoutes' ] );
    }

}