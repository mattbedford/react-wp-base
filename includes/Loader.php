<?php

namespace ReactBase\includes;

class Loader
{

    public function __construct()
    {
        add_action('wp_footer', [ Html::class, 'EchoReactDiv']);
        add_action('wp_enqueue_scripts', [ Scripts::class, 'React']);
    }

}