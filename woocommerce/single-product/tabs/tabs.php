<?php
/**
 * Plugin Name: WooCommerce Tabs to Accordion
 * Plugin URI: https://wpvilla.in
 * Description: Changes the default WooCommerce tabs to an Accordion when on mobile devices
 * Version: 1.0.1
 * Author: Jasper Frumau
 * Author URI: https://wpvilla.in
 *
 * Text Domain: wctta
 *
 * @author wpvillain
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * WooCommerce Tabs to Accordion class
 * 
 * Class to convert WooCommerce Tabs to accordions on smaller screen sizes
 * starting at breakpoint set
 */
class WooCommerceTabsToAccordion
{
	public function __construct()
	{
		// Add new section to WooCommerce > Settings > Products
		add_filter( 'woocommerce_get_sections_products', array($this, 'add_settings_section') );
		add_filter( 'woocommerce_get_settings_products', array($this, 'register_plugin_settings'), 10, 2 );

		add_action( 'wp_head', array($this, 'remove_default_wc_tabs_action'));
		add_action( 'wp_enqueue_scripts', array($this, 'register_scripts_and_styles'));

		add_action( 'woocommerce_after_single_product_summary', array($this, 'custom_tab_template'), 15 );
	}

	/**
	 * Add Settings Sectin function
	 *
	 * @param [type] $sections
	 * @return void
	 */
	public function add_settings_section( $sections )
	{
		$sections['wctta'] = __('WC Tabs to Accordion', 'wctta');
		return $sections;
	}
	/**
	 * Register Plugin Settings function
	 *
	 * @param [type] $settings
	 * @param [type] $current_section
	 * @return void
	 */
	public function register_plugin_settings( $settings, $current_section )
	{
		if ( $current_section == 'wctta' ) {

			$settings_wctta = array();

			$settings_wctta[] = array(

				'name' 	=> __('WC Tabs to Accordion', 'wctta'),
				'type' 	=> 'title',
				'desc' 	=> __('The following options are used to configure the WC Tabs to Accordion plugin', 'wctta'),
				'id' 	=> 'wctta'

			);

			$settings_wctta[] = array(

				'name' => __('Breakpoint', 'wctta'),
				'desc_tip' => __('Set the pixel width which you would like the tabs to change to an accordion', 'wctta'),
				'id' => 'wctta_breakpoint',
				'type' => 'text',
				'default' => '600',
				'css' => 'text-align:right;',
				'desc' => __('px', 'wctta')

			);

			$settings_wctta[] = array('type' => 'sectionend', 'id' => 'wctta');

			return $settings_wctta;

		} else {

			return $settings;

		}
	}

	/**
	 * Script and Styles Registraton function
	 *
	 * @return void
	 */
	

	/**
	 * Remove Default WooCommerce Tabs function
	 *
	 * @return void
	 */
	public function remove_default_wc_tabs_action()
	{
		remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
	}

	public function custom_tab_template()
	{
		$tabs = apply_filters( 'woocommerce_product_tabs', array() );

		if ( ! empty( $tabs ) ) : ?>
			
			<div class="psg-product-detail-popup-wrp">
				<ul class="psg-product-detail-popup-list">
					<?php foreach ( $tabs as $key => $tab ){ ?>
					<li class="psg-product-popup-loop psg_<?php echo esc_attr( $key ); ?>" id="psg-tab-title-<?php echo esc_attr( $key ); ?>">
						
						<div class="psg-product-popup-trigger-wrp">
							<span><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $tab['title'] ), $key ); ?></span>
							<i class="fal fa-plus"></i>
						</div>
						
						<div class="psg-product-popup-content-wrp">
							<div class="psg-product-detail-owerlay"></div>
							<div class="psg-product-popup-content">
								<?php call_user_func( $tab['callback'], $key, $tab ); ?>
							</div>
						</div>
						
					</li>
					<?php } ?>
				</ul>
			</div>

		<?php endif;
	}
}

new WooCommerceTabsToAccordion;