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
?>
    <section id="template-intro" class="small-12 left rel d-table" <?php if(empty($video)) echo 'data-thumb="'. $imgbg .'"'; ?>>
        <?php
            //background
            if(!empty($video)):
        ?>
        <video class="abs small-12" loop autoplay muted>
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
                <h2 class="primary divide-10"><?php echo get_field('template_block',$post->ID); ?></h2>
                <h5 class="divide-20 ghost font-regular"><?php echo get_field('template_bckexc',$post->ID); ?></h5>
            </div>

            <article class="small-12 medium-7 columns two-columns">
                <?php
                    if ( have_posts() ) : while ( have_posts() ) : the_post();
                        the_content();
                    endwhile; endif;
                ?>  
            </article>

            <nav id="template-carousel" class="small-12 columns">
                <?php
                    $args = array( 'posts_per_page' => -1, 'taxonomy' => 'category' );
                    $_posts = get_posts( $args );
                    foreach ($_posts as $post): setup_postdata( $post );
                ?>
                <div class="item column left">
                    <figure class="small-12 left text-center">
                        <h1><a href="#" data-tooltip aria-haspopup="true" title="<?php the_title(); ?>" class="has-tip tip-bottom radius d-iblock small-12 <?php echo get_field('icon_tratamento',$post->ID); ?>"></a></h1>
                    </figure>
                </div>
                <?php endforeach; ?>
            </nav>

            <footer class="small-12 columns text-center template-footer">
                <h1 class="d-iblock"><a href="#" class="button round" title="Veja todos os tratamentos">ver todos os tratamentos</a></h1>
                <h4 class="font-lite primary d-iblock">ou</h4>
                <h1 class="d-iblock"><a href="#" class="button round" title="Entre em contato">entre em contato</a></h1>
            </footer>
        </div>
    </div>
<?php get_footer(); ?>
