<?php

session_start();
// Controladores en Forma SINGULAR *ASI LAS TABLAS ESTEN EN PLURAL*
// Ctr = Controlador --> Nombre Modulo
// Acc = Accion       --> Metodo a Realizar o Ejecutar
require_once('../../config/database.php');

$controller = 'user';
$register = isset($_REQUEST['register']);

if (isset($_SESSION['SUsu']) || $register) {

    try {
        if (!isset($_REQUEST['ctrl'])) {

            require_once("../controllers/$controller.controller.php");
            $controller = ucwords($controller) . 'Controller';
            $controller = new $controller;
            $accion = ucwords(strtolower(isset($_REQUEST['acti']) ? $_REQUEST['acti'] : 'Index'));
            call_user_func(array($controller, $accion));
        } else {

            if (isset($_REQUEST['slidebar'])) {

                $_SESSION['slidebar'] = $_REQUEST['slidebar'];
            }

            $controller = strtolower($_REQUEST['ctrl']);
            $accion = ucwords(strtolower(isset($_REQUEST['acti']) ? $_REQUEST['acti'] : 'Index'));

            if (!file_exists("../controllers/$controller.controller.php")) {

                $error = "No Existe El Controlador";
                require_once("error404.php");
            } else {

                require_once("../controllers/$controller.controller.php");
                $controller = ucwords($controller) . 'Controller';
                $controller = new $controller;

                if (method_exists($controller, $accion)) {


                    call_user_func(array($controller, $accion));
                } else {

                    $error = "No Existe El Metodo";
                    require_once("error404.php");
                }
            }
        }
    } catch (Exception $e) {

        require_once("error404.php");
    }
} else {
    session_destroy();
    header("Location: ../public/index.php");
    die();
}
