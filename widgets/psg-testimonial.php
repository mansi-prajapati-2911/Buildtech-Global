<?php
namespace WPC\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH')) exit; // Exit if accessed directly


class PSG_Testimonial extends Widget_Base{

	public function get_name(){ 
		return 'psg_testimonial';
	}

	public function get_title(){
		return 'PSG Testimonial';
	}

	public function get_icon(){
		return 'eicon-testimonial';
	}

	public function get_categories(){
		return ['psg-widget'];
	}

	protected function register_controls(){

		$this->start_controls_section(
			'section_content',
			[
				'label' => 'Testimonial',
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'testimonial_image',
			[
				'label' =>  __('Choose Image'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater->add_control(
			'testimonial_name',
			[
				'label' => __( 'Name'),
				'type' => Controls_Manager::TEXT,
				'default' => 'Name',
			]
		);

		$repeater->add_control(
			'testimonial_designation',
			[
				'label' => __( 'Designation'),
				'type' => Controls_Manager::TEXT,
				'default' => 'Customer',
			]
		);

		$repeater->add_control(
			'testimonial_rating',
			[
				'label' => __( 'Rating'),
				'type' => Controls_Manager::SELECT,
				'default' => '5',
				'options' => [
					'1'  => __( '1'),
					'2'  => __( '2'),
					'3'  => __( '3'),
					'4'  => __( '4'),
					'5'  => __( '5'),

				],
			]
		);

		$repeater->add_control(
			'testimonial_content',
			[
				'label' => __( 'Content'),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'dynamic' => [
					'active' => true,
				],
				'rows' => '10',
				'default' => __( 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing'),
			]
		);

		$this->add_control(
			'list',
			[
				'label' => __('Repeater List'),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'separator' => 'before',
				'default' => [
					[
						'testimonial_image' => ['url' => \Elementor\Utils::get_placeholder_image_src(),],
						'testimonial_name' => __('Name'),
						'testimonial_designation' => __('Customer'),
						'testimonial_rating'=> __('5'),
						'testimonial_content' => __('Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing'),
					],
					[
						'testimonial_image' => ['url' => \Elementor\Utils::get_placeholder_image_src(),],
						'testimonial_name' => __('John Doe'),
						'testimonial_designation' => __('Customer'),
						'testimonial_rating'=> __('5'),
						'testimonial_content' => __('Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing'),
					],
					[
						'testimonial_image' => ['url' => \Elementor\Utils::get_placeholder_image_src(),],
						'testimonial_name' => __('John Doe'),
						'testimonial_designation' => __('Customer'),
						'testimonial_rating'=> __('5'),
						'testimonial_content' => __('Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing'),
					],
				],
				'title_field' => '{{{ testimonial_name }}}',
			]
		);     

		$this->end_controls_section();

/** Start Name Styling **/ 

		$this->start_controls_section(
			'name_section',
			[
				'label' => __('Name'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'name_color',
			[
				'label' => __('Color'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .psg-testimonial-loop .psg-testimonial-loop-inner .psg-testimonial-top .psg-testimonial-info .psg-testimonial-name' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'name_typography',
				'selector' => '{{WRAPPER}} .psg-testimonial-loop .psg-testimonial-loop-inner .psg-testimonial-top .psg-testimonial-info .psg-testimonial-name',
			]
		);

		$this->end_controls_section();

/** End Name Styling **/

/** Start Designation Styling **/ 

		$this->start_controls_section(
			'designation_section',
			[
				'label' => __('Designation'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'designation_color',
			[
				'label' => __('Color'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .psg-testimonial-loop .psg-testimonial-loop-inner .psg-testimonial-top .psg-testimonial-info .psg-testimonial-designation' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'designation_typography',
				'selector' => '{{WRAPPER}} .psg-testimonial-loop .psg-testimonial-loop-inner .psg-testimonial-top .psg-testimonial-info .psg-testimonial-designation',
			]
		);

		$this->end_controls_section();

/** End Designation Styling **/

/** Start Star Rating Styling **/ 

		$this->start_controls_section(
			'rating_section',
			[
				'label' => __('Rating'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'star_color',
			[
				'label' => __('Color'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .psg-testimonial-loop .psg-testimonial-loop-inner .psg-testimonial-top .psg-testimonial-info .psg-star-rating-wrp' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

/** End Star Rating Styling **/

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
					'{{WRAPPER}} .psg-testimonial-loop .psg-testimonial-loop-inner .psg-testimonial-content' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'selector' => '{{WRAPPER}} .psg-testimonial-loop .psg-testimonial-loop-inner .psg-testimonial-content',
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
				'class' => ['psg-testimonial__label-heading'],
			]
		);

		$unique_id = uniqid('psg_testimonial_');

?>

<div class="psg-testimonial-main" id="<?php echo $unique_id; ?>">
	<?php if ( $settings['list'] ) { ?>
	<div class="psg-testimonial-slider swiper-container">
		<div class="swiper-wrapper">
		<?php foreach (  $settings['list'] as $item ) { ?>
			<div class="psg-testimonial-loop swiper-slide">
				<div class="psg-testimonial-loop-inner">
					<div class="psg-testimonial-top">	 
						<div class="psg-testimonial-img-main">
							<?php echo '<img src="' . $item['testimonial_image']['url'] . '">'; ?>
						</div> 
						<div class="psg-testimonial-info">
							<?php
							if(!empty($item['testimonial_name'])){
								echo '<h5 class="psg-testimonial-name">' . $item['testimonial_name'] . '</h5>';
							}
							if(!empty($item['testimonial_designation'])){
								echo '<p class="psg-testimonial-designation">' . $item['testimonial_designation'] . '</p>';
							}
							?>
							<p class="psg-star-rating-wrp">
								<?php $rating = $item['testimonial_rating']; ?>
								<?php if(!empty($rating)){ ?>
									<?php for($x = 0; $x < $rating ; $x++){ ?>
										<i class="fas fa-star"> </i>
									<?php } ?>
								<?php } ?>
							</p>	
						</div> 
						<img class="psg-testimonial-quote-icon" src="<?php echo get_template_directory_uri(); ?>/assets/images/quotes-icon.png" alt="Double Quotes Icon">
					</div>
					
					<?php if(!empty($item['testimonial_content'])){
						echo '<div class="psg-testimonial-content">'. $item['testimonial_content'] .'</div>';
					} ?>
				</div>
			</div>
			<?php } ?>
		</div>
	</div>
	<div class="swiper-scrollbar"></div>
	<div class="swiper-button-prev"></div>
	<div class="swiper-button-next"></div>
	<script>
		var mySwiper = new Swiper("#<?php echo $unique_id; ?> .psg-testimonial-slider", {
			freeMode: true,
			direction: "horizontal",
			slidesPerView: 2,
			observer: true,
			observeParents: true,
			scrollbar: {
				el: '#<?php echo $unique_id; ?> .swiper-scrollbar ',
				draggable: true,
				snapOnRelease: false
			},
			navigation: {
				nextEl: "#<?php echo $unique_id; ?> .swiper-button-next",
				prevEl: "#<?php echo $unique_id; ?> .swiper-button-prev"
			},
			breakpoints: {
				350: {
					slidesPerView: 1,
				},
				767: {
					slidesPerView: 2,
				},
				1024: {
					slidesPerView: 2,
				},
			},	
		});
	</script>	
	<?php } ?>
</div>

<?php }

}
