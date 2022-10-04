<?php
require_once '../models/ClsCpt.php';

$accion = $_POST['accion'];
controller($accion);

function controller($accion)
{
    $objProcedimiento = new ClsProcedimiento();

    switch ($accion) {
        case 'LISTAR_TARIFARIO':
            $nvl = $_POST['nvlipress'];
            $procedimientos = $objProcedimiento->FiltrarTarifario($nvl);
            $procedimientos = $procedimientos->fetchAll(PDO::FETCH_OBJ);
            $tabla = '';
            $id = 1;
            foreach ($procedimientos as $procedimiento) {
                $tabla .= '<tr>';
                $tabla .= '<td>' . $id . '</td>';
                $tabla .= '<td>' . $procedimiento->codigocpt . '</td>';
                $tabla .= '<td>' . $procedimiento->descripcion . '</td>';
                $tabla .= '<td>' . $procedimiento->precio . '</td>';
                $tabla .= '</tr>';
                $id++;
            }
            echo $tabla;
            break;
        case 'FILTRAR_PROCEDIMIENTO':
            $nvl = $_POST['nvlipress'];
            $filtro = $_POST['filtro'];
            $procedimientos = $objProcedimiento->FiltrarProcedimiento($filtro, $nvl);
            $procedimientos = $procedimientos->fetchAll(PDO::FETCH_OBJ);

            $tabla = '';
            $id = 1;
            foreach ($procedimientos as $procedimiento) {
                $tabla .= '<tr>';
                $tabla .= '<td>' . $id . '</td>';
                $tabla .= '<td>' . $procedimiento->codigocpt . '</td>';
                $tabla .= '<td>' . $procedimiento->descripcion . '</td>';
                $tabla .= '<td>' . $procedimiento->precio . '</td>';
                $tabla .= '</tr>';
                $id++;
            }
            echo $tabla;
            break;
    }
}
