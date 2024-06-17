<div class="col-2 login-container align-self-start h-100">
    
    <!-- EXIBE  A LOGOMARCA-->
    <div class="text-center">
        <img src="/<?php echo IMG_PATH?>/administradores/login/logo.png" alt="Logomarca Camila Gomes Estudio" class="img-fluid">
    </div>

    <!-- FORMULARIO DE LOGIN-->
    <form class="mt-4" method="POST" action="/administradores/autenticar">
    
        <!-- EMAIL DE ACESSO-->
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        
        <!-- SENHA DE ACESSO-->
        <div class="form-group">
            <label for="password">Senha</label>
            <input type="password" class="form-control" id="password" name="senha" required>
        </div>
        
        <button type="submit" class="btn btn-primary btn-block">Entrar</button>
    
    </form>
</div>

<!-- IMAGEM DE EXIBIÇÃO DE DO ESTÚDIO TROCA ALEATORIAMENTE-->
<div class="col-10 login-container h-100">
    <img src="/<?php echo IMG_PATH?>/administradores/login/fundo<?php echo rand(1, 5)?>.jpg" alt="Lago" class="w-100 img-thumbnail rounded img-fluid">
</div>

    