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
const DEFAULT_WEB_PAGE_KEY = "domov";

/** Dostupne webove stranky. */
const WEB_PAGES = array(

    "domov" => array(
        "title" => "Domů",

        //// kontroler
        "file_name" => "HomeController.class.php",
        "class_name" => "HomeController",
    ),
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

    "login" => array(
        "title" => "Přihlášení",

        //// kontroler
        "file_name" => "LoginController.class.php",
        "class_name" => "LoginController",
    ),
    "register" => array(
        "title" => "Registrace",

        //// kontroler
        "file_name" => "RegisterController.class.php",
        "class_name" => "RegisterController",
    ),
    "recenzeRek" => array(
        "title" => "Recenze řek",

        //// kontroler
        "file_name" => "ReviewsRiversController.class.php",
        "class_name" => "ReviewsRiversController",
    ),
    "recenzeKempu" => array(
        "title" => "Recenze kempů",

        //// kontroler
        "file_name" => "ReviewsCampsController.class.php",
        "class_name" => "ReviewsCampsController",
    ),
    "sprava" => array(
        "title" => "Správa",

        //// kontroler
        "file_name" => "ManagementController.class.php",
        "class_name" => "ManagementController",
    ),
);

?>
