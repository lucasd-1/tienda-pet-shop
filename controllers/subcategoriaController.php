<?php
require_once 'models/Subcategoria.php';
require_once 'models/producto.php';

class SubcategoriaController{
    public function index(){
        utils::isAdmin();
        $subcategoria = new Subcategoria();
        $subcategorias = $subcategoria->getAll();


        require_once 'views/subcategoria/index.php';
    }

    public function ver(){
        if(isset($_GET['id']) && isset($_GET['catId'])){
            $id = $_GET['id'];
            $catId = $_GET['catId'];

            //Conseguir categoria
            $categoria = new Categoria();
            $categoria-> setId($catId);
            $subcategoria = new Subcategoria();
            $subcategoria->setId($id);
            $categoria = $categoria->getOne();
            $subcategoria = $subcategoria->getOne();

            //Conseguir producto
            $producto = new Producto();
            $producto->setSubcategoria_id($id);
            $producto->setCategoria_id($catId);
            $productos = $producto->getAllSubcategory();
        }

        require_once 'views/producto/lista.php';
    }

    public function crear(){
        utils::isAdmin();
        require_once 'views/subcategoria/crear.php';

    }

    public function save(){
        utils::isAdmin();

        if(isset($_POST) && isset($_POST['nombre'])){
            //Guardar subcategoria en bd
            $subcategoria = new Subcategoria();
            $subcategoria->setNombre($_POST['nombre']);
            $subcategoria->save();
        }
        header("Location:".base_url."subcategoria/index");

    }
}
