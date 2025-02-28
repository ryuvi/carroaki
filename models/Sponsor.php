<?php

class Sponsor {
    public function getSponsorList() {
        require 'config/database.php';

        $sql = "SELECT * FROM sponsors;";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function inserirPatrocinador($values = array()) {
        require 'config/database.php';

        $sql = "INSERT INTO sponsors (id, nome, link, imagem)
                     VALUES (:id, :nome, :link, :imagem);";

        $stmt = $pdo->prepare($sql);
        $stmt->execute($values);
    }

    public function removerPatrocinador($id = '') {
        require 'config/database.php';

        $sql = "DELETE FROM sponsors WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue('id', $id);
        $stmt->execute();
    }
}

?>