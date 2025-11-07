<?php

/**
 * Template for search results page
 * Hiển thị bố cục riêng cho trang tìm kiếm mà KHÔNG ảnh hưởng trang chủ
 */

get_header(); ?>

<main id="site-content" role="main">

    <div class="search-results-container">
        <h1 class="search-title">
            Tìm kiếm: <span>"<?php echo get_search_query(); ?>"</span>
        </h1>
        <p>Chúng tôi đã tìm thấy <?php echo $wp_query->found_posts; ?> kết quả tìm kiếm.</p>

        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <article class="search-item" id="post-<?php the_ID(); ?>">
                    <div class="search-card">
                        <!-- Cột trái: Ảnh thumbnail -->
                        <div class="search-thumb">
                            <a href="<?php the_permalink(); ?>">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail('medium'); ?>
                                <?php else : ?>
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/no-image.jpg" alt="No image">
                                <?php endif; ?>
                            </a>
                        </div>

                        <!-- Cột phải: Nội dung -->
                        <div class="search-content">
                            <div class="search-date">
                                <div class="day"><?php echo get_the_date('d'); ?></div>
                                <div class="month">Tháng <?php echo get_the_date('m'); ?></div>
                            </div>

                            <div class="search-text">
                                <h2 class="search-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h2>
                                <p class="search-excerpt"><?php echo get_the_excerpt(); ?></p>
                            </div>
                        </div>
                    </div>
                </article>
            <?php endwhile; ?>
        <?php else : ?>
            <p>Không tìm thấy kết quả nào.</p>
        <?php endif; ?>

    </div>

</main>

<?php get_footer(); ?>