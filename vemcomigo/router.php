<?php
date_default_timezone_set('America/Sao_Paulo');

function pr($var)
{
	print_r($var);
	exit;
}

function vd($var)
{
	var_dump($var);
	exit;
}

function is_method($method)
{
	if ($_SERVER['REQUEST_METHOD'] === $method)
	{	
		return true;
	}
	else{
		return false;
	}
}

function post_is_not_blank()
{
	if (isset($_POST) && !empty($_POST))
		return true;
}

function get_is_not_blank()
{
	if (isset($_GET) && !empty($_GET))
		return true;
}

function iso_to_utf8($texto) 
{
	$saida = '';

	$i = 0;
	$len = strlen($texto);
	while ($i < $len) {
		$char = $texto[$i++];
		$ord  = ord($char);

	// Primeiro byte 0xxxxxxx: simbolo ascii possui 1 byte
	if (($ord & 0x80) == 0x00) {

		// Se e' um caractere de controle
		if (($ord >= 0 && $ord <= 31) || $ord == 127) {

			// Incluir se for: tab, retorno de carro ou quebra de linha
			if ($ord == 9 || $ord == 10 || $ord == 13) {
				$saida .= $char;
			}

		// Simbolo ASCII
		} else {
			$saida .= $char;
		}
		// Primeiro byte 110xxxxx ou 1110xxxx ou 11110xxx: simbolo possui 2, 3 ou 4 bytes
		} else {

			// Determinar quantidade de bytes analisando os bits da esquerda para direita
			$bytes = 0;
			for ($b = 7; $b >= 0; $b--) {
				$bit = $ord & (1 << $b);
				if ($bit) {
					$bytes += 1;
				} else {
					break;
				}
			}

			switch ($bytes) {
			case 2: // 110xxxxx 10xxxxxx
			case 3: // 1110xxxx 10xxxxxx 10xxxxxx
			case 4: // 11110xxx 10xxxxxx 10xxxxxx 10xxxxxx
				$valido = true;
				$saida_padrao = $char;
				$i_inicial = $i;
				for ($b = 1; $b < $bytes; $b++) {
					if (!isset($texto[$i])) {
						$valido = false;
						break;
					}
					$char_extra = $texto[$i++];
					$ord_extra  = ord($char_extra);

					if (($ord_extra & 0xC0) == 0x80) {
						$saida_padrao .= $char_extra;
					} else {
						$valido = false;
						break;
					}
				}
				if ($valido) {
					$saida .= $saida_padrao;
				} else {
					$saida .= ($ord < 0x7F || $ord > 0x9F) ? utf8_encode($char) : '';
					$i = $i_inicial;
				}
				break;
			case 1:  // 10xxxxxx: ISO-8859-1
			default: // 11111xxx: ISO-8859-1
				$saida .= ($ord < 0x7F || $ord > 0x9F) ? utf8_encode($char) : '';
				break;
			}
		}
	}
	return $saida;
}

// Mostra erro 404
function error_404()
{
	if(file_exists($_SERVER['DOCUMENT_ROOT'].'/'.APP_FOLDER.'/app/views/layouts/404.html.php')){
		require($_SERVER['DOCUMENT_ROOT'].'/'.APP_FOLDER.'/app/views/layouts/404.html.php');
		exit;
	}
	header('HTTP/1.0 404 Not Found');
	exit;
}

// Exibe uma pagina html
function render($path)
{
	$path = (strstr($path, '/')) ? $path : '/'.CONTROLLER_NAME.'/'.$path;
	require_once($_SERVER['DOCUMENT_ROOT']."/".APP_FOLDER."/app/views$path.html.php");
}

// Carrega função auxiliar da view ou controller
function load_helper($path)
{
	$path = (strstr($path, '/')) ? $path : '/'.CONTROLLER_NAME.'/'.$path;
	require_once($_SERVER['DOCUMENT_ROOT']."/".APP_FOLDER."/app/helpers$path");
}

