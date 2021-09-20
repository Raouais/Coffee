<div class="container text-center">
    

    <h1><?=$title?></h1>

    <a href="?p=admin.product.index" class="btn btn-light border-dark">Revenir</a>

    <?php if (isset($error)) : ?>
        <div class="alert alert-danger" role="alert">
            <?=$error?>
        </div>
    <?php endif ?>
    
    <form action="" method="post" enctype="multipart/form-data">
    
        <?= $form->input('label','Nom du produit');?>
        <?= $form->input('price','Prix du produit');?>
        <?= $form->input('quantity','Quantité en stock');?>
        <?= $form->input('threshold','Seuil');?>
        <label for="">Catégories</label>
            <select name="category_id" id="category" class="form-control">
                <?php foreach ($categories->allTopCategories() as $c) : ?>
                    <option class="bg-primary" value="<?= $c->id ?>" disabled> <?= $c->name ?></option>
                    <?php foreach ($categories->allTopCategories($c->id) as $u) : ?>
                        <option class="bg-info" value="<?= $u->id ?>"> <?= $u->name ?></option>
                    <?php endforeach ?>
                <?php endforeach ?>
            </select>
        <?= $form->input('image','image', ['type' => 'file']);?>
        <br>
        <?= $form->submit('Sauvegarder','primary');?>
        
    </form>

</div>