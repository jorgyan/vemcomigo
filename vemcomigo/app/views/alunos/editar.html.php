
<!-- Exibe o Grafico de Presenças x Ausências -->
<div class="col-10 login-container border-simple h-100">
    
    <!-- indica onde o usuário está na tela --> 
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">EDITAR ALUNO</li>
        </ol>
    </nav> 

    <form action="/alunos/atualizar" method="POST">

        <input type="hidden" name="id" value="<?php echo $aluno[0]["id"]?>">
      
        <div class="row g-3 align-items-center">
            <div class="col-auto">
                <label for="inputNome" class="col-form-label">Nome Completo</label>
                <input type="text" id="inputNome" class="form-control" name="nome" value="<?php echo $aluno[0]["nome"]?>">
            </div>  
        </div>

        <br>

        <div class="row g-3 align-items-center">
            <div class="col-auto">
                <label for="inputEmail" class="col-form-label">Email</label>
                <input type="email" id="inputEmail" class="form-control" name="email" value="<?php echo $aluno[0]["email"]?>">
            </div>  
        </div>

        <br>

        <div class="row g-3 align-items-center">
            <div class="col-auto">
                <label for="inputTelefone" class="col-form-label">Telefone</label>
                <input type="text" id="inputTelefone" class="form-control" name="telefone" value="<?php echo $aluno[0]["telefone"]?>">
            </div>  
        </div>

        <br>
 
        <div class="row g-3 align-items-center">
            <div class="col-auto">
                <label for="inputAlunoDesde" class="col-form-label">Aluno desde</label>
                <input type="date" id="inputAlunoDesde" class="form-control" name="aluno_desde" value="<?php echo $aluno[0]["aluno_desde"]?>">
            </div>  
        </div>

        <br>

        <button type="submit" class="btn btn-primary">Atualizar</button>

    </form>

</div>
