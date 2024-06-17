<?php

// responvel por registrar as presenças
class PresencasController extends Application
{
	// metodo executado primeiro, verifica se o usuário está logado, se não estiver
	function first_()
	{
		if(CONTROLLER_NAME != "administradores" and ACTION_NAME != "login")
		{
			if($_COOKIE['logged'] == false)
				go("/administradores/login");
		}
	}
	
	
    // Exibe um formulario para marcar as presenças dos alunos
    function criar()
    {
        $this->alunos = db_find_by_sql("SELECT * FROM alunos ORDER BY aluno_desde DESC");
    }
    
    

    // Exibe um formulario para marcar as presenças dos alunos
    function salvar()
    {
        db_sql($this->gera_sql_salvar_varios($_POST['presencas']));
        go("/administradores/relatorio_presenca");
    }

    private function gera_sql_salvar_varios($presencas)
    {
        // Criando o comando INSERT
        $sql = "INSERT INTO presencas (aluno_id, presente, data) VALUES ";

        $values = array();
        foreach ($presencas as $presenca) {
            $aluno_id = $presenca["aluno_id"];
            $presente = $presenca["presente"];
            $data = $presenca["data"];

            $values[] = "('$aluno_id', '$presente', '$data')";
        }

        $sql .= implode(", ", $values) . ";";

        // Exibindo o comando SQL
        return nl2br($sql);
    }
}

?>