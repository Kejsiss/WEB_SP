<?php

require_once ("ChangeRiverAJAX.class.php");


    $result = $_POST['uzivatel'];


    $r = new ChangeRiverAJAX();

    $result = $r->getSjizdi($_POST['reka'], $_POST['uzivatel']);

    echo $result;

