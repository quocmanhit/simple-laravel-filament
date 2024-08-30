<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Filament::serving(function () {
            app()->setLocale('vi'); // Thiết lập ngôn ngữ tiếng Việt cho Filament
            Filament::registerNavigationGroups([
                NavigationGroup::make('Custom Pages')
                    ->items([
                        NavigationItem::make('My Custom Page')
                            ->url(route('custom.page'))
                            ->icon('heroicon-o-document')
                            ->sort(1),
                    ]),
            ]);
        });

    }
}
