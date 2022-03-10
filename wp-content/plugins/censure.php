<?php
/*
Plugin Name: Censure 
Description: Comment censorship
Author: Shepilo Vika
*/

function myplugin_activation(){
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
register_activation_hook( __FILE__, 'myplugin_activation' );

function myplugin_deactivation(){
    global $wpdb; 
    $table_name = $wpdb->prefix . 'cens'; 
    $sql = "DROP TABLE IF EXISTS $table_name"; 
    $wpdb->query($sql); 
    delete_option("my_plugin_db_version");
}
register_deactivation_hook( __FILE__, 'myplugin_deactivation' );

function array_obscene_words()
{
    global $wpdb;
    $results = $wpdb->get_results( "SELECT cense FROM {$wpdb->prefix}cens", OBJECT );
    $obscene_words = array();
    foreach ($results as $keys => $values) {
        foreach ($values as $key => $value) {
            array_push($obscene_words, $value);
        }
    }
    return $obscene_words;
}

function menu_panel_add_word() 
{
    add_menu_page('Add word', 'Add word', 'manage_options', 'add_word.php', 'add_word', 'dashicons-phone', 1);
    function add_word() 
    {
        echo "
        <form action='admin-post.php' method='post'>
            <input type='hidden' name='action' value='create_word'>
            <input type='text' name='data' value=''>
            <input type='submit' value='Submit'>
        </form>
        ";
        $obscene_words = array_obscene_words();
        foreach($obscene_words as $key => $value){
            echo "
            <hr>
                <p>
                    <form method='POST' action='admin-post.php'>
                        <input type='hidden' name='action' value='delete_word'>
                        <input type='text' name='data_word' value='$value'>
                        <input type='submit' value='Delete'>
                    </form>
                </p>
            <hr>";
        }
    }
}
add_action('admin_menu', 'menu_panel_add_word');

function censure_filter_comments($comment_text)
{
    $obscene_words = array_obscene_words();
    $the_censure_content = str_ireplace(array_values($obscene_words), "***", $comment_text);
    return  $the_censure_content;
}
add_filter('comment_text', 'censure_filter_comments');


function prefix_admin_create_word() {
    status_header(200);
    global $wpdb;
    if (isset($_POST['data'])) {
        $data = $_POST['data'];
        $wpdb->insert("{$wpdb->prefix}cens",  array(
        'id' => 'AUTO_INCREMENT',
        'cense' => $data,
        ));
    }
    wp_redirect(admin_url('admin.php?page=add_word.php'));
}
add_action( 'admin_post_create_word', 'prefix_admin_create_word' );

function prefix_admin_delete_word() {
    status_header(200);
    global $wpdb;
    if (isset($_POST['data_word'])) {
        $data = $_POST['data_word'];
        $wpdb->delete("{$wpdb->prefix}cens",  array(
            'cense' => $data,
            ));
    }
    wp_redirect(admin_url('admin.php?page=add_word.php'));
}
add_action( 'admin_post_delete_word', 'prefix_admin_delete_word' );
