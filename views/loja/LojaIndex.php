<?php

require_once 'components/head.php';
renderHead('Carro Aki | Loja');
require_once 'components/navbar.php';

?>

<style>
    .jumbotron {
        text-align: center !important;
        background-image: url('<?php echo $utils->startsWith('/', $banner) ? $banner : '/'.$banner; ?>');
        background-position: center center;
        background-repeat: no-repeat;
        background-size: cover;
        height: 50dvh;
        display: flex;
        flex-direction: column;
        justify-content: center;
        color: white;
    }
</style>
<div class="jumbotron">
    <h1 class="display-4"><?php echo $nome; ?></h1>
    <p class="lead"><?php echo $biografia; ?></p>
    <p class="lead"><?php echo $cidade; ?></p>
</div>

<div class="container my-5">
    <div class="row">
        <?php foreach($carros as $carro): ?>
            <div class="col-lg-3 col-md-4 col-sm-6 col-12 d-flex justify-content-center my-2">
                <div class="card" style="width: 100%; max-width: 250px;">
                    <!-- Carrossel de Imagens -->
                    <div id="carousel-<?php echo $carro['id']; ?>" class="carousel slide" data-bs-ride="carousel" style="height: 200px; overflow: hidden;">
                        <div class="carousel-inner">
                            <?php foreach(explode(',', $carro['imagens']) as $index => $image): ?>
                                <div class="carousel-item <?php echo ($index === 0) ? 'active' : ''; ?>" style="height: 100%; width: 100%;">
                                    <img src="<?php echo $utils->startsWith('/', $image) ? $image : '/'.$image; ?>" alt="Imagem do Carro" class="d-block w-100" style="object-fit: cover; height: 100%;">
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carousel-<?php echo $carro['id']; ?>" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carousel-<?php echo $carro['id']; ?>" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>

                    <hr class="border border-dark mx-2 mb-0">

                    <!-- Corpo do Card -->
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title mt-1"><b><?php echo htmlspecialchars($carro['nome']) . ' - ' . htmlspecialchars($carro['ano']); ?></b></h5>
                        <p>R$ <?php echo number_format(htmlspecialchars($carro['preco']), 2, ',', '.'); ?></p>
                        
                        <div class="d-flex justify-content-end mt-auto">
                            <a href='/ver/carro?id=<?php echo htmlspecialchars($carro['id']); ?>' class="btn btn-primary mx-2">
                                Saiba Mais
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>



<?php require_once 'components/footer.php' ?>