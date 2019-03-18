<?php

namespace Taxonomy;

class AutoLoader {
	public function __construct() {
		self::_autoloadClass();
		new Smartphones_Manufactures();
		new Smartphones_Year();
		new Smartphones_Ram();
		new Smartphones_Screen();
		new Smartphones_Processor();

	}

	static function _autoloadClass() {
		spl_autoload_register( function ( $name_class_all ) {
			$name_class_mas = explode( '\\', $name_class_all );
			$name_class     = end( $name_class_mas );
			$path_class     = realpath( get_template_directory() . "/taxonomy/" . $name_class . ".php" );
			if ( file_exists( $path_class ) ) {
				require_once $path_class;
			}
		} );
	}

}

