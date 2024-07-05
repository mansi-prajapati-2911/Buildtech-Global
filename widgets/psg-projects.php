<?php
namespace WPC\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class PSG_Projects extends Widget_Base {

	public function get_name() {
		return 'psg_projects';
	}

	public function get_title() {
		return 'PSG Projects';
	}

	public function get_icon() {
		return 'eicon-gallery-grid';
	}

	public function get_categories() {
		return ['psg-widget'];
	}

	protected function register_controls() {
		
		$project_loop =  get_posts(
			array( 
				'post_type' => 'projects',
				'posts_per_page' => -1,
				'post_status' => 'publish',
				'tax_query' => array(
					array(
						'taxonomy' => 'projects-tag',
						'field'    => 'name',
						'terms'    => 'homepage', 
					)
				),
			)
		); 
		$project_array = array();
		foreach( $project_loop as $project ):
			$project_array[$project->ID] =  $project->post_title;
		endforeach;
		
		$project_array_json = json_encode($project_array);
		
		
		$this->start_controls_section(
			'section_content',
			[
				'label' => 'Project',
			]
		);
		
		$this->add_control(
			'select_by',
			[
				'label' => esc_html__('Source'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'latest',
				'options' => [
					'latest'  => esc_html__( 'Latest'),
					'manual_select'  => esc_html__( 'Manually Selection'),
				],
			]
		);
		
		$this->add_control(
			'post_per_page',
			[
				'label' => esc_html__( 'Post Per Page'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '-1'),
				'placeholder' => esc_html__( 'Enter post per page number here.'),
				'conditions' => [
					'terms' => [
						[
							'name' => 'select_by',
							'value' => 'latest',
						],
					],
				],
			]
		);
		
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'manual_project_id',
			[
				'label' => esc_html__( 'Search & Select'),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'multiple' => false,
				'label_block' => true,
				'options' => $project_array,
			]
		);
		
		$this->add_control(
			'manual_list',
			[
				'label' => esc_html__( 'Project List'),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'manual_project_id' => __(''),
					],
					[
						'manual_project_id' => __(''),
					],
				],
				'title_field' => "<# "
                . "let labels = $project_array_json; " // Now the labels are available to the javascript
                . "let label = labels[manual_project_id]; "// Get the value of the selected page
                . "#>"
                . "{{{ label }}}",
				'conditions' => [
					'terms' => [
						[
							'name' => 'select_by',
							'value' => 'manual_select',
						],
					],
				],
			]
		);
		
		$this->end_controls_section();

/** Start Image Styling **/ 

		$this->start_controls_section(
			'image_section',
			[
				'label' => __('Image'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'image_height',
			[
				'label' => esc_html__( 'Height'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .psg-project-widget-main-wrp .psg-project-widget-loop .psg-project-widget-loop-inner img' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

/** End Image Styling **/ 

/** Start Hover Overlay Styling **/ 

		$this->start_controls_section(
			'hover_overlay_section',
			[
				'label' => __('Hover Overlay'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_control(
			'hover_overlay_color',
			[
				'label' => __('Background'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .psg-project-widget-main-wrp .psg-project-widget-loop .psg-project-widget-loop-inner:before' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'hover_overlay_opacity',
			[
				'label' => esc_html__( 'Opacity'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ '%'],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => '%',
				],
				'selectors' => [
					'{{WRAPPER}} .psg-project-widget-main-wrp .psg-project-widget-loop .psg-project-widget-loop-inner:hover:before' => 'opacity: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

/** End Hover Overlay Styling **/ 

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
					'{{WRAPPER}} .psg-project-widget-main-wrp .psg-project-widget-loop .psg-project-widget-loop-inner .psg-project-widget-title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .psg-project-widget-main-wrp .psg-project-widget-loop .psg-project-widget-loop-inner .psg-project-widget-title',
			]
		);

		$this->end_controls_section();

/** End Title Styling **/ 

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		
		if($settings['select_by'] == "latest"){
			$args = array(
				'post_type' => 'projects',
				'posts_per_page' => $settings['post_per_page'],
				'post_status' => 'publish',
				'order'          => 'DESC',
				'tax_query' => array(
					array(
						'taxonomy' => 'projects-tag',
						'field'    => 'name',
						'terms'    => 'homepage', 
					)
				),
			);
		}
		elseif($settings['select_by'] == "manual_select"){
			$project_ids = array();
			if ( $settings['manual_list'] ) {
				foreach (  $settings['manual_list'] as $item ) {
					$post_id = $item['manual_project_id'];
					$project_ids[$post_id] = $post_id;
				}
				$reco_pro_ids = implode(', ', $project_ids);

				$args = array(
					'post_type' => 'projects',
					'post_status' => 'publish',
					'orderby' => 'post__in',
					'post__in' => $project_ids,
				);
			}
		}
		$projects_query = new \WP_Query( $args );
		//$project_post = get_posts($args);
	?>

<div class="psg-project-widget-main-wrp">
	<?php 
	if($projects_query->have_posts()){
		while ( $projects_query->have_posts() ) : $projects_query->the_post(); ?>
		<div class="psg-project-widget-loop">
			<div class="psg-project-widget-loop-inner">
				<?php echo get_the_post_thumbnail( $projects_query->ID, 'full' );  ?>
				<div class="psg-project-widget-title"><?php the_title(); ?></div>
			</div>
		</div>
		<?php endwhile; 
	}else{
		echo '<h4 class="psg-project-widget-no-post-found">No project found!</h4>';
	}	
	?> 
</div>

	<?php } //End Render
}