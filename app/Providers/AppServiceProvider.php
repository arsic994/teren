<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;

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

        //Implementing function less or equal
        Validator::extend('smaller_or_equal', function($attribute, $value, $parameters, $validator) {
          $min_field = $parameters[0];
          $data = $validator->getData();
          $min_value = $data[$min_field];

          return $value <= $min_value;
      });   
        //Implementing function less or equal
        Validator::replacer('smaller_or_equal', function($message, $attribute, $rule, $parameters) {
          return str_replace(':field', $parameters[0], $message);
      });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
