<?php

require_once('../models/user.model.php');

class UserController
{
    private $user;

    function __construct()
    {
        $this->user = new Usuario();
    }

    public function Index()
    {
        require_once('../views/frames/header.php');
        require_once('../views/frames/navbar.php');
        require_once('../views/frames/slidebar.php');
        require_once('../views/user/usuarioView.php');
        require_once('../views/frames/firtsfooter.php');
        require_once('../views/frames/footer.php');
    }



    public function Insert()
    {

        $datos = $this->user;

        $datos->user = $_REQUEST['usur'];
        $datos->pass = $_REQUEST['pass'];        
        $datos->email = $_REQUEST['email'];

        $respuesta = $this->user->Insert($datos);
    }

    public function Eliminar()
    {

        $rolpuntero         = $_REQUEST['rol'];

        $this->user->Delete($_REQUEST['id']);

        require_once('../views/user/usuarioSelect.php');
    }

    public function Actualizar()
    {
        $datos = $this->user;

        $datos->nombre      = $_REQUEST['nombre'];
        $datos->apellido    = $_REQUEST['apellido'];
        $datos->contraseña  = $_REQUEST['contraseña'];
        $datos->correo      = $_REQUEST['correo'];
        $datos->rol         = $_REQUEST['rol'];
        $datos->estado      = $_REQUEST['estado'];
        $datos->identi      = $_REQUEST['identi'];
        $datos->id          = $_REQUEST['id'];

        $update = $_REQUEST['valid'];

        $rolpuntero         = $_REQUEST['rol'];

        $this->user->Update($datos, $update);

        require_once('../views/user/usuarioSelect.php');
    }

    public function Seleccion()
    {
        $datos = $this->user;

        $rolpuntero = $_REQUEST['rolid'];
        $this->user->Select($rolpuntero);

        require_once('../views/user/usuarioSelect.php');
    }
    public function Recargar()
    {
        require_once('../views/user/usuarioConfirm.php');
    }
    public function Login($user, $pass)
    {
        return $this->user->Login($user, md5($pass));
    }

    public function Logout($id)
    {
        $this->user->Logout($id);
    }
}
