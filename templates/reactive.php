<?php

do_action('wp_head');


if(0 === get_current_user_id() || !current_user_can('read')) {
    die("You don't have permission to view this page.");
}

echo "<div>";
echo "<div id='react-app'>";
echo "</div>";
echo "</div>";

do_action('wp_footer');