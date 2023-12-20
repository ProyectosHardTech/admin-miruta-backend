<?php

namespace App\Models;

use App\Config\Database;
use PDO;
use PDOException;
use Slim\Http\Request as Request;

class Cliente
{
    function getClientesA()
    {
        try {
            $db = new Database();
            $db = $db->connectDb();
            $r = $db->query('SELECT p.iIdPersona as id, p.vchNombres as nombre,p.vchApellidoP as apellidoPaterno, p.vchApellidoM as apellidoMaterno, p.dFecNac as fechaNacimiento, p.iSexo as sexo, p.vchTelefono as telefono, u.vchCorreo as correoElectronico, p.vchDni as dni, p.vchCelular as celular, p.dFecReg as fechaRegistro, u.bInactivo as estado  from persona  p inner join usuario u on u.iIdPersona=p.iIdPersona where u.bInactivo=0 ');
            $data = [];
            $row_count = ($r->rowCount() * -1);
            if ($row_count > 0) {
                $clientes = $r->fetchAll(PDO::FETCH_OBJ);
                $data = array("personas" => $clientes, "codigo" => "200");
            } else $data = array("message" => "No hay datos", "codigo" => "204");

            return $data;
        } catch (PDOException $e) {
            return array("message" => $e->getMessage(), "codigo" => "404");
        }
    }
    function getClientesD()
    {
        try {
            $db = new Database();
            $db = $db->connectDb();
            $r = $db->query('SELECT p.iIdPersona as id, p.vchNombres as nombre,p.vchApellidoP as apellidoPaterno, p.vchApellidoM as apellidoMaterno, p.dFecNac as fechaNacimiento, p.iSexo as sexo, p.vchTelefono as telefono, u.vchCorreo as correoElectronico, p.vchDni as dni, p.vchCelular as celular, p.dFecReg as fechaRegistro, u.bInactivo as estado  from persona  p inner join usuario u on u.iIdPersona=p.iIdPersona where u.bInactivo=1');
            $data = [];
            $row_count = ($r->rowCount() * -1);
            if ($row_count > 0) {
                $clientes = $r->fetchAll(PDO::FETCH_OBJ);
                $data = array("personas" => $clientes, "codigo" => "200");
            } else $data = array("message" => "No hay datos", "codigo" => "204");

            return $data;
        } catch (PDOException $e) {
            return array("message" => $e->getMessage(), "codigo" => "404");
        }
    }
    function deactivateCliente(Request $request)
    {
        $idCliente = $request->getParam('id');
        try {
            if (!empty($idCliente)) {
                $db = new Database();
                $db = $db->connectDb();
                $r = $db->prepare("SELECT *from Usuario where iIdPersona=$idCliente");
                $data = [];
                $r->execute();
                $cliente = $r->fetch(PDO::FETCH_OBJ);
                if ($cliente->bInactivo == 0) {

                    $r = $db->prepare("UPDATE  Usuario set bInactivo=1 where iIdPersona=$idCliente");
                    $data = [];
                    $r->execute();
                    if ($r->rowCount() > 0) $data = array("message" => "modificado con exito", "codigo" => "200");
                    else $data = array("message" => "Ocurrió un error al modificar", "codigo" => "404");
                } else {
                    $r = $db->prepare("UPDATE  Usuario set bInactivo=0 where iIdPersona=$idCliente");
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

    function detalleCliente(Request $request)
    {
        $dni = $request->getParam('dni');
        try {
            $db = new Database();
            $db = $db->connectDb();
            $r = $db->query("SELECT vchDni as id,vchDni as dni, vchNombres as nombres,concat(vchApellidoP,' ',vchApellidoM) as Apellidos, dFecNac as fechaNacimiento, iSexo as sexo, vchDirección as direccion, vchTelefono as telefono, vchCelular as celular FROM Persona where vchDni=$dni");
            $data = [];
            $row_count = ($r->rowCount() * -1);
            if ($row_count > 0) {
                $clientes = $r->fetchAll(PDO::FETCH_OBJ);
                $data = array("personas" => $clientes, "codigo" => "200");
            } else $data = array("message" => "No hay datos", "codigo" => "204");

            return $data;
        } catch (PDOException $e) {
            return array("message" => $e->getMessage(), "codigo" => "404");
        }
    }

    function updateCliente(Request $request)
    {
        $idCliente = $request->getParam('id');
        $dni = $request->getParam('dni');
        $nombre = $request->getParam('nombre');
        $apellidoP = $request->getParam('apellidoPaterno');
        $apellidoM = $request->getParam('apellidoMaterno');
        $celular = $request->getParam('celular');
        $telefono = $request->getParam('telefono');
        $email = $request->getParam('email');
        $direccion = $request->getParam('direccion');
        $sexo = $request->getParam('sexo');
        try {
            if ($this->validateCliente($dni, $nombre, $apellidoP, $apellidoM, $celular, $telefono, $email, $direccion, $sexo)) {
                $db = new Database();
                $db = $db->connectDb();
                $r = $db->prepare("SELECT u.iIdUsuario as id, p.vchNombres as nombre,p.vchApellidoP as apellidoPaterno, p.vchApellidoM as apellidoMaterno, p.dFecNac as fechaNacimiento, p.iSexo as sexo, p.vchDirección as direccion, p.vchTelefono as telefono, u.vchCorreo as correoElectronico, p.vchDni as dni, p.vchCelular as celular, p.dFecReg as fechaRegistro, u.bInactivo as estado  from persona  p inner join usuario u on u.iIdPersona=p.iIdPersona where  p.vchDni =$dni");
                $data = [];
                $r->execute();
                $persona = $r->fetch(PDO::FETCH_OBJ);
                if (
                    $dni == $persona->dni && $nombre == $persona->nombre && $apellidoP == $persona->apellidoPaterno && $apellidoM == $persona->apellidoMaterno && $celular == $persona->celular
                    && $telefono == $persona->telefono && $email == $persona->correoElectronico && $direccion == $persona->direccion && $sexo == $persona->sexo
                ) {

                    $data = array("message" => "modificado con exito", "codigo" => "200");
                } else {
                    $r = $db->prepare("UPDATE Persona set vchNombres='$nombre', vchApellidoP='$apellidoP', vchApellidoM='$apellidoM', vchTelefono='$telefono', iSexo=$sexo where iIdPersona=$idCliente");
                    $data = [];
                    $r->execute();
                    if ($r->rowCount() > 0) {
                        $data = array("message" => "modificado con exito", "codigo" => "200");
                    } else $data = array("message" => "Ocurrió un error al modificar", "codigo" => "404");
                    return $data;
                }
                return $data;
            } else
                return array("message" => "Datos incorrectos", "codigo" => "400");
        } catch (PDOException $e) {
            return array("message" => $e->getMessage(), "codigo" => "404");
        }
    }

    private function validateCliente($dni, $nombre, $apellidoP, $apellidoM, $celular, $email, $direccion, $sexo)
    {
        if (strlen($dni) == 8 && !empty($nombre) && !empty($apellidoP) && !empty($apellidoM) && !empty($celular) && !empty($sexo))  return true;
        else  return false;
    }
}
