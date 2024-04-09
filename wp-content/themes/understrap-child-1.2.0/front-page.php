<?php
/**
 * The template for displaying FrontPage
 *
 * This is the template that displays FrontPage by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

$container = get_theme_mod( 'understrap_container_type' );

?>

<div class="wrapper" id="page-wrapper">

  <div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

    <div class="row">

      <?php
			// Do the left sidebar check and open div#primary.
			get_template_part( 'global-templates/left-sidebar-check' );
			?>

      <main class="site-main" id="main">
        <header class="entry-header">
          <h1 class="entry-title">Главная страница</h1>
        </header>
        <div class="objects">
          <h2 class="entry-title">Последние объекты недвижимости</h2>
          <div class="row">
            <?php
            global $wp_query;
            $args = [
              'post_type'   => 'nedvizhimost',
              'posts_per_page' => 6,
            ];
            $wp_query = new WP_Query($args);
            if ($wp_query->have_posts()) :
              while ($wp_query->have_posts()) : $wp_query->the_post();
                ?>
                  <div class="objects-item col-lg-4 col-md-6 col-12 mb-4">
                    <article id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
                      <div class="objects-wrapper">
                        <div class="objects-img">
                          <?php echo get_the_post_thumbnail( $post->ID, 'middle' ); ?>
                        </div>
                        <div class="objects-desc">
                          <?php 
                          echo '<a href="' . esc_url(get_permalink()) . '" class="link_objects">'; 
                          the_title('<span class="objects-title mb-4"></span>');
                          echo '</a>'; 
                          ?>
                          <ul>
                            <li>Площадь - <?php the_field('ploshhad');?> м2</li>
                            <li>Стоимость - <?php the_field('stoimost');?> р.</li>
                            <li>Адрес - <?php the_field('adres');?> </li>
                            <li>Жилая площадь - <?php the_field('zhilaya_ploshhad');?> м2</li>
                            <li>Этаж - <?php the_field('etazh');?></li>
                          </ul>
                          
                          
                        </div>
                      </div>
                    </article>
                  </div>
                  <?php
                endwhile;
                wp_reset_postdata(); ?>
            <?php endif; ?>
          </div>
        </div>

        <div class="cities">
          <h2 class="entry-title">Города</h2>
          <div class="row">
            <?php
            global $wp_query;
            $args = [
              'post_type'   => 'gorod',
              'posts_per_page' => 6,
            ];
            $wp_query = new WP_Query($args);
            if ($wp_query->have_posts()) :
              while ($wp_query->have_posts()) : $wp_query->the_post();
                ?>
                  <div class="cities-item col-lg-4 col-md-6 col-12 mb-4">
                    <article id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
                      <div class="cities-wrapper">
                        <div class="cities-img">
                          <?php echo get_the_post_thumbnail( $post->ID, 'middle' ); ?>
                        </div>
                        <div class="cities-desc">
                          <?php echo '<a href="' . esc_url(get_permalink()) . '" class="link_cities">'; ?>
                          <?php the_title('<span class="cities-title"></span>'); ?>
                          <?php echo '</a>'; ?>
                        </div>
                      </div>
                    </article>
                  </div>
                  <?php
                endwhile;
                wp_reset_postdata(); ?>
            <?php endif; ?>
          </div>
       
        </div>

        <div class="add_new_obj">
          
        <h2 class="entry-title">Добавление нового объекта недвижимости</h2>
        <?php
          
          acf_form(array(
              'post_id'       => 'new_post',
              'post_title'    => true,
              'post_content'  => true,
              'new_post'      => array(
                  'post_type'     => 'nedvizhimost',
                  'post_status'   => 'publish',
                  // 'tax_input'      => array( 'tip_nedvizhimosti' => array( 'kvartira', 'ofis', 'chastnyj-dom' ) )
              ),
              'submit_value'  => 'Добавить объект Недвижимости'
          ));
          
          ?>
        </div>
      </main>

      <?php
			// Do the right sidebar check and close div#primary.
			get_template_part( 'global-templates/right-sidebar-check' );
			?>

    </div><!-- .row -->

  </div><!-- #content -->

</div><!-- #page-wrapper -->

<?php
get_footer();