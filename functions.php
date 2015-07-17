<?php
/**
 * Funções para o tema
 *
 * @package WordPress
 * @subpackage Anafisio
 * @since Anafisio 1.0
 * @author https://bitbucket.org/joaotdn/
 */

//Versão do tema (RELEASES)
define('THEME_VERSION', '1.0.1');

//Icone do tema
define('THEME_ICON', get_stylesheet_directory_uri() . '/images/icon.png');


/**
* Configure funções para campos personalizados da aplicação
*/
define( 'USE_LOCAL_ACF_CONFIGURATION', true ); // apenas conf. local

add_filter('acf/settings/path', 'plandd_acf_path');

function plandd_acf_path( $path ) {

	   // update path
	   $path = get_stylesheet_directory() . '/includes/acf/';

	   // return
	   return $path;

}

add_filter('acf/settings/dir', 'plandd_acf_dir');

function plandd_acf_dir( $dir ) {

	   // update path
	   $dir = get_stylesheet_directory_uri() . '/includes/acf/';

	   // return
	   return $dir;

}

/**
 * Framework para personalização de campos
 * (custom meta post)
 */
include_once( get_stylesheet_directory() . '/includes/acf/acf.php' );
include_once( get_stylesheet_directory() . '/includes/acf-repeater/acf-repeater.php' );
//define( 'ACF_LITE' , true );
//include_once( get_stylesheet_directory() . '/inc/acf/preconfig.php' );

/**
 * Esta função será chamada logo após a inicialização da aplicação
 *
 * @since ModaBiz 1.0
 */
function plandd_setup() {

	/**
	 * Registrar formatos de miniaturas
	 */
	add_theme_support('post-thumbnails');
    
    set_post_thumbnail_size( 242, 220, true );

    if (function_exists('add_image_size')) {
        add_image_size('estrutura', 242, 220, true);
    }

	/**
	 * Registre os menus do topo e rodapé
	 */
	register_nav_menus( array(
		'primary' => __( 'Menu principal',   'plandd' ),
    	'secondary'  => __( 'Menu institucional', 'plandd' ),
		'terciary'  => __( 'Menu tratamentos', 'plandd' ),
	) );

	// Muda o nome da classe de submenu nativa
    function change_submenu_class($menu) {
        $menu = preg_replace('/ class="sub-menu"/', '/ class="submenu" /', $menu);
        return $menu;
    }
    add_filter('wp_nav_menu', 'change_submenu_class');

	/*
		Remova widgets padrões do wordpress
	 */
	function remove_dashboard_widgets() {
		remove_meta_box('dashboard_right_now', 'dashboard', 'normal');
		remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
		remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal');
		remove_meta_box('dashboard_plugins', 'dashboard', 'normal');
		remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
		remove_meta_box('dashboard_recent_drafts', 'dashboard', 'side');
		remove_meta_box('dashboard_primary', 'dashboard', 'side');
		remove_meta_box('dashboard_secondary', 'dashboard', 'side');
		remove_meta_box('dashboard_activity', 'dashboard', 'normal');
		remove_meta_box('dashboard_welcome', 'dashboard', 'normal');
	}
	add_action('wp_dashboard_setup', 'remove_dashboard_widgets');

	//limita tamanho do resumo
	function new_excerpt_length($length) {
		return 30;
	}
	add_filter('excerpt_length', 'new_excerpt_length');
	// remove paragrafo em resumos
    remove_filter('the_excerpt', 'wpautop');

}
add_action('init','plandd_setup');

/**
 * Renomeia rótulos do post default para 
 * tratamentos
 */
