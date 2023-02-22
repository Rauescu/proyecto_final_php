<?php
namespace Services;
use Repositories\CarritoRepository;

class CarritoService {

    private CarritoRepository $repository;

    function __construct() {
        $this->repository = new CarritoRepository();
    }

    public function completar(array $datos) : string {
        return $this->repository->completar($datos);
    }
    
    public function productos_pedidos ($id):bool{
        return $this->repository->productos_pedidos($id);
    }

    public function getAll() : ?array {
        return $this->repository->getAll();
    }
}
?>