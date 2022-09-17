<?php

add_action('wp_head', 'callback_function'); // Callback function will be fired on head
add_action('wp_footer', 'callback_function'); // Callback function will be fired on footer

function khan_content_filter($content)
{
    $content = $content . "added";
    return $content;
}
add_filter('the_content', 'khan_content_filter');

global $post;
$author_id = $post->post_author;
$author    = get_user_by('id', $author_id);