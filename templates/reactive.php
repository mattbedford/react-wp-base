<?php

do_action('wp_head');


if(!current_user_can('edit_posts') && !current_user_can('edit_pages')) {
    die("You don't have permission to view this page.");
}

echo "<div>";
echo "<div id='react-app'>";
echo "</div>";
echo "</div>";

do_action('wp_footer');