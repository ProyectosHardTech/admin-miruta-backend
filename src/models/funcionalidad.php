<?php

namespace App\Models;

use App\Config\Database;
use PDO;
use PDOException;
use Slim\Http\Request as Request;

class Funcionalidad
{
    function getFuncionalidadA()
    {
        try {
            $db = new Database();
            $db = $db->connectDb();
            $r = $db->query("SELECT *from funcionalidades where estado=1");
            $data = [];
            $row_count = ($r->rowCount() * -1);
            if ($row_count > 0) {
                $funcionalidades = $r->fetchAll(PDO::FETCH_OBJ);
                $data = array("funcionalidades" => $funcionalidades, "codigo" => "200");
            } else $data = array("message" => "No hay datos", "codigo" => "204");
            return $data;
        } catch (PDOException $e) {
            return array("message" => $e->getMessage(), "codigo" => "404");
        }
    }
    function getFuncionalidadI()
    {
        try {
            $db = new Database();
            $db = $db->connectDb();
            $r = $db->query("SELECT *from funcionalidades where estado=0");
            $data = [];
            $row_count = ($r->rowCount() * -1);
            if ($row_count > 0) {
                $funcionalidades = $r->fetchAll(PDO::FETCH_OBJ);
                $data = array("funcionalidades" => $funcionalidades, "codigo" => "200");
            } else $data = array("message" => "No hay datos", "codigo" => "204");
            return $data;
        } catch (PDOException $e) {
            return array("message" => $e->getMessage(), "codigo" => "404");
        }
    }
    function deactivateFuncionalidad(Request $request)
    {
        $idFuncionalidades = $request->getParam('idFuncionalidades');
        try {
            $db = new Database();
            $db = $db->connectDb();
            $r = $db->prepare("SELECT *FROM funcionalidades WHERE idFuncionalidades=$idFuncionalidades");
            $data = [];
            $r->execute();
            $funcionalidades = $r->fetch(PDO::FETCH_OBJ);
            if ($funcionalidades->estado === '1') {
                $r = $db->prepare("UPDATE funcionalidades set Estado=0 where idFuncionalidades=$idFuncionalidades");
                $data = [];
                $r->execute();
                if ($r->rowCount() > 0) $data = array("message" => "modificado con exito", "codigo" => "200");
                else $data = array("message" => "Ocurrió un error al modificar", "codigo" => "404");
            } else {
                $r = $db->prepare("UPDATE funcionalidades set Estado=1 where idFuncionalidades=$idFuncionalidades");
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