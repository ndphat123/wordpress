<?php
/**
 * Template Name: Latest News Timeline
 * Description: Hiển thị 3 bài viết mới nhất theo dạng timeline.
 */
get_header(); ?>

<section class="latest-news-section container">
    <h2 class="latest-news-title">Trang mới nhất</h2>

    <div class="news-list">
        <?php
        $args = array(
            'post_type'      => 'post',
            'posts_per_page' => 3,
        );
        $latest_posts = new WP_Query($args);

        if ($latest_posts->have_posts()) :
            while ($latest_posts->have_posts()) : $latest_posts->the_post(); ?>
                <article class="news-card">
                    <div class="news-image">
                        <?php if (has_post_thumbnail()) {
                            the_post_thumbnail('medium');
                        } ?>
                    </div>
                    <div class="news-info">
                        <div class="news-date">
                            <span class="day"><?php echo get_the_date('d'); ?></span>
                            <span class="month"><?php echo strtoupper(get_the_date('M')); ?></span>
                        </div>
                        <div class="news-content">
                            <h3 class="news-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h3>
                            <p class="news-excerpt"><?php echo wp_trim_words(get_the_content(), 30, '...'); ?></p>
                        </div>
                    </div>
                </article>
            <?php endwhile;
            wp_reset_postdata();
        else : ?>
            <p>Không tìm thấy bài viết nào.</p>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>
