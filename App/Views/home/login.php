<div class="login-container">
    <h6 class="error">
        <?php echo isset($content['message']) ? 'Error: '.$content['message'] : ''; ?>
    </h6>
    <form action="<?php echo URL . 'home/login'; ?>" method="post">
        <div class="input-group">
            <label for="username">Usuario</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div class="input-group">
            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit">Entrar</button>
    </form>
</div>