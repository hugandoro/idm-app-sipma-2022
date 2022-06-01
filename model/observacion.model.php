<?php
class Observacion
{
	private $pdo;

	// Inicializa variables para campos que conforman la ficha de la OBSERVACION
	public $observacion_id = '';
	public $observacion_descripcion = '';
	public $observacion_tipo = '';
	public $reaccion = '';
	public $causa = '';
	public $nc_similar = '';
	public $accion_mejoramiento = '';
	public $plazo = '';
	public $responsable = '';

	// Metodo para iniciar el constructor
	public function __CONSTRUCT()
	{
		try {
			$this->pdo = Database::StartUp();
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	// Metodo para crear un nuevo registro
	public function Ingresar(Observacion $data)
	{
		try {

			$sql = "INSERT INTO observaciones (descripcion, tipo, reaccion, causa, nc_similar, accion_mejoramiento, responsable) 
		        VALUES (?, ?, ?, ?, ?, ?, ?)";

			$this->pdo->prepare($sql)
				->execute(
					array(
						$data->observacion_descripcion,
						$data->observacion_tipo,
						$this->reaccion,
						$this->causa,
						$this->nc_similar,
						$this->accion_mejoramiento,
						$this->responsable
					)
				);
		} catch (Exception $e) {
			die($e->getMessage());
		}

		return $this->pdo->lastInsertId(); //Retorna el ID (Autoincremental) del registro que se acaba de crear
	}

	// Metodo para listar OBSERVACIONES vinculados a un PLAN
	public function listarObservaciones($idPlan){
		try{
			$result = array();

				$stm = $this->pdo->prepare("SELECT a.* FROM observaciones AS a INNER JOIN observacion_plan AS b ON a.id = b.observacion_identificacion WHERE b.plan_id = '$idPlan'");

			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e){
			die($e->getMessage());
		}
	}

	// Metodo para consultar una OBSERVACION 
	public function consultarObservacion($idObs){
		try{
			$result = array();

				$stm = $this->pdo->prepare("SELECT * FROM observaciones WHERE id = '$idObs'");

			$stm->execute();

			return $stm->fetch(PDO::FETCH_OBJ);
		}
		catch(Exception $e){
			die($e->getMessage());
		}
	}

	// Metodo para guardar una RETROALIMENTACION a una observacion
	public function guardarRetroalimentacion(Observacion $data)
	{
		try {

			$sql = "UPDATE observaciones SET reaccion = ?, causa = ?, nc_similar = ?, accion_mejoramiento = ?, plazo = ?, responsable = ? WHERE id = ?";

			$this->pdo->prepare($sql)
				->execute(
					array(
						$data->reaccion,
						$data->causa,
						$data->nc_similar,
						$data->accion_mejoramiento,
						$data->plazo,
						$data->responsable,
						$data->observacion_id
					)
				);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}



}
