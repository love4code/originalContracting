<?php
/**
 * Created by PhpStorm.
 * User: grover family
 * Date: 12/21/2015
 * Time: 4:45 PM
 */
get_header(); ?>

    <?php
        if( have_posts() ):
            while( have_posts() ): the_post(); ?>
                <?php get_template_part('template-parts/content',get_post_format()); ?>
    <?php   endwhile;

        endif;
    ?>

<?php
get_footer();
?>