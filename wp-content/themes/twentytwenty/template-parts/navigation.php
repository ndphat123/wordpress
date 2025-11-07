<?php
/**
 * Custom post navigation (vertical date style)
 * @package WordPress
 * @subpackage Twenty_Twenty
 */

$next_post = get_next_post();
$prev_post = get_previous_post();

if ( $next_post || $prev_post ) :
?>

<nav class="custom-post-navigation section-inner" aria-label="<?php esc_attr_e( 'Post', 'twentytwenty' ); ?>">

    <div class="custom-post-nav-list">

        <?php if ( $prev_post ) : ?>
            <div class="nav-item prev-post">
                <div class="nav-date">
                    <span class="day"><?php echo get_the_date( 'd', $prev_post->ID ); ?></span>
                    <span class="divider">—</span>
                    <span class="month"><?php echo get_the_date( 'm', $prev_post->ID ); ?></span>
                    <span class="year"><?php echo get_the_date( 'y', $prev_post->ID ); ?></span>
                </div>
                <a class="nav-title" href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>">
                    <?php echo esc_html( get_the_title( $prev_post->ID ) ); ?>
                </a>
            </div>
        <?php endif; ?>

        <?php if ( $next_post ) : ?>
            <div class="nav-item next-post">
                <div class="nav-date">
                    <span class="day"><?php echo get_the_date( 'd', $next_post->ID ); ?></span>
                    <span class="divider">—</span>
                    <span class="month"><?php echo get_the_date( 'm', $next_post->ID ); ?></span>
                    <span class="year"><?php echo get_the_date( 'y', $next_post->ID ); ?></span>
                </div>
                <a class="nav-title" href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>">
                    <?php echo esc_html( get_the_title( $next_post->ID ) ); ?>
                </a>
            </div>
        <?php endif; ?>

    </div>

</nav>

<?php endif; ?>
