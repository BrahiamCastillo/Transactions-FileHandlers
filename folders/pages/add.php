<?php

require_once '..\..\folders\layouts\layouts.php';
require_once '..\..\folders\business\logic.php';
require_once 'student.php';
require_once '..\..\folders\service\IServiceBasic.php';
require_once 'StudentServiceCookies.php';

$layout = new Layout(true);
$studentService = new StudentServiceCookie();
$logic = new Logic();

if(isset($_POST["name"]) && isset($_POST["last-name"]) && isset($_POST["carrera"]) && isset($_FILES["profilePhoto"])) {
    if(isset($_POST["status"])) {
        $_POST["status"]="Activo";
    } else {
        $_POST["status"]="Inactivo";
    }

    $newStudent = new Student();
    $newStudent->InicializeData(0,$_POST["name"],$_POST["last-name"],$_POST["carrera"],$_POST["status"]);

    $studentService->Add($newStudent);

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
                <label for="name">Nombre</label>
                <input class="form-control" id="name" name="name">
            </div>
            <div class="form-group">
                <label for="name">Apellido</label>
                <input class="form-control" id="last-name" name="last-name">
            </div>
            <div class="form-group">
                <label for="name">Carrera</label>
                <select class="form-control" name="carrera" id="carrera">
                    <?php foreach ($logic->carreras as $carrera) :
                        echo "<option value='$carrera'>$carrera</option>";
                    ?>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="status" name="status">
                <label class="form-check-label" for="status">Status</label>
            </div>
            <div class="form-group">
                <label for="photo">Foto de perfil:</label>
                <input type ="file" class="form-control" id="photo" name="profilePhoto">
            </div>
            <button type="submit" class="btn btn-primary">Agregar</button>
        </form>
    </div>
    <div class="col-4"></div>
</div>



<?php

$layout->printFooter();

?>