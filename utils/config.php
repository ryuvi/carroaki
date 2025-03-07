<?php

// Config.php (Singleton para Configurações)
class Config {
    private static $instance = null;
    private $config = [];

    private function __construct() {
        $this->config = parse_ini_file('config/config.ini');
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Config();
        }
        return self::$instance;
    }

    public function get($key) {
        return isset($this->config[$key]) ? $this->config[$key] : null;
    }

    private function __clone() {}
    public function __wakeup() {}
}

?>