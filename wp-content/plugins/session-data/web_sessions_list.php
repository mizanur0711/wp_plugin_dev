<?php

class WebSessionList
{
    private $wpdb;
    private $results;

    public function __construct()
    {
        global $wpdb;
        $this->wpdb = $wpdb;
    }

    public function handlingRequest()
    {
        $action = isset($_GET['action']) ? trim($_GET['action']) : "";
        $id = isset($_GET['id']) ? intval($_GET['id']) : "";
        $user_ip = isset($_GET['user_ip']) ? trim($_GET['user_ip']) : "";

        if (!empty($action) && $action == "delete") {
            $row = $this->wpdb->get_row(
                $this->wpdb->prepare("SELECT * from wp_sessions where id =%d", $id)
            );
            if ($row) {
                $this->wpdb->show_errors();
                $table_name = 'wp_sessions';
                $data = ['id' => $id];
                $this->wpdb->delete($table_name, $data, $format = NULL);
            }
        }
        if (!empty($action) && $action == "history") {
            $this->results = $this->wpdb->get_results("SELECT * FROM wp_sessions
                                  WHERE user_ip='$user_ip'");
        } else {
            $this->results = $this->wpdb->get_results("SELECT * FROM wp_sessions
                                          WHERE last_login IN (
                                              SELECT MAX(last_login)
                                              FROM wp_sessions
                                              GROUP BY user_ip
                                          );");
        }
    }

    public function showResults()
    {
        $content = '<table>';
        $content .= '<thead><tr>
                <th>user_ip</th>
                <th>browser</th>
                <th>browser_version</th>
                <th>last_login</th>
                <th>actions</th>
                </tr>
                </thead>';
        foreach ($this->results as $row) {
            $content .= '<tr>';
            $content .= '<td>' . $row->user_ip . '</td>';
            $content .= '<td>' . $row->browser . '</td>';
            $content .= '<td>' . $row->browser_version . '</td>';
            $content .= '<td>' . $row->last_login . '</td>';
            $content .= '<td>
                 <a href="admin.php?page=session-data&id=' . $row->id . '&action=delete">Delete</a>
                 <a href="admin.php?page=session-data&user_ip=' . $row->user_ip . '&action=history">History</a>
                 </td></tr>';
        }
        $content .= '</table>';
        echo $content;
    }
}
