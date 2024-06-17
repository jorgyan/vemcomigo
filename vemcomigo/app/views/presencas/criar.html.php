<!-- Exibe o Grafico de Presenças x Ausências -->
<div class="col-10 login-container border-simple h-100">

    <!-- indica onde o usuário está na tela --> 
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">REGISTRAR PRESENÇA NA AULA</li>
        </ol>
    </nav> 

        <table class="table table-striped table-bordered">
            
            <thead class="thead-dark">
                <tr>
                    <th>Presente</th>
                    <th>Ausente</th>    
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Data</th>
                </tr>
            </thead>
            <tbody>
                <form method="POST" action="/presencas/salvar">

                    <?php 

                    $quantidade_alunos = count($alunos);

                    for($i = 0; $quantidade_alunos > $i; $i++)
                    {
                        ?>

                        <!-- Cria varios hidden cada um com um id dentro de um array presenças-->
                        <input type="hidden" name="presencas[<?php echo $i?>][aluno_id]" value="<?php echo $alunos[$i]['id']?>">

                        <tr>
                            <td>
                                <input type="radio" class="form-control form-control-sm" name="presencas[<?php echo $i?>][presente]" value=1>
                            </td>
                            <td>
                                <input type="radio" class="form-control form-control-sm" name="presencas[<?php echo $i?>][presente]" value=0 checked>
                            </td>
                            <td><?php echo $alunos[$i]['nome']?></td>   
                            <td><?php echo $alunos[$i]['email']?></td>               
                            <td><input type="date" class="form-control" name="presencas[<?php echo $i?>][data]" value="<?php echo date('Y-m-d');?>"></td>
                        </tr>    
                        <?php
                    }
                    ?>
                    
            </tbody>
        </table>

            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>                

</div>
