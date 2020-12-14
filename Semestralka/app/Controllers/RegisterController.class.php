<?php
// nactu rozhrani kontroleru
require_once(DIRECTORY_CONTROLLERS."/IController.interface.php");

class RegisterController implements IController
{

    /** @var DatabaseModel $db  Sprava databaze. */
    private $db;

    /**
     * Inicializace pripojeni k databazi.
     */
    public function __construct() {
        // inicializace prace s DB
        require_once (DIRECTORY_MODELS ."/DatabaseModel.class.php");
        $this->db = new DatabaseModel();
    }

    /**
     * Vrati obsah stranky se seznamem rek
     * @param string $pageTitle     Nazev stranky.
     * @return string               Vypis v sablone.
     */
    public function show(string $pageTitle):string {
        //// vsechna data sablony budou globalni
        global $tplData;
        $tplData = [];
        // nazev
        $tplData['title'] = $pageTitle;

        $tplData['rights'] = $this->db->getAllRights();

        if(isset($_POST['action']) and $_POST['action'] == "addUser" and isset($_POST['login']) && isset($_POST['heslo'])
            && isset($_POST['usrn']) && isset($_POST['surn']) && isset($_POST['mail']) && isset($_POST['pravo'])
            && $_POST['login'] != "" && $_POST['heslo'] != "" && $_POST['usrn'] != "" && $_POST['surn'] != "" && $_POST['mail'] != ""
            && $_POST['pravo'] > 0
        ){

            // provedu smazani uzivatele
            $ok = $this->db->addUser($_POST['login'],$_POST['heslo'],$_POST['usrn'],$_POST['surn'],$_POST['mail'],$_POST['pravo']);
            if($ok){
                $tplData['addUser'] = "OK: Uživatel $_POST[login] byl přidán do databáze.";
            } else {
                $tplData['addUser'] = "CHYBA: Uživatele $_POST[login] se nepodařilo přidat do databáze.";
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