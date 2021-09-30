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
                            <li><a class="dropdown-item" href="?p=admin.dish.index">Plats</a></li>
                            <li><a class="dropdown-item" href="?p=admin.category.index">Catégories</a></li>
                            <li><a class="dropdown-item" href="?p=admin.interface.index">Interfaces</a></li>
                            <li><a class="dropdown-item" href="?p=admin.room.index">Salles</a></li>
                            <li><a class="dropdown-item" href="?p=admin.user.index">Utilisateurs</a></li>
                            <!-- <li><a class="dropdown-item" href="?p=admin.role.index">Rôle</a></li> -->

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