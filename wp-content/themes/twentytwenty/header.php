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

    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php wp_head(); ?>

    <!-- BỔ SUNG CSS TÙY CHỈNH CHO FORM TÌM KIẾM -->
    <style>
        /* 1. Thiết lập Flexbox cho header để căn chỉnh các phần tử ngang hàng */
        .header-titles-wrapper {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
        }

        /* 2. Căn chỉnh vị trí của Form Search */
        /* Giả định: .header-titles chứa Logo/Title. .tdc-search-form cần nằm ngay sau menu Home. */
        /* Nếu form được đặt ngay trong header-titles-wrapper, ta có thể dùng order để định vị nó. */
        .tdc-search-form {
            /* Vị trí của form, order: 2, nằm giữa Logo (order 1) và Menu (order 3) */
            order: 2; 
            margin-right: 15px; /* Khoảng cách với các mục menu tiếp theo */
            /* Cần đảm bảo form hiển thị trên một hàng ngang */
            display: flex;
            align-items: center;
            
        }

        /* 3. Style chi tiết cho Form Search và Submit */
        .tdc-search-form .search-field {
            /* Trường nhập liệu */
            padding: 8px 12px;
            border: 1px solid #ccc;
            /* Đã xóa: border-right: none; -> Giờ đây có border riêng */
            border-radius: 4px; /* Bo góc đầy đủ */
            width: 250px; /* Tăng chiều rộng trường tìm kiếm */
            box-shadow: none; /* Loại bỏ shadow mặc định */
            transition: border-color 0.3s;
        }

        .tdc-search-form .search-field:focus {
            border-color: #555;
            outline: none;
            box-shadow: none;
        }

        .tdc-search-form .search-submit {
            /* Nút Submit */
            padding: 8px 15px;
            /* Giữ nguyên màu sắc theo yêu cầu, chỉ điều chỉnh border và góc bo */
            background-color: #f3f3f3; /* Màu nền nhẹ nhàng (nếu không có màu cụ thể) */
            color: #333;
            border: 1px solid #ccc; 
            /* Đã xóa: border-left: none; -> Giờ đây có border riêng */
            border-radius: 4px; /* Bo góc đầy đủ */
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            height: 38px; /* Đảm bảo chiều cao khớp với input */
            transition: background-color 0.2s;
            
            /* THÊM KHOẢNG CÁCH */
            margin-left: 8px; 
        }
        
        .tdc-search-form .search-submit:hover {
            background-color: #e6e6e6; /* Hiệu ứng hover nhẹ */
        }

        /* 4. Điều chỉnh cho màn hình nhỏ hơn (Mobile) */
        @media (max-width: 900px) {
            /* Ẩn form search này trên mobile hoặc di chuyển nó vào toggle menu nếu cần */
            .tdc-search-form {
                display: none; 
            }
        }
    </style>

</head>

