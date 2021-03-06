<?php 
/**
      * Template Name: Trabalhe conosco
      *
      * @package WordPress
      */
    get_header();
    global $post;
    $video = get_field('template_video',$post->ID);
    $imgbg = get_field('template_imgbg',$post->ID);
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

            <article class="small-12 medium-7 columns">
                <form class="small-12 left contact-form custom-form" data-title="Trabalhe conosco" enctype="multipart/form-data">
                    <label for="nome"><h5 class="primary">Seu nome <small class="ghost font-lite">* obrigatório</small></h5></label>
                    <input type="text" name="nome" id="nome" required placeholder="Digite seu nome completo">
                    <span class="erro-nome d-iblock small-12 left"></span>
                        
                    <label for="email"><h5 class="primary">E-mail</h5></label>
                    <input type="email" name="email" id="email" required placeholder="Digite seu email">

                    <label for="telefone"><h5 class="primary">Telefone <small class="ghost font-lite">* obrigatório</small></h5></label>
                    <input type="tel" name="telefone" id="telefone" required placeholder="(dd)">
                    <span class="erro-telefone d-iblock small-12 left"></span>
                    
                    <label for="papel" class="divide-10"><h5 class="primary">Você é</h5></label>
                    <p>
                        <label class="divide-10"><input type="radio" name="papel" value="Estudante" placeholder="(dd)" class="no-margin"><span>Estudante</span></label>

                        <label class="divide-10"><input type="radio" name="papel" value="Profissional" placeholder="(dd)" class="no-margin"><span>Profissional</span></label>
                    </p>


                    <label for="mensagem"><h5 class="primary">Deixe aqui sua mensagem</h5></label>
                    <textarea name="mensagem" id="mensagem" cols="30" rows="10" placeholder="Digite aqui..." class="small-12 left"></textarea>

                    <p class="small-12 left">
                        <label for="anexo divide-10"><h5 class="primary">Envie seu currículo <small class="ghost font-lite">* obrigatório</small></h5></label>
                        <input type="file" id="anexo" name="anexo">
                        <span class="erro-anexo d-iblock small-12 left"></span>
                    </p>

                    <p class="small-12 left text-right">
                        <button class="round">enviar</button>
                    </p>
                    <input type="hidden" name="page" value="<?php echo the_title(); ?>">
                </form>
            </article>
        </div>
    </div>
<?php get_footer(); ?>
