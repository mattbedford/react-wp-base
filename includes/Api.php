<?php

namespace ReactBase\includes;


abstract class Api {

    public static function LoadApiRoutes()
    {
        register_rest_route(
            'react-base/v1', '/get-posts', array(
                'methods'  => 'POST',
                'callback' => [self::class, 'PostsRoute'],
                'permission_callback' => '__return_true'
            )
        );

        register_rest_route(
            'react-base/v1', '/get-images', array(
                'methods'  => 'POST',
                'callback' => [self::class, 'ImagesRoute'],
                'permission_callback' => '__return_true'
            )
        );
    }

    public static function PostsRoute(WP_REST_Request $request): ?array
    {

        $data = $request->get_params();
        $offset = intval(strip_tags($data['offset'])) ?? 0;

        $p = get_posts(['post_type' => 'post', 'posts_per_page' => 1, 'offset' => $offset]);
        if(!$p) return null;


        $posts = array_map(function ($post) {
            return [
                'id' => $post->ID,
                'title' => $post->post_title,
                'image' => get_the_post_thumbnail_url( $post->ID, 'full' ),
                'content' => $post->post_content,
                'excerpt' => $post->post_excerpt,
                'date' => $post->post_date,
                'modified' => $post->post_modified,
                'slug' => $post->post_name,
                'type' => $post->post_type,
                'author' => get_the_author_meta('display_name', $post->post_author),
            ];
        }, $p);

        return $posts;
    }


    public static function ImagesRoute($request)
    {
        $data = $request->get_params();
        $theme = sanitize_text_field($data['theme']);

        if(in_array($theme, ['nature', 'city', 'technology','food', 'abstract', 'still_life'  ])) {
            $theme = $theme ?? 'nature';
        }

        $response = null;
        $url = 'https://api.api-ninjas.com/v1/randomimage?category=' . $theme;
        $key = get_option('external_api_key');

        $response = wp_remote_get($url, array(
                'headers' => array(
                    'X-Api-Key' => $key,
                    'Accept' => 'image/jpg',
                ),
            ));

        if($response && !is_wp_error($response)) {
            return $response;
        }
        return "Error: something went wrong with this call.";
    }

}