function change_post_menu_label() {
    global $menu;
    global $submenu;
    $menu[5][0] = 'Tratamentos';
    $submenu['edit.php'][5][0] = 'Tratamentos';
    $submenu['edit.php'][10][0] = 'Novo Tratamento';
    echo '';
}
function change_post_object_label() {
    global $wp_post_types;
    $labels = &$wp_post_types['post']->labels;
    $labels->name = 'Tratamentos';
    $labels->singular_name = 'Tratamento';
    $labels->add_new = 'Adicionar Tratamento';
    $labels->add_new_item = 'Novo Tratamento';
    $labels->edit_item = 'Editar Tratamentos';
    $labels->new_item = 'Tratamento';
    $labels->view_item = 'Ver Tratamento';
    $labels->search_items = 'Buscar Tratamentos';
    $labels->not_found = 'Tratamento não encontrado';
    $labels->not_found_in_trash = 'Não encontrado';
}
add_action( 'init', 'change_post_object_label' );
add_action( 'admin_menu', 'change_post_menu_label' );

/**
 * Incorpore scripts essenciais para toda a
 * aplicação
 *
 * @since Anafisio 1.0
 */
function plandd_scripts() {
	/*
		Folha de estilo base para a aplicação
	 */
	wp_enqueue_style('style', get_stylesheet_directory_uri() . '/style.css', array(), THEME_VERSION, "screen");

    /*
    	modernizr
    */
    wp_enqueue_script('modernizr', '//cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js', array(), THEME_VERSION);

    /*
    	Jquery
     */
    wp_deregister_script('jquery');
    wp_register_script('jquery', '//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js', false, THEME_VERSION);
    wp_enqueue_script('jquery');

    /**
     * AangularJS
     */
    //wp_enqueue_script('angularjs', 'https://ajax.googleapis.com/ajax/libs/angularjs/1.3.16/angular.min.js', array(), THEME_VERSION, true);

    /*
	    Scripts essenciais minificados em
	    um arquivo unico e essenciais para
	    o funcionamento do lado cliente
    */
    wp_enqueue_script('scripts', get_stylesheet_directory_uri() . '/scripts.js', array(), THEME_VERSION, true);

}
add_action( 'wp_enqueue_scripts', 'plandd_scripts' );

// Post Types
// ------------------------------------------------------------------------------------

//Banners
include_once( get_stylesheet_directory() . '/includes/cpt/banners.php' );

/*
Icones para post-types
(http://melchoyce.github.io/dashicons/)
edit.php?post_type=acf
*/
function add_menu_icons_styles() {
?>
	<style>
		#menu-posts div.wp-menu-image:before {
			content: "\f481";
		}
		#menu-posts-banners div.wp-menu-image:before {
			content: "\f181";
		}
		*[id^="est-galeria-description"],
		*[id^="est-galeria-url"] {
			display: none !important;
		}
	</style>
	<?php
}
add_action('admin_head', 'add_menu_icons_styles');

// Opções do tema
// ------------------------------------------------------------------------------------

/**
 * Opções gerais para a aplicação e seus
 * componentes
 * @link https://github.com/reduxframework/redux-framework
 *
 * @since Anafisio 1.0
 */
require_once (dirname(__FILE__) . '/includes/redux/redux-framework.php');
require_once (dirname(__FILE__) . '/includes/redux/sample/barebones-config.php');


// Requisições Ajax
// ------------------------------------------------------------------------------------

/**
 * Atualize as imagens do perfil
 */
add_action('wp_ajax_nopriv_tell_user', 'tell_user');
add_action('wp_ajax_tell_user', 'tell_user');

function tell_user() {
	global $plandd_option;
	$sendTo = $plandd_option['inst-email'];
	$phone = filter_var($_GET['phone'],FILTER_SANITIZE_NUMBER_INT);
	$dd = filter_var($_GET['dd'],FILTER_SANITIZE_NUMBER_INT);
	$name = filter_var($_GET['name'],FILTER_SANITIZE_STRING);

	if(!$phone) {
		echo 'Telefone inválido';
		exit();
	}

	if(!$name) {
		echo 'Nome inválido';
		exit();
	}

	if($name && $phone) {
		$message = "{$name} solicitou uma ligação para {$dd} - {$phone} a partir do site";

		//Enviar email
		if(wp_mail( $sendTo, '[Ligue pra mim] - Anafisio', $message ))
			echo 'true';
		else
			echo 'Erro interno. Tente nomavemente em alguns instantes.';
			
	} else {
		echo 'Algum campo está digitado incorretamente.';
	}

	exit();
}

?>