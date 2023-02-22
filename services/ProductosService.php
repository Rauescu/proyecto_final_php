<?php
namespace Services;
use Repositories\ProductosRepository;

class ProductosService {

    private ProductosRepository $repository;

    function __construct() {
        $this->repository = new ProductosRepository();
    }
    
    public function getAll() : ?array {
        return $this->repository->getAll();
    }
    public function save($data) : bool {
        return $this->repository->save($data);
    }
    
    public function update($data) : bool {
        return $this->repository->update($data);
    }
    public function borrar($id) : bool {
        return $this->repository->borrar($id);
    }
    public function actualizar_stock():bool{
        return $this->repository->actualizar_stock();
    }
}
?>