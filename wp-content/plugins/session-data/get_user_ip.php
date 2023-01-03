<?php

class UserIP
{
    private $ip;

    public function __construct()
    {
        $this->ip = $this->getTheUserIP();
    }

    private function getTheUserIP()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return apply_filters('wpb_get_ip', $ip);
    }

    public function getIP()
    {
        return $this->ip;
    }
}
