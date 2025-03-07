<?php echo $form; ?>


<div class="container">
    <div class="row">
        <?php foreach ($cars as $car): ?>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 d-flex justify-content-center my-2">
            
                    <div class="card" style="width: 250px;">
                        <!-- Carrossel de Imagens -->
                        <div id="carousel-<?php echo $car['id']; ?>" class="carousel slide" data-bs-ride="carousel" style="height: 150px; width: 100%; overflow: clip;">
                            <div class="carousel-inner">
                                <?php foreach(explode(',', $car['imagens']) as $index => $image): ?>
                                    <div class="carousel-item <?php echo ($index === 0) ? 'active' : ''; ?>">
                                        <img src="/<?php echo $image; ?>" alt="..." class="d-block w-100" style="object-fit: contain;">
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carousel-<?php echo $car['id']; ?>" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carousel-<?php echo $car['id']; ?>" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>

                        <hr class="border border-dark mx-2 mb-0">

                        <!-- Corpo do Card -->
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title mt-1"><b><?php echo htmlspecialchars($car['nome']) . ' - ' . htmlspecialchars($car['ano']); ?></b></h5>
                            <p>R$ <?php echo number_format(htmlspecialchars($car['preco']), 2, ',', '.'); ?></p>
                            <p><?php echo htmlspecialchars($car['nome_loja']) ?> - <?php echo htmlspecialchars($car['cidade']) ?></p>
                            
                            <div class="d-flex justify-content-around mt-auto">
                                <a href='/ver/carro?id=<?php echo htmlspecialchars($car['id']); ?>' class="btn btn-primary mx-2">
                                    Ver Carro
                                </a>
                                <a href="/ver/loja?id=<?php echo $car['loja_id']; ?>" class="btn btn-secondary mx-2">
                                    Ver Loja
                                </a>
                            </div>
                        </div>
                    </div>
                
                
                </div>

        <?php endforeach; ?>
    </div>
</div>