<?php

/*
* Plugin Name: react-wp-base
*/

namespace ReactBase;

define( 'REACTIVE_PAGE', 'account' );

// One off for testing only. Quickly set an option.
// update_option('external_api_key', 'xxxxxxxxxxxxx');

\register_activation_hook(__FILE__, function(){
   \flush_rewrite_rules();
});

include_once dirname( __FILE__ ) . '/includes/Api.php';
include_once dirname( __FILE__ ) . '/includes/Html.php';
include_once dirname( __FILE__ ) . '/includes/Scripts.php';
include_once dirname( __FILE__ ) . '/includes/Loader.php';
include_once dirname( __FILE__ ) . '/includes/LoginRedirect.php';

new \ReactBase\includes\Loader();

