<?php
class Auth implements IAuth {
    private $pdo;
    private $tiempo = 'PT1H'; // Agrega 1 hora
    
	public function __CONSTRUCT()
	{
		try
		{
			$this->pdo = Database::StartUp();     
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}
    
    public function autenticar($usuario) {
        if(!is_object($usuario)) {
            throw new Exception("Fallo autenticación");
        } else if(empty($usuario->identificacion)){
            throw new Exception("Fallo autenticación");
        }
        
        $fecha = new DateTime();
        $fecha->add(new DateInterval($this->tiempo));
        
		try 
		{
			$sql = "UPDATE usuario SET 
						token          = ?, 
						token_caducidad = ?
				    WHERE identificacion = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				    array(
                        tokenPorCliente(),
                        $fecha->format('Y-m-d h:i:s'),
                        $usuario->identificacion
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
    }
    
    public function estaAutenticado() {
        $stm = $this->pdo->prepare(
            "SELECT * FROM usuario WHERE token = ?"
        );

        $stm->execute([tokenPorCliente()]);

        $result = $stm->fetch(PDO::FETCH_OBJ);
        
        if(!is_object($result)) {
            throw new Exception('No esta autenticado');
        }
        
        $token_fecha = new DateTime($result->TokenCaducidad);
        $fecha = new DateTime();
        
        if($token_fecha < $fecha) {
            throw new Exception('No esta autenticado');
        }
    }
    
    public function destruir() {
        $this->EstaAutenticado();
        
        $sql = "UPDATE usuario SET 
                    token          = null, 
                    token_caducidad = null
                WHERE token = ?";

        $this->pdo->prepare($sql)
             ->execute([tokenPorCliente()]);
    }
    
    public function usuario() {
        $this->EstaAutenticado();
        
        $stm = $this->pdo->prepare(
            "SELECT * FROM usuario WHERE token = ?"
        );

        $stm->execute([tokenPorCliente()]);

        return $stm->fetch(PDO::FETCH_OBJ);
    }
}