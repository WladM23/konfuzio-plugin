<?php

class Konfuzio_Plugin_Admin {

	private $konfuzio_plugin;

	private $version;

	public function __construct( $konfuzio_plugin, $version ) {
		$this->konfuzio_plugin = $konfuzio_plugin;
		$this->version = $version;
	}

	public function new_posttype() {
        register_post_type( 'results', ['public' => true, 'label'=>'Results' ] );
    }

	public function enqueue_styles() {
		wp_enqueue_style( $this->konfuzio_plugin, plugin_dir_url( __FILE__ ) . 'css/konfuzio-plugin-admin.css', array(), $this->version, 'all' );
	}

	public function enqueue_scripts() {
		wp_enqueue_script( $this->konfuzio_plugin, plugin_dir_url( __FILE__ ) . 'js/konfuzio-plugin-admin.js', array( 'jquery' ), $this->version, false );
	}


}