// Carrega função auxiliar de terceiros
function load_plugin($script)
{
	require_once($_SERVER['DOCUMENT_ROOT']."/".APP_FOLDER."/plugins$script");
}

// Redireciona
function go($address, $msg=false)
{
	if($msg)
	{
		setcookie("alert", $msg, time() + 3600, "/");
	}
	
	$address = (strstr($address, '/')) ? $address : '/'.CONTROLLER_NAME.'/'.$address;
	header("location:$address");
}

function alert()
{	
	if(@$_COOKIE['alert'])
		print '<div class="alert"><button type="button" class="close" data-dismiss="alert">×</button><strong>Atenção!</strong> '.$_COOKIE['alert'].'</div>';

	setcookie("alert", "", time() - 3600);
}

// Gera uma tabela html
function create_table($data)
{
	$names_cols=(array)$data[0];
	if(array_key_exists('id', $names_cols))
	{
		unset($names_cols['id']);	
	}
	$names_cols=array_keys($names_cols);
	print "\n<table class='table table-striped table-hover'>\n<tr>";
	foreach($names_cols as $name_col)
	{
		print "\n\t<th>".ucwords(str_replace('_', ' ', $name_col))."</th>";
	}
	print "\n</tr>";

	for ($i=0; $i<count($data); $i++)
	{
		print "\n<tr>";
		foreach ($names_cols as $name_col)
		{
			if($name_col=='data')
				print "\n\t<td>".date_en_to_br($data[$i]->$name_col)."</td>";
			else
				print "\n\t<td>".$data[$i]->$name_col."</td>";
		}
		print "\n</tr>";
	}
	print "\n<table>";
}

// Gera uma tabela html
function create_table2($data, $header)
{
	$names_cols=(array)$data[0];
	if(array_key_exists('id', $names_cols))
	{
		unset($names_cols['id']);	
	}
	unset($names_cols[$header]);
	$names_cols=array_keys($names_cols);
	for ($count=0; $count<count($data); $count++)
	{
		if($header=='data')
			print '<div class="panel panel-default"><div class="panel-heading">'.date_en_to_br($data[$count]->$header).'</div>';
		else
			print '<div class="panel panel-default"><div class="panel-heading">'.ucfirst($data[$count]->$header).'</div>';
		print "\n<table class='table table-hover table-bordered'>\n<tr>";
		foreach ($names_cols as $name_col)
		{
			print "\n\t<tr><td>".ucwords(str_replace('_', ' ', $name_col)).': '.$data[$count]->$name_col."</td></tr>";
		}
		print "\n<table>";
		print '</div></div>';
	}
}

// Transforma a data o formato americano para brasileiro
function date_en_to_br($date)
{
	$data = explode('-', $date);
	return "$data[2]/$data[1]/$data[0]";
}

// Transforma a data o formato brasileiro para americano
function date_br_to_en($date)
{
	$data = explode('/', $date);
	return "$data[2]-$data[1]-$data[0]";
}

// Faz uma requisição post
function http_post($urlForm, $urlFinal, array $data)
{
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $urlForm);
	curl_setopt ($ch, CURLOPT_POST, 1);
	curl_setopt ($ch, CURLOPT_POSTFIELDS, http_build_query($data));
	curl_setopt ($ch, CURLOPT_SESSIONJAR, 'cookie.txt');
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
	$store  =  curl_exec ($ch);
	curl_setopt($ch, CURLOPT_URL, $urlFinal);
	$content  =  curl_exec ($ch);
	curl_close ($ch);
	return $content;
}

// Funções de banco de dados

// Conecta ao banco de dados
function db_connect()
{
	$mysqli = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_NAME);
	
	if($mysqli->connect_error or $mysqli->connect_errno)
	{
	    exit('Erro ao conectar ('.$mysqli->connect_errno.' )'.$mysqli->connect_error);
	}
	else{
	    $mysqli->set_charset('utf8');
	    return $mysqli;	    
	}
}

