<!-- Filtro de Carros -->
<div class="container filters my-3">
    <form method="get">
        <div class="row">
            <!-- Filtro por Ano -->
            <div class="col-md-4 my-sm-0 my-2">
                <input type="number" name="ano" class="form-control" placeholder="Ano" value="<?php echo htmlspecialchars($anoFiltro); ?>">
            </div>

            <!-- Filtro por Loja -->
            <div class="col-md-4 my-sm-0 my-2">
                <input type="text" name="loja" class="form-control" placeholder="Loja" value="<?php echo htmlspecialchars($lojaFiltro); ?>">
            </div>

            <!-- Botão de Filtrar -->
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary w-100">Filtrar</button>
            </div>
        </div>
    </form>
</div>