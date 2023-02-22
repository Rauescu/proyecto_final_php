<?php

    namespace Controller;

    class FrontController{

        public static function main(){

            function show_error(){
                $error = new errorController(); //Usamos este controlador para mostrar errores.
                $error->index();
            }

            if(isset($_GET['controller'])){

                $nombre_controlador = 'Controller\\'.$_GET['controller'].'Controller';
            } elseif(!isset($_GET['controller']) && !isset($_GET['action'])){

                $nombre_controlador = controller_default; // Se establece en un archivo de parámetros.
            }else{
                show_error();
                exit();
            }


            // Si toda va bien creamos una instancia del controlador y la llamamos accion
            if(class_exists($nombre_controlador)){
                $controlador = new $nombre_controlador();

                if(isset($_GET['action']) && method_exists($controlador, $_GET['action'])){
                    $action = $_GET['action'];
                    $controlador->$action();
                }elseif(!isset($_GET['controller']) && !isset($_GET['action'])){
                    $action_default = action_default;
                    $controlador->$action_default();
                }else{
                    show_error();
                }
            }else{
                show_error();
            }


        }
    }

?>