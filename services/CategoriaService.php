<?php
namespace Services;
use Repositories\CategoriaRepository;

class CategoriaService {

    private CategoriaRepository $repository;

    function __construct() {
        $this->repository = new CategoriaRepository();
    }

    public function crear(string $nombre) : void {
        $this->repository->save($nombre);
    }

    public function getAll() : ?array {
        return $this->repository->getAll();

    }

    public function comprueba(string $nombre) : bool {
        return $this->repository->comprueba($nombre);
        
    }

}
?>