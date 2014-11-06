<?php namespace Daursu\Xero;

use Illuminate\Support\ServiceProvider;

/**
* Define for file includes. The certs directory is best stored out of web root so moving the directory
* and updating the reference to BASE_PATH is the best way to ensure things keep working
*/
define('XERO_BASE_PATH', dirname(__FILE__));

class XeroServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('daursu/xero');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		require_once XERO_BASE_PATH . '/lib/OAuthSimple.php';
		require_once XERO_BASE_PATH . '/lib/XeroOAuth.php';
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}
