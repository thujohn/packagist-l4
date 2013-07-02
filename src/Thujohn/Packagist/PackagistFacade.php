<?php namespace Thujohn\Packagist;

use Illuminate\Support\Facades\Facade;

class PackagistFacade extends Facade {

	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor() { return 'packagist'; }

}