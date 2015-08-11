    <section id="structure" class="small-12 left rel" data-thumb="http://www.trenofitness.com/site/images/academia.jpg">
      <div class="info-mask abs small-12"></div>
      <div class="row">
        <header class="small-12 columns text-center">
          <h2 class="white font-regular">Conheça nossa estrutura</h2>
        </header>

        <nav class="nav-pics small-12 columns">
          <?php
            global $plandd_option;
            $gallery = $plandd_option['est-galeria'];
            shuffle($gallery);
            $i = 0;
            foreach ($gallery as $pic):
              if(8 == $i)
                break;
              $i++;

              $thumb = wp_get_attachment_image_src( $pic['attachment_id'], 'medium' );
          ?>
          <figure class="small-6 medium-3 left rel">
            <div class="small-12 abs" data-thumb="<?php echo $thumb['0']; ?>"></div>
            <a href="<?php echo $pic['image']; ?>" class="d-block small-12 abs" data-lightbox="estrutura" data-title="<?php echo $pic['title']; ?>">
              <figcaption class="small-12 abs">
                <h5 class="primary font-regular"><?php echo $pic['title']; ?></h5>
              </figcaption>
            </a>
          </figure>
          <?php endforeach; ?>
        </nav>
      </div>
    </section>