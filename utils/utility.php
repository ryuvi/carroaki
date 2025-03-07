<?php

class Utility {
    private static $instance;

    // Impede a criação do objeto diretamente
    private function __construct() {}

    // Impede a clonagem do objeto
    private function __clone() {}

    // Impede a desserialização
    public function __wakeup() {}

    // Método para obter a instância única da classe
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function gerarUUID() {
        return sprintf(
            "%04x%04x-%04x-%04x-%04x-%04x%04x%04x",
            mt_rand(0,0xffff), mt_rand(0,0xffff),
            mt_rand(0,0xffff),
            mt_rand(0,0x0fff) | 0x4000,
            mt_rand(0,0x3fff) | 0x8000,
            mt_rand(0,0xffff), mt_rand(0,0xffff), mt_rand(0,0xffff)
        );
    }

    public function startsWith($startString, $string) {
        return strpos($string, $startString) === 0;
    }
}

?>
