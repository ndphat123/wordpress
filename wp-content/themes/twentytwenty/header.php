<?php
/**
 * Header file for the Twenty Twenty WordPress default theme.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */
?>
<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header id="site-header" class="header-footer-group color-header">
    <div class="header-inner section-inner">
        <div class="header-titles-wrapper">

            <?php
            $enable_header_search = get_theme_mod( 'enable_header_search', true );
            if ( true === $enable_header_search ) :
            ?>
                <button class="toggle search-toggle mobile-search-toggle" data-toggle-target=".search-modal"
                        data-toggle-body-class="showing-search-modal" data-set-focus=".search-modal .search-field"
                        aria-expanded="false">
                    <span class="toggle-inner">
                        <span class="toggle-icon">
                            <?php twentytwenty_the_theme_svg( 'search' ); ?>
                        </span>
                        <span class="toggle-text"><?php _ex( 'Search', 'toggle text', 'twentytwenty' ); ?></span>
                    </span>
                </button>
            <?php endif; ?>

            <div class="header-titles">
                <?php twentytwenty_site_description(); ?>
            </div>

            <div class="title-edit"><?php twentytwenty_site_logo(); ?></div>
            <div class="header-search-form"><?php get_search_form(); ?></div>

            <button class="toggle nav-toggle mobile-nav-toggle" data-toggle-target=".menu-modal"
                    data-toggle-body-class="showing-menu-modal" aria-expanded="false"
                    data-set-focus=".close-nav-toggle">
                <span class="toggle-inner">
                    <span class="toggle-icon">
                        <?php twentytwenty_the_theme_svg( 'ellipsis' ); ?>
                    </span>
                    <span class="toggle-text"><?php _e( 'Menu', 'twentytwenty' ); ?></span>
                </span>
            </button>

        </div><!-- .header-titles-wrapper -->

        <div class="header-navigation-wrapper">

            <?php
            if ( has_nav_menu( 'primary' ) || ! has_nav_menu( 'expanded' ) ) :
            ?>
                <nav class="primary-menu-wrapper" aria-label="<?php echo esc_attr_x( 'Horizontal', 'menu', 'twentytwenty' ); ?>">
                    <ul class="primary-menu reset-list-style">
                        <?php
                        if ( has_nav_menu( 'primary' ) ) {
                            wp_nav_menu(
                                array(
                                    'container'  => '',
                                    'items_wrap' => '%3$s',
                                    'theme_location' => 'primary',
                                )
                            );
                        } elseif ( ! has_nav_menu( 'expanded' ) ) {
                            wp_list_pages(
                                array(
                                    'match_menu_classes' => true,
                                    'show_sub_menu_icons' => true,
                                    'title_li' => false,
                                    'walker'   => new TwentyTwenty_Walker_Page(),
                                )
                            );
                        }
                        ?>
                    </ul>
                </nav>
            <?php endif; ?>

            <?php if ( true === $enable_header_search || has_nav_menu( 'expanded' ) ) : ?>
                <div class="header-toggles hide-no-js">

                    <?php if ( has_nav_menu( 'expanded' ) ) : ?>
                        <div class="toggle-wrapper nav-toggle-wrapper has-expanded-menu">
                            <button class="toggle nav-toggle desktop-nav-toggle" data-toggle-target=".menu-modal"
                                    data-toggle-body-class="showing-menu-modal" aria-expanded="false"
                                    data-set-focus=".close-nav-toggle">
                                <span class="toggle-inner">
                                    <span class="toggle-text"><?php _e( 'Menu', 'twentytwenty' ); ?></span>
                                    <span class="toggle-icon">
                                        <?php twentytwenty_the_theme_svg( 'ellipsis' ); ?>
                                    </span>
                                </span>
                            </button>
                        </div>
                    <?php endif; ?>

                    <?php if ( true === $enable_header_search ) : ?>
                        <div class="toggle-wrapper search-toggle-wrapper">
                            <button class="toggle search-toggle desktop-search-toggle" data-toggle-target=".search-modal"
                                    data-toggle-body-class="showing-search-modal"
                                    data-set-focus=".search-modal .search-field" aria-expanded="false">
                                <span class="toggle-inner">
                                    <?php twentytwenty_the_theme_svg( 'search' ); ?>
                                    <span class="toggle-text"><?php _ex( 'Search', 'toggle text', 'twentytwenty' ); ?></span>
                                </span>
                            </button>
                        </div>
                    <?php endif; ?>

                    <!-- ✅ Account Dropdown -->
                    <div class="account-toggle-wrapper">
                        <div class="header-account">
                            <?php if ( is_user_logged_in() ) : ?>
                                <div class="account-icon-dropdown">
                                    <a href="#" class="account-toggle">
                                        <div class="account-icon-wrap">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="28" height="28" fill="currentColor">
                                                <path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z"/>
                                            </svg>
                                            <span class="account-text"><?php _e( 'Tài khoản ▼', 'twentytwenty' ); ?></span>
                                        </div>
                                    </a>
                                    <div class="account-dropdown-menu">
                                        <a href="<?php echo admin_url( 'profile.php' ); ?>">
                                            <?php _e( 'Hồ sơ của tôi', 'twentytwenty' ); ?>
                                        </a>
                                        <a href="<?php echo wp_logout_url( home_url() ); ?>">
                                            <?php _e( 'Đăng xuất', 'twentytwenty' ); ?>
                                        </a>
                                    </div>
                                </div>
                            <?php else : ?>
                                <a href="<?php echo wp_login_url(); ?>" class="login-link toggle">
                                    <span class="toggle-inner">
                                        <?php twentytwenty_the_theme_svg( 'user' ); ?>
                                        <span class="toggle-text"><?php _e( 'Login', 'twentytwenty' ); ?></span>
                                    </span>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <!-- /Account Dropdown -->

                </div><!-- .header-toggles -->
            <?php endif; ?>

        </div><!-- .header-navigation-wrapper -->
    </div><!-- .header-inner -->

    <?php
    if ( true === $enable_header_search ) {
        get_template_part( 'template-parts/modal-search' );
    }
    ?>
</header><!-- #site-header -->

<?php
get_template_part( 'template-parts/modal-menu' );
?>

<!-- ✅ Script bật/tắt dropdown -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    const toggle = document.querySelector(".account-icon-dropdown .account-toggle");
    const wrapper = document.querySelector(".account-icon-dropdown");

    if (toggle && wrapper) {
        toggle.addEventListener("click", function(e) {
            e.preventDefault();
            wrapper.classList.toggle("active");
        });

        document.addEventListener("click", function(e) {
            if (!wrapper.contains(e.target)) {
                wrapper.classList.remove("active");
            }
        });
    }
});
</script>

<?php wp_footer(); ?>
</body>
</html>
