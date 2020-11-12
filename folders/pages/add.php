<?php

require_once '..\..\folders\layouts\layouts.php';
require_once '..\..\folders\business\logic.php';
require_once 'student.php';
require_once '..\..\folders\service\IServiceBasic.php';
require_once 'StudentServiceCookies.php';
require_once '../FileHandler/JsonFileHandler.php';
require_once '../FileHandler/FileTransaction.php';
require_once '../FileHandler/IHandler.php';
require_once '../FileHandler/CSVFileHandler.php';
require_once '../FileHandler/transactionObjetc.php';
require_once '../FileHandler/CSVFileTransaction.php';

$layout = new Layout(true);
$transactionService = new CSVFileTransaction("../FileHandler/data");
$logic = new Logic();

if (isset($_POST["monto"]) && isset($_POST["descripcion"]) && isset($_FILES["profilePhoto"])) {

    $profilePhoto = $_FILES["profilePhoto"];

    $time = date('d-m-Y H:i:s');

    $newStudent= array(0, $time, $_POST["monto"], $_POST["descripcion"], "Agregacion", $profilePhoto);

    $transactionService->Add($newStudent);

    header("location: ../../index.php");
    exit();
}


?>


<?php

$layout->printHeader();

?>

<div style="margin-top: 8px;" class="row">
    <div class="col-4"></div>
    <div class="col-4">
        <form enctype="multipart/form-data" action="add.php" method="POST">
            <div class="form-group">
                <label for="monto">Monto</label>
                <input class="form-control" id="monto" name="monto">
            </div>
            <div class="form-group">
                <label for="descripcion">Descripcion</label>
                <input class="form-control" id="descripcion" name="descripcion">
            </div>
            <div class="form-group">
                <label for="photo">Foto de perfil:</label>
                <input type="file" class="form-control" id="photo" name="profilePhoto">
            </div>
            <button type="submit" class="btn btn-primary">Agregar</button>
        </form>
    </div>
    <div class="col-4"></div>
</div>



<?php

$layout->printFooter();

?>