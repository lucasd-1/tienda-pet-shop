<?php
require_once 'models/pedido.php';
require_once 'models/estado_pedido.php';
require_once 'models/provincia.php';
require_once 'models/localidad.php';

class pedidoController{

    public function getLocalidades() {
        $localidad = new Localidad();
        $localidad->setIdProvincia($_POST['prov_id']);
        $loc_filtradas = $localidad->getByProvincia();
        require_once 'views/usuario/getLocalidades.php';
    }
	
	public function envio(){
        $provincia = new Provincia();
        $provincias = $provincia->getAll();
        $localidad = new Localidad();
        $localidad->setIdProvincia(1);
        $localidades = $localidad->getByProvincia();
		require_once 'views/pedido/envio.php';
	}

    public function pago(){
        $provincia = isset($_POST['provincia']) ? $_POST['provincia'] : false;
        $localidad = isset($_POST['localidad']) ? $_POST['localidad'] : false;
        $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : false;
        require_once 'views/pedido/abonar.php';
    }
	
	public function add(){
		if(isset($_SESSION['identity'])){
			$usuario_id = $_SESSION['identity']->id;
			$prov = isset($_POST['provincia']) ? $_POST['provincia'] : 1;
			$loc = isset($_POST['localidad']) ? $_POST['localidad'] : 1;
			$direccion = isset($_POST['direccion']) ? $_POST['direccion'] : '';

			$provincia = new Provincia();
			$localidad = new Localidad();
			$provincia->setId($prov);
			$localidad->setId($loc);

			
			$stats = Utils::statsCarrito();
			$coste = $stats['total'];
				
			if($provincia && $localidad && $direccion){
				// Guardar datos en bd
				$pedido = new Pedido();
				$pedido->setUsuario_id($usuario_id);
				$pedido->setProvincia($provincia->getOne()->provincia);
				$pedido->setLocalidad($localidad->getOne()->localidad);
				$pedido->setDireccion($direccion);
				$pedido->setCoste($coste);
				
				$save = $pedido->save();

				// Guardar linea pedido
				$save_linea = $pedido->save_linea();

                if($save && $save_linea){
					$_SESSION['pedido'] = "complete";
                    unset($_SESSION['carrito']);
                }else{
					$_SESSION['pedido'] = "failed";
				}
				
			}else{
				$_SESSION['pedido'] = "failed";
            }
			
			header("Location:".base_url.'pedido/confirmado');			
		}else{
			// Redigir al index
			header("Location:".base_url);
		}
	}
	
	public function confirmado(){
		if(isset($_SESSION['identity'])){
			$identity = $_SESSION['identity'];
			$pedido_ = new Pedido();
			$pedido_->setUsuario_id($identity->id);
			
			$pedido = $pedido_->getOneByUser();
			
			$pedido_productos = new Pedido();
			$productos = $pedido_productos->getProductosByPedido($pedido->id);
		}
		require_once 'views/pedido/confirmado.php';
	}
	
	public function mis_pedidos(){
		Utils::isIdentity();
		$usuario_id = $_SESSION['identity']->id;
		$pedido = new Pedido();
		
		// Sacar los pedidos del usuario
		$pedido->setUsuario_id($usuario_id);
		$pedidos = $pedido->getAllByUser();
		
		require_once 'views/pedido/mis_pedidos.php';
	}
	
	public function detalle(){
		Utils::isIdentity();
		
		if(isset($_GET['id'])){
			$id = $_GET['id'];
			
			// Sacar el pedido
			$pedido_obj = new Pedido();
			$estado_ped = new Estado_Pedido();
			$pedido_obj->setId($id);
			$pedido = $pedido_obj->getOne();
			$productos = $pedido_obj->getProductosByPedido($id);
			$estados = $estado_ped->getAll();
			
			require_once 'views/pedido/detalle.php';
		}else{
			header('Location:'.base_url.'pedido/mis_pedidos');
		}
	}
	
	public function gestion(){
		Utils::isAdmin();
		$gestion = true;
		
		$pedido = new Pedido();
		$pedidos = $pedido->getAll();
		
		require_once 'views/pedido/mis_pedidos.php';
	}
	
	public function estado(){
		Utils::isAdmin();
		if(isset($_POST['pedido_id']) && isset($_POST['estado'])){
			// Recoger datos form
			$id = $_POST['pedido_id'];
			$estado = $_POST['estado'];
			
			// Upadate del pedido
			$pedido = new Pedido();
			$pedido->setId($id);
			$pedido->setIdEstadoPedido($estado);
			$pedido->edit();

            header("Location:".base_url.'pedido/detalle&id='.$id);
		}else{
			header("Location:".base_url);
		}
	}

    public function abonar(){
	    require_once 'views/pedido/abonar.php';
    }
	
}