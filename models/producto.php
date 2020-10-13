<?php

class Producto{
	private $id;
	private $categoria_id;
	private $subcategoria_id;
	private $nombre;
	private $descripcion;
	private $precio;
	private $stock;
	private $oferta;
	private $fecha;
    private $proveedor;
    private $tags;
    private $imagen;
    private $imagen2;
    private $imagen3;
    private $precio_venta;

    private $db;
	
	public function __construct() {
		$this->db = Database::connect();
	}
	
	function getId() {
		return $this->id;
	}

	function getCategoria_id() {
		return $this->categoria_id;
	}

    function getSubcategoria_id() {
        return $this->subcategoria_id;
    }

	function getNombre() {
		return $this->nombre;
	}

	function getDescripcion() {
		return $this->descripcion;
	}

	function getPrecio() {
		return $this->precio;
	}

	function getStock() {
		return $this->stock;
	}

	function getOferta() {
		return $this->oferta;
	}

	function getFecha() {
		return $this->fecha;
	}

	function getImagen() {
		return $this->imagen;
	}

    function getProveedor() {
        return $this->proveedor;
    }

    function getTags() {
        return $this->tags;
    }

    function getImagen2() {
        return $this->imagen2;
    }

    function getImagen3() {
        return $this->imagen3;
    }

    function getPrecioVenta() {
        return $this->precio_venta;
    }

    function setId($id) {
		$this->id = $id;
	}

    function setCategoria_id($categoria_id) {
		$this->categoria_id = $categoria_id;
	}

    public function setSubcategoria_id($subcategoria_id): void {
        $this->subcategoria_id = $subcategoria_id;
    }

	function setNombre($nombre) {
		$this->nombre = $this->db->real_escape_string($nombre);
	}

	function setDescripcion($descripcion) {
		$this->descripcion = $this->db->real_escape_string($descripcion);
	}

	function setPrecio($precio) {
		$this->precio = $this->db->real_escape_string($precio);
	}

	function setStock($stock) {
		$this->stock = $this->db->real_escape_string($stock);
	}

	function setOferta($oferta) {
		$this->oferta = $this->db->real_escape_string($oferta);
	}

	function setFecha($fecha) {
		$this->fecha = $fecha;
	}

	function setImagen($imagen) {
		$this->imagen = $imagen;
	}

    function setProveedor($proveedor) {
        $this->proveedor = $proveedor;
    }

    function setTags($tags) {
        $this->tags = $tags;
    }

    function setImagen2($imagen2) {
        $this->imagen2 = $imagen2;
    }

    function setImagen3($imagen3) {
        $this->imagen3 = $imagen3;
    }

    function setPrecioVenta($precio_venta) {
	    $this->precio_venta = $precio_venta;
    }

	public function getAll(){
		$productos = $this->db->query("SELECT * FROM productos ORDER BY id DESC");
		return $productos;
	}
        
	public function getAllCategory(){
		$sql = "SELECT p.*, c.nombre AS 'catnombre' FROM productos p "
				. "INNER JOIN categorias c ON c.id = p.categoria_id "
				. "WHERE p.categoria_id = {$this->getCategoria_id()} "
				. "ORDER BY id DESC";
		$productos = $this->db->query($sql);
		return $productos;
	}

    public function getAllSubcategory(){
        $sql = "SELECT p.*, c.nombre AS 'catnombre' FROM productos p "
            . "INNER JOIN subcategorias c ON c.id = p.subcategoria_id "
            . "WHERE p.subcategoria_id = {$this->getSubcategoria_id()} "
            . "ORDER BY id DESC";
        $productos = $this->db->query($sql);
        return $productos;
    }

    public function getAllCategorySubcategory(){
        $sql = "SELECT p.*, c.nombre AS 'catnombre' FROM productos p "
            . "INNER JOIN subcategorias c ON c.id = p.subcategoria_id "
            . "WHERE p.subcategoria_id = {$this->getSubcategoria_id()} "
            . "AND p.categoria_id = {$this->getCategoria_id()} "
            . "ORDER BY id DESC";
        $productos = $this->db->query($sql);
        return $productos;
    }

    public function getRandom($limit){
		$productos = $this->db->query("SELECT * FROM productos ORDER BY RAND() LIMIT $limit");
		return $productos;
	}
	
    public function getOne(){
		$producto = $this->db->query("SELECT * FROM productos WHERE id = {$this->getId()}");
		return $producto->fetch_object();
	}
        
    public function buscarProduct($busqueda){
        $productos = $this->db->query("SELECT * FROM productos WHERE nombre LIKE '%$busqueda%' 
                           or tags LIKE '%$busqueda%' or descripcion LIKE '%$busqueda%'");
        return $productos;
    }
      
	public function save(){
		$sql = "INSERT INTO productos VALUES(
                     NULL, 
                     {$this->getCategoria_id()},
                     '{$this->getNombre()}', 
                     '{$this->getDescripcion()}', 
                     {$this->getPrecio()}, 
                     {$this->getStock()}";

        $sql .= $this->getOferta() != null ? ", '{$this->getOferta()}'" : ",NULL";
        $sql .= ", CURDATE(),
                '{$this->getImagen()}',
                {$this->getSubcategoria_id()}";
        $sql .= $this->getProveedor() != null ? ", '{$this->getProveedor()}'" : ",NULL";
        $sql .= $this->getTags() != null ? ", '{$this->getTags()}'" : ",NULL";
        $sql .= $this->getPrecioVenta() != null ? ", '{$this->getPrecioVenta()}'" : ",NULL";
        $sql .= $this->getImagen2() != null ? ", '{$this->getImagen2()}'" : ",NULL";
        $sql .= $this->getImagen3() != null ? ", '{$this->getImagen3()}'" : ",NULL";
        $sql .= ");";

		return $save = $this->db->query($sql);
	}
	
	public function edit(){
		$sql = "UPDATE productos SET 
                     nombre='{$this->getNombre()}', 
                     descripcion='{$this->getDescripcion()}', 
                     precio={$this->getPrecio()}, 
                     stock={$this->getStock()}, 
                     categoria_id={$this->getCategoria_id()},  
                     subcategoria_id={$this->getSubcategoria_id()},
                     oferta='{$this->getOferta()}',
                     proveedor='{$this->getProveedor()}',
                     tags='{$this->getTags()}'";
		
		if($this->getImagen() != null){
			$sql .= ", imagen='{$this->getImagen()}'";
		}

        $sql .= $this->getImagen2() !== NULL ? ", img2='{$this->getImagen2()}'" : ", img2=NULL";
        $sql .= $this->getImagen3() !== NULL ? ", img3='{$this->getImagen3()}'" : ", img3=NULL";
		$sql .= " WHERE id={$this->id};";
		$save = $this->db->query($sql);
		
		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}
	
	public function delete(){
		$sql = "DELETE FROM productos WHERE id={$this->id}";
		$delete = $this->db->query($sql);
		
		$result = false;
		if($delete){
			$result = true;
		}
		return $result;
	}
	
}