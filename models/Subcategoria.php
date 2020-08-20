<?php

class Subcategoria{
    private $id;
    private $nombre;
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    function getId() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNombre($nombre) {
        $this->nombre = $this->db->real_escape_string($nombre);
    }

    public function getAll(){
        $subcategorias = $this->db->query("SELECT * FROM subcategorias ORDER BY id DESC;");
        return $subcategorias;
    }

    public function getOne(){
        $subcategoria = $this->db->query("SELECT * FROM subcategorias WHERE id={$this->getId()}");
        return $subcategoria->fetch_object();
    }

    public function save(){
        $sql = "INSERT INTO subcategorias VALUES(NULL, '{$this->getNombre()}');";
        $save = $this->db->query($sql);

        $result = false;
        if($save){
            $result = true;
        }
        return $result;
    }

}