function db_find_by_sql($condicao)
{
	$mysqli = db_connect();
	
	if($meta_dados = $mysqli->query($condicao))
	{
		while($resultado[] = $meta_dados->fetch_assoc()){}
		$mysqli->close();
		array_pop($resultado); # Exclui o ultimo elemento vazio
		return $resultado;
	}
	else{
		exit("Erro de SQL: <b>$condicao</b> na linha".__LINE__);
	}
}

function db_sql($condicao)
{
	$mysqli = db_connect();
	$meta_dados = $mysqli->query($condicao);

	if($meta_dados === true)
	{
		$mysqli->close();
		return true;
	}else{
		exit("Erro de SQL: <b>$condicao</b> na linha".__LINE__);
	}
}

function db_find($condicao=' 1=1')
{
	return db_find_by_sql('SELECT * FROM '.CONTROLLER_NAME.' WHERE '.$condicao);
}


function create_form($path, $name_table='', $ignore_fields=[], $data=[])
{
	$name_table = ($name_table)?$name_table:CONTROLLER_NAME;
	$path= (strstr($path, '/'))?$path:'/'.CONTROLLER_NAME.'/'.$path;
	$table = db_find_by_sql('DESCRIBE '.$name_table);

	print "<form action='".$path."' method='post' id='form_".$name_table."'>"."\n";
	
	foreach ($table as $t) 
	{
		if($t["Key"] != 'PRI')
		{
			$field = $t["Field"];
			$value = ($data) ? ' value="'.$data["$field"].'"':'';
			$label = ucwords(str_replace('_', ' ', $t["Field"]));
			print '<div class="control-group">';
			// Testa se é numero
			
			if((substr($t["Type"], 0, 3)=='int' or substr($t["Type"], 0, 5)=='float' or substr($t["Type"], 0, 6) == 'double') and !in_array($t["Field"], $ignore_fields))
			{
				print '<label class="control-label" for="input'.$t["Field"].'">'.$label.'</label>';
				print '<div class="controls"><input '.$value.' type="number" id="input'.$t["Field"].'" name="'.$t["Field"].'" placeholder="'.$label.'" ></div>';
			}
			else if(substr($t["Type"], 0, 7) == 'varchar' and !in_array($t["Field"], $ignore_fields)){
				$type= ($t["Field"] == 'senha' or $t["Field"] == 'password') ? 'password' : 'text';
				print '<label class="control-label" for="input'.$t["Field"].'">'.$label.'</label>';
				print '<div class="controls"><input '.$value.' type="'.$type.'" id="input'.$t["Field"].'" name="'.$t["Field"].'" placeholder="'.$label.'"></div>';
			}
			else if(substr($t["Type"], 0, 4)=='date' and !in_array($t["Field"], $ignore_fields)){
				print '<label class="control-label" for="input'.$t["Field"].'">'.$label.'</label>';
				print '<div class="controls"><input '.$value.' type="date" id="input'.$t["Field"].'" name="'.$t["Field"].'" placeholder="'.$label.'"></div>';
			}
			else if (substr($t["Type"], 0, 4) == 'enum' and !in_array($t["Field"], $ignore_fields)){
				$values = $t["Type"];
				$values = str_replace("enum(", '', $values);
				$values = str_replace(")", '', $values);
				$values = explode(',', $values);
				$values = array_map(function($value) { return str_replace("'", '', $value); }, $values);
				
				print '<label class="control-label" for="select'.$t["Field"].'">'.$label.'</label><div class="controls">';
				
				print '<select id="select'.$t["Field"].'"  name="'.$t["Field"].'">';
				print '<option value="">escolha</option>';
				foreach ($values as $key => $val)
				{
					print '<option value="'.$val.'">'.$val."</option>\n";
				}
				print '</select></div>'."\n";
			}
			else if(substr($t["Type"], 0, 4)=='text' and !in_array($t["Field"], $ignore_fields)){
				print '<label class="control-label" for="select'.$t["Field"].'">'.$label.'</label><div class="controls">';
				$value = ($data) ? $data[$field] : '';
				print '<textarea rows="8" id="textarea'.$t["Field"].'" name="'.$t["Field"].'">'.$value.'</textarea></div>'."\n";
			}
			else if(substr($t["Type"], 0, 7)=='tinyint' and !in_array($t["Field"], $ignore_fields)){
				print '<label class="control-label" for="select'.$t["Field"].'">'.$label.'?</label><div class="controls">';
				print '<input type="radio"  value=1 id="inputSim" name="'.$t["Field"].'"> Sim ';
				print '<input type="radio"  value=0 id="inputNao" name="'.$t["Field"].'"> Não</div>';
			}

			print '</div>';

		}
		else if($data) {
			print "<input type='hidden' name='".$t["Field"]."' value='".$data["id"]."'>";
		}
	}
	print '<div class="control-group"><div class="controls"><button type="submit" class="btn">Enviar</button></div></div></form>';
}

