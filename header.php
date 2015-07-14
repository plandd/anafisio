<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
  <!-- Developed by PlanDD (contato@plandd.cc) -->
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php bloginfo('name'); ?> | <?php is_home()?bloginfo('description'):wp_title(''); ?></title>
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri();?>/favicon.ico" type="image/vnd.microsoft.icon"/>
    <link rel="icon" href="<?php echo get_template_directory_uri();?>/favicon.ico" type="image/x-ico"/>
    <script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyB664XOo1V2z76RD87sMi4b4nAM1JzKthg&sensor=false'></script>
    <script>
      //<![CDATA[
      var getData = {
        'urlDir':'<?php bloginfo('template_directory');?>/',
        'ajaxDir':'<?php echo stripslashes(get_admin_url()).'admin-ajax.php';?>',
        'apiKey' : '<?php echo get_option('jt_api_key');?>'
      }
      //]]>
    </script>
    <?php wp_head(); ?>
  </head>
  <body>
    <!-- menu off-canvas -->
    <nav id="off-canvas" class="fixed full-height bg-secondary" role="navigation">
      <header class="small-12 left bg-primary">
        <h3 class="text-up info font-bold left">Menu</h3>
        <h3 class="right"><a href="#" title="Fechar o menu" class="icon-close2 white"></a></h3>
      </header>
      <div class="off-nav small-12 left"></div>
      <div class="off-call-us small-12 left"></div>
    </nav>
    <a href="#" class="close-off-menu"></a> <!-- fechar menu -->
    <a href="#" class="close-call-us"></a> <!-- fechar form telefone -->

    <!-- cabeçalho -->
    <header id="header" class="small-12 left" role="banner">
      <div class="row rel">
        <!-- logo -->
        <figure class="af-logo small-8 medium-4 columns d-table" role="img">
          <h1><a href="<?php echo home_url();?>" class="d-block" title="Página principal"><img src="<?php echo get_template_directory_uri();?>/images/logo.png" alt="Anafisio"></a></h1>
        </figure>
        <!-- menu principal -->
        <nav id="main-menu" class="small-8 columns show-for-large-up" role="navigation">
          <ul class="inline-list no-margin right">
            <?php
              $defaults = array(
              	'theme_location'  => '',
              	'menu'            => 'Menu principal',
              	'container'       => '',
              	'container_class' => '',
              	'container_id'    => '',
              	'menu_class'      => '',
              	'menu_id'         => '',
              	'echo'            => true,
              	'fallback_cb'     => 'main_menu',
              	'before'          => '',
              	'after'           => '',
              	'link_before'     => '<span>',
              	'link_after'      => '</span>',
              	'items_wrap'      => '%3$s',
              	'depth'           => 0,
              	'walker'          => '',
              );
              wp_nav_menu($defaults);
            ?>
          </ul>
        </nav>
        <!-- menu mobile -->
        <nav id="mo-menu" class="small-4 medium-7 columns right hide-for-large-up">
          <div class="d-table small-12 left">
            <div class="d-table-cell small-12">
              <h3 class="right">
                <a href="#" title="Abrir o menu" class="toggle-menu"><span class="icon-icon_menu"></span></a>
              </h3>
              <h3 class="call-us right show-for-medium-up">
                <a href="#" data-dropdown="call-form" aria-controls="call-form" aria-expanded="false" class="button info round no-margin font-bold" title="Ligamos para você">
                  <figure class="icon-phone left"></figure>
                  <span>Ligamos para você</span>
                </a>
              </h3>
            </div>
          </div>
        </nav>
        <!-- ligamos para você -->
        <div id="call-form" data-dropdown-content class="f-dropdown small content radius" aria-hidden="true" tabindex="-1">
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
          </form>
        </div>
      </div>
    </header>
    <!-- // cabeçalho -->
