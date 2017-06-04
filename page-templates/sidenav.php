<?php
/*
Template Name: Sidenav Page

This template is used to display a sidenav for l o n g content

*/

get_header();

$template = uswds_template_settings('template');
$sidebar_position = get_theme_mod($template . '_sidebar_position_setting');

$main_width = uswds_get_main_width($sidebar_position);
$main_width .= ' ' . uswds_get_width_visibility($template, $sidebar_position);

if( !uswds_hide_layout_part('page-content', $template) ):
?>


<section id="primary" class="usa-grid usa-section">

    <?php
    if($sidebar_position == 'left'):
        uswds_sticky_sidenav($post->ID);
    endif;
    ?>
    <div class="usa-width-two-thirds">
    	<?php
    	while ( have_posts() ) : the_post();

    		get_template_part( 'template-parts/content', 'page' );

    		the_post_navigation();

    		// If comments are open or we have at least one comment, load up the comment template.
    		if ( comments_open() || get_comments_number() ) :
    			comments_template();
    		endif;

    	endwhile; // End of the loop.
    	?>
    </div>
    <?php
    if($sidebar_position == 'right'):
        uswds_sticky_sidenav($post->ID);
    endif;
    ?>

</section>

<?php
endif;
get_footer();
