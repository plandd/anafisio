<?php 
    get_header();
?>
    <section id="category-intro" class="small-12 left rel" data-thumb="<?php echo get_template_directory_uri();?>/images/bg_categorias.jpg">
        <div class="mask-primary small-12 abs"></div>
        <div class="d-table-cell small-12">
            <div class="row">
                <div class="small-12 columns">
                    <header class="small-8 small-offset-2 left text-center post-header">
                        <h3 class="white font-bold"><?php the_title(); ?></h3>
                    </header>
                </div>
            </div>
        </div>
    </section>

    <nav id="nav-posts" class="small-12 left">
        <div class="row">
            <div class="small-12 medium-8 medium-offset-2 columns">

                <article class="small-12 left post-content">
                <?php
                    if ( have_posts() ) : while ( have_posts() ) : the_post();
                        the_content();
                    endwhile; endif;
                ?>
                </article>

                <footer class="post-footer small-12 left">
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
                </footer>
            </div>
        </div><!-- // row -->
    </nav>
<?php get_footer(); ?>
