<!-- Slider -->
<section id="home-slider" class="small-12 left bg-info rel">
  <div class="small-12 abs full-height d-table slide-loader text-center">
    <div class="d-table-cell small-12">
      <img src="<?php echo get_template_directory_uri();?>/images/loader.gif" alt="" class="d-iblock">
    </div>
  </div>

  <nav class="slider-items small-12 left full-height cycle-slideshow"
    data-cycle-fx="fade"
    data-cycle-timeout="8000"
    data-cycle-slides="> figure"
    data-cycle-prev=".next-slide"
    data-cycle-next=".prev-slide"
    data-cycle-pager=".slider-pager"
    data-cycle-pager-template="<span></span>"
    data-cycle-swipe="true"
    data-cycle-swipe-fx="scrollHorz"
  >
    <?php 
      $args = array(
         'posts_per_page' => 4,
         'orderby' => 'date',
         'post_type' => 'banners',
         'post_status' => 'publish'
      );
      $posts = get_posts( $args );
      foreach ($posts as $post): setup_postdata( $post );
        global $post;
    ?>
    <figure class="small-12 full-height" data-thumb="<?php echo get_field('banner_bg'); ?>" role="banner">
      <a href="<?php echo get_field('banner_uri'); ?>" title="<?php the_title(); ?>"></a>
      <div class="slider-mask small-12 full-height abs"></div>
      <?php
          //background
          if(get_field('slider_video',$post->ID)):
      ?>
      <video class="abs small-12 show-for-large-up" loop autoplay muted>
          <source src="<?php echo get_field('slider_video',$post->ID); ?>" type="video/mp4">
      </video>
      <?php
          endif;
      ?>
      <div class="row d-table">
        <article class="small-12 d-table-cell text-center">
          <h2 class="white slide-title"><?php the_title(); ?></h2>
          <h4 class="white font-regular"><?php echo get_field('banner_desc'); ?></h4>
        </article>
      </div>
    </figure>
    <?php endforeach; ?>
  </nav>
  <!-- navegar -->
  <a href="#" title="Slide anterior" class="home-slider-nav prev-slide white">
    <i class="icon-icon_left"></i>
  </a>
  <a href="#" title="Slide anterior" class="home-slider-nav next-slide white">
    <i class="icon-icon_right"></i>
  </a>
  <!-- paginação -->
  <nav class="slider-bullets abs small-12 text-center">
    <div class="slider-pager"></div>
  </nav>
</section>
<!-- // Slider -->
