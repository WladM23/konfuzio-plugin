<?php

class Konfuzio_Plugin_Deactivator {

	public static function deactivate() {
        unregister_post_type( 'results' );
        // Clear the permalinks to remove our post type's rules from the database.
        flush_rewrite_rules();
	}

}
