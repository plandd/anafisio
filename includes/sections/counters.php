    <?php  
      global $plandd_option;
    ?>
    <section id="count-user" class="row">
      <header class="small-12 medium-8 medium-offset-2 columns text-center">
        <h3 class="primary no-margin"><?php echo $plandd_option['numbers-intro'] ?></h3>
      </header>

      <div class="counter-list small-12 columns">
        <?php
          $counters = $plandd_option['numbers-sortable'];
          foreach ($counters as $count):
            $explode = explode(', ', $count);
        ?>
        <hgroup class="small-15 medium-3 columns text-center">
          <h1 class="info no-margin lh-small timer" data-to="<?php echo $explode[0]; ?>" data-speed="2000"></h1>
          <h5 class="no-margin font-regular ghost"><?php echo $explode[1]; ?></h5>
        </hgroup>
        <?php endforeach; ?>

        <hgroup class="small-15 medium-3 columns text-center">
          <h1 class="info no-margin lh-small timer" data-to="<?php echo wp_count_posts()->publish; ?>" data-speed="1000"></h1>
          <h5 class="no-margin font-regular ghost">Tratamentos</h5>
        </hgroup>
      </div>

      <article class="small-12 columns text-center">
        <h3 class="font-regular primary divide-20"><?php echo $plandd_option['number-desc']; ?></h3>
        <h1><a href="#" class="button round">ver todos os tratamentos</a></h1>
      </article>
    </section>