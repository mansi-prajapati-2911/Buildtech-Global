<?php namespace WPC\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH')) exit; // Exit if accessed directly


class PSG_Banner_image extends Widget_Base{

  public function get_name(){
    return 'psg_banner_image';
  }

  public function get_title(){
    return 'Banner Image';
  }

  public function get_icon(){
    return 'eicon-banner';
  }

  public function get_categories(){
    return ['psg-widget'];
  }

  protected function register_controls(){

	  $this->start_controls_section(
		  'section_content',
		  [
			  'label' => 'Banner Image',
		  ]
	  );
	  
	  $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'image',
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .psg-banner-img-wrap',
			]
		);

	  $this->add_control(
		  'cm_title',
		  [
			  'label' => esc_html__( 'Custom Title'),
			  'label_block'=> true,
			  'type' => \Elementor\Controls_Manager::TEXT,
			  'placeholder' => esc_html__( 'Type your custom page title here'),
		  ]
	  );
	  
	  $this->add_control(
		  'banner_description',
		  [
			  'label' => esc_html__( 'Description'),
			  'type' => \Elementor\Controls_Manager::TEXTAREA,
			  'rows' => 10,
			  'default' => esc_html__( 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua'),
			  'placeholder' => esc_html__( 'Type your description here'),
		  ]
	  );

	  $this->end_controls_section();  
    

/** Start Title Styling **/ 

		$this->start_controls_section(
			'title_section',
			[
				'label' => __('Title'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __('Color'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .psg-banner-img-wrap .psg-banner-img-inner .psg-banner-page-title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .psg-banner-img-wrap .psg-banner-img-inner .psg-banner-page-title',
			]
		);

		$this->end_controls_section();

/** End Title Styling **/

/** Start Description Styling **/ 

		$this->start_controls_section(
			'description_section',
			[
				'label' => __('Description'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'description_color',
			[
				'label' => __('Color'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .psg-banner-img-wrap .psg-banner-img-inner .psg-banner-description' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'selector' => '{{WRAPPER}} .psg-banner-img-wrap .psg-banner-img-inner .psg-banner-description',
			]
		);

		$this->end_controls_section();

/** End Description Styling **/

  }/** Register Controls End */
  

  protected function render(){
    $settings = $this->get_settings_for_display();
	
    $this->add_inline_editing_attributes('front_heading', 'basic');
    $this->add_render_attribute(
      'front_heading',
      [
        'class' => ['advertisement__label-heading'],
      ]
    );
    

    ?>
	<div class="psg-banner-img-wrap <?php if(is_shop()){echo "shop_archive_page"; } ?>" >      
      <div class="psg-banner-img-inner">
      <?php 
	  global $post; 
	  $product_search = get_search_query();
	  
	  if(is_shop() && is_search()) { ?>

		  <div class="psg-banner-breadcrumbs">
			  <a href="<?php echo get_home_url(); ?>"><i class="fal fa-home"></i></a> 
			  <span class="separator"><i class="fal fa-chevron-right"></i></span>
			  <a href="<?php echo wc_get_page_permalink( 'shop' ); ?>">Products</a> 
			  <span class="separator"><i class="fal fa-chevron-right"></i></span>
			  Search Result For <?php echo $product_search; ?>
		  </div>
		  <h1 class="psg-banner-page-title">Search Result: <?php echo $product_search; ?></h1>
	 <?php }
	  
	  elseif(is_shop()){ ?>
			<div class="psg-banner-breadcrumbs">
			   <a href="<?php echo get_home_url(); ?>"><i class="fal fa-home"></i></a> 
			   <span class="separator"><i class="fal fa-chevron-right"></i></span>
			   Products
			</div>
			<?php if($settings['cm_title']){
		  		echo '<h1 class="psg-banner-page-title">' . $settings['cm_title'] . '</h1>';
	  		}else{
				echo '<h1 class="psg-banner-page-title">Products</h1>';
			}
			if($settings['banner_description']){
				echo '<p class="psg-banner-description">'. $settings['banner_description'] .'</p>';
			}
	  }elseif (is_product_category()) {
		  function get_parent_terms($term) {
			  if ($term->parent > 0){
				  $term = get_term_by("id", $term->parent, "product_cat");
				  return get_parent_terms($term);
			  }else{
				  $var1 = $term->name;
				  $var2 = $term->slug;
				  return array($var1, $var2);
			  }		
			}
					  
		  global $wp_query;
		  $cat_obj = $wp_query->get_queried_object();
		  $Root_Cat_ID = get_parent_terms($cat_obj);
		  $link = get_term_link( $Root_Cat_ID[1], 'product_cat' );


		  $childterms = get_term_children($Root_Cat_ID[0], 'product_cat');
		  foreach ($childterms as $childterm) {
			  $product_cat = $childterm->name;
			  break;
		  } ?>
		  <div class="psg-banner-breadcrumbs">
			  <a href="<?php echo get_home_url(); ?>"><i class="fal fa-home"></i></a> <span class="separator"><i class="fal fa-chevron-right"></i></span>
			  <a href="<?php echo wc_get_page_permalink( 'shop' ); ?>">Products</a> 

			  <?php if ($cat_obj->parent !== 0){ ?>
			  <span class="separator"><i class="fal fa-chevron-right"></i></span>
			  <a href="<?php echo get_term_link( $Root_Cat_ID[1], 'product_cat' ); ?>"><?php echo $Root_Cat_ID[0]; ?></a>
			  <?php } ?>

			  <?php  $cat = get_queried_object();
		  if ( $cat->parent >= 0 ){ ?> 
			  <span class="separator"><i class="fal fa-chevron-right"></i></span><?php  echo $cat->name; ?> 					
			  <?php } ?>
		  </div>
		  <h1 class="psg-banner-page-title"><?php echo $cat->name; ?></h1>
		  <?php if($settings['banner_description']){
			  echo '<p class="psg-banner-description">'. $settings['banner_description'] .'</p>';
		  } ?>
		  <?php }else{ ?>
		  
			<div class="psg-banner-breadcrumbs"><?php the_breadcrumb(); ?></div>  
			<?php if($settings['cm_title']){
		  		echo '<h1 class="psg-banner-page-title">' .$settings['cm_title'] . '</h1>';
	  		}else{
		  		 the_title( '<h1 class="psg-banner-page-title">', '</h1>' );
	  		}
			if($settings['banner_description']){
				echo '<p class="psg-banner-description">'. $settings['banner_description'] .'</p>';
			}
      	    ?> 
    <?php } ?>
      	</div>
    </div>
    <?php
  }

}

?>