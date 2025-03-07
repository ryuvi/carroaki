<?php
require_once 'components/head.php';
renderHead('Carro Aki | Carro');
require_once 'components/navbar.php';
?>


<div class="container d-flex">
    <div class="carousel slide mr-auto mt-2" style="width: 25rem; margin-left: .5rem !important;" data-bs-ride="carousel" id="carouselCarros">

        <div class="carousel-inner">
        <?php foreach($imagens as $index => $image): ?>
            <?php if ($index === 0): ?>
                <div class="carousel-item active" style="height: 200px; width: 100%; object-fit: cover;">
                    <img src="/<?php echo $image; ?>" alt="..." class="d-block w-100">
                </div>
            <?php else: ?>
                <div class="carousel-item" style="height: 200px; width: 100%; object-fit: cover;">
                    <img src="/<?php echo $image; ?>" alt="..." class="d-block w-100">
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselCarros" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselCarros" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <div class="container my-auto mx-2">
        <div class="row">
            <div class="col border border-dark">
                <p class="my-auto py-2"><b>Modelo:</b> <?php echo $sCarro->nome; ?></p>
            </div>
            <div class="col border border-dark">
                <p class="my-auto py-2"><b>Preço:</b> <?php echo 'R$ ' . number_format($sCarro->preco, 2, ',', '.'); ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col border border-dark">
                <p class="my-auto py-2"><b>Ano:</b> <?php echo $sCarro->ano; ?></p>
            </div>
            <div class="col border border-dark">
                <p class="my-auto py-2"><b>Loja:</b> <?php echo $sCarro->nome_loja; ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col border border-dark">
                <p class="my-auto py-2 text-wrap"><b>Descrição:</b> <?php echo $sCarro->descricao; ?></p>
            </div>
        </div>
    </div>
</div>

<?php require_once 'components/footer.php' ?>