<footer id="footer" class="small-12 left bg-primary">
  <div class="row">

    <div class="small-10 small-offset-1 medium-6 medium-offset-0 large-3 columns">
      <header class="small-12 left">
        <h1><a href="<?php echo home_url();?>" title="Página principal" class="icon-icon_logo_anafisio d-iblock white logo-footer"></a></h1>
      </header>
      <?php
        //dados institucionais
        global $plandd_option;
        $rua = $plandd_option['inst-rua'];
        $num = $plandd_option['inst-num'];
        $comp = $plandd_option['inst-comp'];
        $tel = $plandd_option['inst-tel'];
        $email = $plandd_option['inst-email'];
      ?>
      <article class="small-12 left">
        <p class="ghost lh-small text-normal divide-10"><?php echo $rua; ?><br>No <?php echo $num; ?> - <?php echo $comp; ?></p>
        <p class="lh-small no-margin text-normal"><i class="icon-icon_phone info"></i> <span class="white"><?php echo $tel; ?></span></p>
        <p class="lh-small text-small divide-10"><i class="icon-icon_mail info"></i> <span class="white"><?php echo $email; ?></span></p>
        <nav class="social-footer small-12 left">
          <ul class="small-12 letf inline-list no-margin">
            <?php if($plandd_option['inst-facebook']): ?>
            <li>
              <h4><a href="<?php echo $plandd_option['inst-facebook']; ?>" target="_blank" title="Seguir no Facebook" class="icon-icon_face white"></a></h4>
            </li>
            <?php
              endif;
              if($plandd_option['inst-instagram']):
            ?>
            <li>
              <h4><a href="<?php echo $plandd_option['inst-instagram']; ?>" target="_blank" title="Seguir no Instagram" class="icon-icon_insta white"></a></h4>
            </li>
            <?php endif; ?>
            <li>
              <h4><a href="mailto:<?php echo $plandd_option['inst-email']; ?>" title="Mande-nos um email" class="icon-icon_mail white"></a></h4>
            </li>
          </ul>
        </nav>
      </article>
    </div>

    <!-- menu principal -->
    <div class="small-2 columns custom-menu">
      <header class="divide-10">
        <h5 class="info">Anafisio</h5>
      </header>
      <nav>
        <ul class="no-bullet no-margin text-normal">
          <?php
            $defaults = array(
              'theme_location'  => '',
              'menu'            => 'Menu institucional',
              'container'       => '',
              'container_class' => '',
              'container_id'    => '',
              'menu_class'      => '',
              'menu_id'         => '',
              'echo'            => true,
              'fallback_cb'     => 'main_menu',
              'before'          => '',
              'after'           => '',
              'link_before'     => '',
              'link_after'      => '',
              'items_wrap'      => '%3$s',
              'depth'           => 0,
              'walker'          => '',
            );
            wp_nav_menu($defaults);
          ?>
        </ul>
      </nav>
    </div>

    <!-- menu tratamentos -->
    <div class="small-4 columns custom-menu">
      <header class="divide-10">
        <h5 class="info">Tratamentos</h5>
      </header>
      <nav class="small-12 left">
        <ul class="inline-list no-margin text-normal">
          <?php
            $defaults = array(
              'theme_location'  => '',
              'menu'            => 'Menu tratamentos',
              'container'       => '',
              'container_class' => '',
              'container_id'    => '',
              'menu_class'      => '',
              'menu_id'         => '',
              'echo'            => true,
              'fallback_cb'     => 'main_menu',
              'before'          => '',
              'after'           => '',
              'link_before'     => '',
              'link_after'      => '',
              'items_wrap'      => '%3$s',
              'depth'           => 0,
              'walker'          => '',
            );
            wp_nav_menu($defaults);
          ?>
        </ul>
      </nav>
    </div>

    <!-- ligamos para você -->
    <form action="" class="medium-6 large-3 columns show-for-medium-up tel-form">
      <header class="divide-10">
        <h5 class="info divide-10">Ligamos para você</h5>
        <p class="ghost no-margin lh-small text-normal">Deixe seu nome e telefone que ligamos para você!</p>
      </header>
      <p class="left small-12 no-margin"><input type="text" name="nome" placeholder="Seu nome" required></p>
      <p class="left small-12 no-margin"><input type="tel" name="telefone" placeholder="Seu telefone" required></p>
      <p class="left no-margin"><input type="submit" value="OK" class="right button info no-margin call-for-user"></p>
    </form>
  </div>
</footer>

<section id="credits" class="small-12 left bg-primary">
  <div class="row">
    <p class="text-small left ghost no-margin">&copy; Copyright <?php echo date('Y'); ?>. Todos os direitos reservados.</p>
    <a href="http://plandd.cc" target="_blank" title="Desenvolvido pela Plan - Design e Desenvolvimento" class="right icon-icon_plan white"></a>
  </div>
</section>

<?php if(is_single()): ?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.4&appId=311641142285753";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<script>window.twttr = (function(d, s, id) {
var js, fjs = d.getElementsByTagName(s)[0],
  t = window.twttr || {};
if (d.getElementById(id)) return t;
js = d.createElement(s);
js.id = id;
js.src = "https://platform.twitter.com/widgets.js";
fjs.parentNode.insertBefore(js, fjs);

t._e = [];
t.ready = function(f) {
  t._e.push(f);
};

return t;
}(document, "script", "twitter-wjs"));</script>
<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
<?php endif; ?>

<?php wp_footer(); ?>
</body>
</html>
