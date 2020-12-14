<?php
///////////////////////////////////////////////////////////////////////////
/////////// Sablona pro zobrazeni stranky se spravou uzivatelu  ///////////
///////////////////////////////////////////////////////////////////////////

//// pozn.: sablona je samostatna a provadi primy vypis do vystupu:
// -> lze testovat bez zbytku aplikace.
// -> pri vyuziti Twigu se sablona obejde bez PHP.

//// vypis sablony
// urceni globalnich promennych, se kterymi sablona pracuje
global $tplData;



// pripojim objekt pro vypis hlavicky a paticky HTML
require(DIRECTORY_VIEWS ."/ZakladHTML.class.php");
$tplHeaders = new ZakladHTML();

?>
    <!-- ------------------------------------------------------------------------------------------------------- -->

    <!-- Vypis obsahu sablony -->
<?php

// hlavicka
$tplHeaders->getHTMLHeader($tplData['title']);

if(isset($tplData['addUser'])){
    echo "<div class='alert alert-info'>$tplData[addUser]</div>";
}

///////////// PRO NEPRIHLASENE UZIVATELE ///////////////
/*if(!$myDB->isUserLogged()){*/
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
                        // projdu je a vypisu
                        foreach($tplData['rights'] as $r){
                            echo "<option value='$r[id_PRAVO]'>$r[nazev]</option>";
                        }
                        ?>
                    </select>
                </div><br>
                <p>Všechna pole označená symbolem <sup>*</sup> jsou povinná</p><br>
                <div style="text-align:center;">
                    <button type='submit' name='action' value='addUser' class="btn" style="background-color: #236AB9; color: #D4E4F7">Registrovat</button>
                </div>
            </div>
        </form>
    </div>
    <br>
    <?php
    ///////////// KONEC: PRO NEPRIHLASENE UZIVATELE ///////////////
/*} else {
///////////// PRO PRIHLASENE UZIVATELE ///////////////
?>
<div>
    <b>Přihlášený uživatel se nemůže znovu registrovat.</b>
</div>

<?php
    }*/
// paticka
$tplHeaders->getHTMLFooter();

?>