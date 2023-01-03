<?php
include ('get_user_ip.php');
include ('get_browser.php');

//define("SESSION_DATA_DIR_PATH",plugin_dir_path(__FILE__));

function setSessionData(){
    global $wpdb;
    $ua = getBrowser();
    $ip = getTheUserIP();
    $data = array(
        'user_ip' => $ip,
        'browser' => $ua['name'],
        'browser_version' => $ua['version'],
        'last_login' => current_datetime()->format('Y-m-d H:i:s')
    );
    $table_name = 'wp_sessions';
    //$wpdb->insert($table_name,$data,$format=NULL);

    echo '<div>'."Your browser: " . $ua['name'] . " " . $ua['version']."& Your ip is: ".$ip.'</div>';

}

function webSessionsMenu(){
    add_menu_page('Session Data', 'Session Data', 8, 'session-data','webSessionsList', 'session-data');
}

add_action( 'admin_menu', 'webSessionsMenu' );
add_action( 'wp_footer', 'setSessionData' );


function webSessionsList(){
    include('web_sessions_list.php');
}
 ?>