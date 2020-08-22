<?php

class usuario{
    private $id;
    private $nombre;
    private $apellidos;
    private $email;
    private $password;
    private $rol;
    private $imagenusuario;
    private $db;
    private $dni;
    private $telefono;
    private $direccion;
    private $username;
    
    
    public function __construct() {
        $this->db = dataBase::connect(); 
    }
    
    function getId() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getApellidos() {
        return $this->apellidos;
    }

    function getEmail() {
        return $this->email;
    }

    function getPassword() {
        return password_hash($this->db->real_escape_string($this->password), PASSWORD_BCRYPT, ['cost' => 4]);
    }

    function getRol() {
        return $this->rol;
    }

    function getImagenusuario() {
        return $this->imagenusuario;
    }
    
    function getDni() {
        return $this->dni;
    }
    
    function getTelefono() {
        return $this->telefono; 
    }
    
    function getDireccion() {
        return $this->direccion; 
    }
    
    function getUsername() {
        return $this->username; 
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNombre($nombre) {
        $this->nombre = $this->db->real_escape_string($nombre);
    }

    function setApellidos($apellidos) {
        $this->apellidos = $this->db->real_escape_string($apellidos);
    }

    function setEmail($email) {
        $this->email = $this->db->real_escape_string($email);
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setRol($rol) {
        $this->rol = $rol;
    }
    
    function setDni($dni) {
        $this->dni = $dni; 
    }
    
    function setTelefono($telefono) {
        $this->telefono = $telefono; 
    }
    
    function setDireccion($direccion) {
        $this->direccion = $direccion; 
    }
    
    function setUsername($username) {
        $this->username = $username; 
    }

    function setImagenusuario($imagenusuario) {
        $this->imagenusuario = $imagenusuario;
    }

    public function save(){
        $sql = "INSERT INTO usuarios VALUES(NULL, '{$this->getNombre()}', '{$this->getApellidos()}', '{$this->getEmail()}', '{$this->getPassword()}', '2', '{$this->getDni()}', '{$this->getTelefono()}', '{$this->getDireccion()}', '1', '{$this->getUsername()}', NOW(), NULL, NULL, '{$this->getImagenusuario()}');";
        $save = $this->db->query($sql);
        
        $result = FALSE;
        if($save){
            $result = true;
        }
        return $result;
    }   
    
    public function login(){
        
        $result = false;
        $email = $this->email;
        $password = $this->password;
        //Comprobar si existe el usuario
        
        $sql = "SELECT * FROM usuarios WHERE email = '$email'";
        $login = $this->db->query($sql);
        
        if($login && $login->num_rows == 1){
            $usuario = $login->fetch_object();
            
            //Verificar contraseña
            $verify = password_verify($password, $usuario->password);
            
            if($verify){
                $result = $usuario;
            }
        }
        return $result;
    }
}