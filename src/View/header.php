<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


    <?php if (isset($_SESSION['css'])) {
        echo '<link rel="stylesheet"href="styles/' . $_SESSION['css'] . '.css">';
        unset($_SESSION['css']);
    } ?>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/global.css">

    <title>
        <?php
        if (isset($_SESSION['title'])) showSessionValue('title');
        else echo "Nazwa systemu";
        ?>
    </title>
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar navbar-dark bg-dark">
            <a class="navbar-brand" href="./index.php?action=start">Start</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
                        <ul class="navbar-nav">

                            <?php

                            if (\App\Repository\UserRepository::checkIfUserIsLoggedIn()) {
                                echo '
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" class="navbardrop" data-toggle="dropdown">Kategorie</a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="index.php?action=addCategory">Dodaj kategorie</a>
                                        <a class="dropdown-item" href="index.php?action=listCategories">Lista kategorii</a>
                                    </div>
                                </li>
                                
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" class="navbardrop" data-toggle="dropdown">Produkty</a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="index.php?action=addProduct">Dodaj produkt</a>
                                        <a class="dropdown-item" href="index.php?action=listProducts">Lista produktów</a>
                                    </div>
                                </li>

                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" class="navbardrop" data-toggle="dropdown">Zakupy</a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="index.php?action=addShoppingList">Dodaj zakup</a>
                                        <a class="dropdown-item" href="index.php?action=listShoppingList">Lista zakupów (edycja)</a>
                                        <a class="dropdown-item" href="index.php?action=listShoppingListOnlyView">Lista zakupów (widok)</a>
                                    </div>
                                </li>

                                <li class="nav-item"><a class="nav-link" href="index.php?action=summary">Podsumowanie</a></li>
                                <li class="nav-item"><a class="nav-link" href="index.php?action=fullSummary">Pełne podsumowanie</a></li>
                                <li class="nav-item"><a class="nav-link" href="index.php?action=logout">Wyloguj</a></li>
                            ';
                            } else {
                                echo '<li class="nav-item"><a class="nav-link" href="index.php?action=register">Rejestracja</a></li>';
                                echo '<li class="nav-item"><a class="nav-link" href="index.php?action=login">Logowanie</a></li>';
                            }




                            ?>
                        </ul>
                    </nav>
                </ul>
            </div>
        </nav>