<?php

namespace ReactBase\includes;

abstract class Routing
{

    public static function NotFourOhFour($header, $code, $description, $protocol) {

        if (self::is_tree()) {
            error_log("in the tree");
            $description = get_status_header_desc(200); //Get the default 200 description
            return "{$protocol} 200 {$description}"; //Return a 200 status header
        } else {
            error_log("return normal header");
            return $header;
        }
    }


    public static function MakeRoute($template)
    {

        if (self::is_tree() && file_exists(plugin_dir_path(__DIR__) . 'templates/reactive.php')) {
            $template = plugin_dir_path(__DIR__) . 'templates/reactive.php';
        }

        return $template;
    }


    public static function is_tree() {

        global $wp;

        $match_string = strval(REACTIVE_PAGE);

        if ( preg_match( '#^' . $match_string . '(/.+)?$#', $wp->request ) ) {
            return true;
        }
        return false;
    }

}