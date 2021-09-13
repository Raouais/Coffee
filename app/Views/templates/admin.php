<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title><?= App::getInstance()->title; ?></title>


    <!-- Bootstrap core CSS -->
    <link href="sass/style.css" rel="stylesheet">

</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="?p=admin.config.index">Coffee Bar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="?p=admin.config.index">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?p=admin.product.index">Commandes</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Administration
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="?p=admin.product.index">Produits</a></li>
                            <li><a class="dropdown-item" href="?p=admin.menu.index">Menus</a></li>
                            <li><a class="dropdown-item" href="?p=admin.category.index">Catégories</a></li>
                            <li><a class="dropdown-item" href="?p=admin.user.index">Utilisateurs</a></li>
                            <li><a class="dropdown-item" href="?p=admin.room.index">Salles</a></li>
                            <li><a class="dropdown-item" href="?p=admin.interface.index">Interfaces</a></li>
                            <li><a class="dropdown-item" href="?p=admin.dish.index">Plats</a></li>

                        </ul>
                    </li>
                </ul>
                <!-- <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form> -->
                <div class="d-flex">
                    <a class="nav-link" href="?p=admin.config.logout">Déconnecter</a>
                </div>
            </div>
        </div>
    </nav>
    <div class="container">
        <?= $content; ?>
    </div>

    </main>

    <script src="assets/dist/js/bootstrap.bundle.min.js"></script>

    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script> -->

    <!-- <script src="assets/sidebars.js"></script> -->
</body>

</html>