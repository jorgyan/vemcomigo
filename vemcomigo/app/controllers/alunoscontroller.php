<?php

// Classe responavel por exibir todos os luanos e permitir editar e excluir um aluno
class AlunosController extends Application
{
    // mostra uma tabela com todos os alunos
    function todos()
    {
        $this->alunos = db_find_by_sql("SELECT * FROM alunos ORDER BY aluno_desde DESC");   
    }

    // Exibe o formulario de edição
    function editar()
    {
        $this->aluno = db_find_by_sql("SELECT * FROM alunos WHERE id=".$_GET['id']);   
    }


	// metodo executado primeiro, verifica se o usuário está logado, se não estiver
	function first_()
	{
		if(CONTROLLER_NAME != "administradores" and ACTION_NAME != "login")
		{
			if($_COOKIE['logged'] == false)
				go("/administradores/login");
		}
	}

    // atualiza o aluno
    function atualizar()
    {
        db_update("alunos", $_POST, "id=".$_POST['id']);
        go("/alunos/todos");
    }

    // exclui o aluno
    function excluir()
    {
        // primeiro apago todos os registros de presenca deste aluno, senão o banco não vai permitir apagar o aluno
        db_delete("presencas", "aluno_id=".$_GET['id']);
        
        // em seguida apago o aluno
        db_delete("alunos", "id=".$_GET['id']);
        go("/alunos/todos");
    }

    // Exibe um formulario para cadastrar novo aluno
    function novo()
    {
        
    }

    // salva o aluno
    function salvar()
    {
        db_save("alunos", $_POST);
        go("/alunos/todos");
    }

}
?>