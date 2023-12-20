<?php

namespace App\Models;

use App\Config\Database;
use PDO;
use PDOException;
use Slim\Http\Request as Request;

class Comision
{
    function getComision()
    {
        try {
            $db = new Database();
            $db = $db->connectDb();
            $r = $db->query("SELECT cf.iIdConfiguracionComision as id, c.name as tipoVehiculo, cf.mPorcentajeComision as porcentajeComision, mMontoMaximoDeuda as deudaMaxima from ConfiguracionComision cf  inner join choferTipo c on c.id=cf.iIdChoferTipo");
            $data = [];
            $row_count = ($r->rowCount() * -1);
            if ($row_count > 0) {
                $comision = $r->fetchAll(PDO::FETCH_OBJ);
                $data = array("comision" => $comision, "codigo" => "200");
            } else $data = array("message" => "No hay datos", "codigo" => "204");
            return $data;
        } catch (PDOException $e) {
            return array("message" => $e->getMessage(), "codigo" => "404");
        }
    }
    function updateComision(Request $request)
    {
        $id = $request->getParam('id');
        $comision = $request->getParam('comision');
        $deuda = $request->getParam('deuda');
        try {
            $db = new Database();
            $db = $db->connectDb();
            $r = $db->prepare("UPDATE ConfiguracionComision set mPorcentajeComision=$comision, mMontoMaximoDeuda=$deuda where iIdConfiguracionComision=$id");
            $data = [];
            $r->execute();
            if ($r->rowCount() > 0) $data = array("message" => "modificado con exito", "codigo" => "200");
            else $data = array("message" => "Ocurrió un error al modificar", "codigo" => "404");
            return $data;
        } catch (PDOException $e) {
            return array("message" => $e->getMessage(), "codigo" => "404");
        }
    }
}
