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
    private $localidad;
    private $token;
    private $fechaUltimoPedido;
    private $saldo;
    
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

    function getLocalidad() {
        return $this->localidad;
    }
    
    function getToken(){
        return $this->token;
    }

    public function getFechaUltimoPedido() {
        return $this->fechaUltimoPedido;
    }

    public function setFechaUltimoPedido($fechaUltimoPedido) {
        $this->fechaUltimoPedido = $fechaUltimoPedido;
    }

    public function getSaldo() {
        return $this->saldo;
    }

    public function setSaldo($saldo) {
        $this->saldo = $saldo;
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

    function setLocalidad($localidad) {
        $this->localidad = $localidad;
    }

    function setImagenusuario($imagenusuario) {
        $this->imagenusuario = $imagenusuario;
    }

    function setToken($token) {
        $this->token = $token;
    }

    public function getOneByEmail() {
        $usuario = $this->db->query("SELECT * FROM usuarios WHERE email = '{$this->getEmail()}'");
        return $usuario->fetch_object();
    }
    
    public function save() {
        $saldo = $this->getSaldo() ?? 0;
        $sql = "INSERT INTO usuarios 
                VALUES(NULL, '{$this->getNombre()}', '{$this->getApellidos()}', 
                       '{$this->getEmail()}', '{$this->getPassword()}', {$this->getRol()}, 
                       {$this->getDni()}, {$this->getTelefono()}, 
                       '{$this->getDireccion()}', '{$this->getLocalidad()}', '{$this->getUsername()}', 
                       NOW(), NULL, {$saldo}, '{$this->getImagenusuario()}', NULL);";
        $save = $this->db->query($sql);
        
        $result = false;
        if($save){
            $result = true;
        }

        return $result;
    }

    public function refreshUserByEmail() {
        $user = $this->db->query("SELECT * FROM usuarios WHERE email = '{$this->getEmail()}'")->fetch_object();
        $this->setNombre($user->nombre);
        $this->setApellidos($user->apellidos);
        $this->setRol($user->permiso_id);
        $this->setDni($user->dni);
        $this->setTelefono($user->telefono);
        $this->setDireccion($user->direccion);
        $this->setLocalidad($user->localidad_id);
        $this->setUsername($user->username);
        $this->setFechaUltimoPedido($user->fecha_ult_pedido);
        $this->setSaldo($user->saldo);
        $this->setImagenusuario($user->imagen);
    }

    public function edit(){
        $sql = "UPDATE usuarios SET 
                    nombre='{$this->getNombre()}',  
                    apellidos='{$this->getApellidos()}',  
                    email='{$this->getEmail()}',  
                    password='{$this->getPassword()}',  
                    permiso_id={$this->getRol()},   
                    dni={$this->getDni()}, 
                    telefono={$this->getTelefono()}, 
                    direccion='{$this->getDireccion()}', 
                    localidad_id={$this->getLocalidad()}, 
                    username='{$this->getUsername()}', 
                    password='{$this->getPassword()}', 
                    fecha_ult_pedido='{$this->getFechaUltimoPedido()}', 
                    saldo={$this->getSaldo()}
                 ";

        if($this->getImagenusuario() != null){
            $sql .= ", imagen='{$this->getImagenusuario()}'";
        }

        $sql .= " WHERE email='{$this->getEmail()}';";

        return $this->db->query($sql);
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
    
    function saveToken(){
        $update = "UPDATE usuarios SET token = '{$this->getToken()}' "
                . "WHERE email = '{$this->getEmail()}'";
        return $this->db->query($update);
    }
    
    function deleteToken(){
        $delete = "UPDATE usuarios SET token = NULL WHERE email = '{$this->email}'";
        return $this->db->query($delete);
    }
    
    function selectUserByTokenAndEmail(){
        $usuario = $this->db->query("SELECT * FROM usuarios WHERE token = '{$this->getToken()}' 
                         AND email = '{$this->getEmail()}'");
        return $usuario ? $usuario->fetch_object() : false;
    }
}