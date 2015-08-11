<?php 
    get_header();
    global $post;
    $th = (get_field('slider_imagem',$post->ID)) ? get_field('slider_imagem',$post->ID) : get_template_directory_uri() . "/images/bg_categorias.jpg";
?>
    <section id="category-intro" class="small-12 left rel" data-thumb="<?php echo $th;?>">
        <div class="mask-primary small-12 abs"></div>
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
        <div class="d-table-cell small-12">
            <div class="row">
                <div class="small-12 columns">
                    <header class="small-8 small-offset-2 left text-center post-header">
                        <h1><span class="divide-20 <?php echo get_field('icon_tratamento',$post->ID); ?> white"></span></h1>
                        <h3 class="white font-bold no-margin"><?php the_title(); ?></h3>
                    </header>
                </div>
            </div>
        </div>
    </section>

    <nav id="nav-posts" class="small-12 left">
        <div class="row">
            <div class="small-12 medium-8 medium-offset-2 columns">
                <header class="small-12 left post-subheader">
                    <h4 class="primary divide-20"><?php echo get_field('tratamento_subtitulo',$post->ID); ?></h4>
                </header>
                <?php 
                    //Galeria do tratamento
                    $gallery = get_field('gallery_tratamento',$post->ID);
                    if(isset($gallery) && !empty($gallery)):
                ?>
                <nav class="divide-20 post-gallery rel cycle-slideshow"
                data-cycle-fx="fade"
                data-cycle-timeout="8000"
                data-cycle-slides="> figure"
                data-cycle-prev=".next-slide"
                data-cycle-next=".prev-slide"
                >
                <?php
                    foreach ($gallery as $pic):
                ?>
                
                    <figure class="small-12 left" data-thumb="<?php echo $pic['tratamento_img']; ?>"></figure>
                <?php
                     endforeach;
                ?>
                    <!-- navegar -->
                    <a href="#" title="Slide anterior" class="single-slider-nav prev-slide white">
                        <i class="icon-icon_left"></i>
                    </a>
                    <a href="#" title="Slide anterior" class="single-slider-nav next-slide white">
                        <i class="icon-icon_right"></i>
                    </a>
                </nav>
                <?php endif; ?>

                <article class="small-12 left post-content">
                <?php
                    if ( have_posts() ) : while ( have_posts() ) : the_post();
                        the_content();
                    endwhile; endif;
                ?>
                </article>

                <!--<footer class="post-footer small-12 left">
                    <header class="divide-10">
                        <h3 class="primary">Gostou do nosso conteúdo?</h3>
                    </header>
                    <nav class="small-12 left share-post">
                        <h5 class="left ghost font-regular show-for-large-up">Compartilhe com seus amigos:</h5>
                        <ul class="right inline-list">
                            <li><div class="fb-like" data-layout="button_count" data-href="<?php the_permalink(); ?>"></div></li>
                            <li><a class="twitter-share-button" href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>">Tweet</a></li>
                            <li><div class="g-plusone" data-size="medium" data-width="65" data-href="<?php the_permalink(); ?>"></div></li>
                        </ul>
                    </nav>
                </footer>-->
            </div>
        </div><!-- // row -->
    </nav>
<?php
    //Estrutura
    require get_template_directory()."/includes/sections/estructure.php";
    get_footer();
?>