<body <?php body_class(); ?>>

    <?php
    wp_body_open();
    ?>

    <header id="site-header" class="header-footer-group ">

        <div class="header-inner section-inner">

            <div class="header-titles-wrapper">

                <?php

                // Check whether the header search is activated in the customizer.
                $enable_header_search = get_theme_mod('enable_header_search', true);

                if (true === $enable_header_search) {

                ?>

                    <button class="toggle search-toggle mobile-search-toggle" data-toggle-target=".search-modal" data-toggle-body-class="showing-search-modal" data-set-focus=".search-modal .search-field" aria-expanded="false">
                        <span class="toggle-inner">
                            <span class="toggle-icon">
                                <?php twentytwenty_the_theme_svg('search'); ?>
                            </span>
                            <span class="toggle-text"><?php _ex('Search', 'toggle text', 'twentytwenty'); ?></span>
                        </span>
                    </button><!-- .search-toggle -->

                <?php } ?>

                <div class="header-titles">

                    <?php
                    // Site title or logo.
                    twentytwenty_site_logo();

                    // Site description.
                    twentytwenty_site_description();
                    ?>

                </div><!-- .header-titles -->

                <!-- Form tìm kiếm (Trường nhập + Nút Submit) -->
                <!-- Đặt ở đây để nó nằm ngay sau header-titles (Logo/Home) -->
                <form role="search" method="get" class="tdc-search-form" action="<?php echo esc_url(home_url('/')); ?>">
                    <label> <span class="screen-reader-text"><?php echo _x('Search for:', 'label', 'twentytwenty'); ?></span>
                        <input type="search" class="search-field" placeholder="<?php echo esc_attr_x('Search', 'placeholder', 'twentytwenty'); ?>" value="<?php echo get_search_query(); ?>" name="s" /> </label>
                    <input type="submit" class="search-submit" value="<?php echo esc_attr_x('Submit', 'submit button', 'twentytwenty'); ?>" />
                </form>

                <button class="toggle nav-toggle mobile-nav-toggle" data-toggle-target=".menu-modal" data-toggle-body-class="showing-menu-modal" aria-expanded="false" data-set-focus=".close-nav-toggle">
                    <span class="toggle-inner">
                        <span class="toggle-icon">
                            <?php twentytwenty_the_theme_svg('ellipsis'); ?>
                        </span>
                        <span class="toggle-text"><?php _e('Menu', 'twentytwenty'); ?></span>
                    </span>
                </button><!-- .nav-toggle -->

            </div><!-- .header-titles-wrapper -->

            <div class="header-navigation-wrapper">

                <?php
                if (has_nav_menu('primary') || ! has_nav_menu('expanded')) {
                ?>

                    <nav class="primary-menu-wrapper" aria-label="<?php echo esc_attr_x('Horizontal', 'menu', 'twentytwenty'); ?>">

                        <ul class="primary-menu reset-list-style">

                            <?php
                            if (has_nav_menu('primary')) {

                                wp_nav_menu(
                                    array(
                                        'container' 	=> '',
                                        'items_wrap' 	=> '%3$s',
                                        'theme_location' => 'primary',
                                    )
                                );
                            } elseif (! has_nav_menu('expanded')) {

                                wp_list_pages(
                                    array(
                                        'match_menu_classes' => true,
                                        'show_sub_menu_icons' => true,
                                        'title_li' 	=> false,
                                        'walker' 	=> new TwentyTwenty_Walker_Page(),
                                    )
                                );
                            }
                            ?>

                        </ul>

                    </nav><!-- .primary-menu-wrapper -->

                <?php
                }

                if (true === $enable_header_search || has_nav_menu('expanded')) {
                ?>

                    <div class="header-toggles hide-no-js">

                        <?php
                        if (has_nav_menu('expanded')) {
                        ?>

                            <div class="toggle-wrapper nav-toggle-wrapper has-expanded-menu">

                                <button class="toggle nav-toggle desktop-nav-toggle" data-toggle-target=".menu-modal" data-toggle-body-class="showing-menu-modal" aria-expanded="false" data-set-focus=".close-nav-toggle">
                                    <span class="toggle-inner">
                                        <span class="toggle-text"><?php _e('Menu', 'twentytwenty'); ?></span>
                                        <span class="toggle-icon">
                                            <?php twentytwenty_the_theme_svg('ellipsis'); ?>
                                        </span>
                                    </span>
                                </button><!-- .nav-toggle -->

                            </div><!-- .nav-toggle-wrapper -->

                        <?php
                        }

                        if (true === $enable_header_search) {
                        ?>

                            <div class="toggle-wrapper search-toggle-wrapper">

                                <button class="toggle search-toggle desktop-search-toggle" data-toggle-target=".search-modal" data-toggle-body-class="showing-search-modal" data-set-focus=".search-modal .search-field" aria-expanded="false">
                                    <span class="toggle-inner">
                                        <?php twentytwenty_the_theme_svg('search'); ?>
                                        <span class="toggle-text"><?php _ex('Search', 'toggle text', 'twentytwenty'); ?></span>
                                    </span>
                                </button><!-- .search-toggle -->

                            </div>

                        <?php
                        }
                        ?>

                    </div><!-- .header-toggles -->
                <?php
                }
                ?>

            </div><!-- .header-navigation-wrapper -->

        </div><!-- .header-inner -->

        <?php
        // Output the search modal (if it is activated in the customizer).
        if (true === $enable_header_search) {
            get_template_part('template-parts/modal-search');
        }
        ?>

    </header><!-- #site-header -->

    <?php
    // Output the menu modal.
    get_template_part('template-parts/modal-menu');
