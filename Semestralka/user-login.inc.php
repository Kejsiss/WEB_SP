<?php
///////////////////////////////////////////////////////////////////
////////////// Stranka pro prihlaseni/odhlaseni uzivatele ////////////////
///////////////////////////////////////////////////////////////////

    // nacteni souboru s funkcemi
    require_once("MyDatabase.class.php");
    $myDB = new MyDatabase();

    // nacteni hlavicky stranky
    require_once("ZakladHTML.class.php");
    ZakladHTML::createHeader("Přihlášení a odhlášení uživatele");

    // zpracovani odeslanych formularu
    if(isset($_POST['action'])){
        // prihlaseni
        if($_POST['action'] == 'login' && isset($_POST['login']) && isset($_POST['heslo'])){
            // pokusim se prihlasit uzivatele
            $res = $myDB->userLogin($_POST['login'], $_POST['heslo']);
            if($res){
                echo "OK: Uživatel byl přihlášen.";
            } else {
                echo "ERROR: Přihlášení uživatele se nezdařilo.";
            }
        }
        // odhlaseni
        else if($_POST['action'] == 'logout'){
            // odhlasim uzivatele
            $myDB->userLogout();
            echo "OK: Uživatel byl odhlášen.";
        }
        // neznama akce
        else {
            echo "WARNING: Neznámá akce.";
        }
        echo "<br>";
    }

    // pokud je uzivatel prihlasen, tak ziskam jeho data
    if($myDB->isUserLogged()){
        // ziskam data prihlasenoho uzivatele
        $user = $myDB->getLoggedUserData();
    }

    ///////////// PRO NEPRIHLASENE UZIVATELE ///////////////
    // pokud uzivatel neni prihlasen nebo nebyla ziskana jeho data, tak vypisu prihlasovaci formular
    if(!$myDB->isUserLogged()){
?>
        <div class="container" id="inputTab text-center">
            <h4 class="text-center">Zde se můžeš přihlásit!</h4><br>
            <form method="POST" action="" class="form-inline justify-content-center" role="form">
                <div>
                    <div class="form-group">
                        <label for="log" class="col-sm-3"><sup>*</sup>Login:&nbsp</label>
                        <input type="text" class="form-control col-sm-9" id="log" name="login">
                    </div><br>
                    <div class="form-group">
                        <label for="pass" class="col-sm-3"><sup>*</sup>Heslo:&nbsp</label>
                        <input type="password" class="form-control col-sm-9" id="pass" name="heslo">
                    </div><br>
                    <div id="center_button">
                        <input type="hidden" name="action" value="login">
                        <input type="submit" name="potvrzeni" value="Přihlásit">
                    </div>
                </div>
            </form>
            <br>
            <h5 class="text-center">Nemáš ještě účet? Vytvoř si nový <a href="index.php?page=registrace" style="hover">zde!</a>   </h5>
        </div>
        <br>
<?php
    ///////////// KONEC: PRO NEPRIHLASENE UZIVATELE ///////////////

    } else {

    ///////////// PRO PRIHLASENE UZIVATELE /////////////
        // ziskam nazev prava uzivatele, abych ho mohl vypsat
        $pravo = $myDB->getRightById($user["id_pravo"]);
        // ziskam nazev
        $pravoNazev = ($pravo == null) ? "*Neznámé*" : $pravo['nazev'];

?>
        <h2>Přihlášený uživatel</h2>

        Login: <?php echo $user['username'] ; ?><br>
        Jméno: <?php echo $user['jmeno'] ; ?><br>
        Přijmení: <?php echo $user['prijmeni'] ; ?><br>
        E-mail: <?php echo $user['email'] ; ?><br>
        Právo: <?php echo $pravoNazev ; ?><br>
        <br>

        Odhlášení uživatele:
        <form action="" method="POST">
            <input type="hidden" name="action" value="logout">
            <input type="submit" name="potvrzeni" value="Odhlásit">
        </form>
<?php
    }
    ///////////// KONEC: PRO PRIHLASENE UZIVATELE ///////////////

    // paticka
    ZakladHTML::createFooter();
?>
