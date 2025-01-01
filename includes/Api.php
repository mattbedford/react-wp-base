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

}