<?php 

interface IHandlerFile {

    function ReadList();
    function WriteList();
    function EditList($id);
    function DeleteList($id);
}

?>