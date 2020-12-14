<?php
// nactu rozhrani kontroleru
require_once(DIRECTORY_CONTROLLERS."/IController.interface.php");

class LoginController implements IController
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


        // zpracovani odeslanych formularu
        if(isset($_POST['action'])){
            // prihlaseni
            if($_POST['action'] == 'login' && isset($_POST['login']) && isset($_POST['heslo'])){
                // pokusim se prihlasit uzivatele
                /*$res = $myDB->userLogin($_POST['login'], $_POST['heslo']);
                if($res){
                    echo "OK: Uživatel byl přihlášen.";
                } else {
                    echo "ERROR: Přihlášení uživatele se nezdařilo.";
                }*/
            }
            // odhlaseni
            else if($_POST['action'] == 'logout'){
                // odhlasim uzivatele
                /*$myDB->userLogout();
                echo "OK: Uživatel byl odhlášen.";*/
            }
            // neznama akce
            else {
                echo "WARNING: Neznámá akce.";
            }
            echo "<br>";
        }


        //// vypsani prislusne sablony
        // zapnu output buffer pro odchyceni vypisu sablony
        ob_start();
        // pripojim sablonu, cimz ji i vykonam
        require(DIRECTORY_VIEWS ."/LoginTemplate.tpl.php");
        // ziskam obsah output bufferu, tj. vypsanou sablonu
        $obsah = ob_get_clean();

        // vratim sablonu naplnenou daty
        return $obsah;
    }
}