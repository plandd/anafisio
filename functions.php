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
define('THEME_VERSION', '1.0.3');

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
include_once( get_stylesheet_directory() . '/includes/acf/preconfig.php' );

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
        add_image_size('tratamento', 780, 320, true);
    }

	/**
	 * Registre os menus do topo e rodapé
	 */
	register_nav_menus( array(
		'primary' => __( 'Menu principal',   'plandd' ),
    	'secondary'  => __( 'Menu institucional', 'plandd' )
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

    //Ativa item no menu para postagens filhas
    add_filter('wp_nav_menu_objects', 'add_menu_parent_class');
    function add_menu_parent_class($items) {
    	//print_r($items);

        foreach ($items as $item) {
        	
    		if($item->title == "Tratamentos") {
    			$args = array(
			        'posts_per_page' => -1,
			        'order' => 'ASC',
			        'orderby' => 'title'
			    );

			    $posts = get_posts( $args );
			    
			    foreach ($posts as $post) { 
				    setup_postdata( $post );
				    $link = array (
			            'title'            => get_the_title( $post->ID ),
			            'menu_item_parent' => $item->ID,
			            'ID'               => '',
			            'db_id'            => '',
			            'url'              => get_permalink($post->ID)
				    );
				    $items[] = (object) $link;
			    }
    		}
        }
        return $items;
    }

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
		@font-face {
			font-family: 'icomoon';
			src:url('<?php echo get_stylesheet_directory_uri(); ?>/fonts/icomoon.eot?jukmv4');
			src:url('<?php echo get_stylesheet_directory_uri(); ?>/fonts/icomoon.eot?#iefixjukmv4') format('embedded-opentype'),
				url('<?php echo get_stylesheet_directory_uri(); ?>/fonts/icomoon.ttf?jukmv4') format('truetype'),
				url('<?php echo get_stylesheet_directory_uri(); ?>/fonts/icomoon.woff?jukmv4') format('woff'),
				url('<?php echo get_stylesheet_directory_uri(); ?>/fonts/icomoon.svg?jukmv4#icomoon') format('svg');
			font-weight: normal;
			font-style: normal;
		}

		[class^="icon-"], [class*=" icon-"] {
			font-family: 'icomoon';
			speak: none;
			font-style: normal;
			font-weight: normal;
			font-variant: normal;
			text-transform: none;
			line-height: 1;
			font-size: 32px;

			/* Better Font Rendering =========== */
			-webkit-font-smoothing: antialiased;
			-moz-osx-font-smoothing: grayscale;
		}

		.icon-icon_arrow-down-menu:before {
			content: "\e625";
		}
		.icon-icon_acupuntura:before {
			content: "\e60f";
		}
		.icon-icon_ajuda:before {
			content: "\e610";
		}
		.icon-icon_anafisio:before {
			content: "\e611";
		}
		.icon-icon_bracoquebrado:before {
			content: "\e612";
		}
		.icon-icon_brain:before {
			content: "\e613";
		}
		.icon-icon_cadeiraderoda:before {
			content: "\e614";
		}
		.icon-icon_coluna:before {
			content: "\e615";
		}
		.icon-icon_coracao:before {
			content: "\e616";
		}
		.icon-icon_massagem:before {
			content: "\e617";
		}
		.icon-icon_massagem2:before {
			content: "\e618";
		}
		.icon-icon_muleta:before {
			content: "\e619";
		}
		.icon-icon_muletas:before {
			content: "\e61a";
		}
		.icon-icon_osso:before {
			content: "\e61b";
		}
		.icon-icon_osso2:before {
			content: "\e61c";
		}
		.icon-icon_osso3:before {
			content: "\e61d";
		}
		.icon-icon_pe:before {
			content: "\e61e";
		}
		.icon-icon_pernaquebrada:before {
			content: "\e61f";
		}
		.icon-icon_pilates:before {
			content: "\e620";
		}
		.icon-icon_raiox:before {
			content: "\e621";
		}
		.icon-icon_right2:before {
			content: "\e622";
		}
		.icon-icon_yinyang:before {
			content: "\e623";
		}
		.icon-icon_yoga:before {
			content: "\e624";
		}
		.icon-icon_plan:before {
			content: "\e60c";
		}
		.icon-icon_left:before {
			content: "\e60d";
		}
		.icon-icon_right:before {
			content: "\e60e";
		}
		.icon-icon_baby:before {
			content: "\e600";
		}
		.icon-icon_exit:before {
			content: "\e601";
		}
		.icon-icon_face:before {
			content: "\e602";
		}
		.icon-icon_gear:before {
			content: "\e603";
		}
		.icon-icon_hearth:before {
			content: "\e604";
		}
		.icon-icon_horse:before {
			content: "\e605";
		}
		.icon-icon_insta:before {
			content: "\e606";
		}
		.icon-icon_logo_anafisio:before {
			content: "\e607";
		}
		.icon-icon_mail:before {
			content: "\e608";
		}
		.icon-icon_menu:before {
			content: "\e609";
		}
		.icon-icon_phone:before {
			content: "\e60a";
		}
		.icon-icon_picture:before {
			content: "\e60b";
		}

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

function add_scripts_admin() {
	?>
	<script>
		jQuery(document).ready(function($) {
			setTimeout(function() {
				var opt =  (typeof $('#acf-field-cat_icon').val() !== 'undefined') ? $('#acf-field-cat_icon').val() : $('#acf-field-icon_tratamento').val(),
					elem = ($('#acf-field-cat_icon').length) ? $('#acf-field-cat_icon') : $('#acf-field-icon_tratamento');
					elem.before('<span style="width:100%;float:left;display:block;"><i class="'+ opt +'"></i></span>');
					elem.on('change',function() {
						$(this).siblings('span').find('i').attr('class',$(this).val());
					});
			},1000);
		});
	</script>
	<?php
}
add_action('admin_footer', 'add_scripts_admin');

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
	$phone = filter_var($_GET['phone'],FILTER_SANITIZE_STRING);
	$dd = filter_var($_GET['dd'],FILTER_SANITIZE_STRING);
	$name = filter_var($_GET['name'],FILTER_SANITIZE_STRING);
	$page = filter_var($_GET['page'],FILTER_SANITIZE_STRING);

	if(!$phone) {
		echo 'Telefone inválido';
		exit();
	}

	if(!$name) {
		echo 'Nome inválido';
		exit();
	}

	if($name && $phone) {
		$message = "{$name} solicitou uma ligação para {$dd} - {$phone} a partir do site através da página " . $page;

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

add_action('wp_ajax_nopriv_send_email_generic', 'send_email_generic');
add_action('wp_ajax_send_email_generic', 'send_email_generic');

function send_email_generic() {
	global $plandd_option;

	$fields = $_GET['fields'];
	$subject = $_GET['subject'];

	$params = array();
	parse_str($fields, $params);
	//print_r($params);
	$valNome = false;
	$valTelefone = false;
	$mensagem = 'Mensagem vazia';

	if(array_key_exists('nome', $params) && !empty($params['nome'])) {
		$nome = filter_var($params['nome'],FILTER_SANITIZE_STRING);
		if(!$nome || strlen($nome) > 300) {
			echo 'nome';
			exit();
		} else {
			$valNome = true;
		}
	}

	if(array_key_exists('email', $params) && !empty($params['email'])) {
		$email = filter_var($params['email'],FILTER_VALIDATE_EMAIL);
	}

	if(array_key_exists('papel', $params) && !empty($params['papel'])) {
		$papel = filter_var($params['papel'],FILTER_SANITIZE_STRING);
	}

	/**
	 * Telefone
	 */
	if(array_key_exists('telefone', $params) && !empty($params['telefone'])) {
		$telefone = filter_var($params['telefone'],FILTER_SANITIZE_STRING);
		if(!$telefone || strlen($telefone) > 30) {
			echo 'telefone';
			exit();
		} else {
			$valTelefone = true;
		}
	}

	if(array_key_exists('mensagem', $params) && !empty($params['mensagem'])) {
		$mensagem = filter_var($params['mensagem'],FILTER_SANITIZE_STRING);
	}

	if($valNome && $valTelefone) {
		$msg = $mensagem . "\n";
		$msg .= "Telefone: ". $telefone ."\n";
		$msg .= "Da página: ". $params['page'] ."\n";
		if ($papel) {
			$msg .= "Papel: " . $papel ."\n";
		}

		if(wp_mail( $plandd_option['inst-email'], '['. $subject .']', $msg )) {
			echo 'success';
		} else {
			echo 'error';
		}
	}

	exit();
}

// Shortcodes
// ------------------------------------------------------------------------------------
function button_tratamentos( $atts ) {
	$atts = shortcode_atts( array(
		'btn_type' => 'primary',
		'rotulo' => 'Ver todos os tratamentos'
	), $atts, 'tratamentos' );

	$html = "<div class=\"small-12 left text-center\"><h2><a href=\"". get_category_link(1) ."\" title=\"{$atts['rotulo']}\" class=\"button round white {$atts['btn_type']}\">{$atts['rotulo']}</a></h2></div>";
	
	return $html;
}
add_shortcode( 'tratamentos', 'button_tratamentos' );

function button_ligamos( $atts ) {
	$atts = shortcode_atts( array(
		'btn_type' => 'primary',
		'rotulo' => 'Ligamos para você'
	), $atts, 'solicitar-fone' );

	ob_start();
	?>
	<form id="call-us-form" class="tel-form" novalidate="novalidate">
        <header class="divide-20">
          <h6 class="ghost">Deixe seu nome e telefone que ligaremos para você!</h6>
        </header>
        <p>
          <label><input type="text" name="nome" placeholder="Seu nome" pattern="alpha_numeric" required></label>
        </p>
        <p class="small-2 left no-margin">
          <input type="text" name="dd" placeholder="DD" maxlength="2" pattern="number" required>
        </p>
        <p class="small-10 left pd-left-20 no-margin">
          <input type="text" name="telefone" placeholder="Seu telefone" maxlength="9" pattern="number" required>
        </p>
        <p>
          <button type="submit" class="button radius info small-12 left no-margin call-for-user">Ligue para mim</button>
          <div class="notify small-12 left"></div>
        </p>
        <input type="hidden" name="page" value="<?php echo  is_home() ? 'Home' : wp_title(''); ?>">
    </form>
	<?php

	$output = ob_get_contents();
	ob_end_clean();

	$html = "<div data-reveal-id=\"form-fone\" class=\"small-12 left text-center\"><h2><a href=\"#\" title=\"{$atts['rotulo']}\" class=\"button round white {$atts['btn_type']}\">{$atts['rotulo']}</a></h2></div>";
	$html .= '<div id="form-fone" class="reveal-modal small" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">'. $output .'<a class="close-reveal-modal" aria-label="Close">&#215;</a></div>';
	
	return $html;
}
add_shortcode( 'solicitar-fone', 'button_ligamos' );


?>
