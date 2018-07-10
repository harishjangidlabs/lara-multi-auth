<?php

namespace App\Providers;

use Storage;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use League\Glide\ServerFactory;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
	    Schema::defaultStringLength(191);

	    Paginator::defaultView( 'pagination::view' );
	    //Paginator::defaultSimpleView('pagination::view');

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
	    $this->app->singleton( 'League\Glide\Server', function ( $app ) {

		    $filesystem = $app->make( 'Illuminate\Contracts\Filesystem\Filesystem' );
		    //$filesystem = Storage::getDriver();

		    // Set using factory
		    return ServerFactory::create( [
			    'source'             => $filesystem->getDriver(),
			    'cache'              => $filesystem->getDriver(),
			    'source_path_prefix' => 'public',
			    'cache_path_prefix'  => 'public/.cache',
			    'base_url'           => '/img/'
		    ] );

	    } );


    }
}
