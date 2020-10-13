<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';

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
	
    public function recuperarPass(){

	    // Comprobar email enviado en form y guardarlo en una variable
        if(isset($_POST['email'])) {
            $emailTo = $_POST['email'];

            $usuario = new Usuario();
            $usuario->setEmail($emailTo);

            // Comprobar si existe usuario con ese email
            if (!$usuario->getOneByEmail()) {
                $error = "El email ingresado no pertenece a ningun usuario registrado";
                return require_once 'views/usuario/recuperarpass.php';
            }

            // Generar un token de seguridad
            $token = "0123456789asdfghjklqwertyuiop";
            $token = str_shuffle($token);
            $token = substr($token, 0, 20);

            // Guardar token en la base de datos
            $usuario->setToken($token);
            $saved = $usuario->saveToken();
            if (!$saved) {
                $error = "Hubo un problema al generar el código temporal. Intente más tarde.";
                return require_once 'views/usuario/recuperarpass.php';
            }

            $result = $this->sendEmailResetPass($emailTo, $token);
        }

        require_once 'views/usuario/recuperarpass.php';
    }
        
    public function resetpass() {
        $usuario = new Usuario();

        if (isset($_GET["code"])){
            $code = $_GET['code'];
            $usuario->setEmail($_GET["email"]);
            $usuario->setToken($code);
            if (!$usuario->selectUserByTokenAndEmail()) {
                $error = 'Hubo un error con el token. Por favor, intente nuevamente';
            }

        } elseif (isset($_POST['password'])){
            $usuario->setEmail($_POST['email']);
            $usuario->setToken($_POST['token']);
            if ($usuario->selectUserByTokenAndEmail()) {
                $usuario->deleteToken();
                $usuario->refreshUserByEmail();
                $usuario->setPassword($_POST['password']);
                $result = $usuario->edit();
                if ($result) {
                    $success = 'Contraseña actualizada. Por favor acceda nuevamente';
                } else {
                    $error = 'Hubo un error al actualizar la contraseña. Intente nuevamente';
                }
            } else {
                $usuario->deleteToken();
                $error = 'Token invalido. Intente nuevamente';
            }
        }
        require_once 'views/usuario/resetpass.php';
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

			if($nombre && $apellidos && $email && $password && $dni){
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
					$_SESSION['register'] = 'complete';
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

	public function edit() {
        if(isset($_POST)){

            $usuario = new Usuario();
            $usuario->setId($_SESSION['identity']->id);

            $usuario->setNombre($_POST['nombre']);
            $usuario->setApellidos($_POST['apellidos']);
            $usuario->setEmail($_POST['email']);
            $usuario->setUsername($_POST['username']);
            $usuario->setDni($_POST['dni']);
            $usuario->setTelefono($_POST['telefono']);
            $usuario->setDireccion($_POST['direccion']);
            $usuario->setLocalidad($_POST['localidad']);

            $save = $usuario->edit();
            if($save){
                $_SESSION['identity'] = $usuario->getOne();
                $_SESSION['register'] = "complete";
            }else{
                $_SESSION['register'] = "failed";
            }
        } else{
            $_SESSION['register'] = "failed";
        }

        header("Location:".base_url.'usuario/miPerfil');
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
    
    public function miPerfil() {
	    if (isset($_SESSION['identity'])) {
            $usuario = $_SESSION['identity'];
            $localidad = new Localidad();
            $provincia = new Provincia();
            $localidad->setId($_SESSION['identity']->localidad_id ?? 0);
            if ($localidad->getId() > 0) {
                $debug = 'true';
                $ciudad = $localidad->getOne();
                $localidad->setLocalidad($ciudad->localidad);
                $provincia->setId($ciudad->id_provincia);
                $prov = $provincia->getOne();
                $provincia->setProvincia($prov->provincia);
            } else {
                $localidad->setLocalidad('');
                $provincia->setProvincia('');
            }
        }
        require_once 'views/usuario/miPerfil.php';
    }
        
    public function editar() {
        $usuario = $_SESSION['identity'] ?? false;
        $provincia = new Provincia();
        $provincias = $provincia->getAll();
        $localidad = new Localidad();
        if (isset($usuario->localidad_id)) {
            $localidad->setId($usuario->localidad_id);
            $loc = $localidad->getOne();
            $localidad->setIdProvincia($loc->id_provincia);
            $localidades = $localidad->getByProvincia();
            $localidad->setLocalidad($loc->localidad_id);
            $provincia->setId($localidad->getIdProvincia());
            $provincia->setProvincia($localidad->getNombreProvincia());
        } else {
            $localidad->setLocalidad('');
            $provincia->setProvincia('');
            $localidad->setIdProvincia(1);
            $localidades = $localidad->getByProvincia();
        }

        require_once 'views/usuario/editar.php';
	}


    // TODO: mover a helpers/utils despues de mergear
    // ----- Enviar email con phpmailer -----
    public function sendEmailResetPass($email, $token) {
        $mail = new PHPMailer(true);
        try {
            //Server settings - Configuración
            $mail->SMTPDebug = 0;                                       // Enable verbose debug output
            $mail->CharSet = 'UTF-8';
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                       // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = env('MAIL_USER');                  // SMTP username
            $mail->Password   = env('MAIL_PASS');                  // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients - Mail desde '...' hacia '...'
            $mail->setFrom('petit.shop.contacto@gmail.com', 'Petit Shop');
            $mail->addAddress("$email");     // Add a recipient

            // Attachments - Adjuntos
            //$mail->addAttachment('/var/tmp/file.tar.gz');              // Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');         // Optional name

            // Content - Contenido
            $url = env('BASE_PATH') . "usuario/resetpass&code=$token&email=$email";
            $mail->isHTML(true);                                         // Set email format to HTML
            $mail->Subject = 'Reestrablecer contraseña';
            $mail->Body    = "¡Hola! para restablecer tu contraseña haga clik en el siguiente link <a href='$url'>click aquí</a>"
                . ". Si ud no solicitó reestablecer contraseña ignore el mensaje";

            $mail->send();
            $result = 'El mensaje se envió correctamente';
        } catch (Exception $e) {
            $result = "Hubo un error al enviar el mensaje: {$mail->ErrorInfo}";
        }
        return $result;
    }

}
