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


    // MODO OBSERVACIONES
    // ******************

    // PASO 1 - Metodo para AGREGAR observacion
    public function agregarObservacion()
    {
        $plan = new Plan();

        // Carga la planilla a la cual se vincularan los asistentes
        $plan = $this->modelPlan->Obtener($_REQUEST['id']);

        // Obtiene los datos de las observaciones vinculadas al Plan
        $listadoObservaciones = $this->modelObservacion->listarObservaciones($_REQUEST['id']);

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
        $listadoObservaciones = $this->modelObservacion->listarObservaciones($_REQUEST['id']);

        header('Location: ?c=Observaciones&a=agregarObservacion&id=' . $_REQUEST['id'] . '&token=' . @$_GET['token']);
    }

    // Metodo para DESVINCULAR una observacion
    public function desvincularObservacion()
    {
        $this->modelPlan->desvincularObservacion($_REQUEST['idObservacion'], $_REQUEST['id']);

        header('Location: ?c=Observaciones&a=agregarObservacion&id=' . $_REQUEST['id'] . '&token=' . @$_GET['token']);
    }


    // MODO RETROALIMENTACION DE OBSERVACIONES
    // ***************************************

    // PASO 1 - Metodo para ingresar al modo RETROALIMENTAR observacion
    public function retroalimentarObservacion()
    {
        $plan = new Plan();

        // Carga la planilla a la cual se vincularan los asistentes
        $plan = $this->modelPlan->Obtener($_REQUEST['id']);

        // Obtiene los datos de las observaciones vinculadas al Plan
        $listadoObservaciones = $this->modelObservacion->listarObservaciones($_REQUEST['id']);

        //Carga las vistas para presentar al usuario
        require_once 'view/header.view.php';
        require_once 'view/planes/navbar.view.php';
        require_once 'view/observaciones/retroalimentar_observacion.view.php';
        require_once 'view/footer.view.php';
    }

    // PASO 2 - Metodo AGREGAR/EDITAR RETROALIMENTACION de una observacion
    public function retroalimentarObservacionAgregarEditar()
    {
        $plan = new Plan();

        // Carga la planilla a la cual se vincularan los asistentes
        $plan = $this->modelPlan->Obtener($_REQUEST['id']);

        // Obtiene los datos de las observaciones vinculadas al Plan
        $observacion = $this->modelObservacion->consultarObservacion($_REQUEST['obs_id']); // EDITAR Por ID Observacion

        //Carga las vistas para presentar al usuario
        require_once 'view/header.view.php';
        require_once 'view/planes/navbar.view.php';
        require_once 'view/observaciones/retroalimentar_observacion_diligenciar.view.php';
        require_once 'view/footer.view.php';
    }

    // PASO 3 - Metodo para GUARDAR/ACTUALIZAR RETROALIMENTACION de una observacion
    public function guardarRetroalimentacion()
    {
        $plan = new Plan();
        $observacion = new Observacion();

        // Carga el plan actual al que esta vinculado la observacion
        $plan = $this->modelPlan->Obtener($_REQUEST['id']);

        // Guarda en un nuevo objeto los valores de la observacion y lo retroalimentado
        $observacion->observacion_id = $_REQUEST['id_obs'];
        $observacion->observacion_descripcion = $_REQUEST['descripcion'];
        $observacion->observacion_tipo = $_REQUEST['tipo'];

        $observacion->reaccion = $_REQUEST['reaccion'];
        $observacion->causa = $_REQUEST['causa'];
        $observacion->nc_similar = $_REQUEST['nc_similar'];
        $observacion->accion_mejoramiento = $_REQUEST['accion_mejoramiento'];
        $observacion->plazo = $_REQUEST['plazo'];
        $observacion->responsable = $_REQUEST['responsable'];

        // Actualiza la observacion especificamente los campos de la retroalimentacion
        $this->modelObservacion->guardarRetroalimentacion($observacion);

        header('Location: ?c=Observaciones&a=retroalimentarObservacion&id=' . $_REQUEST['id'] . '&token=' . @$_GET['token']);
    }
}
