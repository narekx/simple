<?php


namespace App\Providers;



use App\ViewComposers\CategoriesComposer;
use App\ViewComposers\CitiesComposer;
use App\ViewComposers\ServicesComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     *
     */
    public function boot ()
    {

    }
}
