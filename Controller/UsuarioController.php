<?php
namespace Controller;
use Models\Usuario;
use Lib\Pages;
use Services\UsuarioService;
use Utils\Utils;

class UsuarioController
{

    private UsuarioService $service;
    private Pages $pages;
    private Utils $utils;

    public function __construct()
    {
        $this->utils = new Utils();
        $this->service = new UsuarioService();
        $this->pages = new Pages();
    }

    public function registro($data)
    {
        // funcion para la creacion de nuevos usuarios
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($data) {
                // If de validacion
                    if ($this->utils->validar_registro($data)){
                        $registro = $data;
                        $registro['password'] = password_hash($registro['password'], PASSWORD_BCRYPT, ['cost' => 4]);
                        $save = $this->service->save($registro);
                        header("Location:" . $_ENV['base_url'] . "usuario_login");
                    }else{
                        $this->pages->render("Usuario/mensaje", ["mensaje" => "Error en los datos "]);
                        // header("Location:" . $_ENV['base_url']."usuario_registro");
                    }
            }
        }
    }

    public function login()
    {
        // funcion para iniciar sesion
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $datos = $_POST['data'];
            if ($this->utils->validar_login($datos)){
                $resultado = $this->service->login($datos);
                // creamos el usuario con los datos que hemos extraido.
                // $usuarioa = new Usuario($resultado[0],$resultado[1],$resultado[2],$resultado[3],$resultado[4],$resultado[5]);
                if ($resultado != []) {
                    if (password_verify($datos['password'], $resultado[4])) {
                        $_SESSION['usuarioa'] = $resultado;
                        header("Location:" . $_ENV['base_url']);
                    } else {
                        header("Location:" . $_ENV['base_url']."usuario_login");
                    }
                } else {
                    $this->pages->render("usuario/mensaje", ["mensaje" => "No hay registros"]);
                }
            }else{
                $this->pages->render("Usuario/mensaje", ["mensaje" => "Error en los datos "]);
            }
        }
    }

    public function cerrar(): void
    {
        // Cerramos sesion, y destruimos la sesion para eliminar todas las variables de sesiones creadas, 
        // y volvemos al index donde se volvera a iniciar una sesion pero sin variables igualadas.
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            session_destroy();
            header("Location:" . $_ENV['base_url']);
        }
    }
}
