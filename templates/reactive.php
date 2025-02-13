<?php

do_action('wp_head');


if(0 === get_current_user_id() || !current_user_can('read')) {
    die("You don't have permission to view this page.");
}

echo "<div>";
echo "<div id='react-app'>";
echo "</div>";
echo "</div>";

echo "<div class='account-cf7-wrapper'>";
echo do_shortcode('[contact-form-7 id="0cbaf9e" title="Contact form 1"]');
echo "</div>";
do_action('wp_footer');