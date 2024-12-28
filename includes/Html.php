<?php

namespace ReactBase\includes;

if(!defined(ABSPATH)) exit;

abstract class Html
{

    public static function EchoReactDiv()
    {

        echo "<div>";
        echo "<div id='react-app'>";
        echo "</div>";
        echo "</div>";
    }

}