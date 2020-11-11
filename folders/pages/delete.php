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

$serviceStudent = new FileTransaction("..\FileHandler\data");

$isContainId = isset($_GET['id']);

if($isContainId) {

    $studentID = $_GET['id'];
    $serviceStudent->Delete($studentID);

}

header("location: ../../index.php");
exit();

?>