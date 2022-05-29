<?php
require_once 'model/usuario.model.php';
require_once 'model/plan.model.php';
require_once 'model/observacion.model.php';

error_reporting(E_ALL ^ E_NOTICE);

class ObservacionesController
{
    private $auth, $modelUsuario, $modelPlan, $modelObservacion;

    // Metodo constructor
    public function __CONSTRUCT()
    {
        $this->modelUsuario = new Usuario();
        $this->modelPlan = new Plan();
        $this->modelObservacion = new Observacion();
        $this->auth  = FactoryAuth::getInstance();

        // Hace un llamado al metodo estaAutenticado para validar si es una sesion registrada
        try {
            $this->auth->estaAutenticado();
        } catch (Exception $e) {
            //header('Location: index.php');
        }
    }

    // PASO 1 - Metodo para AGREGAR observacion
    public function agregarObservacion()
    {
        $plan = new Plan();

        // Carga la planilla a la cual se vincularan los asistentes
        $plan = $this->modelPlan->Obtener($_REQUEST['id']);

        // Obtiene los datos de las observaciones vinculadas al Plan
        $listadoObservaciones = $this->modelPlan->listarObservaciones($_REQUEST['id']);

        //Carga las vistas para presentar al usuario
        require_once 'view/header.view.php';
        require_once 'view/planes/navbar.view.php';
        require_once 'view/observaciones/agregar_observacion.view.php';
        require_once 'view/footer.view.php';
    }

    // PASO 2 - Metodo para GUARDAR y VINCULAR una observacion
    public function guardarObservacion()
    {
        $plan = new Plan();
        $observacion = new Observacion();


        // Carga el plan actual a la que se vinculara la observacion
        $plan = $this->modelPlan->Obtener($_REQUEST['id']);

        $observacion->observacion_descripcion = $_REQUEST['descripcion'];
        $observacion->observacion_tipo = $_REQUEST['tipo'];

        $idNuevaObservacion = $this->modelObservacion->Ingresar($observacion);

        // Crea la relacion de vinculacion Observacion - Plan
        $this->modelPlan->vincularObservacion($idNuevaObservacion, $_REQUEST['id']);

        // Obtiene los datos de las observaciones vinculadas al Plan
        $listadoObservaciones = $this->modelPlan->listarObservaciones($_REQUEST['id']);

        header('Location: ?c=Observaciones&a=agregarObservacion&id=' . $_REQUEST['id'] . '&token=' . @$_GET['token']);
    }

    // Metodo para DESVINCULAR una observacion
    public function desvincularObservacion()
    {
        $this->modelPlan->desvincularObservacion($_REQUEST['idObservacion'], $_REQUEST['id']);

        header('Location: ?c=Observaciones&a=agregarObservacion&id=' . $_REQUEST['id'] . '&token=' . @$_GET['token']);
    }
}
