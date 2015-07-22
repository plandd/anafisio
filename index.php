<?php get_header(); ?>

    <?php
        //Slider principal
        require get_template_directory()."/includes/sections/home_slider.php";
        
        //Barra ligamos para você
        require get_template_directory()."/includes/sections/tel_bar.php";
        
        //Serviços
        require get_template_directory()."/includes/sections/home_services.php";
        
        //Contadores
        require get_template_directory()."/includes/sections/counters.php";
        
        //Estrutura
        require get_template_directory()."/includes/sections/estructure.php";

        //MAp
        require get_template_directory()."/includes/sections/map.php";
    ?>

<?php get_footer(); ?>
