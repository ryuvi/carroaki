<div class="col-md-2 mx-auto d-none d-md-block">
    <h5>Patrocinadores</h5>
    <div class="cards">
    <?php foreach($sponsors as $sponsor): ?>
        <div class="card m-2" style="width: 10rem;">
            <a href="<?php echo $sponsor->link; ?>">
                <img src="<?php echo $sponsor->imagem; ?>" alt="<?php echo $sponsor->nome; ?>" class="card-img-top">
            </a>
        </div>
    <?php endforeach; ?>
    </div>
</div>