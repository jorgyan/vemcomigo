
<!-- Exibe o Grafico de Presenças x Ausências -->
<div class="col-10 login-container border-simple h-100">
    
    <!-- indica onde o usuário está na tela --> 
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">TODOS ALUNOS</li>
        </ol>
    </nav> 

        <table class="table table-striped table-bordered">
            
            <thead class="thead-dark">
                <tr>
                    <th>Nome</th>
                    <th>Aluno desde</th>
                    <th>Telefone</th>
                    <th>Email</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php 

                $quantidade_alunos = count($alunos);

                for($i = 0; $quantidade_alunos > $i; $i++)
                {
                    ?>
                    <tr>
                        <td><?php echo $alunos[$i]['nome']?></td>
                        <td><?php echo date_en_to_br($alunos[$i]['aluno_desde'])?></td>
                        <td><?php echo $alunos[$i]['telefone']?></td>
                        <td><?php echo $alunos[$i]['email']?></td>
                        <td>
                            <a href="/alunos/editar?id=<?php echo $alunos[$i]['id']?>" class="btn btn-warning btn-sm">Editar</a>
                            <a href="/alunos/excluir?id=<?php echo $alunos[$i]['id']?>" class="linkExcluir btn btn-danger btn-sm">Excluir</a>
                        </td>
                    </tr>    
                    <?php
                }
                ?>
                
            </tbody>
        </table>
    <script src="/<?php echo JS_PATH;?>/alunos/todos.js"></script>
</div>
