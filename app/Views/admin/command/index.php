<div class="container text-center">
    <div class="command">
        <script src="https://cdn.socket.io/4.0.1/socket.io.js"></script>

        <div id="commands">
            <!-- Command body -->
            <div class="card card-body border border-info">
                <ul>
                    <li>Command #</li>
                    <li>Table 5</li>
                    <a class="btn btn-info">Etat</a>
                    <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">Voir</a>
                </ul>
                <div class="collapse" id="collapseExample" style="margin-top:10px;">
                    <!-- Catégories -->
                    <ul class="list-group border border-dark">
                        <li class="list-group-item d-flex justify-content-evenly align-items-center">
                            <h4>Boissons</h4>
                            <button class="btn btn-primary">Ajouter</button>
                        </li>
                        <li class="list-group-item">
                            <ul class="list-group border border-primary">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Coca Cola
                                    <div>
                                        <span>Quantité:<span class="badge alert-primary"> 15</span></span>
                                        <a class="btn btn-danger">Supprimer</a>
                                        <a class="btn btn-warning">Corriger</a>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Diekirch
                                    <div>
                                        <span>Quantité:<span class="badge alert-primary"> 10</span></span>
                                        <a class="btn btn-danger">Supprimer</a>
                                        <a class="btn btn-warning">Corriger</a>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Sprite
                                    <div>
                                        <span>Quantité:<span class="badge alert-primary"> 5</span></span>
                                        <a class="btn btn-danger">Supprimer</a>
                                        <a class="btn btn-warning">Corriger</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <div id="total">
                        <p class="text-left h6">Total</p>
                        <span class="badge alert-primary">45€</span>
                    </div>
                    <!-- Catégories -->
                </div>
            </div>
            <!-- Command body -->
        </div>
    </div>

    <script src="dist/command.js"></script>
</div>

<style>
    #total {
        display: flex;
        justify-content: space-between;
        margin: 0 25px 0 0;
    }

    #total .badge {
        order: 1;
    }

    #commands {
        margin-top: 25px;
    }

    #commands ul {
        display: flex;
        justify-content: space-between;
        list-style: none;
        margin: 0 !important;
    }
</style>