<?php

/**
 * The main template file
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 */

get_header();
?>

<div id="tdc-homepage-layout">

    <?php if (is_front_page()) : // ===== CHỈ HIỂN THỊ TRÊN TRANG CHỦ ===== 
    ?>
        <aside class="tdc-sidebar-left">
            <h3>Xem nhiều</h3>
            <div class="tdc-popular-grid">
                <?php
                $recent_posts_args = array(
                    'posts_per_page'      => 6,
                    'orderby'             => 'date',
                    'order'               => 'DESC',
                    'ignore_sticky_posts' => true
                );

                $recent_posts_query = new WP_Query($recent_posts_args);

                if ($recent_posts_query->have_posts()) {
                    $index = 0;
                    while ($recent_posts_query->have_posts()) {
                        $recent_posts_query->the_post();
                        $index++;
                        printf(
                            '<div class="tdc-popular-grid-item">
                            <span class="tdc-popular-number">%1$s</span>
                            <a href="%2$s" class="tdc-popular-title">%3$s</a>
                        </div>',
                            $index,
                            esc_url(get_permalink()),
                            esc_html(get_the_title())
                        );
                    }
                    wp_reset_postdata();
                } else {
                    echo '<div class="tdc-popular-grid-item">Không có bài viết gần đây nào.</div>';
                }
                ?>
            </div>
        </aside>
    <?php endif; ?>


    <?php if (is_search()) : // ===== TRANG TÌM KIẾM ===== 
    ?>
        <!-- 🔹 CỘT TRÁI: Bài viết mới nhất -->
        <aside class="tdc-sidebar-left">
            <h3>Trang mới nhất</h3>
            <?php
            $recent_posts = wp_get_recent_posts(array(
                'numberposts' => 3,
                'post_status' => 'publish'
            ));

            if ($recent_posts) :
                foreach ($recent_posts as $post) :
                    $categories = get_the_category($post['ID']);
                    $category_name = !empty($categories) ? $categories[0]->name : 'Chưa phân loại';
            ?>
                    <div class="latest-post-item">
                        <h4 class="latest-post-heading">
                            <a href="<?php echo get_permalink($post['ID']); ?>">
                                <?php echo wp_trim_words($post['post_title'], 8, '...'); ?>
                            </a>
                        </h4>
                        <a href="<?php echo get_permalink($post['ID']); ?>" class="latest-post-thumbnail">
                            <?php echo get_the_post_thumbnail($post['ID'], 'medium'); ?>
                        </a>
                        <p class="latest-post-excerpt">
                            <?php echo wp_trim_words($post['post_content'], 25, '...'); ?>
                        </p>
                        <div class="latest-post-category">
                            Ngành: <?php echo esc_html($category_name); ?>
                        </div>
                    </div>
            <?php
                endforeach;
            else :
                echo '<p>Không có bài viết mới nào.</p>';
            endif;
            ?>
        </aside>
    <?php endif; ?>



    <main id="site-content" class="tdc-content-center">
        <?php
        if (have_posts()) {
            while (have_posts()) {
                the_post();
                get_template_part('template-parts/content', get_post_type());
            }
        } elseif (is_search()) {
        ?>
            <!-- ✅ Khi không có kết quả tìm kiếm -->
            <div class="no-search-results">
                <header class="archive-header">
                    <div class="archive-header-inner">
                        <h1 class="archive-title">
                            <span class="color-accent">Kết quả tìm kiếm:</span>
                            "<?php echo esc_html(get_search_query()); ?>"
                        </h1>

                        <!-- Ô tìm kiếm hiển thị cùng hàng -->
                        <div class="no-search-results-form section-inner thin">
                            <?php get_search_form(array('aria_label' => __('search again', 'twentytwenty'))); ?>
                        </div>
                    </div>

                    <div class="archive-subtitle">
                        <p>Không tìm thấy kết quả nào phù hợp. Vui lòng thử lại với từ khóa khác.</p>
                    </div>
                </header>
            </div>
        <?php
        } else {
            echo '<p>Không tìm thấy bài viết nào.</p>';
        }

        get_template_part('template-parts/pagination');
        ?>
    </main>



    <?php if (is_front_page()) : // ===== CỘT PHẢI TRANG CHỦ ===== 
    ?>
        <aside class="tdc-sidebar-right">
            <h3>Comments</h3>
            <ul class="tdc-comments-list">
                <?php
                $comments = get_comments(array(
                    'number'      => 8,
                    'status'      => 'approve',
                    'type'        => 'comment',
                    'post_status' => 'publish'
                ));

                if ($comments) {
                    foreach ($comments as $comment) {
                        printf(
                            '<li><a href="%s" class="tdc-comment-content">%s</a></li>',
                            esc_url(get_comment_link($comment)),
                            esc_html($comment->comment_content)
                        );
                    }
                } else {
                    echo '<li>Không có bình luận nào.</li>';
                }
                ?>
            </ul>
        </aside>
    <?php endif; ?>


    <?php if (is_search()) : // ===== CỘT PHẢI TRANG TÌM KIẾM ===== 
    ?>
        <aside class="tdc-sidebar-right">
            <h3>Bình luận mới nhất</h3>
            <ul class="tdc-comments-list">
                <?php
                $comments = get_comments(array(
                    'number'      => 10,
                    'status'      => 'approve',
                    'type'        => 'comment',
                    'hierarchical' => 'threaded'
                ));

                if ($comments) :
                    // Hàm đệ quy hiển thị comment và phản hồi
                    function tdc_render_comment($comment, $depth = 0)
                    {
                ?>
                        <li class="comment-item depth-<?php echo $depth; ?>">
                            <div class="comment-avatar">
                                <?php echo get_avatar($comment->comment_author_email, 40); ?>
                            </div>
                            <div class="comment-content-box">
                                <div class="comment-author-box">
                                    <span class="comment-author-name"><?php echo esc_html($comment->comment_author); ?></span>
                                </div>
                                <div class="comment-text">
                                    <?php echo esc_html(wp_trim_words($comment->comment_content, 15, '...')); ?>
                                </div>
                            </div>
                        </li>
                <?php
                        // Lấy phản hồi con
                        $child_comments = get_comments(array(
                            'parent' => $comment->comment_ID,
                            'status' => 'approve',
                        ));
                        if ($child_comments) {
                            echo '<ul class="comment-children">';
                            foreach ($child_comments as $child) {
                                tdc_render_comment($child, $depth + 1);
                            }
                            echo '</ul>';
                        }
                    }

                    // Lặp bình luận gốc
                    foreach ($comments as $comment) {
                        if ($comment->comment_parent == 0) {
                            tdc_render_comment($comment);
                        }
                    }
                else :
                    echo '<li>Chưa có bình luận nào.</li>';
                endif;
                ?>
            </ul>
        </aside>
    <?php endif; ?>


</div>
<!-- thêm bình luận ở cuối dòng search -->
 <?php if ( is_search() ) : ?>
    <section class="tdc-latest-news section-inner">
        <h3 class="tdc-latest-title">Latest News</h3>
        <ul class="tdc-latest-list">
            <?php
            $latest_news = new WP_Query(array(
                'posts_per_page' => 3, // số bài mới nhất
                'orderby' => 'date',
                'order' => 'DESC',
            ));

            if ($latest_news->have_posts()) :
                while ($latest_news->have_posts()) : $latest_news->the_post(); ?>
                    <li class="tdc-latest-item">
                        <span class="tdc-latest-dot"></span>
                        <div class="tdc-latest-content">
                            <a href="<?php the_permalink(); ?>" class="tdc-latest-title-link"><?php the_title(); ?></a>
                            <p class="tdc-latest-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?></p>
                        </div>
                        <span class="tdc-latest-date"><?php echo get_the_date('d F, Y'); ?></span>
                    </li>
                <?php endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </ul>
    </section>
<?php endif; ?>


<?php get_template_part('template-parts/footer-menus-widgets'); ?>
<?php get_footer(); ?>