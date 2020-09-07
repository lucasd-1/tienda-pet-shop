<?php
require_once 'models/producto.php';

class productoController{
	
	public function index(){
		$producto = new Producto();
		$productos = $producto->getRandom(6);
	
		// renderizar vista
		require_once 'views/producto/destacados.php';
	}
	
	public function ver(){
		if(isset($_GET['id'])){
			$id = $_GET['id'];
		
			$producto = new Producto();
			$producto->setId($id);
			
			$product = $producto->getOne();
			
		}
		require_once 'views/producto/ver.php';
	}
        
    public function buscar(){
		if(isset($_POST['busqueda'])){
			$busqueda = $_POST['busqueda'];
		
			$producto = new Producto();
					
			$productos = $producto->buscarProduct($busqueda);
			
		}
		require_once 'views/producto/lista.php';
	}
	
	public function gestion(){
		Utils::isAdmin();
		
		$producto = new Producto();
		$productos = $producto->getAll();
		
		require_once 'views/producto/gestion.php';
	}
	
	public function crear(){
		Utils::isAdmin();
		require_once 'views/producto/crear.php';
	}

	// TODO: agregar validaciones de file upload https://www.php.net/manual/en/features.file-upload.php
	public function save(){
		Utils::isAdmin();
		if(isset($_POST)){
			$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
			$descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;
			$precio = isset($_POST['precio']) ? $_POST['precio'] : false;
			$stock = isset($_POST['stock']) ? $_POST['stock'] : false;
            $oferta = isset($_POST['oferta']) ? $_POST['oferta'] : false;
            $categoria = isset($_POST['categoria']) ? $_POST['categoria'] : false;
            $subcategoria = isset($_POST['subcategoria']) ? $_POST['subcategoria'] : false;
			$proveedor = isset($_POST['proveedor']) ? $_POST['proveedor'] : false;
			$tags = isset($_POST['tags']) ? $_POST['tags'] : false;
            $precio_venta = isset($_POST['precio_venta']) ? $_POST['precio_venta'] : false;


            if($nombre && $descripcion && $precio && $stock && $categoria && $subcategoria){
				$producto = new Producto();
				$producto->setNombre($nombre);
				$producto->setDescripcion($descripcion);
				$producto->setPrecio($precio);
				$producto->setStock($stock);
				$producto->setCategoria_id($categoria);
                $producto->setSubcategoria_id($subcategoria);

                $producto->setOferta($oferta);
                $producto->setProveedor($proveedor);
                $producto->setTags($tags);
                $producto->setPrecioVenta($precio_venta);

                $producto->setImagen2($_POST['imagen2_current']);
                $producto->setImagen3($_POST['imagen3_current']);

                // Guardar la imagen
                foreach($_FILES as $key => $value) {
                    $filename = $value['name'];
                    $mimetype = $value['type'];
                    $_SESSION['file'] = $value;

                    if($mimetype == "image/jpg" || $mimetype == 'image/jpeg' || $mimetype == 'image/png' || $mimetype == 'image/gif'){

                        if(!is_dir('uploads/images')){
                            mkdir('uploads/images', 0777, true);
                        }

                        switch ($key) {
                            case 'imagen1':
                                $producto->setImagen($filename);
                                break;
                            case 'imagen2':
                                $producto->setImagen2($filename);
                                break;
                            case 'imagen3':
                                $producto->setImagen3($filename);
                                break;
                        }
                        move_uploaded_file($value['tmp_name'], 'uploads/images/'.$filename);
                    }
                }

                // Borrar imagenes
                if (isset($_POST['delete-imagen2'])) {
                    $producto->setImagen2(null);
                }
                if (isset($_POST['delete-imagen3'])) {
                    $producto->setImagen3(null);
                }

                if(isset($_GET['id'])){
					$id = $_GET['id'];
					$producto->setId($id);
					
					$save = $producto->edit();
				}else{
					$save = $producto->save();
				}

				if($save){
					$_SESSION['producto'] = "complete";
				}else{
					$_SESSION['producto'] = "failed";
				}
			}else{
				$_SESSION['producto'] = "failed";
			}
		}else{
			$_SESSION['producto'] = "failed";
		}
		header('Location:'.base_url.'producto/gestion');
	}
	
	public function editar(){
		Utils::isAdmin();
		if(isset($_GET['id'])){
			$id = $_GET['id'];
			$edit = true;
			
			$producto = new Producto();
			$producto->setId($id);
			
			$pro = $producto->getOne();
			
			require_once 'views/producto/crear.php';
			
		}else{
			header('Location:'.base_url.'producto/gestion');
		}
	}
	
	public function eliminar(){
		Utils::isAdmin();
		
		if(isset($_GET['id'])){
			$id = $_GET['id'];
			$producto = new Producto();
			$producto->setId($id);
			
			$delete = $producto->delete();
			if($delete){
				$_SESSION['delete'] = 'complete';
			}else{
				$_SESSION['delete'] = 'failed';
			}
		}else{
			$_SESSION['delete'] = 'failed';
		}
		
		header('Location:'.base_url.'producto/gestion');
	}
	
}