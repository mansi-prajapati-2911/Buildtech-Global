<?php
namespace WPC\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class PSG_Products_Category extends Widget_Base {

	public function get_name() {
		return 'psg_products_category';
	}

	public function get_title() {
		return 'PSG Products Category';
	}

	public function get_icon() {
		return 'eicon-products';
	}

	public function get_categories() {
		return ['psg-widget'];
	}

	protected function register_controls() {
		
		$product_category_loop =  get_categories(
			array( 
				'taxonomy'     => 'product_cat',
				'hide_empty'   => 0,
				'orderby'      => 'name',
				'order' => 'asc',
				'exclude' => array(21),
			)
		);
		$product_category_array = array();
		foreach( $product_category_loop as $category ):
		$product_category_array[$category->term_id] =  $category->name;
		endforeach;
		
		$product_category_json = json_encode($product_category_array);
		
		$this->start_controls_section(
			'product_category_section',
			[
				'label' => __('Product Category'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		
		$this->add_control(
			'pc_heading',
			[
				'label' => esc_html__( 'Heading'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Product Categories'),
				'label_block' => true,
				'placeholder' => esc_html__( 'Type your heading here'),
			]
		);
		
		$this->add_control(
			'pc_description',
			[
				'label' => esc_html__( 'Description' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 5,
				'default' => esc_html__( 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam'),
				'placeholder' => esc_html__( 'Type your description here'),
			]
		);
		
		$this->add_control(
			'pc_btn_text',
			[
				'label' => esc_html__( 'Button Text'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'View All'),
				'placeholder' => esc_html__( 'Type your button text here'),
			]
		);
		
		$this->add_control(
			'pc_btn_link',
			[
				'label' => esc_html__( 'Button Link'),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com'),
				'options' => [ 'url', 'is_external', 'nofollow' ],
				'default' => [
					'url' => '#',
					'nofollow' => true,
				],
				'label_block' => true,
			]
		);
		
		
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'cat_id',
			[
				'label' => esc_html__( 'Search & Select'),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'multiple' => false,
				'label_block' => true,
				'options' => $product_category_array,
			]
		);
		
		$this->add_control(
			'product_cat_list',
			[
				'label' => esc_html__( 'Category List'),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[ 'cat_id' => __(''), ],
					[ 'cat_id' => __(''), ],
				],
				'title_field' => "<# "
                . "let labels = $product_category_json; " // Now the labels are available to the javascript
                . "let label = labels[cat_id]; "// Get the value of the selected page
                . "#>"
                . "{{{ label }}}",
			]
		);
		
		$this->end_controls_section();

/** Start Heading Styling **/ 

		$this->start_controls_section(
			'heading_section',
			[
				'label' => __('Heading'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'heading_color',
			[
				'label' => __('Color'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .psg-product-category-main-wrp .psg-pc-list li .psg-pc-detailbox-inner .psg-pc-detailbox-top .psg-pc-detailbox-heading' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'heading_typography',
				'selector' => '{{WRAPPER}} .psg-product-category-main-wrp .psg-pc-list li .psg-pc-detailbox-inner .psg-pc-detailbox-top .psg-pc-detailbox-heading',
			]
		);

		$this->end_controls_section();

/** End Heading Styling **/

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
					'{{WRAPPER}} .psg-product-category-main-wrp .psg-pc-list li .psg-pc-detailbox-inner .psg-pc-detailbox-top .psg-pc-detailbox-description' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'selector' => '{{WRAPPER}} .psg-product-category-main-wrp .psg-pc-list li .psg-pc-detailbox-inner .psg-pc-detailbox-top .psg-pc-detailbox-description',
			]
		);

		$this->end_controls_section();

/** End Description Styling **/


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
					'{{WRAPPER}} .psg-product-category-main-wrp .psg-pc-list li .psg-pc-loop-inner .psg-pc-info-wrp .psg-pc-name' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .psg-product-category-main-wrp .psg-pc-list li .psg-pc-loop-inner .psg-pc-info-wrp .psg-pc-name',
			]
		);

		$this->end_controls_section();

/** End Title Styling **/

/** Start Explore More Styling **/ 

		$this->start_controls_section(
			'explore_more_section',
			[
				'label' => __('Explore More'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'explore_more_color',
			[
				'label' => __('Color'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .psg-product-category-main-wrp .psg-pc-list li .psg-pc-loop-inner .psg-pc-info-wrp a.psg-pc-btn' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'explore_more_typography',
				'selector' => '{{WRAPPER}} .psg-product-category-main-wrp .psg-pc-list li .psg-pc-loop-inner .psg-pc-info-wrp a.psg-pc-btn',
			]
		);

		$this->end_controls_section();

/** End Explore More Styling **/



	}

	protected function render() {
		$settings = $this->get_settings_for_display();
	?>
<div class="psg-product-category-main-wrp">
	<ul class="psg-pc-list">
		
		<?php if( !empty($settings['pc_heading']) || !empty($settings['pc_description']) || !empty($settings['pc_btn_text']) || !empty($settings['pc_btn_link']['url'])){ ?>
		<li class="psg-pc-detailbox">
			<div class="psg-pc-detailbox-inner">	
				<?php if(!empty($settings['pc_heading']) || !empty($settings['pc_description']) ){
				echo '<div class="psg-pc-detailbox-top">';
					if(!empty($settings['pc_heading'])){ echo '<h2 class="psg-pc-detailbox-heading">'. $settings['pc_heading'] .'</h2>'; }
					if(!empty($settings['pc_description'])){ echo '<div class="psg-pc-detailbox-description">'. $settings['pc_description'] .'</div>'; }
				echo '</div>';
				} ?>
				<?php if(!empty($settings['pc_btn_text'])){
				$this->add_link_attributes( 'pc_btn_link', $settings['pc_btn_link'] );
				echo '<div class="psg-pc-detailbox-btn">';
					echo '<a '. $this->get_render_attribute_string( 'pc_btn_link' ) .'>'. $settings['pc_btn_text'] .'</a>';
				echo '</div>';
				} ?>
			</div>
		</li>
		<?php } ?>
		
	<?php 
	if($settings['product_cat_list']){
		foreach (  $settings['product_cat_list'] as $item ) {
			$cat_id = $item['cat_id'];
			$thumbnail_id = get_term_meta( $cat_id, 'thumbnail_id', true );
			$image_url = wp_get_attachment_url( $thumbnail_id );
			$term = get_term_by('term_id', $cat_id, 'product_cat'); 
 			$name = $term->name; 
		?>
		<li class="psg-pc-loop">
			<div class="psg-pc-loop-inner">
				<div class="psg-pc-image" style="background-image: url(<?php echo $image_url; ?>);"></div>
				<div class="psg-pc-info-wrp">
					<h4 class="psg-pc-name"><?php echo $name; ?></h4>
					<a href="<?php echo esc_attr(esc_url( get_category_link($cat_id))); ?>" class="psg-pc-btn">Explore More</a>
				</div>
			</div>
		</li>	
		<?php }
	}
	?>
		
	</ul>
</div>
	<?php } //End Render
}