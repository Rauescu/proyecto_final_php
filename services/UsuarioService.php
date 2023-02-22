<?php
namespace Services;
use Repositories\UsuarioRepository;
class UsuarioService {

    private UsuarioRepository $repository;

    function __construct() {
        $this->repository = new UsuarioRepository();
    }

    public function save(array $user) : bool {
        return $this->repository->save($user);
        
    }
    public function comprueba(string $email) : bool {
        return $this->repository->comprueba($email);
        
    }

    public function login(array $user):array{
        return $this->repository->login($user);
    }



}
?>