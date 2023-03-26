<!DOCTYPE html>
<html lang='fr-FR'>

<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css' integrity='sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65' crossorigin='anonymous'>
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js' integrity='sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V' crossorigin='anonymous'></script>
    <title><?= $title ?? "Mon pokedex PHP" ?></title>
</head>

<body>
    <header>
        <nav class='navbar navbar-expand-lg navbar-dark bg-dark'>
            <div class='container-fluid'>
                <a class='navbar-brand' href='index.php'>
                    <img src='./Assets/image/logo.png' alt='Logo pokeball' width=60></img>
                </a>
                <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
                    <span class='navbar-toggler-icon'></span>
                </button>
                <div class='collapse navbar-collapse' id='navbarSupportedContent'>
                    <ul class='navbar-nav me-auto mb-2 mb-lg-0'>
                        <li class='nav-item'>
                            <a class='nav-link active' aria-current='page' href='index.php'>Acceuil</a>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link' href='#'>Types</a>
                        </li>
                    </ul>
                    <form class='d-flex'>
                        <input class='form-control me-2' type='search' placeholder='Search' aria-label='Search'>
                        <button class='btn btn-outline-success' type='submit'>Rechercher</button>
                    </form>
                </div>
            </div>
        </nav>
    </header>