function db_save($tabela, $dados)
{
	$tabela = ($tabela) ? $tabela : CONTROLLER_NAME;
	$mysqli = db_connect();
	$dados = (is_object($dados))?(array)$dados:$dados;
	$atributos = array_keys($dados);
	
	// medida de segurança
	$atributos = array_map('addslashes', $atributos);
	$valores = array_values($dados);
	
	// medida de segurança
	$valores = array_map('addslashes', $valores);

	$sql_atributos = implode(',', $atributos);
	$sql_valores = implode("','", $valores);

	if($mysqli->query("INSERT INTO $tabela ($sql_atributos) VALUES('$sql_valores')"))
	{
		$linhasCriadas = $mysqli->affected_rows;
		$mysqli->close();
		return $linhasCriadas;
	}
	else{
		exit("Erro: INSERT INTO $tabela ($sql_atributos) VALUES('$sql_valores')");
	}
}

function db_update($tabela, $novos_dados, $condicao = 'WHERE 1=1')
{
	$novos_dados = (is_object($novos_dados))?(array)$novos_dados:$novos_dados;
	$sql_atributos = '';
	foreach($novos_dados as $atributo  => $valor)
		$sql_atributos.= "$atributo='$valor',";
	
	$mysqli = db_connect();
	
	if($mysqli->query("UPDATE $tabela SET ".substr($sql_atributos, 0, -1)." WHERE $condicao"))
	{
		$linhas_atualizadas = $mysqli->affected_rows;
		$mysqli->close();
		return $linhas_atualizadas;
	}else{
		exit("Erro de sql: UPDATE $tabela SET ".substr($sql_atributos, 0, -1)." WHERE $condicao");
	}
}

// deleta um registro da tabela do banco de dados
function db_delete($tabela, $condicao = 'WHERE 1 = 1')
{
	$mysqli = db_connect();

	if($mysqli->query("DELETE FROM $tabela WHERE $condicao"))
	{
		$linhas_excluidas = $mysqli->affected_rows;
		$mysqli->close();
		return $linhas_excluidas;
	}
	else{
		exit("Erro de SQL: DELETE FROM $tabela WHERE $condicao");
	}
}


class Application
{
	public function __set($var, $value)
	{
		$GLOBALS[$var] = $value;
	}
	// metodo sera executado primeiro
	public function first_(){}
}

# Inicio do roteamento

// Obtem o nome da pasta que está o site
define('APP_FOLDER', str_replace('router.php', '', str_replace('/', '', $_SERVER['PHP_SELF'])));

// Arquivo com as configurações do site
require($_SERVER['DOCUMENT_ROOT'].'/'.APP_FOLDER.'/config.php');

