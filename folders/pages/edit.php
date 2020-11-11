<?php

require_once '..\..\folders\layouts\layouts.php';
require_once '..\..\folders\business\logic.php';
require_once 'student.php';
require_once '..\..\folders\service\IServiceBasic.php';
require_once 'StudentServiceCookies.php';
require_once '..\FileHandler\JsonFileHandler.php';
require_once '..\FileHandler\FileTransaction.php';
require_once '../FileHandler/IHandler.php';
require_once '../FileHandler/transactionObjetc.php';

$layout = new Layout(true);
$studentService = new FileTransaction("..\FileHandler\data");
$logic = new Logic();

if (isset($_GET['id'])) {

    $studentId = $_GET['id'];

    $modify = $studentService->GetById($studentId);
    $arrayEncode = json_encode($modify);
    $arrayDecode =json_decode($arrayEncode,true);


    if (isset($_POST["monto"]) && isset($_POST["descripcion"]) && isset($_FILES["profilePhoto"])) {

        $profilePhoto = $_FILES["profilePhoto"];

        $time = date('d-m-Y H:i:s');

        $updateStudent = new TransactionObject();

        $updateStudent->InicializeData($studentId, $time, $_POST["monto"], $_POST["descripcion"], "Modificacion", $profilePhoto);

        $studentService->Edit($studentId, $updateStudent);

        header("location: ../../index.php");
        exit();
    }
} else {

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
        <form enctype="multipart/form-data" action="edit.php?id=<?php echo $studentId; ?>" method="POST">
            <div class="form-group">
                <label for="monto">Monto</label>
                <input class="form-control" id="monto" name="monto" value="<?php echo $modify->monto; ?>">
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <input class="form-control" id="descripcion" name="descripcion" value="<?php echo $modify->descripcion; ?>">
            </div>


            <div class="card mb-4 shadow-sm bg-dark text-light">

                <?php if ($modify->profilePhoto == "" || $modify->profilePhoto == null) : ?>

                    <img class="bd-placeholder-img card-img-top" src="../../folders/FileHandler\images/default.png" width="50%" height="225" aria-label="Placeholder: Thumbnail">

                <?php else : ?>

                    <img class="bd-placeholder-img card-img-top" src="<?php echo "../../folders\FileHandler\images/" . $modify->profilePhoto; ?>" width="50%" height="225" aria-label="Placeholder: Thumbnail">

                <?php endif; ?>

                <div class="card-body text-light">
                    <div class="form-group">
                        <label for="photo">Foto de perfil:</label>
                        <input type="file" class="form-control" id="photo" name="profilePhoto">
                    </div>
                </div>
            </div>

    </div>
    <button type="submit" class="btn btn-primary">Agregar</button>
    </form>
</div>
<div class="col-4"></div>
</div>



<?php

$layout->printFooter();

?>