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



/** Adresar kontroleru. */
const DIRECTORY_CONTROLLERS = "app\Controllers";
/** Adresar modelu. */
const DIRECTORY_MODELS = "app\Models";
/** Adresar sablon */
const DIRECTORY_VIEWS = "app\Views";

//// Dostupne stranky webu ////

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
    "vytvoritRecenziReky" => array(
        "title" => "Tvorba recenze řeky",

        //// kontroler
        "file_name" => "MakeReviewRiverController.class.php",
        "class_name" => "MakeReviewRiverController",
    ),
    "vytvoritRecenziKempu" => array(
        "title" => "Tvorba recenze kempu",

        //// kontroler
        "file_name" => "MakeReviewCampController.class.php",
        "class_name" => "MakeReviewCampController",
    ),
    "recenzeList" => array(
        "title" => "Seznam recenzí",

        //// kontroler
        "file_name" => "ReviewListController.class.php",
        "class_name" => "ReviewListController",
    ),
    "vytvoritReku" => array(
        "title" => "Přidání řeky",

        //// kontroler
        "file_name" => "MakeRiverController.class.php",
        "class_name" => "MakeRiverController",
    ),
    "vytvoritKemp" => array(
        "title" => "Přidání kempu",

        //// kontroler
        "file_name" => "MakeCampController.class.php",
        "class_name" => "MakeCampController",
    ),
    "urcitSpravce" => array(
        "title" => "Určení správce",

        //// kontroler
        "file_name" => "MakeManagerController.class.php",
        "class_name" => "MakeManagerController",
    ),
    "spravaUzivatelu" => array(
        "title" => "Správa uživatelů",

        //// kontroler
        "file_name" => "UserManagementController.class.php",
        "class_name" => "UserManagementController",
    ),
    "spravaRecenzi" => array(
        "title" => "Správa uživatelských recenzí",

        //// kontroler
        "file_name" => "UserReviewsManagementController.class.php",
        "class_name" => "UserReviewsManagementController",
    ),
    "recenzeUzivatel" => array(
        "title" => "Recenze uživatele",

        //// kontroler
        "file_name" => "UsersReviewsController.class.php",
        "class_name" => "UsersReviewsController",
    ),
);

?>
