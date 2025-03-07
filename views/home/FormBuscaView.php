<!-- Filtro de Carros -->
<div class="container filters my-3">
    <form method="get">
        <div class="row">
            <!-- Filtro por Ano -->
            <div class="col-md-3 my-sm-0 my-2">
                <input type="number" name="ano" class="form-control" placeholder="Ano" value="<?php echo htmlspecialchars($anoFiltro); ?>">
            </div>

            <!-- Filtro por Loja -->
            <div class="col-md-3 my-sm-0 my-2">
                <input type="text" name="loja" class="form-control" placeholder="Loja" value="<?php echo htmlspecialchars($lojaFiltro); ?>">
            </div>

            <div class="col-md-3 my-sm-0 my-2">
                <select name="city" id="city" class="form-select">
                    <option value="">Selecione uma cidade</option>
                    <option value="São José dos Campos">São José dos Campos</option>
                    <option value="Jacareí">Jacareí</option>
                    <option value="Caçapava">Caçapava</option>
                    <option value="Taubaté">Taubaté</option>
                </select>
            </div>

            <!-- Botão de Filtrar -->
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary w-100">Filtrar</button>
            </div>
        </div>
    </form>
</div>