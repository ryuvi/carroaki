<?php
// Session.php (Singleton para Sessão)
class Session {
    private static $instance = null;

    private function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Session();
        }
        return self::$instance;
    }

    public function unset($key) {
        unset($_SESSION[$key]);
    }

    public function set($key, $value) {
        $_SESSION[$key] = $value;
    }

    public function get($key) {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    public function destroy() {
        session_destroy();
    }

    private function __clone() {}
    public function __wakeup() {}
}
?>