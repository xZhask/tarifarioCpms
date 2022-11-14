<?php
require_once '../models/ClsCpt.php';
require_once '../models/ClsIpress.php';

$accion = $_POST['accion'];
controller($accion);

function controller($accion)
{
    $objProcedimiento = new ClsProcedimiento();
    $objIpress = new ClsIpress();

    switch ($accion) {
        case 'LISTAR_UNIDADES':
            $listadoUnidades = $objIpress->ListarIpress();
            $listadoUnidades = $listadoUnidades->fetchAll(PDO::FETCH_OBJ);
            echo json_encode($listadoUnidades);
            break;
        case 'LISTAR_PROCEDIMIENTOS':
            $nvl = $_POST['nvlipress'];
            $procedimientos = $objProcedimiento->FiltrarTarifario("nvl$nvl");
            echo (armarTabla($procedimientos));
            break;
        case 'FILTRAR_PROCEDIMIENTOS':
            $nvl = $_POST['nvlipress'];
            $filtro = $_POST['filtro'];
            $procedimientos = $objProcedimiento->FiltrarProcedimiento($filtro, "nvl$nvl");
            echo (armarTabla($procedimientos));
            break;
    }
}
function armarTabla($listado)
{
    $procedimientos = $listado->fetchAll(PDO::FETCH_OBJ);
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
    return $tabla;
}
