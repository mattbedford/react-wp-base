<?php

namespace ReactBase\includes;


use ulogger;

abstract class UserCustomerSync
{

    public static function AssignCustomerAsPostAuthor( $post_id ) {

            $owner = get_field('owner', $post_id);
            $owner_id = $owner->ID;
            $data = [
                'ID' => $post_id,
                'post_author' => $owner_id
            ];
            $post_id = \wp_update_post($data);

            return $post_id;

    }
}