<div class="container">
    
    <form action="" method="post">
    
        <?= $form->input('label','Nom du produit');?>
        <?= $form->input('price','Prix du produit');?>
        <?= $form->input('quantity','Quantité en stock');?>
        <?= $form->input('threshold','Seuil');?>
        <?= $form->input('imagePath','Image');?>
        <?= $form->submit('Sauvegarder','primary');?>
        
    </form>

</div>