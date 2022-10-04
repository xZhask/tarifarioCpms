<?php
require_once 'conexion.php';

class ClsProcedimiento
{
    function FiltrarTarifario($nvl)
    {
        $sql = "SELECT * FROM cpt WHERE " . $nvl . "='SI'";
        global $cnx;
        return $cnx->query($sql);
    }
    function FiltrarProcedimiento($filtro, $nvl)
    {
        $sql = "select * from cpt where descripcion iLIKE :filtro and " . $nvl . "='SI'";
        global $cnx;
        $parametros = [
            ':filtro' => '%' . $filtro . '%'
        ];
        $pre = $cnx->prepare($sql);
        $pre->execute($parametros);
        return $pre;
    }
    function ActualizarDescargas($cantidad, $ultimadescarga)
    {
        $sql = "UPDATE descargas SET cantidad=:cantidad, ultimadescarga=:ultimadescarga";
        global $cnx;
        $parametros = [
            ':cantidad' => $cantidad,
            ':ultimadescarga' => $ultimadescarga,
        ];
        $pre = $cnx->prepare($sql);
        $pre->execute($parametros);
        return $pre;
    }
    function CantidadDescargas()
    {
        $sql = "SELECT cantidad FROM descargas WHERE id=1";
        global $cnx;
        return $cnx->query($sql);
    }
}
