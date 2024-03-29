<?php


class ListarVentasService 
{
    protected $ventasRepository;    

    /**
     * @param VentasRepository $ventasRepository     // permite obtener datos de ventas de la base de datos     
     */
    public function __construct() {
        $this->ventasRepository = new VentaRepository();        
    }

    public function listar(bool $activos = false): array {        
        try {            
            $result = $this->ventasRepository->list($activos);                
        } catch (\Exception $e) {            
            // TO DO ADD LOG
        }
        return $result;
    }

}