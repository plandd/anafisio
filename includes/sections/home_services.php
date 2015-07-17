    <section id="services" class="row">
      <header class="small-12 columns text-center">
        <h2 class="primary no-margin">Tratamentos específicos para a sua necessidade.</h2>
        <h4 class="ghost font-regular">Grupos de tratamentos pensados especialmente para você.</h4>
      </header>

      <nav class="nav-services small-12 left owl-carousel owl-theme owl-responsive-1000 owl-loaded">
        <?php
          $terms = get_terms('category', 'orderby=rand&hide_empty=0');
          foreach ($terms as $term):
        ?>
        <div class="item column rel service-card">
          <figure class="small-12 left rel">
            <a href="<?php echo get_term_link( $term ); ?>" class="service-link d-block rel small-12 left" title="<?php echo "Ver todos os tratamentos em " . $term->name; ?>">
              <div class="small-12 abs" data-thumb="<?php echo get_field('cat_img',$term); ?>"></div>
              <figcaption class="small-12 left rel">
                <hgroup class="small-12 d-table-cell text-center white">
                  <h1 class="no-margin"><span class="<?php echo get_field('cat_icon',$term); ?>"></span></h1>
                  <h3 class="no-margin font-regular lh-small"><?php echo $term->name; ?></h3>
                </hgroup>
              </figcaption>
            </a>
          </figure>
        </div>
        <?php endforeach; ?>
      </nav>
    </section>