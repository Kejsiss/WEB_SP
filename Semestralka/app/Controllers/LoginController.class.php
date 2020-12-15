<?php
// nactu rozhrani kontroleru
require_once(DIRECTORY_CONTROLLERS."/IController.interface.php");

class LoginController implements IController
{

    /** @var DatabaseModel $db  Sprava databaze. */
    private $um;

    /**
     * Inicializace pripojeni k databazi.
     */
    public function __construct() {
        // inicializace prace s DB
        //require_once (DIRECTORY_MODELS ."/DatabaseModel.class.php");
        require_once (DIRECTORY_MODELS ."/UserModel.class.php");
        require_once("MySessions.class.php");
        $this->um= new UserModel();
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

        if(MySessions::sessionExists('current_user_id')){
            $this->um->userLogout();
            header("LOCATION:http://localhost/dashboard/phpZkouska/WEB_SP/Semestralka/index.php?page=domov");
        }

        $tplData['isUserLogged'] = $this->um->isUserLogged();


        // zpracovani odeslanych formularu
        if(isset($_POST['action'])){
            // prihlaseni
            if($_POST['action'] == 'logIn' && isset($_POST['login']) && isset($_POST['heslo'])){
                //pokusim se prihlasit uzivatele
                $res = $this->um->userLogin($_POST['login'], $_POST['heslo']);
                if($res){
                    header("LOCATION:http://localhost/dashboard/phpZkouska/WEB_SP/Semestralka/index.php?page=domov");

                } else {
                    $tplData['logIn'] = "CHYBA: Uživatele $_POST[login] se nepodařilo přihlásit.";
                }
            }
            // neznama akce
            else {
                echo "WARNING: Neznámá akce.";
            }
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