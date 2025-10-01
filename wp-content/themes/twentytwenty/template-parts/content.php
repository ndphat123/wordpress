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

<article <?php post_class('tdc-news-item'); ?> id="post-<?php the_ID(); ?>">

    <div class="tdc-news-wrapper">

        <?php if (!is_single()) : ?>
            <!-- Ảnh bên trái -->
            <div class="tdc-news-thumb">
                <a href="<?php the_permalink(); ?>">
                    <?php
                    if (has_post_thumbnail()) {
                        the_post_thumbnail('medium');
                    } else {
                        echo '<img src="https://via.placeholder.com/250x180" alt="No image">';
                    }
                    ?>
                </a>
            </div>

            <!-- Nội dung bên phải -->
            <div class="tdc-news-content">

                <!-- Ngày tháng -->
                <div class="tdc-news-date">
                    <?php echo get_the_date('d M Y'); ?>
                </div>

                <!-- Tiêu đề -->
                <h2 class="tdc-news-title">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h2>

                <!-- Categories -->
                <div class="tdc-news-category">
                    <?php the_category(', '); ?>
                </div>
            <?php endif; ?>


            <!-- Mô tả -->
            <div class="tdc-news-excerpt">
                <?php
                if (is_single()) {
                    the_content();
                } else {
                    the_excerpt();
                }
                ?>
            </div>

            
            <!-- // Chỉ hiển thị bình luận trong trang single -->
            <!-- if (is_single() && (comments_open() || get_comments_number())) { -->
                <!-- comments_template(); -->
            <!-- } -->
        


            
            </div>
    </div>
    <?php
            // Hiển thị danh sách bình luận + form bình luận
            if (comments_open() || get_comments_number()) {
                comments_template();
            }
            ?>
</article>