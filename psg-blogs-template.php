<?php 
add_shortcode('psg_blog_archive_template_shortcode', 'psg_blog_archive_template'); 
function psg_blog_archive_template() {
ob_start();
	$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;	
	if ( get_query_var('paged') ) {
		$paged = get_query_var('paged');
	} elseif ( get_query_var('page') ) {
		$paged = get_query_var('page');
	} else {
		$paged = 1;
	}
	
?>
<div class="psg-blog-template-main-wrp">
	<div class="psg-blog-upper">
		<div class="psg-post-search-wrp">
			<input class="psg-post-search-inner" placeholder="Search by keywords" type="text" name="blog-search" id="blog-search" onkeyup="blog_fetch()">
			<button type="submit" class="psg-post-search-btn" value="Submit"><i class="far fa-search"></i></button>
		</div>
		
		<div class="psg-sorting" id="blog-sort-by">
			<select name="orderby" id="sorting-select" class="sorting-select">
				<option>Sort By </option>
				<?php if($_GET["blog_sort"]){?>
				<option value="DESC" <?php if($_GET["blog_sort"] == "DESC") echo 'selected'; ?>>Latest</option>
				<option value="ASC"  <?php if($_GET["blog_sort"] == "ASC")  echo 'selected'; ?>>Oldest</option>
				<?php }else{ ?>
				<option value="DESC">Latest </option>
				<option value="ASC"> Oldest </option>
				<?php } ?>
			</select>
		</div>
	</div>
	
	
<?php 
	
$blog_sort = $_GET['blog_sort'];	
$blog_search = $_GET['blog_search'];
	
	
$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
	
	if( !empty($blog_sort) && !empty($blog_search) ){
		$args = array(  
			'post_type' => 'post',
			'post_status' => 'publish',
			'posts_per_page' => 9, 
			'paged' => $paged,
			'order'	=> $blog_sort,
			's'		=> $blog_search,
		);
	}
	elseif( !empty($blog_sort) && empty($blog_search) ){
		$args = array(  
			'post_type' => 'post',
			'post_status' => 'publish',
			'posts_per_page' => 9, 
			'paged' => $paged,
			'order'	=> $blog_sort,
		);
	}
	elseif( empty($blog_sort) && !empty($blog_search) ){
		$args = array(  
			'post_type' => 'post',
			'post_status' => 'publish',
			'posts_per_page' => 9, 
			'paged' => $paged,
			'order'	=> 'DESC',
			's'		=> $blog_search,
		);
	}
	else{
		$args = array(  
			'post_type' => 'post',
			'post_status' => 'publish',
			'posts_per_page' => 9, 
			'paged' => $paged,
			'order'	=> 'DESC'
		);
	}	
	
$blog_query = new WP_Query( $args );
?>

<div id="psg-blog-1">
	<div id="psg-blog" class="psg-blog-archive-main-wrp">
		<?php
	if($blog_query->have_posts()){
	while ( $blog_query->have_posts() ) : $blog_query->the_post(); ?>
		<div class="psg-blog-archive-loop">
			<div class="psg-blog-archive-loop-inner">
				<div class="psg-blog-archive-loop-top">        
					<a class="psg-blog-archive-feature-image" href="<?php echo get_permalink($post->ID) ?>">
						<?php echo get_the_post_thumbnail( $post->ID, 'full' );  ?>
					</a> 
					<div class="psg-blog-archive-title"><a href="<?php echo get_permalink($post->ID) ?>"><?php the_title(); ?></a></div>
				</div>

				<div class="psg-blog-archive-read-more">
					<a href="<?php echo esc_url(get_permalink()); ?>" class="blog-btn">Read More</a>
				</div>	

			</div>
		</div>
		<?php endwhile;
	}else{
		echo '<h4 class="psg-blog-archive-no-post-found">No post found!</h4>';
	}
	?>
	</div>
    	
	 <!--Pagenation Start-->
        <?php if ($blog_query->max_num_pages > 1) : ?>
        <div class="psg-pagination">
			
			<?php if(1 == $paged){ ?>
			<a class="prev page-numbers disable" >
				<i class="fal fa-chevron-left"></i>
			</a>
			<?php }
	
			$big = 999999999; // need an unlikely integer

			echo paginate_links( array(
				'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
				'format' => '?paged=%#%',
				'prev_text'    => __('<i class="fal fa-chevron-left"></i>'),
				'next_text'    => __('<i class="fal fa-chevron-right"></i>'),
				'current' => max( 1, get_query_var('paged') ),
				'total' =>  $blog_query->max_num_pages,	
			) );
						
			if( $blog_query->max_num_pages == $paged){ ?>
			<a class="next page-numbers disable" >
				<i class="fal fa-chevron-right"></i>
			</a>
			<?php } ?>
		</div>
        <?php endif; ?>
    <!--Pagenation End-->
	
</div>
</div>	

<?php wp_reset_postdata(); 
	//session_destroy();
 $var = ob_get_clean();
        return $var;

} ?>
