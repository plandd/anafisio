<?php 
    /**
      * Template Name: Sobre nós
      *
      * @package WordPress
      */
    get_header();
    global $post;
    $video = get_field('template_video',$post->ID);
    $imgbg = get_field('template_imgbg',$post->ID);
    $contato = get_page_by_title('Contato');
?>
    <section id="template-intro" class="small-12 left rel d-table" <?php if(!empty($imgbg)) echo 'data-thumb="'. $imgbg .'"'; ?>>
        <?php
            //background
            if(!empty($video)):
        ?>
        <video class="abs small-12 show-for-large-up" loop autoplay muted>
            <source src="<?php echo $video; ?>" type="video/mp4">
            <img src="<?php echo $imgbg; ?>" alt="">
        </video>
        <?php
            endif;
        ?>

        <div class="mask-primary small-12 abs"></div>
        <div class="d-table-cell small-12 text-right rel">
            <div class="row">
                <header class="small-12 left template-header">
                    <h1 class="white no-margin"><?php the_title(); ?></h1>
                    <h3 class="white font-regular no-margin"><?php echo get_field('template_excerpt',$post->ID); ?></h3>
                </header>
            </div>
        </div>
    </section>

    <div class="small-12 left template-content">
        <div class="row">
            <div class="blockquote small-12 medium-5 columns">
                <h2 class="primary divide-10 text-right"><?php echo get_field('template_block',$post->ID); ?></h2>
                <h5 class="divide-20 ghost font-regular text-right"><?php echo get_field('template_bckexc',$post->ID); ?></h5>
                <?php
                    $thumb = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
                    if(isset($thumb)):
                ?>
                <figure class="small-12 left text-center">
                    <img src="<?php echo $thumb[0]; ?>" alt="" class="d-iblock">
                </figure>
                <?php endif; ?>
            </div>

            <article class="small-12 medium-7 columns two-columns">
                <?php
                    if ( have_posts() ) : while ( have_posts() ) : the_post();
                        the_content();
                    endwhile; endif;
                ?>  
            </article>
            
            <?php
                if(get_the_title($post->ID) == 'Sobre nós'):
            ?>
            <nav id="template-carousel" class="small-12 columns">
                <?php
                    $args = array( 'posts_per_page' => -1, 'taxonomy' => 'category' );
                    $_posts = get_posts( $args );
                    foreach ($_posts as $post): setup_postdata( $post );
                ?>
                <div class="item column left">
                    <figure class="small-12 left text-center">
                        <h1><a href="#" data-tooltip aria-haspopup="true" title="<?php the_title(); ?>" class="has-tip tip-top radius d-iblock small-12 <?php echo get_field('icon_tratamento',$post->ID); ?>"></a></h1>
                    </figure>
                </div>
                <?php endforeach; ?>
            </nav>

            <footer class="small-12 columns text-center template-footer">
                <h1 class="d-iblock"><a href="<?php echo get_category_link(1); ?>" class="button round" title="Veja todos os tratamentos">ver todos os tratamentos</a></h1>
                <h4 class="font-lite primary d-iblock">ou</h4>
                <h1 class="d-iblock"><a href="<?php echo get_page_link($contato->ID); ?>" class="button round" title="Entre em contato">entre em contato</a></h1>
            </footer>
            <?php else: ?>
            <footer class="small-12 columns text-center template-footer">
                <div class="divide-20"></div>
                <h1 class="d-iblock"><a href="<?php echo get_page_link($contato->ID); ?>" class="button round" title="Solicite-nos uma visita">solicite uma visita</a></h1>
            </footer>
            <?php endif; ?>

        </div>
    </div>
<?php get_footer(); ?>
