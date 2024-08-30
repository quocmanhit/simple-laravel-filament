<?php

namespace App\Filament\Pages;
use Illuminate\Contracts\Support\Htmlable;
use Filament\Actions\Action;
use Filament\Pages\Page;
use Filament\Widgets\StatsOverviewWidget;

class TestCustom extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.test-custom';
    public function onboardingAction(): Action
    {
        return Action::make('onboarding')
            ->modalHeading('Welcome')
            ->visible(fn (): bool => ! auth()->user()->isOnBoarded());
    }

    public $defaultActionArguments = ['step' => 2];
//    protected function getHeaderWidgets(): array
//    {
//        return [
//            StatsOverviewWidget::class
//        ];
//    }
//    public function getHeaderWidgetsColumns(): int | array
//    {
//        return [
//            'md' => 4,
//            'xl' => 5,
//        ];
//    }
//    public function getWidgetData(): array
//    {
//        return [
//            'stats' => [
//                'total' => 100,
//            ],
//        ];
//    }
//    public $stats = [];
    protected static ?string $title = 'Custom Page Title';
    public function getTitle(): string | Htmlable
    {
        return __('Custom Page Title');
    }
    protected ?string $heading = 'Custom Page Heading';
    public function getHeading(): string
    {
        return __('Custom Page Heading');
    }
    protected ?string $subheading = 'Custom Page Subheading';
    public function getSubheading(): ?string
    {
        return __('Custom Page Subheading');
    }
}
