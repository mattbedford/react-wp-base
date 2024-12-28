<?php

namespace ReactBase\includes;


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
    }

}