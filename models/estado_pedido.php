<?php

class Estado_Pedido {
    private $db;
    private $id;
    private $descripcion;

    public function __construct() {
        $this->db = dataBase::connect();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * @param mixed $descripcion
     */
    public function setDescripcion($descripcion): void
    {
        $this->descripcion = $descripcion;
    }

    public function getOne(){
        $estado_pedido = $this->db->query("SELECT * FROM estados_pedidos WHERE id = {$this->getId()}")->fetch_object();
        $this->setDescripcion($estado_pedido->descripcion);
    }

    public function getAll(){
        return $this->db->query("SELECT * FROM estados_pedidos");
    }
}
