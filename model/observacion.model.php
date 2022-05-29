<?php
class Observacion
{
	private $pdo;

	// Inicializa variables para campos que conforman la ficha de la OBSERVACION
	public $observacion_id = '';
	public $observacion_descripcion = '';
	public $observacion_tipo = '';

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

			$sql = "INSERT INTO observaciones (descripcion, tipo) 
		        VALUES (?, ?)";

			$this->pdo->prepare($sql)
				->execute(
					array(
						$data->observacion_descripcion,
						$data->observacion_tipo
					)
				);
		} catch (Exception $e) {
			die($e->getMessage());
		}

		return $this->pdo->lastInsertId(); //Retorna el ID (Autoincremental) del registro que se acaba de crear
	}


}
