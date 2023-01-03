<?php
include('get_user_ip.php');
include('get_browser.php');

/**
 * Plugin Name: Session Data
 * Description: this will show user ip in distinct & history by user ip.
 */
class SessionData
{
    public function __construct()
    {
        add_action('wp_footer', array($this, 'setSessionData'));
        add_action('admin_menu', array($this, 'webSessionsMenu'));
    }

    public function setSessionData()
    {
        global $wpdb;
        $userIP = new UserIP();
        $ua = getBrowser();
        $ip = $userIP->getIP();
        $data = array(
            'user_ip' => $ip,
            'browser' => $ua['name'],
            'browser_version' => $ua['version'],
            'last_login' => current_datetime()->format('Y-m-d H:i:s')
        );
        $table_name = 'wp_sessions';
        $wpdb->insert($table_name, $data, $format = NULL);

        echo '<div>' . "Your browser: " . $ua['name'] . " " . $ua['version'] . "& Your ip is: " . $ip . '</div>';
    }

    public function webSessionsMenu()
    {
        add_menu_page('Session Data', 'Session Data', 8, 'session-data', array($this, 'webSessionsList'), 'session-data');
    }

    public function webSessionsList()
    {
        include('web_sessions_list.php');
        $webSessionList = new WebSessionList();
        $webSessionList->handlingRequest();
        $webSessionList->showResults();
    }
}

new SessionData();
