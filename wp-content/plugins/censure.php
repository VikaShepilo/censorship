<?php
/*
Plugin Name: Censure 
Description: Comment censorship
Author: Shepilo Vika
*/

function myplugin_activation(){
	create_table();
}
register_activation_hook( __FILE__, 'myplugin_activation' );

function myplugin_deactivation(){
    global $wpdb; 
    $table_name = $wpdb->prefix . 'cens'; 
    $sql = "DROP TABLE IF EXISTS $table_name"; 
    $wpdb->query($sql); 
    delete_option("my_plugin_db_version");
}
register_deactivation_hook( __FILE__, 'myplugin_deactivation' );

function create_table(){
    global $wpdb;
    $table_name = $wpdb->prefix . "cens";
    $sql = "CREATE TABLE " . $table_name . " (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        cense text NOT NULL COLLATE utf8_general_ci,
        UNIQUE KEY id (id)
    );";
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
} 
add_action( 'init', 'create_table' );

function menu_panel_add_word() 
{
    add_menu_page('Add word', 'Add word', 'manage_options', 'add_word.php', 'add_word','dashicons-phone', 1);
    function add_word() {
    echo "<h2>Add word</h2>
    <hr>
        <p>
            <form method='POST' action=''>
                New word: 
                <input type='text' name='new-word'><br>
                <input type='submit'>
                </p>
            </form>
        </p>
    <hr>";
    }
}
add_action('admin_menu', 'menu_panel_add_word');

function censure_filter_comments($comment_text)
{
    global $wpdb;
    $results = $wpdb->get_results( "SELECT cense FROM {$wpdb->prefix}cens", OBJECT );
    $obscene_words = array();
    foreach ($results as $keys => $values) {
        foreach ($values as $key => $value) {
            array_push($obscene_words, $value);
        }
    }
    $the_censure_content = str_ireplace(array_values($obscene_words), "***", $comment_text);
    return  $the_censure_content;
}
add_filter('comment_text', 'censure_filter_comments');

function censure_filter_data() 
{
    global $wpdb;
    if (isset($_POST['new-word'])) {
        $data = $_POST['new-word'];
        $wpdb->insert("{$wpdb->prefix}cens",  array(
        'id' => 'AUTO_INCREMENT',
        'cense' => $data,
        ));
    }
} 
add_filter('admin_init', 'censure_filter_data'); 