<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vodácka Stránka</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <style>
        body{
            background-color: #D4E4F7;
        }
        header{
            background-color: #236AB9;
            margin-bottom:0;
        }
        nav{
            background-color: #341C09;
            margin-bottom: 2%;
        }
        footer{
            background-color: #341C09;
            position: relative;
            right: 0;
            bottom: 0;
            left: 0;
        }
        h1{
            color: #341C09;
            font-weight: bold;
        }
        a{
            color:  #FC7307;
            font-size: 20px;
        }
        a:hover{
            color: #D4E4F7;
        }
        i{
            color: #236AB9;
            font-size: 20px;
        }
        .navbar-toggler{
            background-color:#FC7307;
        }
        #inputTab{
            margin-bottom: 2%;
            font-weight: bold;
            padding-top: 30px;
        }
        #center_button {
            width: 25%;
            margin: 0 auto;
        }
        #btnOdeslat{
            background-color: #341C09;
            color: #FC7307;
        }
        @media only screen and (min-width:768px) {
            footer{
                background-color: #341C09;
                margin-bottom: 0;
                padding-bottom: 0;
                margin-top: 100%;
            }
        }
    </style>

</head>
<body>
<header class="jumbotron text-center" style="background-color:#236AB9; margin-bottom:0" >
    <h1 class="display-2">Půjčovna lodí a vodáckých služeb</h1>
    <h2 style="color:#341C09;">Připoj se k nám a poznej pravé dobrodružství!</h2>
</header>
<nav class="navbar navbar-expand-sm navbar-inverse">
    <div class="container">
        <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon">
                    <i class="fas fa-bars" style="color:#D4E4F7; font-size:28px;"></i>
                </span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="index.html"><i class='fas fa-home'></i>  Domů</a></li>
                <li class="nav-item"><a class="nav-link" href="aboutUS.html"><i class='fas fa-map-signs'></i>   O nás</a></li>
                <li class="nav-item"><a class="nav-link" href="boats.html"><i class='fas fa-caravan'></i>   Půjčovny</a></li>
                <li class="nav-item"><a class="nav-link" href="camps.html"><i class='fas fa-campground'></i>    Tabořiště</a></li>
                <li class="nav-item"><a class="nav-link" href="camps.html"><i class='fas fa-water'></i>    Řeky</a></li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="logIn.php"><i class='fas fa-user-circle'></i>    Přihlášení</a></li>
                <li class="nav-item"><a class="nav-link" href="register.php"><i class='fas fa-user'></i>    Zaregistrovat</a></li>

            </ul>
        </div>
    </div>
</nav>
<div class="container" id="inputTab text-center">
    <h4 class="text-center">Zaregistruj se aby si mohl využít všechny naše služby!</h4><br>
    <form method="get" class="form-inline justify-content-center" role="form">
        <div>
            <div class="form-group">
                <label for="usr" class="col-sm-3"><sup>*</sup>Jméno:</label>
                <input type="text" class="form-control col-sm-9" id="usr">
            </div><br>
            <div class="form-group">
                <label for="surn" class="col-sm-3"><sup>*</sup>Přijmení:&nbsp</label>
                <input type="text" class="form-control col-sm-9" id="surn">
            </div><br>
            <div class="form-group">
                <label for="email" class="col-sm-3"><sup>*</sup>Email:&nbsp</label>
                <input type="email" class="form-control col-sm-9" id="email">
            </div><br>
            <div class="form-group">
                <label for="tel" class="col-sm-3">Telefon:&nbsp</label>
                <input type="tel" class="form-control col-sm-9" id="tel">
            </div><br>
            <p>Všechna pole označená symbolem <sup>*</sup> jsou povinná</p><br>
            <div id="center_button">
                <button type="submit" name="btnOdeslat" class="btn btn-lg" id="btnOdeslat">Odeslat</button>
            </div>
        </div>
    </form>
</div>
<br>
<footer class="py-1 mt-1 text-center font-weight-bold">
    <h5 style="color: #FC7307; padding-top: 1%; padding-bottom: 1%"> &copy;Tomáš Kment 2020</h5>
</footer>
</body>

<!-- ------------- JavaScripty ------------- -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

</html>