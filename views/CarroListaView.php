
<div class="main-content my-5">
    <!-- Lista de Carros -->
    <div class="container">
        <div class="row">
            <?php foreach ($cars as $car): ?>
                <div class="col-md-2 col-sm-6 my-2">
                    <div class="card">
                        <!-- Imagem ou Vídeo -->
                        <?php if (in_array(pathinfo($car['imagem'], PATHINFO_EXTENSION), array('mp4', 'avi', 'mov'))): ?>
                            <video class="card-img-top" controls>
                                <source src="<?php echo $car['imagem']; ?>" type="video/mp4">
                                Seu navegador não suporta o vídeo.
                            </video>
                        <?php else: ?>
                            <img src="<?php echo $car['imagem']; ?>" class="card-img-top" alt="Imagem do carro">
                        <?php endif; ?>
                        <div class="card-body">
                            <h6 class="card-title"><?php echo htmlspecialchars($car['modelo']); ?></h5>

                            <p><?php echo htmlspecialchars($car['loja']) ?></p>
                            
                            <a href='<?php echo htmlspecialchars($car['contato']); ?>' class="btn btn-primary w-100 my-2">Mais Informações</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

