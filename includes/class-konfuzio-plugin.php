<?php

class Konfuzio_Plugin {

	protected $loader;

	protected $konfuzio_plugin;

	protected $version;

	public function __construct() {
		if ( defined( 'PLUGIN_NAME_VERSION' ) ) {
			$this->version = PLUGIN_NAME_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->konfuzio_plugin = 'konfuzio-plugin';

		$this->load_dependencies();
		$this->define_admin_hooks();
		$this->define_public_hooks();
		$this->define_shortcode_hocks();
	}

	private function load_dependencies() {
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-konfuzio-plugin-loader.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-konfuzio-plugin-admin.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-konfuzio-plugin-public.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'shortcode/class-konfuzio-plugin-shortcode-visualisator.php';
		$this->loader = new Konfuzio_Plugin_Loader();
	}

	private function define_shortcode_hocks(){
	    $plugin_shortcode_visualisator = new Konfuzio_Plugin_Sortcode_Visualisator($this->get_plugin_name(), $this->get_version() );
	    $this->loader->add_action('wp_enqueue_scripts', $plugin_shortcode_visualisator, 'enqueue_styles');
        $this->loader->add_action('wp_enqueue_scripts', $plugin_shortcode_visualisator, 'enqueue_scripts');
	    $this->loader->add_shortcode('konfuzio_visualisator',$plugin_shortcode_visualisator,'konfuzio_visualisator');
    }

	private function define_admin_hooks() {
		$plugin_admin = new Konfuzio_Plugin_Admin( $this->get_plugin_name(), $this->get_version() );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		$this->loader->add_action('init', $plugin_admin, 'new_posttype');
        flush_rewrite_rules();


	}

	private function define_public_hooks() {
		$plugin_public = new Konfuzio_Plugin_Public( $this->get_plugin_name(), $this->get_version() );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

	}


    public function run() {
		$this->loader->run();
	}

	public function get_plugin_name() {
		return $this->konfuzio_plugin;
	}

	public function get_loader() {
		return $this->loader;
	}

	public function get_version() {
		return $this->version;
	}

}