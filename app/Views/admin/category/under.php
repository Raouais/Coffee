<div class="container text-center">

    <h1><?=$title?></h1>

    <?php if($category !== 0):?>
        <a href="?p=admin.category.index&id=<?= $category->category_id ?>" class="btn btn-light">Revenir</a>
    <?php else : ?>
        <a href="?p=admin.category.index" class="btn btn-light">Revenir</a>
    <?php endif ?>

    <form action="" method="post">
    
        <?= $form->input('name','Nom de la catégorie');?>
        <?= $form->input('color','Associer une couleur');?>
        <?= $form->submit('Sauvegarder','primary');?>
        
    </form>
</div>