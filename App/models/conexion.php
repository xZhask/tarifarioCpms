<?php
try {
    $manejador = 'pgsql';
    $servidor = 'localhost';
    $usuario = 'odindeveloper_josue';
    $pass = 'Yi@m!BSOI}hK';
    $db = 'odindeveloper_dbcpt';
    $cadena = "$manejador:host=$servidor;dbname=$db";
    $cnx = new PDO($cadena, $usuario, $pass);
    date_default_timezone_set('America/Lima');
} catch (Exception $ex) {
    echo 'Error de acceso, informelo a la brevedad :' . $ex;
    exit();
}
