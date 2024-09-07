<?php

require_once('../models/user.model.php');

class UserController
{
    private $user;

    function __construct()
    {
        $this->user = new UserModel();
    }

    public function Index()
    {
        require_once('../views/frames/header.php');
        require_once('../views/frames/navbar.php');
        require_once('../views/user/user.view.php');
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
        $this->user->Delete($_REQUEST['id']);
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
