<div class="container text-center">
    <h1>Salles</h1>

<table class="table">
    <thead>
        <tr>
            <td>ID</td>
            <td>Nom</td>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($items as $room):?>
            <tr>
                <td><?= $room->id?></td>
                <td> <a href="?p=room.show&id=<?= $room->id?>" class="btn btn-info"><?= $room->name?></a></td> 
                <!-- <td>
                    <a href="?p=admin.room.edit&id=<?= $room->id;?>" class="btn btn-primary">Editer</a>
                    <form action="?p=admin.room.delete" method="post" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $room->id;?>">
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </td> -->
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
