<?php

class Localidad{
    private $id;
    private $id_provincia;
    private $nombre;
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    function getId() {
        return $this->id;
    }

    function getIdProvincia() {
        return $this->id_provincia;
    }

    function getNombre() {
        return $this->nombre;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setIdProvincia($id_provincia) {
        $this->id_provincia = $id_provincia;
    }

    function setNombre($nombre) {
        $this->nombre = $this->db->real_escape_string($nombre);
    }

    public function getAll(){
        $localidades = $this->db->query("SELECT * FROM localidades ORDER BY id DESC;");
        return $localidades;
    }

    public function getOne(){
        $localidad = $this->db->query("SELECT * FROM localidades WHERE id={$this->getId()}");
        return $localidad->fetch_object();
    }

    public function getByProvincia() {
        $localidades = $this->db->query(
                "SELECT * FROM localidades 
                WHERE id_provincia={$this->getIdProvincia()} 
                ORDER BY id DESC;");
        return $localidades;
    }

    public function getNombreProvincia() {
        $provincia = $this->db->query(
            "SELECT TOP 1 provincia FROM provincias
                INNER JOIN localidades l on provincias.id = l.id_provincia
                WHERE id={$this->getIdProvincia()};");
        return $provincia;
    }
}