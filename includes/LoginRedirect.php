<?php

namespace ReactBase\includes;


abstract class LoginRedirect
{


    public static function SubscriberRedirectToAccountPage( $redirect_to, $request, $user ) {

        if( is_wp_error( $user )) return $redirect_to;
        if ( ! $user ) return $redirect_to;
        if(!self::RoleIsSubscriber($user)) return $redirect_to;

        return get_site_url() . '/' . REACTIVE_PAGE;

    }


    public static function BlockWpAdminForSubscribers() {
        if ( defined('DOING_AJAX') && \DOING_AJAX ) return;

        $user = wp_get_current_user();

        if(self::RoleIsSubscriber($user)) {
            wp_redirect( get_site_url() . '/' . REACTIVE_PAGE );
            die;
        }
    }

    public static function RoleIsSubscriber($user)
    {

        if ( isset( $user->roles ) && is_array( $user->roles ) ) {
            return in_array("subscriber", $user->roles);
        }
        return false;
    }


}