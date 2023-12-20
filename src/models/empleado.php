<?php

namespace App\Models;

use App\Config\Database;
use PDO;
use PDOException;
use Slim\Http\Request as Request;

class Empleado  
{
    function login(Request $request)
    {
        $usuario = $request->getParam('usuario');
        $clave = $request->getParam('clave');
        $usuario = strtolower($usuario);
        try {
            if ($this->validateLogin(trim($usuario), $clave)) {
                $db = new Database();
                $db = $db->connectDb();
                $r = $db->prepare("SELECT dni, nombre, apellidos, celular, email, estado from admin_usuarios where  email = '$usuario' AND clave= '$clave'");
                $data = [];
                $r->execute();
                $row_count = ($r->rowCount() * -1);
                if ($row_count > 0) { 
                    $empleado = $r->fetch(PDO::FETCH_OBJ);
                    $estado = $empleado->estado;
                    if($estado == 1){
                            $dni = $empleado->dni;
                            if ($dni) {
                                $r = $db->prepare("SELECT m.nombre, u.estado from admin_usuarios_modulos u inner join admin_modulos m on u.idModulo=m.idModulo where dni=$dni");
                                $r->execute();
                                $empleModu = $r->fetchAll(PDO::FETCH_OBJ);
                                $res = [
                                    'empleado' => $empleado,
                                    'modulo' => $empleModu
                                ];
                            }
                            $data = array("data" => $res, "message" => "Usuario existe", "codigo" => "200");
                    }else {
                        $data = array("message" => "Usuario deshabilitado", "codigo" => "409");
                    }
                } else $data = array("message" => "Usuario o clave incorrecta", "codigo" => "401");
                return $data;
            } else return array("message" => "Datos corruptos", "codigo" => "400");
        } catch (PDOException $e) {
            return array("message" => $e->getMessage(), "codigo" => "404");
        }
    }
    private function validateLogin($usuario, $clave)
    {
        if (!empty($usuario) && !empty($clave)) return true;
        else  return false;
    }

    function registro(Request $request)
    {

        $dni = $request->getParam('dni');
        $nombre = $request->getParam('nombre');
        $apellidos = $request->getParam('apellidos');
        $celular = $request->getParam('celular');
        $email = $request->getParam('email');
        $clave = $request->getParam('clave');


        try {
            if ($this->validatePersona($dni, $nombre, $apellidos, $celular, $email, $clave)) {
                $db = new Database();
                $db = $db->connectDb();
                $r = $db->prepare("SELECT *FROM admin_usuarios WHERE dni =$dni");
                $r->execute();
                $row_count = ($r->rowCount() * -1);
                if ($row_count > 0) $data = array("message" => "DNI en uso", "codigo" => "409");
                else {
                    $r = $db->prepare("INSERT INTO admin_usuarios(dni, nombre, apellidos, celular, email,clave) values($dni,'$nombre','$apellidos',$celular,'$email','$clave')");
                    $data = [];
                    $r->execute();
                    if ($r->rowCount() > 0) {
                        $data = array("message" => "Registrado con exito", "codigo" => "200");
                    } else $data = array("message" => "Ocurrió un error al registrar", "codigo" => "404");
                }
                return $data;
            } else {
                return array("message" => "Datos incorrectos", "codigo" => "400");
            }
        } catch (PDOException $e) {
            return array("message" => $e->getMessage(), "codigo" => "404");
        }
    }


    function getEmpleadoA()
    {
        try {
            $db = new Database();
            $db = $db->connectDb();
            $r = $db->query('SELECT  dni as id, dni, nombre, apellidos, celular, email, estado from admin_usuarios where estado=1;');
            $data = [];
            $row_count = ($r->rowCount() * -1);
            if ($row_count > 0) {
                $empleado = $r->fetchAll(PDO::FETCH_OBJ);
                $data = array("personas" => $empleado, "codigo" => "200");
            } else $data = array("message" => "No hay datos", "codigo" => "204");

            return $data;
        } catch (PDOException $e) {
            return array("message" => $e->getMessage(), "codigo" => "404");
        }
    }

