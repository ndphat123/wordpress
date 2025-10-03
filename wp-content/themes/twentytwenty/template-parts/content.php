<?php

/**
 * The default template for displaying content
 *
 * Used for both singular and index.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

?>

<!--
    THÊM KIỂM TRA ĐIỀU KIỆN RÕ RÀNG HƠN:
    - Nếu là trang Single, chỉ cần wrapper và phần bình luận.
    - Nếu là trang Danh sách/Archive, hiển thị bố cục 2 cột.
-->

<article <?php post_class('tdc-news-item tdc-list-item-spacing'); ?> id="post-<?php the_ID(); ?>">

    <div class="tdc-news-wrapper">

        <?php if (!is_single()) : // Giao diện trang danh sách (Archive/Index) - Bố cục 2 cột [Ngày] | [Nội dung] ?>
            
            <!-- CỘT 1: Ngày tháng lớn -->
            <div class="tdc-date-col">
                <!-- Ngày (Ví dụ: 07) -->
                <div class="date-day font-bold text-6xl text-gray-800 leading-none">
                    <?php echo get_the_date('d'); ?>
                </div>
                <!-- Tháng (Ví dụ: THÁNG 10) -->
                <div class="date-month-year mt-1">
                    <span class="date-month-text uppercase text-sm text-gray-500 tracking-wider">
                        <?php 
                        // Sử dụng 'F' (tên tháng)
                        echo get_the_date('F'); 
                        ?>
                    </span>
                </div>
            </div>
            
            <!-- THÀNH PHẦN GIỮA: Dấu sọc đứng | -->
            <div class="tdc-vertical-divider"></div>

            <!-- CỘT 2: Nội dung (Tiêu đề, Mô tả) -->
            <div class="tdc-content-col">
                
                <!-- Tiêu đề -->
                <h2 class="tdc-news-title">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h2>

                <!-- Mô tả -->
                <div class="tdc-news-excerpt text-gray-600 text-sm mt-1">
                    <?php the_excerpt(); ?>
                </div>
                
            </div> <!-- Đóng .tdc-content-col -->

        <?php else : // Giao diện trang chi tiết (Single Post) ?>
            
            <!-- 
                TRANG CHI TIẾT: CHỈ HIỂN THỊ NỘI DUNG.
                Thông thường the_content() sẽ được gọi trong single.php, 
                nhưng nếu template này được include trong vòng lặp chính, 
                ta vẫn phải gọi the_content() ở đây, 
                NHƯNG ta không cần hiển thị lại tiêu đề và các metadata khác.
                Do bài viết của bạn bị lặp tiêu đề, tôi sẽ chỉ giữ lại the_content()
                để đảm bảo không bị thiếu nội dung.
            -->
            <div class="tdc-single-content">
                <?php the_content(); ?>
            </div>

        <?php endif; ?>

    </div> <!-- Đóng .tdc-news-wrapper -->

    <?php
        // Hiển thị danh sách bình luận + form bình luận, chỉ trên trang single
        if (is_single() && (comments_open() || get_comments_number())) {
            comments_template();
        }
    ?>

</article>
