<?php
///////////////////////////////////////////////////////////////////////////
/////////// Sablona pro zobrazeni stranky s urcenim spravce  //////////////
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

if(isset($tplData['makeManager'])){
    echo "<div class='alert alert-info'>$tplData[makeManager]</div>";
}

if($tplData['isUserLogged']){
    //SEKCE PRO PRIHLASENE UZIVATELE
    ?>
    <div class="container" id="inputTab text-center">
        <h4 class="text-center">Zde můžeš určovat správce!</h4><br>
        <form method="POST" action="" class="form-inline justify-content-center" role="form">
            <div>
                <div class="form-group">
                    <label for="role" class="col-sm-6">Vodáci:&nbsp</label>
                    <select name="paddlers" id="vodaci">
                        <?php
                        foreach($tplData['paddlers'] as $p){
                            echo "<option value='$p[id_UZIVATEL]'>$p[username]</option>";
                        }
                        ?>
                    </select>
                </div><br>
                <div style="text-align:center;">
                    <button type='submit' name='action' value='makeManager' class="btn" style="background-color: #236AB9; color: #D4E4F7">Přidat Správce</button>
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
$tplHeaders->getHTMLFooterManagement();

?>