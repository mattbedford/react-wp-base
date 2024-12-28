<?php

namespace ReactBase\includes;

if (!defined('ABSPATH')) exit;

abstract class Scripts
{

    public static function React()
    {
        $plugin_url  = plugin_dir_url( __DIR__ );
        wp_enqueue_script('react-wp-app-script',
            $plugin_url . '/build/index.js',
            array('wp-element', 'wp-api-fetch', 'react-jsx-runtime'),
            '1.00',
            true);
        wp_enqueue_style('react-wp-app-style',
        $plugin_url . '/build/index.css');
    }

}