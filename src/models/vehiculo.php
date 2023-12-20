<?php

namespace App\Models;

use App\Config\Database;
use PDO;
use PDOException;
use Slim\Http\Request as Request;

class Vehiculo
{
    function getTipoVehiculo()
    {
        try {
            $db = new Database();
            $db = $db->connectDb();
            $r = $db->query("SELECT iIdTipoVehiculo as id, vchNombre as nombre, mTarifaReserva as tarifaReserva, nNumAsientos as numeroAsientos, mTarifaMinima as tarifoMinima, fImpuestos as impuestos, vchImagen as imagen FROM tipoVehiculo");
            $data = [];
            $row_count = ($r->rowCount() * -1);
            if ($row_count > 0) {
                $marcas = $r->fetchAll(PDO::FETCH_OBJ);
                $data = array("tipoVehiculo" => $marcas, "codigo" => "200");
            } else $data = array("message" => "No hay datos", "codigo" => "204");
            return $data;
        } catch (PDOException $e) {
            return array("message" => $e->getMessage(), "codigo" => "404");
        }
    }
    function getMarca()
    {
        try {
            $db = new Database();
            $db = $db->connectDb();
            $r = $db->query("SELECT iIdMarca as id, vchMarca as marca FROM MARCA ORDER BY vchMarca asc");
            $data = [];
            $row_count = ($r->rowCount() * -1);
            if ($row_count > 0) {
                $marcas = $r->fetchAll(PDO::FETCH_OBJ);
                $data = array("marcas" => $marcas, "codigo" => "200");
            } else $data = array("message" => "No hay datos", "codigo" => "204");

            return $data;
        } catch (PDOException $e) {
            return array("message" => $e->getMessage(), "codigo" => "404");
        }
    }
    function getModeloT()
    {
        try {
            $db = new Database();
            $db = $db->connectDb();
            $r = $db->query("SELECT iIdModelo as id, vchModelo as modelo FROM Modelo");
            $data = [];
            $row_count = ($r->rowCount() * -1);
            if ($row_count > 0) {
                $marcas = $r->fetchAll(PDO::FETCH_OBJ);
                $data = array("modeloT" => $marcas, "codigo" => "200");
            } else $data = array("message" => "No hay datos", "codigo" => "204");

            return $data;
        } catch (PDOException $e) {
            return array("message" => $e->getMessage(), "codigo" => "404");
        }
    }
    function getModeloA()
    {
        try {
            $db = new Database();
            $db = $db->connectDb();
            $r = $db->query("SELECT o.iIdModelo as id, o.vchModelo as modelo, m.vchMarca as Marca from Modelo o inner join Marca m on o.iIdMarca=m.iIdMarca where estado=1");
            $data = [];
            $row_count = ($r->rowCount() * -1);
            if ($row_count > 0) {
                $modelo = $r->fetchAll(PDO::FETCH_OBJ);
                $data = array("modelos" => $modelo, "codigo" => "200");
            } else $data = array("message" => "No hay datos", "codigo" => "204");

            return $data;
        } catch (PDOException $e) {
            return array("message" => $e->getMessage(), "codigo" => "404");
        }
    }
    function getModeloD()
    {
        try {
            $db = new Database();
            $db = $db->connectDb();
            $r = $db->query("SELECT o.iIdModelo as id, o.vchModelo as modelo, m.vchMarca as Marca from Modelo o inner join Marca m on o.iIdMarca=m.iIdMarca where estado=0");
            $data = [];
            $row_count = ($r->rowCount() * -1);
            if ($row_count > 0) {
                $modelo = $r->fetchAll(PDO::FETCH_OBJ);
                $data = array("modelos" => $modelo, "codigo" => "200");
            } else $data = array("message" => "No hay datos", "codigo" => "204");

            return $data;
        } catch (PDOException $e) {
            return array("message" => $e->getMessage(), "codigo" => "404");
        }
    }
    function addModelo(Request $request)
    {
        $id = $request->getParam('id');
        $modelo = $request->getParam('modelo');
        try {
            $db = new Database();
            $db = $db->connectDb();
            $r = $db->prepare("INSERT into Modelo (vchModelo,iIdMarca) values ('$modelo',$id)");
            $data = [];
            $r->execute();
            if ($r->rowCount() > 0) {
                $data = array("message" => "Registrado con exito", "codigo" => "200");
            } else $data = array("message" => "Ocurrió un error al registrar", "codigo" => "404");
            return $data;
        } catch (PDOException $e) {
            return array("message" => $e->getMessage(), "codigo" => "404");
        }
    }
    function addMarca(Request $request)
    {
        $marca = $request->getParam('marca');
        try {
            $db = new Database();
            $db = $db->connectDb();
            $r = $db->prepare("INSERT into Marca ( vchMarca) values ('$marca')");
            $data = [];
            $r->execute();
            if ($r->rowCount() > 0) {
                $data = array("message" => "Registrado con exito", "codigo" => "200");
            } else $data = array("message" => "Ocurrió un error al registrar", "codigo" => "404");
            return $data;
        } catch (PDOException $e) {
            return array("message" => $e->getMessage(), "codigo" => "404");
        }
    }
    function updateMarca(Request $request)
    {
        $id = $request->getParam('id');
        $marca = $request->getParam('marca');
        try {
            $db = new Database();
            $db = $db->connectDb();
            $r = $db->prepare("SELECT *from marca where iIdMarca=$id");
            $data = [];
            $r->execute();
            $marcas = $r->fetch(PDO::FETCH_OBJ);
            if ($marca == $marcas->vchMarca) {
                $data = array("message" => "modificado con exito", "codigo" => "200");
            } else {
                $r = $db->prepare("UPDATE marca set vchMarca='$marca' where iIdMarca=$id");
                $data = [];
                $r->execute();
                if ($r->rowCount() > 0) $data = array("message" => "modificado con exito", "codigo" => "200");
                else $data = array("message" => "Ocurrió un error al modificar", "codigo" => "404");
                return $data;
            }
            return $data;
        } catch (PDOException $e) {
            return array("message" => $e->getMessage(), "codigo" => "404");
        }
    }
    function updateModelo(Request $request)
    {
        $id = $request->getParam('id');
        $modelo = $request->getParam('modelo');
        try {
            $db = new Database();
            $db = $db->connectDb();
            $r = $db->prepare("UPDATE modelo set vchModelo='$modelo' where iIdModelo=$id");
            $data = [];
            $r->execute();
            if ($r->rowCount() > 0) $data = array("message" => "modificado con exito", "codigo" => "200");
            else $data = array("message" => "Ocurrió un error al modificar", "codigo" => "404");
            return $data;
        } catch (PDOException $e) {
            return array("message" => $e->getMessage(), "codigo" => "404");
        }
    }
    function deactivateModelo(Request $request)
    {
        $idModelo = $request->getParam('id');
        try {
            $db = new Database();
            $db = $db->connectDb();
            $r = $db->prepare("SELECT *FROM modelo WHERE iIdModelo = $idModelo");
            $data = [];
            $r->execute();
            $usuario = $r->fetch(PDO::FETCH_OBJ);
            if ($usuario->estado == "1") {
                $r = $db->prepare("UPDATE   modelo set estado=0 where iIdModelo=$idModelo");
                $data = [];
                $r->execute();
                if ($r->rowCount() > 0) $data = array("message" => "modificado con exito", "codigo" => "200");
                else $data = array("message" => "Ocurrió un error al modificar", "codigo" => "404");
            } else {
                $r = $db->prepare("UPDATE   modelo set estado=1 where iIdModelo=$idModelo");
                $data = [];
                $r->execute();
                if ($r->rowCount() > 0) $data = array("message" => "modificado con exito", "codigo" => "200");
                else $data = array("message" => "Ocurrió un error al modificar", "codigo" => "404");
            }
            return $data;
        } catch (PDOException $e) {
            return array("message" => $e->getMessage(), "codigo" => "404");
        }
    }
}
