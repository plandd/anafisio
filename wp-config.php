<?php
/** 
 * As configurações básicas do WordPress.
 *
 * Esse arquivo contém as seguintes configurações: configurações de MySQL, Prefixo de Tabelas,
 * Chaves secretas, Idioma do WordPress, e ABSPATH. Você pode encontrar mais informações
 * visitando {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. Você pode obter as configurações de MySQL de seu servidor de hospedagem.
 *
 * Esse arquivo é usado pelo script ed criação wp-config.php durante a
 * instalação. Você não precisa usar o site, você pode apenas salvar esse arquivo
 * como "wp-config.php" e preencher os valores.
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar essas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define('DB_NAME', 'plandd_anafisio');

/** Usuário do banco de dados MySQL */
define('DB_USER', 'thiago');

/** Senha do banco de dados MySQL */
define('DB_PASSWORD', 'thiago');

/** nome do host do MySQL */
define('DB_HOST', 'localhost');

/** Conjunto de caracteres do banco de dados a ser usado na criação das tabelas. */
define('DB_CHARSET', 'utf8mb4');

/** O tipo de collate do banco de dados. Não altere isso se tiver dúvidas. */
define('DB_COLLATE', '');

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * Você pode alterá-las a qualquer momento para desvalidar quaisquer cookies existentes. Isto irá forçar todos os usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'n~4wC?VbGeyU6& TgJ%6n`[)~$F!;7RfoT{y7rtR^+k -]/gR<#]E(LcQ%6P|u{-');
define('SECURE_AUTH_KEY',  ':tH{,|>`wPVCB:wZpQ-E]i>A)wGJG6+(r8gD,PN+ty?2|S 0dne4N!dR:Kc*3j@q');
define('LOGGED_IN_KEY',    'd*H{DZ-^o+CgOd [^bJ U)N{`P_tIi`_7-#rp|}C|^sZ<C[xBO>>?55vRrYZ.d3Q');
define('NONCE_KEY',        '+d-x2P>YdCs+JK2tiTpj/+z|0%t|hSsg:kN582K_sKnW-js<sOx|e;*l9iH_OKMZ');
define('AUTH_SALT',        ' $~ErDq+M1T1.v% M2+#I;NnFWU QtJKPS5_MKnGY9??[<H#AxG721g[[N*GOXA|');
define('SECURE_AUTH_SALT', '~W2%3O:K{moda)WOM@c`-(|9(yGvew 5EkNdT6zSuV%(-9WX02B@_!BHD=PsiWrF');
define('LOGGED_IN_SALT',   '@g/.20N-j[RWuPpHdrxQg3ko126SMonFuv9.Flh#^eC)G;?d7+HS/MzT59v_i4{7');
define('NONCE_SALT',       '/v?IiU0TFk& {nqAz }Y2GBe+2;eM0m+a;Z70>t4nCGslDw0YD*/aZwtJ]#gKl(y');

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der para cada um um único
 * prefixo. Somente números, letras e sublinhados!
 */
$table_prefix  = 'wp_';


/**
 * Para desenvolvedores: Modo debugging WordPress.
 *
 * altere isto para true para ativar a exibição de avisos durante o desenvolvimento.
 * é altamente recomendável que os desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 */
define('WP_DEBUG', false);

/* Isto é tudo, pode parar de editar! :) */
define('WP_SITEURL', 'http://' . $_SERVER['HTTP_HOST'] . '/newsite');
define('WP_HOME', 'http://' . $_SERVER['HTTP_HOST'] . '/newsite');

/** Caminho absoluto para o diretório WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
	
/** Configura as variáveis do WordPress e arquivos inclusos. */
require_once(ABSPATH . 'wp-settings.php');
