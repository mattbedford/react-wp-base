<?php

namespace ReactBase\includes;


class Api {

    public static function LoadApiRoutes()
    {
        register_rest_route(
            'react-base/v1', '/get-posts', array(
                'methods'  => 'GET',
                'callback' => [self::class, 'PostsRoute'],
                'permission_callback' => '__return_true'
            )
        );
    }

    public static function PostsRoute(): ?array
    {

        $p = get_posts(['post_type' => 'post', 'posts_per_page' => 100]);
        return $p;
    }

}