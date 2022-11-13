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
            $filtro = $_POST['filtro'];
            if ($filtro == "")
                $procedimientos = $objProcedimiento->FiltrarTarifario("nvl$nvl");
            else
                $procedimientos = $objProcedimiento->FiltrarProcedimiento($filtro, "nvl$nvl");
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
