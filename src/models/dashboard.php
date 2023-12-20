<?php

namespace App\Models;

use App\Config\Database;
use PDO;
use PDOException;
use Slim\Http\Request as Request;

class Dashboard
{
    function getViajesTaxi()
    {
        try {
            $db = new Database();
            $db = $db->connectDb();
            $r = $db->query("SELECT count(iIdViaje) as viaje from viaje where iTipoViaje=1");
            $data = [];
            $row_count = ($r->rowCount() * -1);
            if ($row_count > 0) {
                $viajes = $r->fetch(PDO::FETCH_OBJ);
                // $data = array("viajes" => $viajes, "codigo" => "200");
                $data=$viajes;
            } else $data = array("message" => "No hay datos", "codigo" => "204");
            return $data;
        } catch (PDOException $e) {
            return array("message" => $e->getMessage(), "codigo" => "404");
        }
    }
    function getViajesInterprovincial()
    {
        try {
            $db = new Database();
            $db = $db->connectDb();
            $r = $db->query("SELECT count(iIdViaje) as viaje from viaje where iTipoViaje=2");
            $data = [];
            $row_count = ($r->rowCount() * -1);
            if ($row_count > 0) {
                $viajes = $r->fetch(PDO::FETCH_OBJ);
                $data=$viajes;
            } else $data = array("message" => "No hay datos", "codigo" => "204");
            return $data;
        } catch (PDOException $e) {
            return array("message" => $e->getMessage(), "codigo" => "404");
        }
    }
    function getViajesCargaPesada()
    {
        try {
            $db = new Database();
            $db = $db->connectDb();
            $r = $db->query("SELECT count(iIdViaje) as viaje from viaje where iTipoViaje=3");
            $data = [];
            $row_count = ($r->rowCount() * -1);
            if ($row_count > 0) {
                $viajes = $r->fetch(PDO::FETCH_OBJ);
                $data=$viajes;
            } else $data = array("message" => "No hay datos", "codigo" => "204");
            return $data;
        } catch (PDOException $e) {
            return array("message" => $e->getMessage(), "codigo" => "404");
        }
    }

    function getTotalChofer()
    {
        try {
            $db = new Database();
            $db = $db->connectDb();
            $r = $db->query("SELECT count(iIdChofer) as total from Chofer");
            $data = [];
            $row_count = ($r->rowCount() * -1);
            if ($row_count > 0) {
                $viajes = $r->fetch(PDO::FETCH_OBJ);
                $data=$viajes;
            } else $data = array("message" => "No hay datos", "codigo" => "204");
            return $data;
        } catch (PDOException $e) {
            return array("message" => $e->getMessage(), "codigo" => "404");
        }
    }
    function getTotalRecargas()
    {
        try {
            $db = new Database();
            $db = $db->connectDb();
            $r = $db->query("SELECT SUM(mMontoRecarga) as totalRecargas FROM choferBilleteraPago");
            $data = [];
            $row_count = ($r->rowCount() * -1);
            if ($row_count > 0) {
                $viajes = $r->fetch(PDO::FETCH_OBJ);
                $data=$viajes;
            } else $data = array("message" => "No hay datos", "codigo" => "204");
            return $data;
        } catch (PDOException $e) {
            return array("message" => $e->getMessage(), "codigo" => "404");
        }
    }

    function getComisionXDinero()
    {
        try {
            $db = new Database();
            $db = $db->connectDb();
            $r = $db->query("EXECUTE FECHAS");
            $r = $db->prepare("SELECT *FROM Actualizar");
            $data = [];
            $r->execute();
            $row_count = ($r->rowCount() * -1);
            if ($row_count   > 0) {
                $total = $r->fetchAll(PDO::FETCH_OBJ);
                $data = array("total" => $total, "codigo" => "200");
            } else $data = array("message" => "No hay datos", "codigo" => "204");
            return $data;
        } catch (PDOException $e) {
            return array("message" => $e->getMessage(), "codigo" => "404");
        }
    }
}