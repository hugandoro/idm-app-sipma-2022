<?php
require_once 'model/usuario.model.php';
require_once 'model/plan.model.php';
require_once 'model/observacion.model.php';

error_reporting(E_ALL ^ E_NOTICE);

class PlanesController
{
    private $auth, $modelUsuario, $modelPlan;

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

    // Metodo que estructura la pagina por defecto
    public function Index()
    {
        //Carga las vistas para presentar al usuario
        require_once 'view/header.view.php';
        require_once 'view/planes/navbar.view.php';
        require_once 'view/planes/listar.view.php';
        require_once 'view/footer.view.php';
    }

    // Metodo para cargar formulario de ingreso nuevo plan
    public function nuevoPlan()
    {
        require_once 'view/header.view.php';
        require_once 'view/planes/navbar.view.php';
        require_once 'view/planes/nueva.view.php';
        require_once 'view/footer.view.php';
    }

    // Metodo para guardar una plan
    public function guardarPlan()
    {
        $plan = new Plan();

        $plan->fecha = $_REQUEST['fecha'];
        $plan->proceso = $_REQUEST['proceso'];
        $plan->origen = $_REQUEST['origen'];

        $plan->usuario_id = $this->auth->usuario()->identificacion;

        $plan->id = $this->modelPlan->Registrar($plan); //Registra y recibe el ID del nuevo registro

        header('Location: index.php?c=Planes&a=Index&token=' . @$_GET['token']);
    }

    // Metodo que permite editar una plan
    public function editarPlan()
    {
        $plan = new Plan();

        // Valida si se recibe un ID - si existe es modo edicion y hace un llamado a obtener los datos del modelo
        if (isset($_REQUEST['id'])) {
            $plan = $this->modelPlan->Obtener($_REQUEST['id']);
        }

        //Carga las vistas para presentar al usuario
        require_once 'view/header.view.php';
        require_once 'view/planes/navbar.view.php';
        require_once 'view/planes/nueva_editar.view.php';
        require_once 'view/footer.view.php';
    }

    // Metodo para guardar una plan (ACTUALIZARLA)
    public function actualizarPlan()
    {
        $plan = new Plan();

        $plan->id = $_REQUEST['id'];
        $plan->fecha = $_REQUEST['fecha'];
        $plan->proceso = $_REQUEST['proceso'];
        $plan->origen = $_REQUEST['origen'];

        $plan->usuario_id = $this->auth->usuario()->identificacion;

        $this->modelPlan->Actualizar($plan);

        header('Location: index.php?c=Planes&a=Index&token=' . @$_GET['token']);
    }

    // Metodo para eliminar una plan
    public function eliminarPlan()
    {
        $plan = new Plan();

        $plan_id = $_REQUEST['id'];
        $this->modelPlan->Borrar($plan_id);

        header('Location: index.php?c=Planes&a=Index&token=' . @$_GET['token']);
    }

    // Metodo para cerrar una plan de su modo edicion (CERRAR PLAN)
    public function cerrarPlan()
    {
        $plan = new Plan();

        $plan->id = $_REQUEST['id'];
        $this->modelPlan->Cerrar($plan);

        header('Location: index.php?c=Planes&a=Index&token=' . @$_GET['token']);
    }

    // Metodo que visualizar plan en su ETAPA UNO previo a presentar
    public function verEtapaUno()
    {
        $plan = new Plan();

        // Valida si se recibe un ID - si existe es modo edicion y hace un llamado a obtener los datos del modelo
        if (isset($_REQUEST['id'])) {
            $plan = $this->modelPlan->Obtener($_REQUEST['id']);
        }

        // Obtiene los datos de las observaciones vinculadas al Plan
        $listadoObservaciones = $this->modelPlan->listarObservaciones($_REQUEST['id']);

        //Carga las vistas para presentar al usuario
        require_once 'view/header.view.php';
        require_once 'view/planes/navbar.view.php';
        require_once 'view/planes/ver_etapa_uno_previo_a_presentar.php';
        require_once 'view/footer.view.php';
    }
}
