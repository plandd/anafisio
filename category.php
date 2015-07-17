<?php 
    $obj = get_queried_object();
    get_header();
?>
    <section id="category-intro" class="small-12 left rel" data-thumb="<?php echo get_template_directory_uri();?>/images/bg_categorias.jpg">
        <div class="mask-primary small-12 abs"></div>
        <div class="d-table-cell small-12">
            <div class="row">
                <div class="small-12 columns">
                    <header class="small-8 small-offset-2 left text-center">
                        <h3 class="white font-bold"><?php echo single_cat_title(); ?></h3>
                    </header>
                    <p class="white small-12 left text-center text-medium no-margin"><?php echo $obj->description; ?></p>
                </div>
            </div>
        </div>
    </section>

    <nav id="nav-posts" class="small-12 left">
        <div class="row">
            <header class="small-12 columns">
                <h3 class="primary divide-20">Tratamentos indicados:</h3>
            </header>
            <?php
                while (have_posts()) : the_post();
            ?>
            <div class="post-card small-12 left">
                <header class="small-12 medium-3 columns d-table post-info">
                    <h4><a href="<?php the_permalink(); ?>" class="primary" title="<?php the_title(); ?>"><?php the_title(); ?></a></h4>
                </header>
                <article class="small-12 medium-6 columns d-table post-info">
                    <p class="ghost text-normal"><?php the_excerpt(); ?></p>
                </article>
                <footer class="small-12 medium-3 columns d-table post-info text-right">
                    <p><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="button round no-margin">Ver tratamento</a></p>
                </footer>
            </div>
            <?php
                endwhile;
            ?>
            
            <div class="divide-20"></div>
            <article class="small-12 columns text-center">
                <h1><a href="#" class="button round">ver todos os tratamentos</a></h1>
            </article>
        </div>
    </nav>
<?php get_footer(); ?>
