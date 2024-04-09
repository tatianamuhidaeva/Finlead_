<?php
/**
 * Single post partial template
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

  <header class="entry-header">

    <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

    <div class="entry-meta">

      <?php understrap_posted_on(); ?>

    </div><!-- .entry-meta -->

  </header><!-- .entry-header -->

  <?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>

  <div class="entry-content">

    <?php
		the_content();
		?>
    <?php
// Find connected pages
$connected = new WP_Query( array(
  'connected_type' => 'city_to_objs',
  'connected_items' => get_queried_object(),
  'nopaging' => true,
	'limit' => 10
) );

// Display connected pages
if ( $connected->have_posts() ) :
?>
    <h3>Объекты недвижимости города <?php the_title();?>:</h3>
    <ul>
      <?php while ( $connected->have_posts() ) : $connected->the_post(); ?>
      <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
      <?php endwhile; ?>
    </ul>

    <?php 
// Prevent weirdness
wp_reset_postdata();

endif;
?>
    <?php
		understrap_link_pages();
		?>

  </div><!-- .entry-content -->

  <footer class="entry-footer">

    <?php understrap_entry_footer(); ?>

  </footer><!-- .entry-footer -->

</article><!-- #post-<?php the_ID(); ?> -->