<?php
require_once 'model/usuario.model.php';

class AuthController{
    
    private $model,
            $auth;
    
    // Metodo constructor
    public function __CONSTRUCT(){
        $this->model = new Usuario();
        $this->auth  = FactoryAuth::getInstance();
    }
    
    // Metodo que estructura la pagina por defecto de la pantalla de logueo
    public function Index(){
        require_once 'view/header.view.php';
        require_once 'view/navbar.view.php';
        require_once 'view/auth/auth-index.view.php';
        require_once 'view/footer.view.php';
    }
    
    // Metodo para validar los datos ingresados por el usuario
    public function Autenticar(){
        try {
            $r = $this->auth->autenticar(
                $this->model->Acceder(
                    $_POST['usuario'],
                    $_POST['password']
                )
            );
            
            // Valida modelo de autenticacion definido (Si llega a esta fase el USUARIO SI EXISTE)
            if(__AUTH__ === 'token'){
                header("Location: ?c=Planes&token=$r"); // Si fuera token, redirecciona al controlador por defecto anexando el N° de token generado
            } 
            else{
                header('Location: ?c=Planes'); // En caso contrario, redireccion al controlador por defecto            
            }
        } 
        catch(Exception $e){
            header('Location: index.php'); // En caso de error remite a pagina inicial por defecto para validar credenciales de acceso
        }
    }
    
    // Metodo para cerrar sesion de un usuario
    public function Desconectarse(){
        $this->auth->destruir();
        header('Location: index.php'); // Remite a pagina inicial por defecto para validar credenciales de acceso
    }
}