<?php


class ListarClientesService 
{
    protected $clienteRespository;    

    /**
     * @param ClienteRepository $clienteRespository     // permite obtener datos de clietnes de la base de datos     
     */
    public function __construct() {
        $this->clienteRespository = new ClienteRepository();        
    }

    public function listar(bool $activos = false): array {        
        try {            
            $result = $this->clienteRespository->list($activos);                
        } catch (\Exception $e) {            
            // TO DO ADD LOG
        }
        return $result;
    }

}