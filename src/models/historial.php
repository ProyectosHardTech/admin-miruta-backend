<?php

namespace App\Models;

use App\Config\Database;
use PDO;
use PDOException;
use Slim\Http\Request as Request;

class Historial
{
    function getHistorialPagos()
    {
        try {
            $db = new Database();
            $db = $db->connectDb();
            $r = $db->query("SELECT c.iIdChofer as id, p.vchNombres as nombre, p.vchApellidoM as apellido, mMontoRecarga as montoRecarga, b.dFechaRegistro as fechaRecarga  from persona p inner join usuario u on u.iIdPersona=p.iIdPersona inner join Chofer c on c.iIdUsuario=u.iIdUsuario inner join ChoferBilleteraPago b on b.iIdChofer=c.iIdChofer order by b.dFechaRegistro DESC");
            $data = [];
            $row_count = ($r->rowCount() * -1);
            if ($row_count > 0) {
                $historial = $r->fetchAll(PDO::FETCH_OBJ);
                $data = array("historialPagos" => $historial, "codigo" => "200");
            } else $data = array("message" => "No hay datos", "codigo" => "204");

            return $data;
        } catch (PDOException $e) {
            return array("message" => $e->getMessage(), "codigo" => "404");
        }
    }

    function getHistorialViajesChoferes()
    {
        try {
            $db = new Database();
            $db = $db->connectDb();
            $r = $db->query("SELECT  c.iIdChofer as idChofer,(select count(iIdUsuario) from viaje where iIdUsuario=u.iIdUsuario) as cant,  p.vchDni as id, concat( p.vchNombres,' ',p.vchApellidoP) as nombre, c.fechaEstado, u.vchCorreo as correoElectronico from Chofer c inner join Usuario u on c.iIdUsuario=u.iIdUsuario inner join Persona p on u.iIdPersona=p.iIdPersona WHERE c.iEstado=2 order by p.vchNombres ASC  ");
            $data = [];
            $row_count = ($r->rowCount() * -1);
            if ($row_count > 0) {
                $historial = $r->fetchAll(PDO::FETCH_OBJ);
                $data = array("historialViajesChofer" => $historial, "codigo" => "200");
            } else $data = array("message" => "No hay datos", "codigo" => "204");

            return $data;
        } catch (PDOException $e) {
            return array("message" => $e->getMessage(), "codigo" => "404");
        }
    }
    function getHistorialViajesClientes()
    {
        try {
            $db = new Database();
            $db = $db->connectDb();
            $r = $db->query("SELECT u.iIdUsuario as id,(select count(iIdUsuario) from viaje where iIdUsuario=u.iIdUsuario) as cant,  p.vchDni as dni, concat( p.vchNombres,' ',p.vchApellidoP) as nombre, u.vchCorreo as correoElectronico from persona  p inner join usuario u on u.iIdPersona=p.iIdPersona where u.bInactivo=0 order by p.vchNombres ASC  ");
            $data = [];
            $row_count = ($r->rowCount() * -1);
            if ($row_count > 0) {
                $historial = $r->fetchAll(PDO::FETCH_OBJ);
                $data = array("historialViajesChofer" => $historial, "codigo" => "200");
            } else $data = array("message" => "No hay datos", "codigo" => "204");

            return $data;
        } catch (PDOException $e) {
            return array("message" => $e->getMessage(), "codigo" => "404");
        }
    }

    function getHistorialViajesXchofer(Request $request)
    {
        $id = $request->getParam('idChofer');
        try {
            $db = new Database();
            $db = $db->connectDb();
            $r = $db->query("SELECT c.iIdChofer as id, p.vchNombres as nombre, p.vchApellidoP as apellido, vchNombreInicial as inicio, vchNombreFinal as final, v.dFecReg as fechaViaje from Viaje v inner join Chofer c on v.iIdChofer=c.iIdChofer inner join Usuario u on u.iIdUsuario=c.iIdUsuario inner join Persona p on p.iIdPersona=u.iIdPersona where c.iIdChofer=$id");
            $data = [];
            $row_count = ($r->rowCount() * -1);
            if ($row_count > 0) {
                $historial = $r->fetchAll(PDO::FETCH_OBJ);
                $data = array("historialViajesChofer" => $historial, "codigo" => "200");
            } else $data = array("message" => "No hay datos", "codigo" => "204");

            return $data;
        } catch (PDOException $e) {
            return array("message" => $e->getMessage(), "codigo" => "404");
        }
    }
    function getHistorialViajesXcliente(Request $request)
    {
        $idUsuario = $request->getParam('id');
        try {
            $db = new Database();
            $db = $db->connectDb();
            $r = $db->query("SELECT c.iIdChofer as id, p.vchNombres as nombre, p.vchApellidoP as apellido, vchNombreInicial as inicio, vchNombreFinal as final, v.dFecReg as fechaViaje from Viaje v inner join Chofer c on v.iIdChofer=c.iIdChofer inner join Usuario u on u.iIdUsuario=c.iIdUsuario inner join Persona p on p.iIdPersona=u.iIdPersona where u.iIdUsuario=$idUsuario");
            $data = [];
            $row_count = ($r->rowCount() * -1);
            if ($row_count > 0) {
                $historial = $r->fetchAll(PDO::FETCH_OBJ);
                $data = array("historialViajesClientes" => $historial, "codigo" => "200");
            } else $data = array("message" => "No hay datos", "codigo" => "204");

            return $data;
        } catch (PDOException $e) {
            return array("message" => $e->getMessage(), "codigo" => "404");
        }
    }
}
