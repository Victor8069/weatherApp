<?php

require_once('../models/weather.model.php');

class WeatherController
{
    private $weather;

    function __construct()
    {
        $this->weather = new WeatherModel();
    }

    public function Index()
    {
        require_once('../views/frames/header.php');
        require_once('../views/frames/navbar.php');
        require_once('../views/weather/weather.view.php');
        require_once('../views/frames/firtsfooter.php');
        require_once('../views/frames/footer.php');
    }

    public function Insert()
    {

        $datos = $this->weather;

        $datos->city = $_REQUEST['city'];
        $datos->desc = $_REQUEST['desc'];        
        $datos->temp = $_REQUEST['temp'];  
        $datos->usrid = $_REQUEST['usrid'];

        $respuesta = $this->weather->Insert($datos);
        require_once('../views/weather/weather.select.php');
    }

    public function Eliminar()
    {
        $this->weather->Delete($_REQUEST['id']);
        require_once('../views/weather/usuarioSelect.php');
    }

    public function Recargar()
    {
        require_once('../views/weather/usuarioConfirm.php');
    }

}
