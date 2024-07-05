<?php
namespace WPC\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH')) exit; // Exit if accessed directly


class PSG_Home_Slider extends Widget_Base{

	public function get_name(){ 
		return 'psg_home_slider';
	}

	public function get_title(){
		return 'PSG Home Slider';
	}

	public function get_icon(){
		return 'eicon-slider-push';
	}

	public function get_categories(){
		return ['psg-widget'];
	}

	protected function register_controls(){

		$this->start_controls_section(
			'section_content',
			[
				'label' => 'Slider',
			]
		);

		$repeater = new \Elementor\Repeater();
				
		$repeater->add_control(
			'slider_image',
			[
				'label' =>  'Choose Image',
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'background-image: url({{URL}});',
				],
			]
		);
		
		$repeater->add_control(
			'slider_title',
			[
				'label' => __( 'Title'),
				'label_block' => 'true',
				'type' => Controls_Manager::TEXT,
				'default' => 'Specialist In Core Bit And Core Bit Re-Tipping',
				'placeholder' => __('Type slider title here.'),
			]
		);

		$repeater->add_control(
			'slider_content',
			[
				'label' => __( 'Content'),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'separator' => 'before',
				'dynamic' => [
					'active' => true,
				],
				'rows' => '6',
				'default' => __( 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.' ),
			]
		);

		$repeater->add_control(
			'slider_btn',
			[
				'label' => __('Button Text'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __('Explore Products'),
				'placeholder' => __('Type Button Text'),
				'separator' => 'before',
			]
		);

		$repeater->add_control(
			'btn_link',
			[
				'label' => __('Button Link'),
				'type' => Controls_Manager::URL,
				'show_external' => true,
				'default' => [
					'url' => '#',
				],
				'dynamic' => [
					'active' => true,
				],
			]
		);
		
		
		$this->add_control(
			'list',
			[
				'label' => __('Slides'),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'separator' => 'before',
				'default' => [
					[
						'slider_image' => ['url' => \Elementor\Utils::get_placeholder_image_src(),],
						'slider_title'=> __('Specialist In Core Bit And Core Bit Re-Tipping'),
						'slider_content' => __('Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.'),
						'slider_btn'=> __('Explore Products'),
						'btn_link'=> ['url' => '#',],
					],
					[
					    'slider_image' => ['url' => \Elementor\Utils::get_placeholder_image_src(),],
						'slider_title'=> __('Specialist In Core Bit And Core Bit Re-Tipping'),
						'slider_content' => __('Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.'),
						'slider_btn'=> __('Explore Products'),
						'btn_link'=> ['url' => '#',],
					],
				],
				'title_field' => '{{{ slider_title }}}',
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
					'{{WRAPPER}} .psg-home-slider-container .psg-home-slider-inner .psg-home-slider-title' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .psg-home-slider-container .psg-home-slider-inner .psg-home-slider-title',
			]
		);

		$this->end_controls_section();

/** End Title Styling **/ 

		
/** Start Content Styling **/ 

		$this->start_controls_section(
			'content_section',
			[
				'label' => __('Content'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'content_color',
			[
				'label' => __('Color'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .psg-home-slider-container .psg-home-slider-inner .psg-home-slider-content' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'content_text_typography',
				'selector' => '{{WRAPPER}} .psg-home-slider-container .psg-home-slider-inner .psg-home-slider-content',
			]
		);

		$this->end_controls_section();

/** End Content Styling **/
		
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
		
		$unique_id = uniqid('psg_');

?>

<div class="psg-home-slider-repeater-main" id="<?php echo $unique_id; ?>">
	<?php if ( $settings['list'] ) { ?>
	<div class="psg-home-slider-main">
		<?php foreach (  $settings['list'] as $item ) {
		
		?>
		<div class="psg-home-slider-img-wrap elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?>" >  
			<div class="psg-home-slider-container">
				<div class="psg-home-slider-inner">
					<?php
			
					$slider_btn_link = "btn_link" . $item['_id'];
			
					if ( ! empty( $item['btn_link']['url'] ) ) {
						$this->add_link_attributes( $slider_btn_link , $item['btn_link'] );
					}
											   
					if(!empty($item['slider_title'])){ ?>
					<h1 class="psg-home-slider-title"><?php echo $item['slider_title']; ?></h1>
					<?php } 
													   
					if(!empty($item['slider_content'])){ ?>
					<p class="psg-home-slider-content"><?php echo $item['slider_content']; ?></p>
					<?php } 
					?>	
					<div class="psg-home-slider-btn-wrp">
					
					<?php if(!empty($item['slider_btn'])){ ?>
						<a <?php echo $this->get_render_attribute_string( $slider_btn_link ); ?> class="psg-home-slider-btn-link"> <?php echo $item['slider_btn'] ?></a>
					<?php } ?>
					
					</div>       
					
				</div>
			</div>	
		</div>
		<?php } ?>
	</div>
	

<!-- Start Home Slider Widget js -->  
	
<script type="text/javascript">
	jQuery('#<?php echo $unique_id; ?> .psg-home-slider-main').slick({
		loop:true,	 
// 		autoplay: true,
// 		autoplaySpeed: 5000,
		slidesToShow: 1,
		slidesToScroll: 1,
		dots: false,
		arrows: true,
		responsive: [
		  {
			  breakpoint: 1025,
			  settings: {
				  arrows: false,
	  			  dots: true,
			  }
		  },
	  ] 
	});
</script>
	
<!-- End Home Slider Widget js -->
	
	<?php } ?>
</div>



<?php }


}