<?php 
add_shortcode('psg_project_archive_template_shortcode', 'psg_project_archive_template'); 
function psg_project_archive_template() {
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
<div class="psg-project-template-main-wrp">
	
	<?php 
	$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
	$args = array(  
		'post_type' => 'projects',
		'post_status' => 'publish',
		'posts_per_page' => 12, 
		'paged' => $paged,
		'order'	=> 'DESC'
	);
	
	$projects_query = new WP_Query( $args );
	?>


	<div class="psg-project-archive-main-wrp">
	<?php 
	if($projects_query->have_posts()){
	while ( $projects_query->have_posts() ) : $projects_query->the_post(); ?>
		<div class="psg-project-archive-loop">
			<div class="psg-project-archive-loop-inner">
				<?php echo get_the_post_thumbnail( $post->ID, 'full' );  ?>
				<div class="psg-project-archive-title"><?php the_title(); ?></div>
			</div>
		</div>
	<?php endwhile; 
	}else{
		echo '<h4 class="psg-project-archive-no-post-found">No project found!</h4>';
	}	
	?> 
	</div>
    
    	
	  <!--Pagenation Start-->
        <?php if ($projects_query->max_num_pages > 1) : ?>
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
				'total' =>  $projects_query->max_num_pages,	
			) );
						
			if( $projects_query->max_num_pages == $paged){ ?>
			<a class="next page-numbers disable" >
				<i class="fal fa-chevron-right"></i>
			</a>
			<?php } ?>
		</div>
        <?php endif; ?>
    <!--Pagenation End-->
	
</div>	

<?php wp_reset_postdata(); 
	//session_destroy();
 $var = ob_get_clean();
        return $var;

} ?>
