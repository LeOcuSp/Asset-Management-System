<?php

namespace App\Providers\Filament;
// namespace App\Filament\Widgets;

use Filament\Pages;
use Filament\Panel;
use Filament\Widgets;
use Filament\PanelProvider;
use PhpParser\Node\Stmt\Label;
use Filament\Navigation\MenuItem;
use Filament\Support\Colors\Color;
use Filament\Navigation\NavigationItem;
use Filament\Navigation\NavigationGroup;
use App\Filament\Widgets\AssetDamageStats;
use Filament\Http\Middleware\Authenticate;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Saade\FilamentFullCalendar\FilamentFullCalendarPlugin;
use Saade\FilamentFullCalendar\Widgets\FullCalendarWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use App\Filament\User\Resources\EventRegisterResource\Widgets\CalendarWidget;

class UserPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            
            ->databaseNotificationsPolling('30s')
            ->id('user')
            ->path('/')
            ->login()
            ->colors([
                'primary' => Color::rgb('rgb(255, 0, 0)'),
                'success' => Color::Blue,
                'warning' => Color::Orange,
                'danger' => Color::Yellow,
                'info' => Color::Green,
            ])
            ->discoverResources(in: app_path('Filament/User/Resources'), for: 'App\\Filament\\User\\Resources')
            ->discoverPages(in: app_path('Filament/User/Pages'), for: 'App\\Filament\\User\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/User/Widgets'), for: 'App\\Filament\\User\\Widgets')
            ->widgets([
                AssetDamageStats::class,
                FullCalendarWidget::class, 
            ])
        
            ->userMenuItems([
                MenuItem::make()->label('Admin')
                ->icon('heroicon-o-shield-check')
                ->url('admin')
                ->visible(fn():bool => auth()->user()->is_admin),
            ])
            ->topNavigation()
            ->navigationItems([
            ])
           
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->plugins([FilamentFullCalendarPlugin::make()]);
            ;
    }
}
