<?php

// Classe responsável por autenticar o administrador e gerenciar o estúdio
class AdministradoresController extends Application
{
	// Primeira view, exibe a tela de login de administração
	function login()
	{
		if(isset($_COOKIE['logged']) and $_COOKIE['logged'] == true)
			go("/administradores/relatorio_presenca");
		else{
			// define o cookie como não logado
			setcookie("logged", false, time() + 86400, "/");

			// Exibe layout diferente do default, pois somente esta tela tem 
			define("CUSTOM_LAYOUT", "administradores/login");	
		}
	}

	// Tela principal de administração, por padrão mostra as visitas mensais x ausências mensais de alunos cadastrados
	function relatorio_presenca()
	{

		$sql = <<<'EOT'
		SELECT
			YEAR(data) AS ano,
			DATE_FORMAT(data, '%M') AS mes,
			SUM(presente = 1) AS presencas,
			SUM(presente = 0) AS ausencias
		FROM
			presencas
		GROUP BY
			YEAR(data),
			MONTH(data)
		ORDER BY
			YEAR(data),
			MONTH(data);
		EOT;

		$visitas_mensais = db_find_by_sql($sql);
		
		$visitas_mensais = $this->traduzir_meses($visitas_mensais);

		// Converter os dados para JSON
		$this->meses_json = json_encode($visitas_mensais["meses"]);
		$this->presencas_json = json_encode($visitas_mensais["presencas"]);
		$this->ausencias_json = json_encode($visitas_mensais["ausencias"]);			
	}

	// Verifica o email e senha do administrador do sistema estão corretos
	function autenticar()
	{
		if(is_method("POST") and post_is_not_blank())
		{		
			$administrador = db_find_by_sql("SELECT id, email, senha FROM administradores WHERE email='".$_POST['email']."' AND senha='".$_POST['senha']."'");

			// verifica se o administrador foi encontrado no banco de dados
			if(!empty($administrador))
			{
				setcookie("logged", true, time() + 86400, "/");
				go("/administradores/relatorio_presenca");
			}
			else{
				go("/administradores/login");
			}

		}
		else{
			go("/administradores/login");
		}
	}

	// Sai do sistema e volta para tela de login
	function sair()
	{
		setcookie('logged', '', time() - 3600, '/');
		go("/administradores/login");
	}
	

	// metodo executado primeiro, verifica se o usuário está logado, se não estiver
	function first_()
	{
		if(ACTION_NAME != "login")
		{
			if($_COOKIE['logged'] == false)
				go("/administradores/login");
		}
	}


	function traduzir_meses($visitas_mensais)
	{

		$month_translation = [
			"January" => "Janeiro",
			"February" => "Fevereiro",
			"March" => "Março",
			"April" => "Abril",
			"May" => "Maio",
			"June" => "Junho",
			"July" => "Julho",
			"August" => "Agosto",
			"September" => "Setembro",
			"October" => "Outubro",
			"November" => "Novembro",
			"December" => "Dezembro"
		];

		$result = [
			"meses" => [],
			"presencas" => [],
			"ausencias" => []
		];

		foreach ($visitas_mensais as $record) {
			$mes_ingles = $record["mes"];
			$mes_portugues = isset($month_translation[$mes_ingles]) ? $month_translation[$mes_ingles] : $mes_ingles;
			
			$result["meses"][] = $mes_portugues;
			$result["presencas"][] = (int) $record["presencas"];
			$result["ausencias"][] = (int) $record["ausencias"];
		}

		return $result;

	}

}
?>