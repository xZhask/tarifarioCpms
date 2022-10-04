<?php
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use \PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Color;

require_once '../../../App/models/ClsCpt.php';

$objProcedimiento = new ClsProcedimiento();

$nvl = $_GET['nvl'];

$nro = $nvl == '3' ? 'III' : ($nvl == '2' ? 'II' : 'I');

$descargas = $objProcedimiento->CantidadDescargas();
$descargas = $descargas->fetch(PDO::FETCH_NAMED);
$descargas = $descargas['cantidad'];
$descargas++;
$fecha = date('Y/m/d');

$objProcedimiento->ActualizarDescargas($descargas, $fecha);

$estiloHeader = [
    'font' => [
        'bold' => true,
        'color' => ['rgb' => 'FFFFFF'],
    ],
    'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
        ]
    ],
    'alignment' => [
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
    ],
    'fill' => [
        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
        'startColor' => [
            'rgb' => '26A69A',
        ],
    ],
];
$estiloBody = [
    'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
        ]
    ],
    'alignment' => [
        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
    ]
];
$estiloCentro = [
    'alignment' => [
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,

    ]
];

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(40);
$spreadsheet->getActiveSheet()->getStyle("A1")->getFont()->setSize(16);
$spreadsheet->getActiveSheet()->mergeCells('A1:D1');
$spreadsheet->getActiveSheet()->getStyle('A1:D2')->applyFromArray($estiloHeader);
$sheet->getColumnDimension('A')->setWidth(10);
$spreadsheet->getActiveSheet()->getStyle('A')->applyFromArray($estiloCentro);
$spreadsheet->getActiveSheet()->getStyle('B')->applyFromArray($estiloCentro);
$spreadsheet->getActiveSheet()->getStyle('D')->applyFromArray($estiloCentro);
$sheet->setCellValue('A1', 'TARIFARIO PARA IPRESS DE NIVEL ' . $nro);
$spreadsheet->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
$sheet->setCellValue('A2', '#');
$sheet->getColumnDimension('B')->setWidth(20);
$sheet->setCellValue('B2', 'CÓDIGO');
$sheet->getColumnDimension('C')->setWidth(100);
$sheet->setCellValue('C2', 'DESCRIPCIÓN');
$sheet->getColumnDimension('D')->setWidth(15);
$sheet->setCellValue('D2', 'PRECIO');

$filaExcel = 3;

$procedimientos = $objProcedimiento->FiltrarTarifario("nvl$nvl");
$procedimientos = $procedimientos->fetchAll(PDO::FETCH_OBJ);
$id = 1;
foreach ($procedimientos as $procedimiento) {
    $sheet->setCellValue('A' . $filaExcel, $id);
    $sheet->setCellValue('B' . $filaExcel, $procedimiento->codigocpt);
    $sheet->setCellValue('c' . $filaExcel, $procedimiento->descripcion);
    $sheet->setCellValue('D' . $filaExcel, $procedimiento->precio);
    $id++;
    $filaExcel++;
}
$filaExcel--;
$spreadsheet->getActiveSheet()->getStyle('A3:D' . $filaExcel)->applyFromArray($estiloBody);

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Tarifario.xlsx"');
header('Cache-Control: max-age=0');

$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save('php://output');