// Pagina default é chamada
if(str_ireplace('?'.$_SERVER['QUERY_STRING'], '', $_SERVER['REQUEST_URI']) == '/') 
{
	define('CONTROLLER_NAME', CONTROLLER_DEFAULT);
	define('ACTION_NAME', ACTION_DEFAULT);
}else{
	$_controller_action = explode('/', str_ireplace('?'.$_SERVER['QUERY_STRING'], '', $_SERVER['REQUEST_URI']));
	define('CONTROLLER_NAME', strtolower($_controller_action[1]));
	if(count($_controller_action) == 2 or (count($_controller_action) == 3 and $_controller_action[2] == ''))
		define('ACTION_NAME', 'index');
	else
		define('ACTION_NAME', strtolower($_controller_action[2]));
}

// Não permite que os dados sejam exibidos
ob_start();

// Obtem o endereço do controller e executa
define('ASSETS_PATH', $_SERVER['DOCUMENT_ROOT'].'/'.APP_FOLDER.'/app/assets');
define('CONTROLLER_PATH', $_SERVER['DOCUMENT_ROOT'].'/'.APP_FOLDER.'/app/controllers/'.CONTROLLER_NAME.'controller.php');


//define a localização raiz do CSS
define('CSS_PATH', APP_FOLDER.'/app/assets/css');

//define a localização raiz do js
define('JS_PATH', APP_FOLDER.'/app/assets/js');

//define a localização raiz do js
define('IMG_PATH', APP_FOLDER.'/app/assets/images');


if(file_exists(CONTROLLER_PATH))
if(file_exists(CONTROLLER_PATH))
{
	require(CONTROLLER_PATH);
	if(class_exists(CONTROLLER_NAME.'Controller'))
	{
		$_name_controller=CONTROLLER_NAME.'Controller';
		$_class_controller = new $_name_controller;
		
		$_name_action = ACTION_NAME;
		if(method_exists($_class_controller, $_name_action))
		{
			/*if(isset($_POST))
			{
				$_POST=array_map('addslashes', $_POST);
				$_POST=array_map('strip_tags', $_POST);
			}
			if(isset($_GET))
			{
				$_GET=array_map('addslashes', $_GET);
				$_GET=array_map('strip_tags', $_GET);
			}*/

			$_class_controller->first_();
			$_class_controller->$_name_action();

			// Obtem o endereço da view e executa
			define('VIEW_PATH', $_SERVER['DOCUMENT_ROOT']."/".APP_FOLDER."/app/views/".CONTROLLER_NAME."/".ACTION_NAME.".html.php");
			if(file_exists(VIEW_PATH))
			{
				require(VIEW_PATH);
				// chama os respectivos arquivos css e js da pagina;
				if(file_exists($_SERVER['DOCUMENT_ROOT'].'/'.APP_FOLDER.'/app/assets/stylesheets/'.CONTROLLER_NAME.'/'.ACTION_NAME.'.css'))
				{
					print "\n<link rel = 'stylesheet' type = 'text/css' href = '/".APP_FOLDER."/app/assets/stylesheets/".CONTROLLER_NAME.'/'.ACTION_NAME.".css'>";
				}
				if(file_exists($_SERVER['DOCUMENT_ROOT'].'/'.APP_FOLDER.'/app/assets/javascripts/'.CONTROLLER_NAME."/".ACTION_NAME.".js")){
					print("\n<script type = 'text/javascript' src = '/".APP_FOLDER."/app/assets/javascripts/".CONTROLLER_NAME.'/'.ACTION_NAME.".js'></script>");
				}
			}
			
			define('HTML', ob_get_clean());
			define('TITLE_PAGE', ucwords(str_replace('_', ' ', ACTION_NAME)).' - '.ucfirst(CONTROLLER_NAME));
			
			// verifica se o programador deseja exibir um layout diferente do tradicional
			if(defined("CUSTOM_LAYOUT")){
				render('/layouts/'.CUSTOM_LAYOUT);
			}
			else{ // caso contrario exibe o layout definido no arquivo config.php
				render('/layouts/'.LAYOUT_DEFAULT);
			}
			
			exit;
		}
	}
}
ob_end_clean();
error_404();
?>