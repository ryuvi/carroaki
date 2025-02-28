<?php if (isset($_SESSION['mensagem'])): ?>
    <div class="alert alert-<?php echo $_SESSION['tipo']; ?>"><?php echo $_SESSION['mensagem']; ?></div>
    <?php
    unset($_SESSION['tipo']);
    unset($_SESSION['mensagem']);
    ?>
<?php endif; ?>