    function getEmpleadoD()
    {
        try {
            $db = new Database();
            $db = $db->connectDb();
            $r = $db->query('SELECT  dni as id, dni, nombre, apellidos, celular, email, estado from admin_usuarios where estado=0;');
            $data = [];
            $row_count = ($r->rowCount() * -1);
            if ($row_count > 0) {
                $empleado = $r->fetchAll(PDO::FETCH_OBJ);
                $data = array("personas" => $empleado, "codigo" => "200");
            } else $data = array("message" => "No hay datos", "codigo" => "204");

            return $data;
        } catch (PDOException $e) {
            return array("message" => $e->getMessage(), "codigo" => "404");
        }
    }

    function getModuloEmpleado(Request $request)
    {
        $dni = $request->getParam('dni');
        try {
            $db = new Database();
            $db = $db->connectDb();
            $r = $db->prepare("SELECT  m.idModulo, m.nombre from admin_usuarios_modulos u inner join admin_modulos m on m.idModulo=u.idModulo WHERE dni=$dni");
            $data = [];
            // $r->bindParam(':idMascota', $idMascota);
            $r->execute();
            $row_count = ($r->rowCount() * -1);
            if ($row_count > 0) {
                $moduloE = $r->fetchAll(PDO::FETCH_OBJ);
                $r = $db->prepare("SELECT * from admin_modulos");
                $r->execute();
                $empleModu = $r->fetchAll(PDO::FETCH_OBJ);
                // $res = [
                //     'modulos' => $moduloE,
                //     'modulosTotal' => $empleModu
                // ];
                $data = array("modulos" => $moduloE, "modulosTotal" => $empleModu, "codigo" => "200");
            } else {

                $r = $db->prepare("SELECT * from admin_modulos");
                $r->execute();
                $empleModu = $r->fetchAll(PDO::FETCH_OBJ);
                $data = array("modulosTotal" => $empleModu, "message" => "No hay datos", "codigo" => "204");
            }
            return $data;
        } catch (PDOException $e) {
            return array("message" => $e->getMessage(), "codigo" => "404");
        }
    }
    function deactivateEmpleado(Request $request)
    {
        $dni = $request->getParam('dni');
        try {
            if (strlen($dni) == 8) {
                $db = new Database();
                $db = $db->connectDb();
                $r = $db->prepare("SELECT *FROM admin_usuarios WHERE dni = $dni");
                $data = [];
                $r->execute();
                $usuario = $r->fetch(PDO::FETCH_OBJ);
                if ($usuario->estado == 1) {

                    $r = $db->prepare("UPDATE   admin_usuarios set estado=0 where dni=$dni");
                    $data = [];
                    $r->execute();
                    if ($r->rowCount() > 0) $data = array("message" => "modificado con exito", "codigo" => "200");
                    else $data = array("message" => "Ocurrió un error al modificar", "codigo" => "404");
                } else {
                    $r = $db->prepare("UPDATE   admin_usuarios set estado=1 where dni=$dni");
                    $data = [];
                    $r->execute();
                    if ($r->rowCount() > 0) $data = array("message" => "modificado con exito", "codigo" => "200");
                    else $data = array("message" => "Ocurrió un error al modificar", "codigo" => "404");
                }
                return $data;
            } else return array("message" => "Datos incorrectos", "codigo" => "400");
        } catch (PDOException $e) {
            return array("message" => $e->getMessage(), "codigo" => "404");
        }
    }
    function udpdateEmpleado(Request $request)
    {

        $dni = $request->getParam('dni');
        $nombre = $request->getParam('nombre');
        $apellidos = $request->getParam('apellidos');
        $celular = $request->getParam('celular');
        $email = $request->getParam('email');
        $clave = $request->getParam('clave');
        try {
            if ($this->validatePersona($dni, $nombre, $apellidos, $celular, $email)) {
                $db = new Database();
                $db = $db->connectDb();
                $r = $db->prepare("SELECT *from admin_usuarios where dni=$dni");
                $data = [];
                $r->execute();
                $persona = $r->fetch(PDO::FETCH_OBJ);

                if (!$clave) {
                    if ($dni == $persona->dni) {
                        if (
                            $nombre == $persona->nombre && $apellidos == $persona->apellidos && $celular == $persona->celular
                            && $email == $persona->email
                        )
                            $data = array("message" => "modificado con exito", "codigo" => "200");
                        else $data = $this->update($db, $dni, $nombre, $apellidos, $celular, $email);
                    } else {
                        $r = $db->prepare("SELECT *from admin_usuarios where dni=$dni");
                        $r->execute();
                        if ($r->rowCount() > 0) $data = array("message" => "DNI en uso", "codigo" => "409");
                        else $data = $this->update($db, $dni, $nombre, $apellidos, $celular, $email, $clave);
                    }
                    return $data;
                } else {
                    if ($dni == $persona->dni) {
                        if (
                            $nombre == $persona->nombre && $apellidos == $persona->apellidos && $celular == $persona->celular
                            && $email == $persona->email && $clave == $persona->clave
                        )
                            $data = array("message" => "modificado con exito", "codigo" => "200");
                        else $data = $this->update02($db, $dni, $nombre, $apellidos, $celular, $email, $clave);
                    } else {
                        $r = $db->prepare("SELECT *from admin_usuarios where dni=$dni");
                        $r->execute();
                        if ($r->rowCount() > 0) $data = array("message" => "DNI en uso", "codigo" => "409");
                        else $data = $this->update02($db, $dni, $nombre, $apellidos, $celular, $email, $clave);
                    }
                    return $data;
                }
                return $data;
            } else
                return array("message" => "Datos incorrectos", "codigo" => "400");
        } catch (PDOException $e) {
            return array("message" => $e->getMessage(), "codigo" => "404");
        }
    }
    
