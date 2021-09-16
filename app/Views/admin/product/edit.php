<div class="container text-center">
    

    <h1><?=$title?></h1>
    
    <form action="" method="post" enctype="multipart/form-data">
    
        <?= $form->input('label','Nom du produit');?>
        <?= $form->input('price','Prix du produit');?>
        <?= $form->input('quantity','Quantité en stock');?>
        <?= $form->input('threshold','Seuil');?>
        <?= $form->input('image','image', ['type' => 'file']);?>
        <br>
        <?= $form->submit('Sauvegarder','primary');?>
        
    </form>

</div>