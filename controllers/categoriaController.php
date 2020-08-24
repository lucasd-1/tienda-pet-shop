<?php
require_once 'models/categoria.php';
require_once 'models/producto.php';

class categoriaController{
    public function index(){
        utils::isAdmin();
        $categoria = new categoria();
        $categorias = $categoria->getAll();
        
        
        require_once 'views/categoria/index.php';
    }
    
    public function ver(){
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            
            //Conseguir categoria
            $categoria = new Categoria();
            $categoria->setId($id);
            
            $categoria = $categoria->getOne();
            
            //Conseguir producto
            $producto = new Producto();
            $producto->setCategoria_id($id);
            $productos = $producto->getAllCategory();
        }
        
        require_once 'views/producto/lista.php';
    }
    
    public function crear(){
        utils::isAdmin();
        require_once 'views/categoria/crear.php';
        
    }
    
    public function save(){
        utils::isAdmin();
        
        if(isset($_POST) && isset($_POST['nombre'])){
                //Guardar categoria en bd
                $categoria = new categoria();
                $categoria->setNombre($_POST['nombre']);
                $categoria->save();
        }
        header("Location:".base_url."categoria/index");
      
    }
}