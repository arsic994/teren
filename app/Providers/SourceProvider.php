<?php 

namespace App\Providers;

use App\Source; //model name
use Illuminate\Support\ServiceProvider;

class SourceProvider extends ServiceProvider 
{
	public function boot() {
		view()->composer('*', function($view){
			
			$source_data=Source::all();
			//dd($source_data);
			$view->with('source_data', $source_data); //niz koji ce da sadrzi podatke koje vucemo iz tabele

		});
	}
}