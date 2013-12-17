<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FileManager
 *
 * @author galbanie <galbanie at setrukmarcroger@gmail.com>
 */
class FileManager {
    private $connexion = null;

    public function __construct(PDO $connexion){
        $this->connexion = $connexion;
    }
    
    public function insertBlob($filePath,$mime){
        $blob = fopen($filePath,'rb');

        $sql = "INSERT INTO files(mime,data) VALUES(:mime,:data)";
        $stmt = $this->connexion->prepare($sql);

        $stmt->bindParam(':mime',$mime);
        $stmt->bindParam(':data',$blob,PDO::PARAM_LOB);
        
        $stmt->execute();
        
        return $this->connexion->lastInsertId();
    }

    function updateBlob($id,$filePath,$mime) {

            $blob = fopen($filePath,'rb');

            $sql = "UPDATE files
                            SET mime = :mime,
                            data = :data
                            WHERE id = :id";

            $stmt = $this->connexion->prepare($sql);

            $stmt->bindParam(':mime',$mime);
            $stmt->bindParam(':data',$blob,PDO::PARAM_LOB);
            $stmt->bindParam(':id',$id);

            return $stmt->execute();

    }

    public function selectBlob($id) {

            $sql = "SELECT mime,
                            data
                            FROM files
                            WHERE id = :id";

            $stmt = $this->connexion->prepare($sql);
            $stmt->execute(array(":id" => $id));
            $stmt->bindColumn(1, $mime);
            $stmt->bindColumn(2, $data, PDO::PARAM_LOB);

            $stmt->fetch(PDO::FETCH_BOUND);

            return array("mime" => $mime,
                            "data" => $data);

    }

    public function __destruct() {
            $this->connexion = null;
    }
}
