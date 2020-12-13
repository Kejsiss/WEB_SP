<?php
///////////////////////////////////////////////////////
////////////// Zakladni nastaveni webu ////////////////
///////////////////////////////////////////////////////

////// nastaveni pristupu k databazi ///////

    // prihlasovaci udaje k databazi
    define("DB_SERVER","localhost"); // https://students.kiv.zcu.cz nebo ci 147.228.63.10
    define("DB_NAME","kivweb");
    define("DB_USER","root");
    define("DB_PASS","");

    // definice konkretnich nazvu tabulek
    define("TABLE_UZIVATEL","uzivatel");
    define("TABLE_PRAVO","pravo");
    define("TABLE_SJIZDI","sjizdi");
    define("TABLE_TABORI","tabori");
    define("TABLE_REKA","reka");
    define("TABLE_TABORISTE","taboriste");

//// Dostupne stranky webu ////

/** Adresar kontroleru. */
const DIRECTORY_CONTROLLERS = "app\Controllers";
/** Adresar modelu. */
const DIRECTORY_MODELS = "app\Models";
/** Adresar sablon */
const DIRECTORY_VIEWS = "app\Views";



/** Klic defaultni webove stranky. */
const DEFAULT_WEB_PAGE_KEY = "taboriste";

/** Dostupne webove stranky. */
const WEB_PAGES = array(
    //// Uvodni stranka ////
    "reky" => array(
        "title" => "Řeky",

        //// kontroler
        "file_name" => "RiversController.class.php",
        "class_name" => "RiversController",
    ),
    "taboriste" => array(
        "title" => "Tábořiště",

        //// kontroler
        "file_name" => "CampsController.class.php",
        "class_name" => "CampsController",
    ),
    "recenze" => array(
        "title" => "Recenze",

        //// kontroler
        "file_name" => "ReviewsController.class.php",
        "class_name" => "ReviewsController",
    ),
    //// KONEC: Uvodni stranka ////

);

?>
