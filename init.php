<?php

/*
* Plugin Name: react-wp-base
*/

namespace ReactBase;

define( 'REACTIVE_PAGE', 'Account' );

include_once dirname( __FILE__ ) . '/includes/Api.php';
include_once dirname( __FILE__ ) . '/includes/Html.php';
include_once dirname( __FILE__ ) . '/includes/Scripts.php';
include_once dirname( __FILE__ ) . '/includes/Loader.php';

new \ReactBase\includes\Loader();

