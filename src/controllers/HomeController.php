<?php

require_once("Controller.php");

class HomeController extends Controller {
    function Index(){
        parent::View("AQUI VAI O TEXTO");
    }

    function Contato(){
        parent::View("Contato");
    }
}
?>