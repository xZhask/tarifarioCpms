<?php
try {
    $manejador = 'mysql';
    $servidor = 'localhost';
    $usuario = 'root';
    $pass = 'mysql';
    $db = 'magusa_cpms';
    /*$usuario = 'magusa_dirsapol';
    $pass = '@hMI#~E2**-^';
    $db = 'magusa_cpms';*/
    $cadena = "$manejador:host=$servidor;dbname=$db";
    $cnx = new PDO($cadena, $usuario, $pass, [
        PDO::ATTR_PERSISTENT => 'true',
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'",
    ]);
    date_default_timezone_set('America/Lima');
} catch (Exception $ex) {
    echo 'Error de acceso, informelo a la brevedad :' . $ex;
    exit();
}
