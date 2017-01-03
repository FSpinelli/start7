<?php
/**
 * As configurações básicas do WordPress
 *
 * O script de criação wp-config.php usa esse arquivo durante a instalação.
 * Você não precisa user o site, você pode copiar este arquivo
 * para "wp-config.php" e preencher os valores.
 *
 * Este arquivo contém as seguintes configurações:
 *
 * * Configurações do MySQL
 * * Chaves secretas
 * * Prefixo do banco de dados
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/pt-br:Editando_wp-config.php
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar estas informações
// com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define('DB_NAME', 'u210876001_s7');

/** Usuário do banco de dados MySQL */
define('DB_USER', 'u210876001_s7');

/** Senha do banco de dados MySQL */
define('DB_PASSWORD', 'Fks007700@');

/** Nome do host do MySQL */
define('DB_HOST', 'mysql.hostinger.com.br');

/** Charset do banco de dados a ser usado na criação das tabelas. */
define('DB_CHARSET', 'utf8mb4');

/** O tipo de Collate do banco de dados. Não altere isso se tiver dúvidas. */
define('DB_COLLATE', '');

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las
 * usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org
 * secret-key service}
 * Você pode alterá-las a qualquer momento para desvalidar quaisquer
 * cookies existentes. Isto irá forçar todos os
 * usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'Bc{L*#A?[_cOG)4/%Xxmy&r/xENT^(7Q)vJULs-MFv(PbFJ;bsnJlGe059Kv-?<J');
define('SECURE_AUTH_KEY',  '<-/;|gh=`=kzhcPsqJ{GZF!q;%:wqZ|U{9;7Vkewt~TpqR9.o7Jk6e;4tm5#+XU]');
define('LOGGED_IN_KEY',    '`-n+dVEImNd`ujEU4gEHkw/GY=Xai.&.&WB~FsGob$0i_2Q30Rha,#KyC) >bVb?');
define('NONCE_KEY',        '*S2A2rMWF|,Q0!.E`S<}$aS+/{0p!Y%{q7s%D(BO2 X*%G.N@gG8?DFsHqotEXKg');
define('AUTH_SALT',        '2[STDhHiJ2d]1%WYw<Mdp0!as3&nQ1tei4Xd#,Ks`p!yy<~W9jMeDT7d!mp8.@8t');
define('SECURE_AUTH_SALT', '?Co-QKl+^;EjyW+UO`s$k+<]DCT?Lj)FS[ZB}JAsSF|aBv>b5JD$X8*!-:$qJ-+_');
define('LOGGED_IN_SALT',   'y~RY idK7=V0#~lv!gL^HS&aZ;/Z1: XmIOw@TZ0KDe3H;IJ4,n`U_`4f^AaP4d.');
define('NONCE_SALT',       'juC(HJ4,}C#j@{HONhJSo/fELw6F]U,FWP!zYxxT;7~j<oB8|(zK@F_Q4~m+ddND');

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der
 * para cada um um único prefixo. Somente números, letras e sublinhados!
 */
$table_prefix  = 'wp_';

/**
 * Para desenvolvedores: Modo debugging WordPress.
 *
 * Altere isto para true para ativar a exibição de avisos
 * durante o desenvolvimento. É altamente recomendável que os
 * desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 *
 * Para informações sobre outras constantes que podem ser utilizadas
 * para depuração, visite o Codex.
 *
 * @link https://codex.wordpress.org/pt-br:Depura%C3%A7%C3%A3o_no_WordPress
 */
define('WP_DEBUG', false);

/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Configura as variáveis e arquivos do WordPress. */
require_once(ABSPATH . 'wp-settings.php');
