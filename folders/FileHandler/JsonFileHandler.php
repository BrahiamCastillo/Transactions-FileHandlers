<?php

require_once '../FileHandlerInterface/IJasonHandler.php';

class JsonFileHandler implements IHandlerFile{
    public $directory;
    public $transactionList;

    function __construct($directory = "data", $transactionList)
    {
        $this->directory = $directory;
        $this->transactionList = $transactionList;
    }

    function ReadList() {

    }

    function WriteList() {

    }

    function EditList($id) {

    }

    function DeleteList($id) {
        
    }

}

?>