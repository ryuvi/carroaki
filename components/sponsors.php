<div class="container my-4">
    <h5 class="text-center mb-3">Nossos Patrocinadores</h5>
    <div class="row justify-content-center align-items-center text-center">
    <?php foreach($sponsors as $sponsor): ?>
        <div class="col-4 col-md-2">
            <a href="<?php echo $sponsor->link; ?>" class="img-fluid">
                <img src="<?php echo $sponsor->imagem; ?>" alt="<?php echo $sponsor->nome; ?>" style="width: 5rem;" class="border rounded">
            </a>
        </div>
    <?php endforeach; ?>
    </div>
</div>