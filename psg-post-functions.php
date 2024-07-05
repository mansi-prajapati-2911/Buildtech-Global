<?php

require_once( get_template_directory() . '/psg-blogs-template.php' );
require_once( get_template_directory() . '/psg-project-template.php' );

//----------------------- Start action Blog Posts sort ------------------//

add_action( 'wp_ajax_get_psg_blog_from_sort', 'get_psg_blog_from_sort' );
add_action( 'wp_ajax_nopriv_get_psg_blog_from_sort', 'get_psg_blog_from_sort' ); 

function get_psg_blog_from_sort(){
	if ( get_query_var('paged') ) {
		$paged = get_query_var('paged');
	} elseif ( get_query_var('page') ) {
		$paged = get_query_var('page');
	} else {
		$paged = 1;
	}
	$blog_sort = $_POST["blog_sort"];
	$blog_search = $_POST['blog_search'];
	
	$post_per_page = 9;
	if( !empty($blog_sort) && !empty($blog_search) ){
		$args = array(  
			'post_type' => 'post',
			'post_status' => 'publish',
			'posts_per_page' => $post_per_page, 
			'paged' => $paged,
			'order'	=> $blog_sort,
			's'		=> $blog_search,
		);
	}elseif( !empty($blog_sort) && empty($blog_search) ){
		$args = array(  
			'post_type' => 'post',
			'post_status' => 'publish',
			'posts_per_page' => $post_per_page, 
			'paged' => $paged,
			'order'	=> $blog_sort,
		);
	}elseif( empty($blog_sort) && !empty($blog_search) ){
		$args = array(  
			'post_type' => 'post',
			'post_status' => 'publish',
			'posts_per_page' => $post_per_page, 
			'paged' => $paged,
			'order'	=> 'DESC',
			's'		=> $blog_search,
		);
	}else{
		$args = array(  
			'post_type' => 'post',
			'post_status' => 'publish',
			'posts_per_page' => $post_per_page, 
			'paged' => $paged,
			'order'	=> 'DESC'
		);
	}
		
	$blog_query = new WP_Query( $args );
?>
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
			'base' => home_url('/blogs/%_%'),
			'format' => 'page/%#%/?&blog_sort='.$blog_sort.'&blog_search='.$blog_search,	
			'prev_text'    => __('<i class="fal fa-chevron-left"></i>'),
			'next_text'    => __('<i class="fal fa-chevron-right"></i>'),
			'current' => max( 1, get_query_var('paged') ),
			'total' =>  $blog_query->max_num_pages,	
		) );

		if( $blog_query->max_num_pages == $paged){ ?>
		<a class="next page-numbers disable" >
			<i class="fal fa-chevron-right"></i>
		</a>
		<?php }
		?>
	</div>
	<?php endif; ?>
    <!--Pagenation End-->


<?php wp_reset_postdata();
exit(); }

//-------------------- End action Blog Posts sort ------------------//




//----------------------- Start action Event Posts sort ------------------//
add_action( 'wp_ajax_get_psg_event_from_sort', 'get_psg_event_from_sort' );
add_action( 'wp_ajax_nopriv_get_psg_event_from_sort', 'get_psg_event_from_sort' ); 

