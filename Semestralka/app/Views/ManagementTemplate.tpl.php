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

if(isset($tplData['ReviewRiver'])){
    echo "<div class='alert alert-info'>$tplData[addUser]</div>";
}

if(isset($tplData['ReviewCamp'])){
    echo "<div class='alert alert-info'>$tplData[addUser]</div>";
}


$res = "<form method='POST' action='' class='form-inline justify-content-center' role='form'>
            <div>";

if($tplData['authorization'] <= 2)
{
    $res .= "<button type='submit' name='action' value='addRiver' class='btn' style='background-color: #236AB9; color: #D4E4F7'>Přidat řeku</button>
             <button type='submit' name='action' value='addCamp' class='btn' style='background-color: #236AB9; color: #D4E4F7'>Přidat tábořiště</button>
";

    if ($tplData['authorization'] == 1){
        $res .= "<button type='submit' name='action' value='addManager' class='btn' style='background-color: #236AB9; color: #D4E4F7'>Určit správce</button>
";
    }
}

$res .= "<button type='submit' name='action' value='ReviewRiver' class='btn' style='background-color: #236AB9; color: #D4E4F7'>Recenze řeky</button>
         <button type='submit' name='action' value='ReviewCamp' class='btn' style='background-color: #236AB9; color: #D4E4F7'>Recenze tábořiště</button>
         <button type='submit' name='action' value='ReviewList' class='btn' style='background-color: #236AB9; color: #D4E4F7'>Seznam recenzí</button>

         </div></form>";

echo $res;
// paticka
$tplHeaders->getHTMLFooter();

?>