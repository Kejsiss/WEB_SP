<?php
// nactu rozhrani kontroleru
require_once(DIRECTORY_CONTROLLERS."/IController.interface.php");

/**
 * Kontroller obstarava registraci uzivatele
 * @author Kment
 * Class RegisterController
 */
class RegisterController implements IController
{

    /** @var DatabaseModel $db  Sprava databaze. */
    private $um;

    /**
     * Inicializace pripojeni k databazi.
     */
    public function __construct() {
        // inicializace prace s DB
        require_once (DIRECTORY_MODELS ."/UserModel.class.php");
        $this->um = new UserModel();
    }

    /**
     * Vrati obsah stranky
     * @param string $pageTitle     Nazev stranky.
     * @return string               Vypis v sablone.
     */
    public function show(string $pageTitle):string {
        //// vsechna data sablony budou globalni
        global $tplData;
        $tplData = [];
        // nazev
        $tplData['title'] = $pageTitle;


        if(isset($_POST['action']) and $_POST['action'] == "addUser" and isset($_POST['login']) && isset($_POST['heslo'])
            && isset($_POST['usrn']) && isset($_POST['surn']) && isset($_POST['mail'])
            && $_POST['login'] != "" && $_POST['heslo'] != "" && $_POST['usrn'] != "" && $_POST['surn'] != "" && $_POST['mail'] != ""
        ){

            // provedu smazani uzivatele
            $ok = $this->um->addUser($_POST['login'],$_POST['heslo'],$_POST['usrn'],$_POST['surn'],$_POST['mail'],3);
            if($ok == 0){
                $tplData['addUser'] = "OK: Uživatel $_POST[login] byl přidán do databáze.";
            } else if($ok == 1) {
                $tplData['addUser'] = "CHYBA: Uživatele $_POST[login] se nepodařilo přidat do databáze.";
            }
            else{
                $tplData['addUser'] = "CHYBA: Uživatel s loginem $_POST[login] již existuje.";
            }
        }

        //// vypsani prislusne sablony
        // zapnu output buffer pro odchyceni vypisu sablony
        ob_start();
        // pripojim sablonu, cimz ji i vykonam
        require(DIRECTORY_VIEWS ."/RegisterTemplate.tpl.php");
        // ziskam obsah output bufferu, tj. vypsanou sablonu
        $obsah = ob_get_clean();

        // vratim sablonu naplnenou daty
        return $obsah;
    }
}