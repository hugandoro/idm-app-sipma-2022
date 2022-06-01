<?php
class Plan
{
	private $pdo;

	// Inicializa variables para campos que conforman la planilla
	public $id = '';
	public $fecha = '';
	public $proceso = '';
	public $origen = '';
	public $usuario_id = '';
	public $estado = '';

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
	public function Registrar(Plan $data)
	{
		try {

			$sql = "INSERT INTO planes (fecha, proceso, origen, usuario_id) 
		        VALUES (?, ?, ?, ?)";

			$this->pdo->prepare($sql)
				->execute(
					array(
						$data->fecha,
						$data->proceso,
						$data->origen,
						$data->usuario_id
					)
				);
		} catch (Exception $e) {
			die($e->getMessage());
		}

		return $this->pdo->lastInsertId(); //Retorna el ID (Autoincremental) del registro que se acaba de crear
	}

	public function Borrar($idPlan){
		try{
			$stm = $this->pdo
						->prepare("DELETE FROM planes WHERE id = ? ");			          
			$stm->execute(array($idPlan));
		} 
		catch (Exception $e){
			//die($e->getMessage());
		}
	}

	// Metodo para listar todas las planillas de determinado USUARIO
	public function Listar($usuario)
	{
		try {
			$result = array();
			$stm = $this->pdo->prepare("SELECT * FROM planes WHERE usuario_id = '$usuario' ORDER BY fecha DESC");
			$stm->execute();
			return $stm->fetchAll(PDO::FETCH_OBJ);

		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	// Metodo para obtener los datos puntuales de un registro
	public function Obtener($idPlan){
		try{
			$stm = $this->pdo
			            ->prepare("SELECT * FROM planes WHERE id = ?");

			$stm->execute(array($idPlan));
			return $stm->fetch(PDO::FETCH_OBJ);
		} 
		catch (Exception $e){
			die($e->getMessage());
		}
	}

	// Metodo para actualizar un registro
	public function Actualizar($data){
		try{

			$sql = "UPDATE planes SET 
						fecha						= ?,
						proceso						= ?,
						origen						= ?,
						usuario_id					= ?

				    WHERE id = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				    array(
						$data->fecha,
						$data->proceso,
						$data->origen,
						$data->usuario_id,

                        $data->id //No se debe sobreescribir, se usa para ubicar el registro a modificar
					)
				);
		} 
		catch (Exception $e){
			die($e->getMessage());
		}
	}

	// Metodo para CERRAR un plan
	public function Cerrar($data){
		try{

			$sql = "UPDATE planes SET 
						estado	= ?

				    WHERE id = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				    array(
						"Cerrado",
                        $data->id //No se debe sobreescribir, se usa para ubicar el registro a modificar
					)
				);
		} 
		catch (Exception $e){
			die($e->getMessage());
		}
	}

	// Metodo para PRESENTAR un plan
	public function Presentar($data){
		try{

			$sql = "UPDATE planes SET 
						estado	= ?

				    WHERE id = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				    array(
						"Presentado",
                        $data->id //No se debe sobreescribir, se usa para ubicar el registro a modificar
					)
				);
		} 
		catch (Exception $e){
			die($e->getMessage());
		}
	}

	// Metodo para crear el vinculo Observacion - Plan
	public function vincularObservacion($idObservacion,$idPlan){
		try{
			$sql = "INSERT INTO observacion_plan (observacion_identificacion,plan_id) VALUES (?, ?)";
			$this->pdo->prepare($sql)
				 ->execute(array($idObservacion,$idPlan));
		}
		catch (Exception $e){
			die($e->getMessage());
			//break;
		}
	}

	// Metodo para desvincular Observacion - Plan
	public function desvincularObservacion($idObservacion,$idPlan){
		try{
			$stm = $this->pdo
						->prepare("DELETE FROM observacion_plan WHERE (observacion_identificacion = ?) AND (plan_id = ?) ");			          
			$stm->execute(array($idObservacion,$idPlan));
		} 
		catch (Exception $e){
			die($e->getMessage());
			//break;
		}
	}


}
