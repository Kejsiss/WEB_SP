<?php
///////////////////////////////////////////////////////////////////////////
/////////// Sablona pro zobrazeni stranky s prihlasenim uzivatele  ////////
///////////////////////////////////////////////////////////////////////////
// urceni globalnich promennych, se kterymi sablona pracuje
global $tplData;



// pripojim objekt pro vypis hlavicky a paticky HTML
require(DIRECTORY_VIEWS ."/ZakladHTML.class.php");
$tplHeaders = new ZakladHTML();

?>
    <!-- ------------------------------------------------------------------------------------------------------- -->

    <!-- Vypis obsahu sablony -->
<?php
// muze se hodit:
//<form method='post'>
//    <input type='hidden' name='id_user' value=''>
//    <button type='submit' name='action' value='delete'>Smazat</button>
//</form>

// hlavicka
$tplHeaders->getHTMLHeader($tplData['title']);

if(isset($tplData['logIn'])){
    echo "<div class='alert alert-info'>$tplData[logIn]</div>";
}

if(!$tplData['isUserLogged']){
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
                <div style="text-align:center;">
                    <button type='submit' name='action' value='logIn' class="btn" style="background-color: #236AB9; color: #D4E4F7">Přihlásit se</button>
                </div>
            </div>
        </form>
        <br>
        <h5 class="text-center">Nemáš ještě účet? Vytvoř si nový <a href="index.php?page=register" style="color: #236AB9">zde!</a>   </h5>
    </div>
    <br>
    <?php

}

// paticka
$tplHeaders->getHTMLFooter();

?>