function get_psg_event_from_sort(){
 if ( get_query_var('paged') ) {
		$paged = get_query_var('paged');
	} elseif ( get_query_var('page') ) {
		$paged = get_query_var('page');
	} else {
		$paged = 1;
	}
	
	 $event_sort = $_POST["event_sort"];
	 $event_cat = $_POST["event_cat"];
	 $event_search = $_POST['event_search'];

    
if( !empty($event_sort) && !empty($event_search) && !empty($event_cat) ){
	//echo "1";
	$args = array(  
        'post_type' => 'event',
        'post_status' => 'publish',
        'posts_per_page' => 6, 
        'orderby' => 'post_date', 
        'order' => 'DESC', 
        'paged' => $paged,
		'order'	=> $event_sort,
		's'		=> $event_search,
		'meta_query' => array(
			array(
				'key' => 'event_feature_post',
				'value' => 1,
				'compare' => 'NOT IN',
				)
			),
		'tax_query' => array(
			array(
				'taxonomy' => 'event-category',
				'field'    => 'term_id',
				'terms'    => $event_cat , // LIKE (here should be any LIKE clause etc)
			)
        ),
    );		
}elseif(empty($event_sort) && !empty($event_search) && empty($event_cat)){
	//echo "2";
	$args = array(  
		
        'post_type' => 'event',
        'post_status' => 'publish',
        'posts_per_page' => 6, 
        'orderby' => 'post_date', 
        'order' => 'DESC',
		's' => $event_search,
        'paged' => $paged,
		'meta_query' => array(
			array(
				'key' => 'event_feature_post',
				'value' => 1,
				'compare' => 'NOT IN',
				)
			),
    );		
}elseif(!empty($event_sort) && empty($event_search) && empty($event_cat)){
		//echo "3";
	$args = array(  
        'post_type' => 'event',
        'post_status' => 'publish',
        'posts_per_page' => 6, 
        'orderby' => 'post_date',
        'order' => $event_sort,
        'paged' => $paged,
		'meta_query' => array(
			array(
				'key' => 'event_feature_post',
				'value' => 1,
				'compare' => 'NOT IN',
				)
			),
    );		
}elseif(!empty($event_sort) && !empty($event_search) && empty($event_cat)){
	//echo "4";
	$args = array(  
        'post_type' => 'event',
        'post_status' => 'publish',
        'posts_per_page' => 6, 
        'orderby' => 'post_date', 
        'order' => $event_sort,
		's' => $event_search,
        'paged' => $paged,
		'meta_query' => array(
			array(
				'key' => 'event_feature_post',
				'value' => 1,
				'compare' => 'NOT IN',
				)
			),
    );		
}elseif(empty($event_sort) && empty($event_search) && !empty($event_cat)){
	//echo "5";
	$args = array(
		'post_type' => 'event',
	    'post_status' => 'publish',
		'posts_per_page' => 6,
		'orderby' => 'post_date',
		'order' => 'DESC',
		'paged' => $paged,
		'meta_query' => array(
			array(
				'key' => 'event_feature_post',
				'value' => 1,
				'compare' => 'NOT IN',
				)
			),
		'tax_query' => array(
			array(
				'taxonomy' => 'event-category',
				'field'    => 'term_id',
				'terms'    => $event_cat , // LIKE (here should be any LIKE clause etc)
			)
        ),
	);
}elseif(empty($event_sort) && !empty($event_search) && !empty($event_cat)){
	//echo "6";
	$args = array(
		'post_type' => 'event',
	    'post_status' => 'publish',
		'posts_per_page' => 6,
		'orderby' => 'post_date',
		'order' => 'DESC',
		's' => $event_search,
		'paged' => $paged,
		'meta_query' => array(
			array(
				'key' => 'event_feature_post',
				'value' => 1,
				'compare' => 'NOT IN',
				)
			),
		'tax_query' => array(
			array(
				'taxonomy' => 'event-category',
				'field'    => 'term_id',
				'terms'    => $event_cat , // LIKE (here should be any LIKE clause etc)
			)
        ),
	);
}elseif(isset($event_cat) && isset($event_sort) ){
	//echo "7";
	$args = array(
		'post_type' => 'event',
	    'post_status' => 'publish',
		'posts_per_page' => 6,
		'orderby' => 'post_date',
		'order' => $event_sort,
		'paged' => $paged,
		'meta_query' => array(
			array(
				'key' => 'event_feature_post',
				'value' => 1,
				'compare' => 'NOT IN',
				)
			),
		'tax_query' => array(
			array(
				'taxonomy' => 'event-category',
				'field'    => 'term_id',
				'terms'    => $event_cat , // LIKE (here should be any LIKE clause etc)
			)
        ),
	);
}else {	
	$args = array(
		'post_type' => 'event',
	    'post_status' => 'publish',
		'posts_per_page' => 6,
		'orderby' => 'post_date',
		'order' => 'DESC',
		'paged' => $paged,
		'meta_query' => array(
			array(
				'key' => 'event_feature_post',
				'value' => 1,
				'compare' => 'NOT IN',
				)
			),
	);
}
	$event = new WP_Query( $args );	
?>	

<div id="psg-event" class="psg-event-archive-main-wrp">
	<?php 
	while ( $event->have_posts() ) : $event->the_post(); ?>
	<div class="psg-event-archive">
		<div class="psg-event-archive-inner">
			<div class="psg-event-archive-image-wrap">
			<div class="psg-event-archive-feature-img">        
				<a href="<?php echo get_permalink($post->ID) ?>">
					<?php echo get_the_post_thumbnail( $post->ID, 'full' );  ?>
				</a>  
				
				<?php
				$event_date_1 = rwmb_meta( 'event_date' );
				$newdate = date("d F Y", strtotime($event_date_1));
				$current_date = date("d F Y");
		
				$date1 = $current_date;
				$date2 = $newdate;
				$dateTimestamp1 = strtotime($date1);
				$dateTimestamp2 = strtotime($date2);
				
				if ($dateTimestamp1 < $dateTimestamp2) {
					echo '<span class="psg-event-label"> ' . 'UPCOMING EVENTS' . ' </span>';	
				}
				?>	
			</div>
			</div>
			
				<?php
					$event_start_time = rwmb_meta( 'event_time');
					$event_booking_label = rwmb_meta( 'event_zoom' );
					$event_booking_link = rwmb_meta( 'event_url' );
					$event_available_seat = rwmb_meta( 'event_seat_number' );
					$event_total_seat =  rwmb_meta( 'event_seat_number_2' );
				 ?>		
			
				<div class="psg-event-archive-content-wrp">
					<h3 class="psg-event-title"><a href="<?php echo get_permalink($post->ID) ?>"><?php the_title(); ?></a></h3>
					
				
				<?php if(!empty($event_start_time)){ ?>
				<h3 class="psg-event-tm"><i class="fal fa-calendar-alt"></i> <?php $event_date = rwmb_the_value( 'event_date', ['format' => 'd F Y'] ) ?>, <?php echo $event_start_time ;?></h3>
				<?php } ?>
				
				 <div class="event-zoom">	
                    <?php $event_booking_label = rwmb_meta( 'event_zoom' );
				   if(!empty($event_booking_label) && !empty($event_booking_link)){ ?>
					<a class="event_url" href="<?php echo $event_booking_link; ?>" ><h3 class="psg-event-zm"><i class="fal fa-map-marker-alt"></i><?php echo $event_booking_label; ?></h3></a>
					<?php } ?>
				 </div>
				
				<div class="psg-event-bottom-wrap">
					<?php
					if(!empty($event_available_seat) && !empty($event_total_seat)){ 
					$heighlight = "";

						if($event_available_seat < 6){
							$heighlight = "psg_event_heighlight";
						}
						?>
					<h3 class="psg-event-st"><i class="fal fa-loveseat"></i><?php echo '<span class="'.$heighlight.'"> ' . $event_available_seat . ' </span>' .' / '. $event_total_seat ." seats "; ?></h3>
					<?php } ?>

					<h5 class="psg-event-btn">
						<a href="<?php echo esc_url(get_permalink()); ?>" class="event-btn">VIEW DETAILS<i class="fal fa-long-arrow-right"></i></a>
					</h5>
				</div>	
					
				</div>
			
			<div class="psg-event-bottom-wrap-res">
					<div class="event-zoom">	
                    <?php $event_booking_label = rwmb_meta( 'event_zoom' );
				   if(!empty($event_booking_label) && !empty($event_booking_link)){ ?>
					<a class="event_url" href="<?php echo $event_booking_link; ?>" ><h3 class="psg-event-zm"><i class="fal fa-map-marker-alt"></i><?php echo $event_booking_label; ?></h3></a>
					<?php } ?>
				 	</div>
					
					<?php
					if(!empty($event_available_seat) && !empty($event_total_seat)){ 
					$heighlight = "";

						if($event_available_seat < 6){
							$heighlight = "psg_event_heighlight";
						}
						?>
					<h3 class="psg-event-st"><i class="fal fa-loveseat"></i><?php echo '<span class="'.$heighlight.'"> ' . $event_available_seat . ' </span>' .' / '. $event_total_seat ." seats "; ?></h3>
					<?php } ?>	
				</div>
			
		</div>
	</div>
	<?php endwhile; ?> 
</div>

  <!--Pagenation Start-->
        <?php if ($event->max_num_pages > 1) : ?>
        <div class="pagination psg-pagination">
				<?php if(1 == $paged){ ?>
						<a class="prev page-numbers disable" >
							<i class="fal fa-chevron-left"></i>
						</a>
					<?php }
						$big = 999999999; // need an unlikely integer

						echo paginate_links( array(
						'base' => home_url('/event-listing/%_%'),
						'format' => 'page/%#%/?&event_sort='.$event_sort.'&event_cat='.$event_cat.'&event_search='.$event_search,	
						'prev_text'    => __('<i class="fal fa-chevron-left"></i>'),
						'next_text'    => __('<i class="fal fa-chevron-right"></i>'),
						'current' => max( 1, get_query_var('paged') ),
						'total' =>  $event->max_num_pages,	
						) );
						
						if( $event->max_num_pages == $paged){ ?>
						<a class="next page-numbers disable" >
								<i class="fal fa-chevron-right"></i>
						</a>
					<?php }
					?>
			</div>
        <?php endif; ?>
    <!--Pagenation End-->

<?php wp_reset_postdata();
 exit(); }

//-------------------- End action Event Posts sort ------------------//