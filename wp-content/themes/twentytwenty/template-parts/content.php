<?php

/**
 * Template hiển thị nội dung cho bài viết, dùng chung cho:
 * - Trang chủ / archive
 * - Trang tìm kiếm (is_search)
 * - Trang chi tiết (is_single)
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 */

?>

<article <?php post_class('tdc-news-item'); ?> id="post-<?php the_ID(); ?>">

    <?php if (is_search()) : ?>
        <!-- ========== GIAO DIỆN KẾT QUẢ TÌM KIẾM ========== -->
        <div class="search-results-container">
            <div class="search-card">

                <!-- ẢNH ĐẠI DIỆN -->
                <?php if (has_post_thumbnail()) : ?>
                    <div class="search-thumb">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('medium_large'); ?>
                        </a>
                    </div>
                <?php endif; ?>

                <!-- NỘI DUNG BÊN PHẢI -->
                <div class="search-content">

                    <!-- NGÀY THÁNG -->
                    <div class="search-date">
                        <div class="day"><?php echo get_the_date('d'); ?></div>
                        <div class="month"><?php echo strtoupper(get_the_date('M')); ?></div>
                    </div>

                    <!-- THÔNG TIN CHÍNH -->
                    <div class="search-text">
                        <h2 class="search-title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h2>
                        <div class="search-excerpt">
                            <?php the_excerpt(); ?>
                        </div>
                    </div>
                </div><!-- .search-content -->
            </div><!-- .search-card -->
        </div><!-- .search-results-container -->

    <?php elseif (!is_single()) : ?>
        <!-- ========== GIAO DIỆN DANH SÁCH BÀI VIẾT (KHÔNG ẢNH) ========== -->
        <div class="tdc-news-wrapper">
            <div class="tdc-date-col">
                <div class="date-day"><?php echo get_the_date('d'); ?></div>
                <div class="date-month"><?php echo get_the_date('F'); ?></div>
            </div>
            <div class="tdc-vertical-divider"></div>
            <div class="tdc-content-col">
                <h2 class="tdc-news-title">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h2>
                <div class="tdc-news-excerpt">
                    <?php the_excerpt(); ?>
                </div>
            </div>
        </div>

    <?php else : ?>
        <!-- ========== GIAO DIỆN TRANG CHI TIẾT (ĐỒNG HỒ NGANG TIÊU ĐỀ + COMMENT ĐẸP) ========== -->
        <div class="tdc-single-layout">

            <!-- Cột trái: Categories -->
            <aside class="sidebar-left">
                <h3>Categories</h3>
                <ul>
                    <?php wp_list_categories(['title_li' => '']); ?>
                </ul>
            </aside>

            <!-- Cột giữa: Nội dung bài viết -->
            <div class="tdc-single-wrapper">

                <!-- TIÊU ĐỀ + NGÀY THÁNG NGANG HÀNG -->
                <div class="tdc-single-header">
                    <h1 class="tdc-single-title"><?php the_title(); ?></h1>
                    <div class="tdc-date-circle beside-title">
                        <div class="day"><?php echo get_the_date('d'); ?></div>
                        <div class="line-year">
                            <span class="line">——</span>
                            <span class="year"><?php echo get_the_date('y'); ?></span>
                        </div>
                        <div class="month"><?php echo get_the_date('m'); ?></div>
                    </div>
                </div>



                <!-- NỘI DUNG BÀI VIẾT -->
                <div class="tdc-single-content">
                    <?php the_content(); ?>
                </div>

                <!-- ĐIỀU HƯỚNG -->
                <div class="post-footer section-inner">
                    <?php get_template_part('template-parts/navigation'); ?>
                </div>

                <!-- PHẦN BÌNH LUẬN -->
                <?php if (comments_open() || get_comments_number()) : ?>
                    <div class="tdc-comments-box">
                        <?php comments_template(); ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Cột phải: Bài viết gần đây -->
            <aside class="sidebar-right">
                <h3>Bài viết gần đây</h3>
                <ul class="recent-posts-list">
                    <?php
                    $recent_posts = wp_get_recent_posts([
                        'numberposts' => 5,
                        'post_status' => 'publish',
                        'suppress_filters' => false
                    ]);

                    foreach ($recent_posts as $post) :
                        // Thiết lập các biến ngày tháng
                        $day = get_the_date('d', $post['ID']);
                        $month = get_the_date('m', $post['ID']);
                        $year = get_the_date('y', $post['ID']); // Lấy năm 2 chữ số
                    ?>
                        <li class="nav-item">
                            <div class="nav-date">
                                <span class="day"><?php echo $day; ?></span>
                                <span class="divider">—</span> <span class="month"><?php echo $month; ?></span>
                                <span class="year"><?php echo $year; ?></span>
                            </div>
                            <div class="nav-divider-col"></div>
                            <div class="nav-content-col">
                                <a href="<?php echo get_permalink($post['ID']); ?>" class="nav-post-title">
                                    <?php echo esc_html($post['post_title']); ?>
                                </a>
                            </div>
                        </li>
                    <?php endforeach;
                    wp_reset_query(); ?>
                </ul>
            </aside>
        </div>
    <?php endif; ?>