    function controlModulos(Request $request)
    {
        $dni = $request->getParam('dni');
        $modulos = $request->getParam('modulos');
        $ModulosE = json_decode($modulos);
        $db = new Database();
        $db = $db->connectDb();
        $r = $db->prepare("DELETE FROM admin_usuarios_modulos WHERE dni = $dni;");
        $data = [];
        $r->execute();
        if ($r->rowCount() >= 0) {
            $data = array("message" => "Se elimino correctamente", "codigo" => "200");
            foreach($ModulosE as $valor){
                $r = $db->prepare("INSERT INTO admin_usuarios_modulos (dni, idModulo) VALUES ($dni,$valor)");
                $data = [];
                $r->execute();
                if ($r->rowCount() > 0) {
                    $data = array("message" => "Registrado con exito", "codigo" => "200");
                } else $data = array("message" => "Ocurrió un error al registrar", "codigo" => "404");
            }
        } else $data = array("message" => "Error al eliminar", "codigo" => "404");
        return $data;
    }



    function update($db, $dni, $nombre, $apellidos, $celular, $email)
    {
        $r = $db->prepare("UPDATE admin_usuarios SET nombre='$nombre', apellidos='$apellidos', celular=$celular, email='$email'  WHERE dni = $dni");
        $data = [];
        $r->execute();
        if ($r->rowCount() > 0) $data = array("message" => "modificado con exito", "codigo" => "200");
        else $data = array("message" => "Ocurrió un error al modificar", "codigo" => "404");
        return $data;
    }

    function update02($db, $dni, $nombre, $apellidos, $celular, $email, $clave)
    {
        $r = $db->prepare("UPDATE admin_usuarios SET nombre='$nombre', apellidos='$apellidos', celular=$celular, email='$email', clave='$clave'  WHERE dni = $dni");
        $data = [];
        $r->execute();
        if ($r->rowCount() > 0) $data = array("message" => "modificado con exito", "codigo" => "200");
        else $data = array("message" => "Ocurrió un error al modificar", "codigo" => "404");
        return $data;
    }


    private function validatePersona($dni, $nombre, $apellidos, $celular, $email)
    {
        if (strlen($dni) == 8 && !empty($nombre) && !empty($apellidos)  && !empty($celular) && !empty($email))  return true;
        else  return false;
    }
}
