<?php

namespace react_base;

class Output {

    public function __construct()
    {

        add_action('wp_enqueue_scripts', [self::class, 'Enqueue']);
        add_action('wp_body_open', function () {
            echo "<div>";
            echo "<div id='react-app'>";
            echo "</div>";
            echo "</div>";
        });

    }


    public static function Enqueue(): void
    {

        $plugin_url  = plugin_dir_url( __FILE__ );
        wp_enqueue_script('react-settings-page-menu-options',
            $plugin_url . '/build/index.js',
            array('wp-element', 'wp-api-fetch', 'react-jsx-runtime'),
            '1.00',
            true);

    }

}