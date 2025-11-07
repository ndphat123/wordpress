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
        <!-- ========== GIAO DIỆN TRANG CHI TIẾT (CÓ ĐỒNG HỒ NGÀY THÁNG) ========== -->
        <div class="tdc-single-wrapper">

        <div class="border">
            <h1 class="tdc-single-title"><?php the_title(); ?></h1>
        </div>
            <!-- Đồng hồ ngày tháng góc phải -->
            <div class="tdc-date-circle">
                <div class="day"><?php echo get_the_date('d'); ?></div>
                <div class="line-year">
                    <span class="line">——</span>
                    <span class="year"><?php echo get_the_date('y'); ?></span>
                </div>
                <div class="month"><?php echo get_the_date('m'); ?></div>
            </div>


            <!-- Nội dung bài viết -->
            <div class="tdc-single-content">
                <?php the_content(); ?>
            </div>

            <!-- Navigation + Comment -->
            <div class="post-footer section-inner">
                <?php
                // Điều hướng bài trước / bài sau
                get_template_part('template-parts/navigation');

                // Hiển thị comment nếu bật
                // if ((comments_open() || get_comments_number()) && !post_password_required()) {
                //     echo '<div class="comments-wrapper section-inner">';
                //     comments_template();
                //     echo '</div>';
                // }
                ?>
            </div>

        </div>
    <?php endif; ?>

    <?php
    // Hiển thị bình luận nếu là bài viết chi tiết
    if (is_single() && (comments_open() || get_comments_number())) {
        comments_template();
    }
    ?>

</article>