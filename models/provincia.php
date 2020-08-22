<?php

class Provincia {
    private $id;
    private $provincia;

    public function __construct() {
        $this->db = Database::connect();
    }

    function getId() {
        return $this->id;
    }

    function getProvincia() {
        return $this->provincia;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setProvincia($provincia) {
        $this->provincia = $this->db->real_escape_string($provincia);
    }

    public function getAll(){
        $provincias = $this->db->query(
            "SELECT * FROM provincias ORDER BY id ASC;"
        );
        return $provincias;
    }

    public function getOne(){
        $provincia = $this->db->query("SELECT * FROM provincias WHERE id={$this->getId()}");
        return $provincia->fetch_object();
    }
}