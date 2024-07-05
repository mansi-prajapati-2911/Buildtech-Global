<?php
/**
 * The template for displaying singular post-types: posts, pages and user-defined custom post types.
 *
 * @package HelloElementor
 */
get_header();
?>

<main <?php post_class( 'site-main' ); ?> role="main">
	<div class="psg-single-blog-main">
		<div class="psg-blog-back-btn">
			<a href="<?php echo esc_url( get_permalink(441) ); ?>"><i class="fal fa-arrow-left"></i> <span>Back</span></a>
		</div>
	
		<?php while ( have_posts() ) : the_post(); ?>
		<div  class="psg-single-blog-inner">
			<div class="psg-single-blog-row">
				<div class="psg-single-blog-left">
					<?php $post_date = get_the_date( 'd F Y' );?>
					<p class="psg-single-blog-date"><?php echo $post_date; ?></p>
					<h1 class="psg-blog-title"> <?php the_title();	?> </h1>
					<div class="psg-single-blog-social-icons">
						<span class="psg-single-blog-social-label">Share to:</span>
						<ul>
							<li>
								<a href="<?php echo esc_url('https://www.facebook.com/sharer/sharer.php?u='.urlencode(get_permalink())); ?>" target="_blank">
									<i class="fab fa-facebook-f"></i>
								</a>
							</li>
							<li>
								<a href="<?php echo esc_url('https://twitter.com/intent/tweet?text='.urlencode(get_the_title()).'&amp;url='.urlencode(get_permalink())); ?>" target="_blank">
									<i class="fab fa-twitter"></i>
								</a>
							</li>
							<li>
								<a href="<?php echo esc_url('https://www.linkedin.com/shareArticle?mini=true&url='.urlencode(get_permalink()).'&amp;title='.urlencode(get_the_title())); ?>&amp;summary=<?php echo urlencode(get_the_excerpt()); ?>" target="_blank">
									<i class="fab fa-linkedin-in"></i>
								</a>
							</li>
							<li>
								<a href="<?php echo esc_url('https://api.whatsapp.com/send?text='.urlencode(get_permalink())); ?>" target="_blank">
									<i class="fab fa-whatsapp"></i>
								</a>
							</li>
							<li class="psg-copy-link">
								<p class="psg-social-link-copy" id="p1" style="display: none;"><?php the_permalink(); ?></p>
								<button class="psg-social-link-btn" onclick="copyToClipboard('#p1')"><i class="fal fa-link"></i>
									<span class="psg-hover-tooltip">
										<a href="#" data-toggle="tooltip" data-placement="right" title="Copied">Copied</a>
									</span>
								</button>
							</li>
							
						</ul>
					</div> 
				</div>
				<div class="psg-single-blog-feature-image">
					<?php echo get_the_post_thumbnail( $post->ID, 'full' ); ?>
				</div>
			</div>
			<?php 
			if( '' !== get_post()->post_content ) {
				echo '<div class="psg-single-blog-content">';
				  the_content(); 
				echo '</div>';
			}
			?>
			

			<?php /* comments_template(); */ ?>

		</div>
		<?php endwhile; ?>	
	
	</div>
</main>
<?php 
get_sidebar();
get_footer();

?>