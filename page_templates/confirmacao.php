<?php 
/**
      * Template Name: Confirmação de envio de email
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
                    <h1 class="white no-margin">E-mail enviado</h1>
                </header>
            </div>
        </div>
    </section>

    <div class="small-12 left template-content">
        <div class="row">
            <div class="blockquote small-12 medium-5 columns">
                <h2 class="primary divide-10">Seu email foi enviada com sucesso</h2>
                <h5 class="divide-20 ghost font-regular">Aguarde nossa resposta</h5>
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
                <p>Aguarde. Você está sendo redirecionado...</p>
            </article>
        </div>
    </div>

    <script>
        window.onload = function() {
            setTimeout(function() { window.location.href = '<?php echo home_url(); ?>'; }, 3000);
        }
    </script>
<?php get_footer(); ?>
