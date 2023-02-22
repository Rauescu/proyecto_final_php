<?php
namespace Services;
use Repositories\PedidoRepository;

class PedidoService {

    private PedidoRepository $repository;

    function __construct() {
        $this->repository = new PedidoRepository();
    }
    public function getAll() : ?array {
        return $this->repository->getAll();

    }


}
?>