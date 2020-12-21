<?php
///////////////////////////////////////////////////////////////////////////
/////////// Sablona pro zobrazeni stranky s vytvarenim rek   //////////////
///////////////////////////////////////////////////////////////////////////

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

if(isset($tplData['addRiver'])){
    echo "<div class='alert alert-info'>$tplData[addRiver]</div>";
}

if($tplData['isUserLogged']){
    //SEKCE PRO PRIHLASENE UZIVATELE
    ?>
    <div class="container" id="inputTab text-center">
        <h4 class="text-center">Zde můžeš přidat řeku do databáze!</h4><br>
        <form method="POST" action="" class="form-inline justify-content-center" role="form">
            <div>
                <div class="form-group">
                    <label for="river">Název řeky:&nbsp</label>
                    <input type="text" class="form-control col-sm-12" id="river" name="river">
                </div><br>
                <div class="form-group">
                    <label for="length">Délka řeky:&nbsp</label>
                    <input type="number" class="form-control col-sm-12" id="length" name="distance">
                </div><br>
                <div class="form-group">
                    <label for="numberOfWeir">Počet jezů:&nbsp</label>
                    <input type="number" class="form-control col-sm-12" id="numberOfWeir" name="weir">
                </div><br>
                <div style="text-align:center;">
                    <button type='submit' name='action' value='addRiver' class="btn" style="background-color: #236AB9; color: #D4E4F7">Přidat řeku</button>
                </div>
            </div>
        </form>
    </div>
    <br>
    <?php
}else {
    //SEKCE PRO NEPRIHLASENE UZIVATELE
    ?>
    <h1 class="text-center">Tato sekce je pouze pro přihlášené uživatele</h1>
    <?php
}

// paticka
$tplHeaders->getHTMLFooter();

?>