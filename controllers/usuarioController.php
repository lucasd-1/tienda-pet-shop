<?php
require_once 'models/usuario.php';
require_once 'models/provincia.php';
require_once 'models/localidad.php';

class usuarioController{
	
	public function index(){
		echo "Controlador Usuarios, Acción index";
	}
	
	public function registro(){
	    $provincia = new Provincia();
	    $provincias = $provincia->getAll();
	    $localidad = new Localidad();
	    $localidad->setIdProvincia(1);
	    $localidades = $localidad->getByProvincia();
		require_once 'views/usuario/registro.php';
	}
	
	public function save(){
		if(isset($_POST)){
			$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
			$apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : false;
			$email = isset($_POST['email']) ? $_POST['email'] : false;
			$password = isset($_POST['password']) ? $_POST['password'] : false;
            $dni = isset($_POST['dni']) ? $_POST['dni'] : false;
            $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : false;
            $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : false;
            $username = isset($_POST['username']) ? $_POST['username'] : false;
            $rol = isset($_POST['rol']) ? $_POST['rol'] : 2;
            $localidad = isset($_POST['localidad']) ? $_POST['localidad'] : false;
			
			if($nombre && $apellidos && $email && $password){
				$usuario = new Usuario();
				$usuario->setNombre($nombre);
				$usuario->setApellidos($apellidos);
				$usuario->setEmail($email);
				$usuario->setPassword($password);
                $usuario->setDni($dni);
                $usuario->setTelefono($telefono);
                $usuario->setDireccion($direccion);
                $usuario->setUsername($username);
                $usuario->setRol($rol);
                $usuario->setLocalidad($localidad);
                                
                                
                if(isset($_FILES['imagenusuario'])){
                    $file = $_FILES['imagenusuario'];
                    $filename = $file['name'];
                    $mimetype = $file['type'];

                    if($mimetype == "image/jpg" || $mimetype == 'image/jpeg' || $mimetype == 'image/png' || $mimetype == 'image/gif'){

                        if(!is_dir('uploads/imgsUsers')){
                            mkdir('uploads/imgsUsers', 0777, true);
                        }

                        $usuario->setImagenusuario($filename);
                        move_uploaded_file($file['tmp_name'], 'uploads/imgsUsers/'.$filename);
                    }
                }

                $save = $usuario->save();
				if($save){
					$_SESSION['register'] = "complete";
				}else{
					$_SESSION['register'] = "failed";
				}
			} else{
				$_SESSION['register'] = "failed";
			}
		} else{
			$_SESSION['register'] = "failed";
		}

		header("Location:".base_url.'usuario/registro');
	}
	
	public function login(){
		if(isset($_POST)){
			// Identificar al usuario
			// Consulta a la base de datos
			$usuario = new Usuario();
			$usuario->setEmail($_POST['email']);
			$usuario->setPassword($_POST['password']);
			
			$identity = $usuario->login();
			
			if($identity && is_object($identity)){
				$_SESSION['identity'] = $identity;
				
				if($identity->permiso_id == 1){
					$_SESSION['admin'] = true;
				}
				
			}else{
				$_SESSION['error_login'] = 'Identificación fallida !!';
			}
		
		}
		header("Location:".base_url);
	}
	
	public function logout(){
		if(isset($_SESSION['identity'])){
			unset($_SESSION['identity']);
		}
		
		if(isset($_SESSION['admin'])){
			unset($_SESSION['admin']);
		}
		
		header("Location:".base_url);
	}

	public function getLocalidades() {
        $localidad = new Localidad();
        $localidad->setIdProvincia($_POST['prov_id']);
        $loc_filtradas = $localidad->getByProvincia();
        require_once 'views/usuario/getLocalidades.php';
    }
	
}
