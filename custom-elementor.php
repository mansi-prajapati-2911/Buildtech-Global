<?php
namespace WPC;

// use Elementor\Plugin; ?????
class Widget_Loader{

  private static $_instance = null;

  public static function instance()
  {
    if (is_null(self::$_instance)) {
      self::$_instance = new self();
    }
    return self::$_instance;
  }


	private function include_widgets_files(){
		require_once(__DIR__ . '/widgets/banner-image.php');
		require_once(__DIR__ . '/widgets/psg-home-slider.php');
		require_once(__DIR__ . '/widgets/psg-testimonial.php');
		require_once(__DIR__ . '/widgets/psg-products.php');
		require_once(__DIR__ . '/widgets/psg-product-category.php');
		require_once(__DIR__ . '/widgets/psg-projects.php');
	}



	public function register(){

		$this->include_widgets_files();
		\Elementor\Plugin::instance()->widgets_manager->register(new Widgets\PSG_Banner_image());
		\Elementor\Plugin::instance()->widgets_manager->register(new Widgets\PSG_Home_Slider());
		\Elementor\Plugin::instance()->widgets_manager->register(new Widgets\PSG_Testimonial());
		\Elementor\Plugin::instance()->widgets_manager->register(new Widgets\PSG_Products());
		\Elementor\Plugin::instance()->widgets_manager->register(new Widgets\PSG_Products_Category());
		\Elementor\Plugin::instance()->widgets_manager->register(new Widgets\PSG_Projects());
						
	}

  public function __construct(){
    add_action('elementor/widgets/register', [$this, 'register'], 99);
  }
}

// Instantiate Plugin Class
Widget_Loader::instance();

?>