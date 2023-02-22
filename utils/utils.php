<?php

namespace Utils;

class Utils
{
    public function validar_registro($array): ?bool
    {

        $errores = true;

        if (!validar_texto($array['nombre'])) {
            $errores =  false;
        } else {
            if ($errores != false) {
                $errores = true;
            }
        }

        if (!validar_texto($array['apellidos'])) {
            $errores =  false;
        } else {
            if ($errores != false) {
                $errores = true;
            }
        }
        $email = filter_var($array['email'], FILTER_SANITIZE_EMAIL);
        if (!is_valid_email($email)) {
            $errores =  false;
        } else {
            if ($errores != false) {
                $errores = true;
            }
        }

        if (strlen($array['password']) < 7) {
            $errores =  false;
        } else {
            if ($errores != false) {
                $errores = true;
            }
        }

        if (strlen($array['password']) > 16) {
            $errores =  false;
        } else {
            if ($errores != false) {
                $errores = true;
            }
        }

        if (!preg_match('`[0-9]`', $array['password'])) {
            $errores = false;
        } else {
            if ($errores != false) {
                $errores = true;
            }
        }

        if (!preg_match('`[A-Z]`', $array['password'])) {
            $errores = false;
        } else {
            if ($errores != false) {
                $errores = true;
            }
        }

        return $errores;
    }



    public function validar_login($array): ?bool
    {

        $errores = true;

        $email = filter_var($array['email'], FILTER_SANITIZE_EMAIL);
        if (!is_valid_email($email)) {
            $errores = false;
        } else {
            if ($errores != false) {
                $errores = true;
            }
        }

        if (strlen($array['password']) < 7) {
            $errores = false;
        } else {
            if ($errores != false) {
                $errores = true;
            }
        }

        if (strlen($array['password']) > 16) {
            $errores = false;
        } else {
            if ($errores != false) {
                $errores = true;
            }
        }

        return $errores;
    }

    public function validar_crearProductos($array): ?bool
    {

        $errores = true;
        if (!validarRequerido($array['nombre'])) {
            $errores = false;
        } else {
            if ($errores != false) {
                $errores = true;
            }
        }
        if (!validar_texto($array['nombre'])) {
            $errores = false;
        } else {
            if ($errores != false) {
                $errores = true;
            }
        }
        if (!validarRequerido($array['descripcion'])) {
            $errores = false;
        } else {
            if ($errores != false) {
                $errores = true;
            }
        }
        return $errores;
    }



    public function validar_updateProductos($array): ?bool
    {

        $errores = true;
        if (!validarRequerido($array['descripcion'])) {
            $errores = false;
        } else {
            if ($errores != false) {
                $errores = true;
            }
        }
        return $errores;
    }


    public function validar_crearCategoria($data): ?bool
    {

        $errores = true;
        if (!validarRequerido($data)) {
            $errores = false;
        } else {
            if ($errores != false) {
                $errores = true;
            }
        }
        if (!validar_texto($data)) {
            $errores = false;
        } else {
            if ($errores != false) {
                $errores = true;
            }
        }
        return $errores;
    }



    public function validar_crearPedido($array): ?bool
    {

        $errores = true;
        if (!validarRequerido($array['provincia'])) {
            $errores = false;
        } else {
            if ($errores != false) {
                $errores = true;
            }
        }
        if (!validar_texto($array['provincia'])) {
            $errores = false;
        } else {
            if ($errores != false) {
                $errores = true;
            }
        }

        if (!validarRequerido($array['localidad'])) {
            $errores = false;
        } else {
            if ($errores != false) {
                $errores = true;
            }
        }
        if (!validar_texto($array['localidad'])) {
            $errores = false;
        } else {
            if ($errores != false) {
                $errores = true;
            }
        }

        if (!validarRequerido($array['direccion'])) {
            $errores = false;
        } else {
            if ($errores != false) {
                $errores = true;
            }
        }
        return $errores;
    }
}




// FUNCIONES DE VALIDACION 



function validarRequerido(string $texto)
{
    return !(trim($texto) == '');
}

function validar_texto(string $texto)
{
    $patron_texto = "/^[a-zA-ZáéíóúÁÉÍÓÚäëïüöÄËÏÖÜàèìùòÀÈÙÌÒ\s]+$/";
    return preg_match($patron_texto, $texto);
}
function limpiarTexto(string $texto)
{
    return preg_replace('/[a-zA-Z]/', '', $texto);
}
function validarInt($numero, $minimo)
{
    return (filter_var($numero, FILTER_VALIDATE_INT)) && ($numero > $minimo);
}

function validarExtras($array)
{
    return count($array);
}

function validarImagen($imagen)
{
    return $imagen;
}
function is_valid_email($str)
{
    return (false !== filter_var($str, FILTER_VALIDATE_EMAIL));
}

function validarCampos($direccion, $precio, $tamano, $extra, $observaciones, $imagen)
{
    $errores = array();

    if (!validarRequerido($direccion)) {
        $errores['direccion'] = "Debes introducir una direccion valida";
    } else {
        $errores['direccion'] = "";
    }

    if (!validarInt($precio, 0)) {
        $errores['precio'] = "Debes introducir un precio valido mayor que 0";
    } else {
        $errores['precio'] = "";
    }

    if (!validarInt($tamano, 0)) {
        $errores['tamano'] = "Debes introducir un tamaño valido mayor que 0";
    } else {
        $errores['tamano'] = "";
    }

    //Extras
    if (!validarExtras($extra)) {
        $errores['extras'] = "Debes introducir al menos un extra";
    } else {
        $errores['extras'] = '';
    }

    if (!validarRequerido($observaciones)) {
        $errores['observaciones'] = "Debes introducir una observación valida";
    } else {
        $errores['observaciones'] = "";
    }

    if (validarImagen($imagen)) {
        $errores['foto'] = "Debes introducir una imagen";
    } else {
        $errores['foto'] = "";
    }
    return $errores;
}
