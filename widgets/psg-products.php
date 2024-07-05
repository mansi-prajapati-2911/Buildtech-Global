<?php
namespace WPC\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH')) exit; // Exit if accessed directly


class PSG_Products extends Widget_Base{

	public function get_name(){ 
		return 'psg_products';
	}

	public function get_title(){
		return 'PSG Products';
	}

	public function get_icon(){
		return 'eicon-products';
	}

	public function get_categories(){
		return ['psg-widget'];
	}

	protected function register_controls(){
		
		$product_loop =  get_posts(
			array( 
				'post_type' => 'product',
				'posts_per_page' => -1,
				'post_status' => 'publish',
			)
		); 

		foreach( $product_loop as $prod_loop ):
		$product_array[$prod_loop->ID] =  $prod_loop->post_title;
		endforeach;
		
		$product_array_json = json_encode($product_array);

		$this->start_controls_section(
			'query_section',
			[
				'label' => __('Query'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'psg_product_query',
			[
				'label' => esc_html__('Source'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'latest_products',
				'options' => [
					'psg_bestsellers'  => esc_html__( 'Bestsellers'),
					'manual_select'  => esc_html__( 'Manually Selection'),
					'latest_products'  => esc_html__( 'Latest Products'),
				],
			]
		);
		
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'psg_manual_prd_id',
			[
				'label' => esc_html__( 'Search & Select'),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'multiple' => false,
				'label_block' => true,
				'options' => $product_array,
			]
		);
		
		$this->add_control(
			'psg_manual_list',
			[
				'label' => esc_html__( 'Product List'),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'psg_manual_prd_id' => __(''),
					],
					[
						'psg_manual_prd_id' => __(''),
					],
				],
				'title_field' => "<# "
                . "let labels = $product_array_json; " // Now the labels are available to the javascript
                . "let label = labels[psg_manual_prd_id]; "// Get the value of the selected page
                . "#>"
                . "{{{ label }}}",
				'conditions' => [
					'terms' => [
						[
							'name' => 'psg_product_query',
							'value' => 'manual_select',
						],
					],
				],
			]
		);

		
		$this->add_control(
			'product_order',
			[
				'label' => __( 'Order' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'asc',
				'options' => [
					'asc'  => __( 'ASC'),
					'desc' => __( 'DESC'),
				],
				'conditions' => [
					'terms' => [
						[
							'name' => 'psg_product_query',
							'operator' => 'in',
							'value' => ['latest_products'],
						],
					],
				],
			]
		);
		
		$this->add_control(
			'enable_scrollbar',
			[
				'label' => esc_html__( 'Enable Scrollbar' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes'),
				'label_off' => esc_html__('No'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		
		$this->add_control(
			'enable_arrow',
			[
				'label' => esc_html__( 'Enable Arrow' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes'),
				'label_off' => esc_html__('No'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		
		$this->end_controls_section();
		
		
/*** Start Scrollbar Styling ***/ 

		$this->start_controls_section(
			'scrollbar_section',
			[
				'label' => __('Scrollbar'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'enable_scrollbar' => 'yes',
				],
			]
		);
		
		$this->add_responsive_control(
			'show_scrollbar',
			[
				'label' => esc_html__( 'Show Scrollbar'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'block',
				'options' => [
					'block' => esc_html__('Show'),
					'none'  => esc_html__('Hide'),
				],
				'selectors' => [
					'{{WRAPPER}} .psg-products-widget-inner .psg-products-widget-list .swiper-scrollbar' => 'display: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'scrollbar_bg_color',
			[
				'label' => __('Background'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .psg-products-widget-inner .psg-products-widget-list .swiper-scrollbar' => 'background: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'scrollbar_drag_bg_color',
			[
				'label' => __('Drag Background'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .psg-products-widget-inner .psg-products-widget-list .swiper-scrollbar .swiper-scrollbar-drag' => 'background: {{VALUE}}',
				],
			]
		);
		
		$this->end_controls_section();

/*** End Scrollbar Styling ***/
		
/*** Start Arrow Styling ***/ 

		$this->start_controls_section(
			'arrow_section',
			[
				'label' => __('Arrow'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'enable_arrow' => 'yes',
				],
			]
		);
		
		$this->add_responsive_control(
			'show_arrow',
			[
				'label' => esc_html__( 'Show Arrow'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'flex',
				'options' => [
					'flex' => esc_html__('Show'),
					'none'  => esc_html__('Hide'),
				],
				'selectors' => [
					'{{WRAPPER}} .psg-products-widget-main .psg-products-widget-inner .swiper-button-prev,{{WRAPPER}} .psg-products-widget-main .psg-products-widget-inner .swiper-button-next' => 'display: {{VALUE}};',
				],
			]
		);
		
		
		
		$this->start_controls_tabs(
			'arrow_style_tabs'
		);
		
		//Normal
		$this->start_controls_tab(
			'arrow_normal_tab',
			[
				'label' => esc_html__( 'Normal'),
			]
		);
		
		$this->add_control(
			'arrow_color',
			[
				'label' => __('Color'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .psg-products-widget-inner .swiper-button-next:before, {{WRAPPER}} .psg-products-widget-inner .swiper-button-prev:before' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'arrow_bg_color',
			[
				'label' => __('Background'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .psg-products-widget-inner .swiper-button-next, {{WRAPPER}} .psg-products-widget-inner .swiper-button-prev' => 'background: {{VALUE}}',
				],
			]
		);
		
		$this->end_controls_tab();
		//Hover
		$this->start_controls_tab(
			'arrow_hover_tab',
			[
				'label' => esc_html__( 'Hover'),
			]
		);
		
		$this->add_control(
			'hover_arrow_color',
			[
				'label' => __('Color'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .psg-products-widget-inner .swiper-button-next:hover:before, {{WRAPPER}} .psg-products-widget-inner .swiper-button-prev:hover:before' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'hover_arrow_bg_color',
			[
				'label' => __('Background'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .psg-products-widget-inner .swiper-button-next:hover, {{WRAPPER}} .psg-products-widget-inner .swiper-button-prev:hover' => 'background: {{VALUE}}',
				],
			]
		);
		
		$this->end_controls_tab();
		
		//Disable
		$this->start_controls_tab(
			'arrow_disable_tab',
			[
				'label' => esc_html__( 'Disable'),
			]
		);
		
		$this->add_control(
			'disable_arrow_color',
			[
				'label' => __('Color'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .psg-products-widget-inner .swiper-button-disabled:before' => 'color: {{VALUE}} !important',
				],
			]
		);
		
		$this->add_control(
			'disable_arrow_bg_color',
			[
				'label' => __('Background'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .psg-products-widget-inner .swiper-button-disabled' => 'background: {{VALUE}} !important',
				],
			]
		);
		
		$this->end_controls_tab();
		
		$this->end_controls_tabs();
		$this->end_controls_section();

/*** End Arrow Styling ***/

}/** Register Controls End */
	
	protected function render(){
		$settings = $this->get_settings_for_display();

		$this->add_inline_editing_attributes('front_heading', 'basic');
		$this->add_render_attribute(
			'front_heading',
			[
				'class' => ['psg-slider__label-heading'],
			]
		);
		$widget_uniqid = uniqid('psg_product');
		$psg_product_query = $settings['psg_product_query'];
		global $woocoommerce , $product;
		?>
		<div id="<?php echo $widget_uniqid; ?>" class="psg-products-widget-main">
			<div class="psg-products-widget-inner">
				<div class="psg-products-widget-list">
			<?php 
		
		    if($psg_product_query == "latest_products"){ //Latest Product
				$product_order = $settings['product_order'];
				$content = do_shortcode( '[products limit="6" orderby="date" order="'.$product_order.'"]' );
				echo  $content;
			}
		
			elseif($psg_product_query == "psg_bestsellers"){ //Bestsellers
				$product_order = $settings['product_order'];
				$content = do_shortcode( '[products limit="6" orderby="popularity"]' );
				echo  $content;
			}
			
			else{//Manual Selection
				$product_ids = array();
				if ( $settings['psg_manual_list'] ) {
					foreach (  $settings['psg_manual_list'] as $item ) {
						$post_id = $item['psg_manual_prd_id'];
						$product_ids[$post_id] = $post_id;
					}
					$reco_pro_ids = implode(', ', $product_ids);
					if(!empty($reco_pro_ids)){
						$content = do_shortcode( '[products ids="'.$reco_pro_ids.'" orderby="post__in"]' );
						echo  $content;
					}else{
						echo '<h5 class="psg-product-not-selected">Please select the products. </h5>';
					}
					
				}else{
					echo '<h5 class="psg-product-not-selected">Please select the products. </h5>';
				}
			}
			?>
				</div>
				<?php if($settings['enable_arrow'] == 'yes'){ ?>
				<div class="swiper-button-prev"></div>
				<div class="swiper-button-next"></div>
				<?php } ?>
			</div>	
		</div>
		<script>
			<?php if($settings['enable_scrollbar'] == "yes"){ ?>
				jQuery(".psg-products-widget-list > div.woocommerce").append('<div class="swiper-scrollbar" id="<?php echo $widget_uniqid; ?>_swiper_scrollbar"></div>');
			<?php } ?>
			jQuery(".psg-products-widget-list > div.woocommerce").addClass("swiper-container");
			jQuery(".psg-products-widget-list ul.products").addClass("swiper-wrapper");
			jQuery(".psg-products-widget-list ul.products li").addClass("swiper-slide");
			var mySwiper = new Swiper("#<?php echo $widget_uniqid; ?> .psg-products-widget-list > div.woocommerce", {
				freeMode: true,
				slidesPerView: 'auto',
				direction: "horizontal",
				observer: true,
				observeParents: true,
				spaceBetween: 0,
				<?php if($settings['enable_scrollbar'] == "yes"){ ?>
				scrollbar: {
					el: "#<?php echo $widget_uniqid.'_swiper_scrollbar'; ?>",
					draggable: true,
					snapOnRelease: false
				},
				<?php } ?>
				<?php if($settings['enable_arrow'] == 'yes'){ ?>
				navigation: {
					nextEl: "#<?php echo $widget_uniqid; ?> .swiper-button-next",
					prevEl: "#<?php echo $widget_uniqid; ?> .swiper-button-prev"
				}
				<?php } ?>
			});
		</script>
		

	<?php }
}