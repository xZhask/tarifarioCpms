<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/47b4aaa3bf.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="resources/js/jquery-ui-1.13.1/jquery-ui.min.css">
    <link rel="stylesheet" href="resources/css/styles.css">
    <link rel="icon" type="image/png" href="resources/img/icontarifario.png" />
    <title>Tarifario | Procedimientos</title>
</head>

<body>
    <div class="wrapper">
        <header>
            <div class="cont-inputsearch">
                <input type="hidden" name="nivelipress" id="nivelipress">
                <input type="text" id="ipress" name="ipress" placeholder="Ingresar Ipress ...">
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>
            <div class="cont-info-tarifario">
                <h2>Tarifario Actual Dirsapol: Acta 26</h2>
                <img src="resources/img/dirsapol.png" alt="">
            </div>
        </header>
        <div class="section">
            <div class="bg-dark"></div>
            <div class="cont-search">
                <input type="text" name="procedimiento" id="procedimiento" placeholder="Buscar Procedimiento">
                <a type="button" id="btnExcel"><i class="fa-regular fa-file-excel"></i> Descargar Tarifario</a>
            </div>
            <div class="cont-table">
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>CPMS</th>
                            <th>Descripción</th>
                            <th>Precio</th>
                        </tr>
                    </thead>
                    <tbody id="tbcpt">
                        <!--AJAX-->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
<script language="javascript" src="resources/js/jquery-3.6.0.min.js"></script>
<script language="javascript" src="resources/js/jquery-ui-1.13.1/jquery-ui.min.js"></script>
<script language="javascript" src="resources/js/functions.js"></script>
</html>