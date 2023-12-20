<?php

namespace App\Models;

use App\Config\Database;
use PDO;
use PDOException;
use Slim\Http\Request as Request;

class Choferes
{
    function getChoferesP()
    {
        try {
            $db = new Database();
            $db = $db->connectDb();
            $r = $db->query("
                SELECT 
                    c.iMarcaVehiculo, 
                    c.iModeloVehiculo, 
                    c.nuevaMarca, 
                    c.nuevoModelo, 
                    c.vchPlaca as placa, 
                    ma.vchMarca as marca, 
                    mo.vchModelo as modelo, 
                    c.nLicencia as licencia,
                    c.dFecReg as fechaResgistro, 
                    c.iIdChofer as idChofer, 
                    u.iIdUsuario as idUsuario, 
                    c.observaciones, 
                    p.vchDni as id, 
                    p.vchNombres as nombre, 
                    concat(p.vchApellidoP,' ', p.vchApellidoM) as apellidos,
                    p.vchDireccion as direccion,
                    p.vchCelular as celular, 
                    u.vchCorreo as correoElectronico, 
                    C.iTotalViajes as vTotal, 
                    C.iViajesAceptados as vAceptados, 
                    C.iViajesCancelados as vCancelados, 
                    C.iViajesCompletados as vCompletados, 
                    C.mGananciaTotal as ganaciaTotal, 
                    C.iEstado as estado   
                from Chofer c 
                inner join Usuario u 
                    on c.iIdUsuario=u.iIdUsuario 
                inner join Persona p 
                    on u.iIdPersona=p.iIdPersona 
                inner join Marca ma
                    on ma.iIdMarca=c.iMarcaVehiculo 
                inner join modelo mo
                    on mo.iIdModelo=c.iModeloVehiculo
                WHERE c.iEstado=0 
                order by c.dFecReg DESC
            ");
            $data = [];
            $row_count = ($r->rowCount() * -1);
            if ($row_count > 0) {
                $choferes = $r->fetchAll(PDO::FETCH_OBJ);
                $data = array("choferesPendientes" => $choferes, "codigo" => "200");
            } else $data = array("message" => "No hay datos", "codigo" => "204");

            return $data;
        } catch (PDOException $e) {
            return array("message" => $e->getMessage(), "codigo" => "404");
        }
    }




    function getChoferesO()
    {
        try {
            $db = new Database();
            $db = $db->connectDb();
            $r = $db->query("SELECT  c.iIdChofer as idChofer, c.fechaEstado, u.iIdUsuario as idUsuario, c.observaciones, p.vchDni as id, concat(p.vchNombres,' ',p.vchApellidoP,' ', p.vchApellidoM) as nombreCompleto,p.vchDireccion as direccion,p.vchCelular as celular, u.vchCorreo as correoElectronico, C.iTotalViajes as vTotal, C.iViajesAceptados as vAceptados, C.iViajesCancelados as vCancelados, C.iViajesCompletados as vCompletados, C.mGananciaTotal as ganaciaTotal, C.iEstado as estado   from Chofer c inner join Usuario u on c.iIdUsuario=u.iIdUsuario inner join Persona p on u.iIdPersona=p.iIdPersona WHERE c.iEstado=2 order by c.fechaEstado DESC ");
            $data = [];
            $row_count = ($r->rowCount() * -1);
            if ($row_count > 0) {
                $choferes = $r->fetchAll(PDO::FETCH_OBJ);
                $data = array("choferesObservados" => $choferes, "codigo" => "200");
            } else $data = array("message" => "No hay datos", "codigo" => "204");

            return $data;
        } catch (PDOException $e) {
            return array("message" => $e->getMessage(), "codigo" => "404");
        }
    }

    function getChoferesC()
    {
        try {
            $db = new Database();
            $db = $db->connectDb();
            $r = $db->query("SELECT  c.iIdChofer  as idChofer, c.fechaEstado, c.iIdUsuario as idUsuario, c.observaciones, p.vchDni as id, concat(p.vchNombres,' ',p.vchApellidoP,' ', p.vchApellidoM) as nombreCompleto,p.vchDireccion as direccion,p.vchCelular as celular, u.vchCorreo as correoElectronico, C.iTotalViajes as vTotal, C.iViajesAceptados as vAceptados, C.iViajesCancelados as vCancelados, C.iViajesCompletados as vCompletados, C.mGananciaTotal as ganaciaTotal, C.iEstado as estado   from Chofer c inner join Usuario u on c.iIdUsuario=u.iIdUsuario inner join Persona p on u.iIdPersona=p.iIdPersona WHERE c.iEstado=5 order by c.fechaEstado DESC ");
            $data = [];
            $row_count = ($r->rowCount() * -1);
            if ($row_count > 0) {
                $choferes = $r->fetchAll(PDO::FETCH_OBJ);
                $data = array("choferesCorregidos" => $choferes, "codigo" => "200");
            } else $data = array("message" => "No hay datos", "codigo" => "204");

            return $data;
        } catch (PDOException $e) {
            return array("message" => $e->getMessage(), "codigo" => "404");
        }
    }

    function getChoferesA()
    {
        try {
            $db = new Database();
            $db = $db->connectDb();
            $r = $db->query("SELECT  c.fechaEstado, c.iIdChofer as idChofer,u.flagComisionUsuario, u.iIdUsuario as idUsuario,u.penalidad as penalidad, p.dFecNac as fechaNacimiento,  c.observaciones, p.vchDni as id, concat( p.vchNombres,' ',p.vchApellidoP,' ', p.vchApellidoM) as nombreCompleto,p.vchDireccion as direccion,p.vchCelular as celular, u.vchCorreo as correoElectronico, C.iTotalViajes as vTotal, C.iViajesAceptados as vAceptados, C.iViajesCancelados as vCancelados, C.iViajesCompletados as vCompletados, C.mGananciaTotal as ganaciaTotal, C.iEstado as estado   from Chofer c inner join Usuario u on c.iIdUsuario=u.iIdUsuario inner join Persona p on u.iIdPersona=p.iIdPersona WHERE c.iEstado=1 order by c.fechaEstado DESC ");
            $data = [];
            $row_count = ($r->rowCount() * -1);
            if ($row_count > 0) {
                $choferes = $r->fetchAll(PDO::FETCH_OBJ);
                $data = array("choferesActivos" => $choferes, "codigo" => "200");
            } else $data = array("message" => "No hay datos", "codigo" => "204");

            return $data;
        } catch (PDOException $e) {
            return array("message" => $e->getMessage(), "codigo" => "404");
        }
    }

    function getChoferesR()
    {
        try {
            $db = new Database();
            $db = $db->connectDb();
            $r = $db->query("SELECT c.iIdChofer as idChofer, c.observaciones, c.fechaEstado, c.fechaEstado, c.observaciones, p.vchDni as id, p.vchNombres as nombre, concat(p.vchApellidoP,' ', p.vchApellidoM) as apellidos,p.vchDireccion as direccion,p.vchCelular as celular, u.vchCorreo as correoElectronico, C.iTotalViajes as vTotal, C.iViajesAceptados as vAceptados, C.iViajesCancelados as vCancelados, C.iViajesCompletados as vCompletados, C.mGananciaTotal as ganaciaTotal, C.iEstado as estado   from Chofer c inner join Usuario u on c.iIdUsuario=u.iIdUsuario inner join Persona p on u.iIdPersona=p.iIdPersona WHERE c.iEstado=4 order by c.fechaEstado DESC");
            $data = [];
            $row_count = ($r->rowCount() * -1);
            if ($row_count > 0) {
                $choferes = $r->fetchAll(PDO::FETCH_OBJ);
                $data = array("choferesRechazados" => $choferes, "codigo" => "200");
            } else $data = array("message" => "No hay datos", "codigo" => "204");

            return $data;
        } catch (PDOException $e) {
            return array("message" => $e->getMessage(), "codigo" => "404");
        }
    }
    function getChoferesD()
    {
        try {
            $db = new Database();
            $db = $db->connectDb();
            $r = $db->query("SELECT  c.fechaEstado, c.iIdChofer as idChofer, p.dFecNac as fechaNacimiento,  c.observaciones, p.vchDni as id, concat( p.vchNombres,' ',p.vchApellidoP,' ', p.vchApellidoM) as nombreCompleto,p.vchDireccion as direccion,p.vchCelular as celular, u.vchCorreo as correoElectronico, C.iTotalViajes as vTotal, C.iViajesAceptados as vAceptados, C.iViajesCancelados as vCancelados, C.iViajesCompletados as vCompletados, C.mGananciaTotal as ganaciaTotal, C.iEstado as estado   from Chofer c inner join Usuario u on c.iIdUsuario=u.iIdUsuario inner join Persona p on u.iIdPersona=p.iIdPersona WHERE c.iEstado=3 order by c.fechaEstado DESC ");
            $data = [];
            $row_count = ($r->rowCount() * -1);
            if ($row_count > 0) {
                $choferes = $r->fetchAll(PDO::FETCH_OBJ);
                $data = array("choferesInactivos" => $choferes, "codigo" => "200");
            } else $data = array("message" => "No hay datos", "codigo" => "204");

            return $data;
        } catch (PDOException $e) {
            return array("message" => $e->getMessage(), "codigo" => "404");
        }
    }


    function getDocChofer(Request $request)
    {
        $idChofer = $request->getParam('idChofer');
        try {
            $db = new Database();
            $db = $db->connectDb();
            $r = $db->query("SELECT d.vchRuta, ch.observaciones, ch.iIdUsuario as idUsuario, d.iEstado, d.iTipoDocumento, d.vchMotivoRechazo, d.dFecReg from Documento d inner join Documentacion dc on d.iIdDocumentacion=dc.iIdDocumentacion inner join Usuario u on u.iIdUsuario=dc.iIdUsuario inner join Chofer ch on ch.iIdUsuario=u.iIdUsuario where ch.iIdChofer = $idChofer;");
            $data = [];
            $row_count = ($r->rowCount() * -1);
            if ($row_count > 0) {
                $choferes = $r->fetchAll(PDO::FETCH_OBJ);
                $data = array("documentos" => $choferes, "codigo" => "200");
            } else $data = array("message" => "No hay datos", "codigo" => "204");

            return $data;
        } catch (PDOException $e) {
            return array("message" => $e->getMessage(), "codigo" => "404");
        }
    }
    function deactivateChofer(Request $request)
    {
        $idChofer = $request->getParam('idChofer');
        $observacion = $request->getParam('observaciones');
        try {
            if (!empty($idChofer)) {
                $db = new Database();
                $db = $db->connectDb();
                $r = $db->prepare("SELECT *from chofer where iIdChofer=$idChofer");
                $data = [];
                $r->execute();
                $cliente = $r->fetch(PDO::FETCH_OBJ);
                if ($cliente->iEstado == 1) {
                    $r = $db->prepare("UPDATE  chofer set observaciones='$observacion', iEstado=3, fechaEstado=(SELECT SYSDATETIME()) where iIdChofer=$idChofer");
                    $data = [];
                    $r->execute();
                    if ($r->rowCount() > 0) $data = array("message" => "modificado con exito", "codigo" => "200");
                    else $data = array("message" => "Ocurrió un error al modificar", "codigo" => "404");
                } else {
                    $r = $db->prepare("UPDATE  chofer set observaciones='$observacion', iEstado=1, fechaEstado=(SELECT SYSDATETIME()) where iIdChofer=$idChofer");
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
    function docValidador(Request $request)
    {
        $idUsuario = $request->getParam('idUsuario');
        $tipoDoc = $request->getParam('documentos');
        // $documentoT = json_decode($tipoDoc);
        // return $tipoDoc;

        try {
            $db = new Database();
            $db = $db->connectDb();

            if ($tipoDoc == "activado") {
                $r = $db->prepare("SELECT *from Documentacion where iIdUsuario=$idUsuario");
                $data = [];
                $r->execute();
                $doc = $r->fetch(PDO::FETCH_OBJ);
                $idDoc = $doc->iIdDocumentacion;


                $row_count = ($r->rowCount() * -1);

                if ($row_count > 0) {
                    $r = $db->prepare("UPDATE Documento set iEstado=2 where iIdDocumentacion=$idDoc");
                    $data = [];
                    $r->execute();
                    // $doc = $r->fetch(PDO::FETCH_OBJ);
                    if ($r->rowCount() > 0) {
                        $r = $db->prepare("UPDATE Chofer set iEstado=1, fechaEstado=(SELECT SYSDATETIME()) where iIdUsuario=$idUsuario");
                        $data = [];
                        $r->execute();

                        $w = $db->prepare("SELECT *from Dispositivo where iIdUsuario=$idUsuario");
                        $data = [];
                        $w->execute();
                        $usu = $w->fetch(PDO::FETCH_OBJ);


                        $to = $usu->vchToken;

                        // echo $to;
                        // return $to;
                        // notificacion

                        $notification = array(
                            'title' => "🚙MiRuta®🌟",
                            'body' => "Tiene una observación en su postulación",
                        );
                        $data = array(
                            'click_action' => 'FLUTTER_NOTIFICATION_CLICK',
                            'display_notification' => 'true',
                            'action' => 'aprobbed',
                            'code' => 'asda',
                            'title' => "🚙MiRuta®🌟",
                            'content' => "Aprovado opara chofer",
                            'backoffice' => "1",
                            'type' => "new_service"
                        );

                        $feilds = array('to' => $to, 'notification' => $notification, 'data' => $data);

                        $ch = curl_init();

                        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        curl_setopt($ch, CURLOPT_POST, 1);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($feilds));

                        $headers = array();

                        $headers[] = 'Authorization: key=AAAAu5q29Ko:APA91bEQWk5Ovex7Tjmzg66QS5_4RjeW7knWfY-e7epbGej_5s90GmmKFBZiEN5BfYY6tasHzN3NpxJU3HvKw-lGAxiBNnAKkny0cUx6Oiraono1jemqYaN_PJpfWk6wwruTMUUV4xCF';
                        // $headers[] = env('TIPO') == 'DEV' ? env('TOKENDEV') : env('TOKEN');
                        $headers[] = 'Content-Type: application/json';
                        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

                        $result = curl_exec($ch);

                        if (curl_errno($ch)) {
                            echo 'Error:' . curl_error($ch);
                        }
                        curl_close($ch);

                        if ($r->rowCount() > 0) {
                            $data = array("message" => "modificado con exito", "codigo" => "200");
                        } else $data = array("message" => "Ocurrió un error al modificar", "codigo" => "404");
                    } else $data = array("message" => "Ocurrió un error al modificar", "codigo" => "404");
                } else $data = array("message" => "Ocurrió un error al modificar", "codigo" => "404");
                return $data;
            } else {
                $r = $db->prepare("SELECT *from Documentacion where iIdUsuario=$idUsuario");
                $data = [];
                $r->execute();
                $doc = $r->fetch(PDO::FETCH_OBJ);
                $idDoc = $doc->iIdDocumentacion;
                $row_count = ($r->rowCount() * -1);
                if ($row_count > 0) {
                    $r = $db->prepare("SELECT *from Documento where iIdDocumentacion=$idDoc");
                    $data = [];
                    $r->execute();
                    $row_count = ($r->rowCount() * -1);
                    if ($row_count > 0) {
                        $r = $db->prepare("UPDATE Documento set iEstado=3 where iIdDocumentacion=$idDoc");
                        $data = [];
                        $r->execute();
                        if ($r->rowCount() > 0) {
                            foreach ($tipoDoc as $valor) {

                                // return 'hols';
                                $r = $db->prepare("UPDATE Documento set iEstado=2 where iIdDocumentacion=$idDoc and iTipoDocumento=$valor");
                                $data = [];
                                $r->execute();
                            }
                            $r = $db->prepare("UPDATE chofer set iEstado=2, fechaEstado=(SELECT GETDATE())  where iIdUsuario=$idUsuario");
                            $data = [];
                            $r->execute();
                            // return $r;
                            $w = $db->prepare("SELECT *from Dispositivo where iIdUsuario=$idUsuario");
                            $data = [];
                            $w->execute();
                            $usu = $w->fetch(PDO::FETCH_OBJ);


                            $to = $usu->vchToken;

                            // echo $to;
                            // return $to;
                            // notificacion

                            // $notification = array(
                            //     'title' => "🚙MiRuta®🌟",
                            //     'body' => "Tiene una observación en su postulación",
                            // );
                            $data = array(
                                'click_action' => 'FLUTTER_NOTIFICATION_CLICK',
                                'display_notification' => 'true',
                                'action' => 'check_doc',
                                'code' => 'asda',
                                'title' => "🚙MiRuta®🌟",
                                'content' => "Tiene una observación en su postulación",
                                'backoffice' => "1",
                                'type' => "new_service"
                            );

                            $feilds = array('to' => $to, 'data' => $data);

                            $ch = curl_init();

                            curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                            curl_setopt($ch, CURLOPT_POST, 1);
                            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($feilds));

                            $headers = array();

                            $headers[] = 'Authorization: key=AAAAB3azMbo:APA91bGlxXLcnkThy8gul7GeBwO5SSbRi6XqQzH-TQYIIS54qVyAZ6PQ_094lgLgIl1ITVjVMR4-8o3fa-FGOVgHWlDPSPelpcaeriUeNQmPKJKyV49qzoHSEEPRmxcAxKxkTYCOpYx2';
                            // $headers[] = env('TIPO') == 'DEV' ? env('TOKENDEV') : env('TOKEN');
                            $headers[] = 'Content-Type: application/json';
                            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

                            $result = curl_exec($ch);

                            if (curl_errno($ch)) {
                                echo 'Error:' . curl_error($ch);
                            }
                            curl_close($ch);
// return $to;
                            if ($r->rowCount() > 0) {
                                $data = array("message" => "modificado con exito", "codigo" => "200");
                            } else $data = array("message" => "Ocurrió un error al modificar", "codigo" => "404");
                        } else $data = array("message" => "Ocurrió un error al modificar", "codigo" => "404");
                    } else $data = array("message" => "Datos incorrectos", "codigo" => "400");
                } else $data = array("message" => "Datos incorrectos", "codigo" => "400");
                return $data;
            }
        } catch (PDOException $e) {
            return array("message" => $e->getMessage(), "codigo" => "404");
        }
    }

    function getDocObservados(Request $request)
    {
        $idUsuario = $request->getParam('idUsuario');
        try {
            $db = new Database();
            $db = $db->connectDb();
            $r = $db->query("SELECT dc.vchRuta, dc.iEstado as estado, dc.iTipoDocumento as tipoDocumento  from Documentacion d inner join Documento dc on d.iIdDocumentacion=dc.iIdDocumentacion where d.iIdUsuario=$idUsuario");
            $data = [];
            $row_count = ($r->rowCount() * -1);
            if ($row_count > 0) {
                $choferes = $r->fetchAll(PDO::FETCH_OBJ);
                $data = array("documentosObservados" => $choferes, "codigo" => "200");
            } else $data = array("message" => "No hay datos", "codigo" => "204");
            return $data;
        } catch (PDOException $e) {
            return array("message" => $e->getMessage(), "codigo" => "404");
        }
    }
    function rechazarPendientes(Request $request)
    {
        $idChofer = $request->getParam('idChofer');
        $observaciones = $request->getParam('observaciones');
        try {
            $db = new Database();
            $db = $db->connectDb();
            $r = $db->prepare("SELECT * from chofer where iIdChofer=$idChofer");
            $r->execute();
            $doc = $r->fetch(PDO::FETCH_OBJ);
            $idDoc = $doc->iIdDocumentacion;
            $row_count = ($r->rowCount() * -1);
            if ($row_count > 0) {
                $db = new Database();
                $db = $db->connectDb();
                $r = $db->prepare("UPDATE chofer set observaciones='$observaciones', iEstado=4, fechaEstado=(SELECT GETDATE()) where iIdChofer=$idChofer");
                $data = [];
                $r->execute();
                if ($r->rowCount() > 0) {
                    $r = $db->prepare("UPDATE Documento set iEstado=5 where iIdDocumentacion=$idDoc");
                    $data = [];
                    $r->execute();
                    $data = array("message" => "modificado con exito", "codigo" => "200");
                } else $data = array("message" => "Ocurrió un error al modificar", "codigo" => "404");
                return $data;
            } else $data = array("message" => "Ocurrió un error al modificar", "codigo" => "404");
        } catch (PDOException $e) {
            return array("message" => $e->getMessage(), "codigo" => "404");
        }
    }
}
