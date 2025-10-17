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

<?php if ( is_front_page() ) : // CHỈ HIỂN THỊ TRÊN TRANG CHỦ TĨNH ?>
	<aside class="tdc-sidebar-left">
        <h3>Xem nhiều</h3>
        
        <div class="tdc-popular-grid">
            <?php
            // Khối lấy các bài viết GẦN ĐÂY nhất
            $recent_posts_args = array(
                'posts_per_page'      => 6, // Lấy 6 bài viết gần đây
                'orderby'             => 'date', // Sắp xếp theo ngày đăng
                'order'               => 'DESC', // Mới nhất lên đầu
                'ignore_sticky_posts' => true
            );

            $recent_posts_query = new WP_Query( $recent_posts_args );

            if ( $recent_posts_query->have_posts() ) {
                $index = 0;
                while ( $recent_posts_query->have_posts() ) {
                    $recent_posts_query->the_post();
                    $index++;
                    // Sử dụng div để tạo mục con trong Grid
                    printf(
                        '<div class="tdc-popular-grid-item">
                            <span class="tdc-popular-number">%1$s</span>
                            <a href="%2$s" class="tdc-popular-title">%3$s</a>
                        </div>',
                        $index, // Số thứ tự
                        esc_url( get_permalink() ),
                        esc_html( get_the_title() )
                    );
                }
                wp_reset_postdata(); // Đặt lại dữ liệu bài viết
            } else {
                // Đảm bảo thông báo lỗi cũng nằm trong một mục grid
                echo '<div class="tdc-popular-grid-item">Không có bài viết gần đây nào.</div>';
            }
            ?>
        </div>
    </aside>
	<?php endif; // End if ( is_front_page() ) ?>

	<?php if ( is_search() ) : // Nếu là TRANG TÌM KIẾM, hiển thị "Pages" ?>
    <aside class="tdc-sidebar-left tdc-search-pages">
        <h3>Pages</h3> 
        <ul class="tdc-page-list">
            <?php
            // Lấy danh sách các trang (Pages)
            wp_list_pages( array(
                'title_li'    => '',
                'depth'       => 1, // Chỉ hiển thị trang cấp 1
                'sort_column' => 'menu_order',
                'number'      => 5,
            ) );
            ?>
        </ul>
    </aside>
    <?php 
	endif; // Kết thúc điều kiện cột trái
    ?>



	<main id="site-content" class="tdc-content-center">

		<?php
		// Bỏ qua phần hiển thị tiêu đề Archive/Search vì đây là trang chủ 
		// và đã được bao quanh bởi cấu trúc 3 cột.

		if (have_posts()) {
			while (have_posts()) {
				the_post();
				// Sử dụng template part để hiển thị bài viết (sử dụng content.php)
				get_template_part('template-parts/content', get_post_type());
			}
		} elseif (is_search()) {
			// Hiển thị form search nếu không có kết quả
		?>
			<div class="no-search-results-form section-inner thin">
				<?php get_search_form(array('aria_label' => __('search again', 'twentytwenty'),)); ?>
			</div>
		<?php
		} else {
			// Hiển thị thông báo nếu không có bài viết
			echo '<p>Không tìm thấy bài viết nào.</p>';
		}

		// Phân trang
		get_template_part('template-parts/pagination');
		?>

	</main>
	<?php if ( is_front_page() ) : // CHỈ HIỂN THỊ TRÊN TRANG CHỦ TĨNH ?>
	<aside class="tdc-sidebar-right">
		<h3>Comments</h3>
		<ul class="tdc-comments-list">
			<?php
			$comments = get_comments(array(
				'number'      => 8, // Số lượng comment muốn hiển thị
				'status'      => 'approve',
				'type'        => 'comment',
				'post_status' => 'publish'
			));

			if ($comments) {
				foreach ($comments as $comment) {
					// Hiển thị nội dung comment
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
	<?php endif; // End if ( is_front_page() ) ?>

</div> <?php get_template_part('template-parts/footer-menus-widgets'); ?>
<?php get_footer(); ?>