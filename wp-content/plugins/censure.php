<?php
/*
Plugin Name: Censure 
Description: Comment censorship
Author: Shepilo Vika
*/

function censure_filter_comments($the_content)
{
    global $wpdb;
    $results = $wpdb->get_results( "SELECT cense FROM {$wpdb->prefix}cens", OBJECT );
    $obscene_words = array();
    foreach ($results as $keys => $values) {
        foreach ($values as $key => $value) {
            array_push($obscene_words, $value);
        }
    }

    $the_censure_content = str_ireplace(array_values($obscene_words), "***", $the_content);

    return  $the_censure_content;
}
add_filter('the_content', 'censure_filter_comments');


function censure_filter_data( $data ) 
{
    global $wpdb;
    $wpdb->insert("{$wpdb->prefix}cens",  array(
        'cense' => $data['new-word'],
    ));
} 
add_filter( 'wpcf7_posted_data', 'censure_filter_data'); 

