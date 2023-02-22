<?php
namespace Controller;
use Lib\Pages;
use Services\PedidoService;


class PedidoController {
    private PedidoService $service;
    private Pages $pages;



    public function __construct() {
        $this->service = new PedidoService();
        $this->pages = new Pages();
    }


}
?>