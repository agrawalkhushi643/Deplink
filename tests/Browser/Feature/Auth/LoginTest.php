<?php

namespace Tests\Browser\Feature\Auth;

use Tests\Browser\Components\Navbar\ProfileComponent;
use Tests\Browser\Pages\LoginPage;
use Tests\Browser\Pages\PackagesPage;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * @throws \Exception
     * @throws \Throwable
     */
    public function testDefaultAccount()
    {
        $this->artisan('db:seed');
        $this->browse(function (Browser $browser) {
            $browser->visit(new LoginPage)
                ->within(new ProfileComponent, function ($browser) {
                    $browser->assertIsGuest();
                })
                ->type('@email', 'admin@localhost')
                ->type('@password', 'secret')
                ->assertSee('Remember me')
                ->click('@login')
                ->on(new PackagesPage)
                ->within(new ProfileComponent, function ($browser) {
                    $browser->assertIsLoggedIn();
                });
        });
    }
}
