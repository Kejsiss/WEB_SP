<?php
///////////////////////////////////////////////////////////////////
////////////// Stranka pro registraci uzivatele ////////////////
///////////////////////////////////////////////////////////////////

    // nacteni souboru s funkcemi
    require_once("MyDatabase.class.php");
    $myDB = new MyDatabase();

    // nacteni hlavicky stranky
    require_once("ZakladHTML.class.php");
    ZakladHTML::createHeader("Registrace nového uživatele");

    // zpracovani odeslanych formularu
    if(isset($_POST['potvrzeni'])){
        // mam vsechny pozadovane hodnoty?
        if(isset($_POST['login']) && isset($_POST['heslo'])
            && isset($_POST['usrn']) && isset($_POST['surn']) && isset($_POST['mail']) && isset($_POST['pravo'])
            && $_POST['login'] != "" && $_POST['heslo'] != "" && $_POST['usrn'] != "" && $_POST['surn'] != "" && $_POST['mail'] != ""
            && $_POST['pravo'] > 0
        ){
            // pozn.: heslo by melo byt sifrovano
            // napr. password_hash($password, PASSWORD_BCRYPT) pro sifrovani
            // a password_verify($password, $hash) pro kontrolu hesla.

            // mam vsechny atributy - ulozim uzivatele do DB
            $res = $myDB->addNewUser($_POST['login'], $_POST['heslo'], $_POST['usrn'], $_POST['surn'], $_POST['mail'], $_POST['pravo']);
            // byl ulozen?
            if($res){
                echo "<div class='alert alert-success'>
                        <strong>Úspěch!</strong> Vaše registrace proběhla v pořádku, nyní se můžete přihlásit.
                    </div>";
            } else {
                echo "<div class='alert alert-danger'>
                      <strong>Neúspěch</strong> Nastala chyba při ukládání uživatele do databáze.
                    </div>";
            }
        } else {
            // nemam vsechny atributy
            echo "<div class='alert alert-warning'>
                      <strong>Chybné zadání</strong> Nebyly přijaty požadované atributy uživatele.
                    </div>";
        }
        echo "<br><br>";
    }
    
    ///////////// PRO NEPRIHLASENE UZIVATELE ///////////////
    if(!$myDB->isUserLogged()){
?>
        <div class="container" id="inputTab text-center">
            <h4 class="text-center">Zaregistruj se aby si mohl využít všechny naše služby!</h4><br>
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
                    <div class="form-group">
                        <label for="usr" class="col-sm-3"><sup>*</sup>Jméno:&nbsp</label>
                        <input type="text" class="form-control col-sm-9" id="usr" name="usrn">
                    </div><br>
                    <div class="form-group">
                        <label for="sur" class="col-sm-3"><sup>*</sup>Přijmení:&nbsp</label>
                        <input type="text" class="form-control col-sm-9" id="sur" name="surn">
                    </div><br>
                    <div class="form-group">
                        <label for="email" class="col-sm-3"><sup>*</sup>Email:&nbsp</label>
                        <input type="email" class="form-control col-sm-9" id="email" name="mail">
                    </div><br>
                    <div class="form-group">
                        <label for="role" class="col-sm-3">Role:&nbsp</label>
                        <select name="pravo" id="role">
                            <?php
                            // ziskam vsechna prava
                            $rights = $myDB->getAllRights();
                            // projdu je a vypisu
                            foreach($rights as $r){
                                echo "<option value='$r[id_PRAVO]'>$r[nazev]</option>";
                            }
                            ?>
                        </select>
                    </div><br>
                    <p>Všechna pole označená symbolem <sup>*</sup> jsou povinná</p><br>
                    <div id="center_button">
                        <input type="submit" name="potvrzeni" value="Registrovat">
                    </div>
                </div>
            </form>
        </div>
        <br>
<?php
    ///////////// KONEC: PRO NEPRIHLASENE UZIVATELE ///////////////
    } else {
    ///////////// PRO PRIHLASENE UZIVATELE ///////////////
?>
        <div>
            <b>Přihlášený uživatel se nemůže znovu registrovat.</b>
        </div>
<?php
    }
    ///////////// KONEC: PRO PRIHLASENE UZIVATELE ///////////////

    // paticka
    ZakladHTML::createFooter();

?>

