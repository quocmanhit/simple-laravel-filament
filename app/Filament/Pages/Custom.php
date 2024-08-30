<?php
namespace App\Filament\Pages;

use Filament\Pages\Page;

class CustomPage extends Page
{
    protected static ?string $navigationLabel = 'Custom Page';
    protected static ?string $navigationGroup = 'Nhóm Mới';

    public static function getNavigationItems(): array
    {
        return [
            NavigationItem::make()
                ->label('Menu Mới')
                ->icon('heroicon-o-collection')
                ->url(route('custom.page'))
                ->group('Nhóm Mới'),
        ];
    }

    public function render(): \Illuminate\Contracts\View\View
    {
        return view('filament.pages.custom-page');
    }
}
