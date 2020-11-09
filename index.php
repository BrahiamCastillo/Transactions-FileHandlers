<?php

require_once 'folders\layouts\layouts.php';
require_once 'folders\business\logic.php';
require_once 'folders\pages\student.php';
require_once 'folders\service\IServiceBasic.php';
require_once 'folders\pages\StudentServiceCookies.php';

$layout = new Layout(false);
$logic = new Logic();
$serviceStudent = new StudentServiceCookie();

$studentList = $serviceStudent->GetList();

if (!empty($studentList)) {

    if (isset($_GET["carrera"])) {

        $studentList = $logic->careerFilter($studentList, "carrera", $_GET["carrera"]);
    }
}

?>

<?php

$layout->printHeader();

?>

<main role="main">

    <section class="jumbotron text-center">
        <div class="container">
            <h1>Registro de estudiantes</h1>
            <p class="lead text-muted">Aquí se podrá apreciar la lista de estudiantes agregados.</p>
            <p>
                <a href="folders\pages\add.php" class="btn btn-primary my-2">Agregar estudiante</a>
            </p>
        </div>
    </section>

    <div class="album py-5 bg-light">
        <div class="container">

            <div class="row" style="margin-bottom: 12px;">
                <div class="col-md-2"></div>
                <div class="col-md-10">
                    <div class="btn-group">
                        <a href="index.php?carrera=Redes" class="btn btn-dark text-light">Redes</a>
                        <a href="index.php?carrera=Software" class="btn btn-dark text-light">Software</a>
                        <a href="index.php?carrera=Multimedia" class="btn btn-dark text-light">Multimedia</a>
                        <a href="index.php?carrera=Mecatrónica" class="btn btn-dark text-light">Mecatrónica</a>
                        <a href="index.php?carrera=Seguridad informática" class="btn btn-dark text-light">Seguridad informática</a>
                        <a href="index.php" class="btn btn-dark text-light">TODOS</a>
                    </div>
                </div>
            </div>

            <div class="row">

                <?php if (empty($studentList)) : ?>

                    <h2>No hay estudiantes registrados.</h2>

                <?php else : ?>

                    <?php foreach ($studentList as $students) : ?>

                        <div class="col-md-4 bg-dark" style="margin-right: 8px; margin-bottom: 8px;">
                            <div class="card mb-4 shadow-sm bg-dark text-light">

                                <?php if ($students->profilePhoto == "" || $students->profilePhoto == null) : ?>

                                    <img class="bd-placeholder-img card-img-top" src="folders/pages/default.png" width="100%" height="225" aria-label="Placeholder: Thumbnail">

                                <?php else : ?>

                                    <img class="bd-placeholder-img card-img-top" src="<?php echo "folders/pages/" . $students->profilePhoto; ?>" width="100%" height="225" aria-label="Placeholder: Thumbnail">

                                <?php endif; ?>

                                <div class="card-body size-letter">
                                    <p>Nombre: <?php echo $students->name; ?></p>
                                    <p>Apellido: <?php echo $students->lastName; ?></p>
                                </div>
                                <div class="card-body text-light">
                                    <p>Carrera: <?php echo $students->carrera; ?></p>
                                    <p>Status: <?php echo $students->status; ?></p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <hr>
                                        </hr>
                                        <div class="btn-group">
                                            <a href="folders\pages\delete.php?id=<?php echo $students->id; ?>" class="btn btn-sm btn-outline-secondary text-light">Borrar</a>
                                            <a href="folders\pages\edit.php?id=<?php echo $students->id; ?>" class="btn btn-sm btn-outline-secondary text-light">Editar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php endforeach; ?>

                <?php endif; ?>

            </div>
        </div>
    </div>

</main>

<?php

$layout->printFooter();

?>