<?php


class ListarProductosService 
{
    protected $productoRepository;    

    /**
     * @param ProductoRepository $productoRepository     // permite obtener datos de productos de la base de datos     
     */
    public function __construct() {
        $this->productoRepository = new ProductoRepository();        
    }

    public function listar(bool $activos = false): array {        
        try {            
            $result = $this->productoRepository->list($activos);                
        } catch (\Exception $e) {            
            // TO DO ADD LOG
        }
        return $result;
    }

}