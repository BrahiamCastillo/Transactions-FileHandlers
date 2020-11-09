<?php

require_once '..\..\folders\layouts\layouts.php';
require_once '..\..\folders\business\logic.php';
require_once 'student.php';
require_once '..\..\folders\service\IServiceBasic.php';
require_once 'StudentServiceCookies.php';

$layout = new Layout(true);
$studentService = new StudentServiceCookie();
$logic = new Logic();

if (isset($_GET['id'])) {

    $studentId = $_GET['id'];

    $modify = $studentService->GetById($studentId);


    if (isset($_POST["name2"]) && isset($_POST["last-name2"]) && isset($_POST["carrera2"]) && isset($_FILES["profilePhoto"])) {
        if (isset($_POST["status2"])) {
            $_POST["status2"] = "Activo";
        } else {
            $_POST["status2"] = "Inactivo";
        }

        $updateStudent = new Student();
        $updateStudent->InicializeData($studentId, $_POST["name2"], $_POST["last-name2"], $_POST["carrera2"], $_POST["status2"]);

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
        <form enctype="multipart/form-data" action="edit.php?id=<?php echo $modify->id; ?>" method="POST">
            <div class="form-group">
                <label for="name2">Nombre</label>
                <input class="form-control" id="name2" name="name2" value="<?php echo $modify->name; ?>">
            </div>
            <div class="form-group">
                <label for="last-name2">Apellido</label>
                <input class="form-control" id="last-name2" name="last-name2" value="<?php echo $modify->lastName; ?>">
            </div>
            <div class="form-group">
                <label for="carrera2">Carrera</label>
                <select class="form-control" name="carrera2" id="carrera2">
                    <?php foreach ($logic->carreras as $carrera) : ?>
                        <?php if ($modify->carrera == $carrera) : ?>
                            <option selected value='<?php echo $carrera; ?>'><?php echo $carrera; ?></option>";
                        <?php else : ?>
                            <option value='<?php echo $carrera ?>'><?php echo $carrera; ?></option>";
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="status2" name="status2">
                <label class="form-check-label" for="status2">Status</label>
            </div>


            <div class="card mb-4 shadow-sm bg-dark text-light">

                <?php if ($modify->profilePhoto == "" || $modify->profilePhoto == null) : ?>

                    <img class="bd-placeholder-img card-img-top" src="../../folders/pages/default.png" width="50%" height="225" aria-label="Placeholder: Thumbnail">

                <?php else : ?>

                    <img class="bd-placeholder-img card-img-top" src="<?php echo "../../folders/pages/" . $modify->profilePhoto; ?>" width="50%" height="225" aria-label="Placeholder: Thumbnail">

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