<?php

require_once 'models/estado_pedido.php';

class Utils{
	
	public static function deleteSession($name){
		if(isset($_SESSION[$name])){
			$_SESSION[$name] = null;
			unset($_SESSION[$name]);
		}
		
		return $name;
	}
	
	public static function isAdmin(){
		if(!isset($_SESSION['admin'])){
			header("Location:".base_url);
		}else{
			return true;
		}
	}
	
	public static function isIdentity(){
		if(!isset($_SESSION['identity'])){
			header("Location:".base_url);
		}else{
			return true;
		}
	}
	
	public static function showCategorias(){
		require_once 'models/categoria.php';
		$categoria = new Categoria();
		$categorias = $categoria->getAll();
		return $categorias;
	}

    public static function showSubcategorias(){
        require_once 'models/Subcategoria.php';
        $subcategoria = new Subcategoria();
        $subcategorias = $subcategoria->getAll();
        return $subcategorias;
    }

    public static function showProductos() {
        require_once 'models/producto.php';
        $producto = new Producto();
        $productos = $producto->getAll();
        return $productos;
    }

    public static function statsCarrito(){
		$stats = array(
			'count' => 0,
			'total' => 0
		);
		
		if(isset($_SESSION['carrito'])){
			$stats['count'] = count($_SESSION['carrito']);
			
			foreach($_SESSION['carrito'] as $producto){
				$stats['total'] += $producto['precio']*$producto['unidades'];
			}
		}
		
		return $stats;
	}
	
	public static function showStatus($status){
		$estado = new Estado_Pedido();
		$estado->setId($status);
		$estado->getOne();
		return $estado->getDescripcion();
	}

	public static function getCsv($result, $filename) {
        $head[] = [];
        header('Content-type: application/csv');
        header('Content-Disposition: attachment; filename='.$filename.'.csv');
        ob_end_clean();
        $headers = $result->fetch_fields();
        foreach($headers as $header) {
            $head[] = $header->name;
        }
        $f = fopen('php://output', 'w');
        fputcsv($f, array_values($head));
        while ($row = mysqli_fetch_row($result)) {
            fputcsv($f, $row);
        }
        fclose($f);
        exit;
    }

}