<?php

namespace App\Models;

use App\Config\Database;
use PDO;
use PDOException;
use Slim\Http\Request as Request;

class FormaPago
{
    function getformaPagoA()
    {
        try {
            $db = new Database();
            $db = $db->connectDb();
            $r = $db->query("SELECT  iId as id, rRuta as ruta, nNombre as nombre, eEstado as estado from FormaPago where eEstado='A';");
            $data = [];
            $row_count = ($r->rowCount() * -1);
            if ($row_count > 0) {
                $fPagos = $r->fetchAll(PDO::FETCH_OBJ);
                $data = array("formaPagos" => $fPagos, "codigo" => "200");
            } else $data = array("message" => "No hay datos", "codigo" => "204");
            return $data;
        } catch (PDOException $e) {
            return array("message" => $e->getMessage(), "codigo" => "404");
        }
    }
    function getformaPagoD()
    {
        try {
            $db = new Database();
            $db = $db->connectDb();
            $r = $db->query("SELECT  iId as id, rRuta as ruta, nNombre as nombre, eEstado as estado from FormaPago where eEstado='I';");
            $data = [];
            $row_count = ($r->rowCount() * -1);
            if ($row_count > 0) {
                $fPagos = $r->fetchAll(PDO::FETCH_OBJ);
                $data = array("formaPagos" => $fPagos, "codigo" => "200");
            } else $data = array("message" => "No hay datos", "codigo" => "204");
            return $data;
        } catch (PDOException $e) {
            return array("message" => $e->getMessage(), "codigo" => "404");
        }
    }
    function deactivateFormaPago(Request $request)
    {
        $idForma = $request->getParam('id');
        try {
            $db = new Database();
            $db = $db->connectDb();
            $r = $db->prepare("SELECT *FROM FormaPago WHERE iId=$idForma");
            $data = [];
            $r->execute();
            $formaP = $r->fetch(PDO::FETCH_OBJ);
            echo($formaP->eEstado);
            if ($formaP->eEstado === 'A') {
                $r = $db->prepare("UPDATE FormaPago set eEstado='I' where iId=$idForma");
                $data = [];
                $r->execute();
                if ($r->rowCount() > 0) $data = array("message" => "modificado con exito", "codigo" => "200");
                else $data = array("message" => "Ocurrió un error al modificar", "codigo" => "404");
            } else {
                $r = $db->prepare("UPDATE FormaPago set eEstado='A' where iId=$idForma");
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
