<?php

namespace Tests\Browser\Components\Navbar;

use Laravel\Dusk\Browser;
use Laravel\Dusk\Component as BaseComponent;

class ProfileComponent extends BaseComponent
{
    /**
     * Get the root selector for the component.
     *
     * @return string
     */
    public function selector()
    {
        return '.profile';
    }

    /**
     * Assert that the browser page contains the component.
     *
     * @param  Browser $browser
     * @return void
     */
    public function assert(Browser $browser)
    {
        $browser->assertVisible($this->selector());
    }

    /**
     * Get the element shortcuts for the component.
     *
     * @return array
     */
    public function elements()
    {
        return [
            '@logout' => 'form[action="' . route('logout') . '"] button',
            '@login' => 'a[href="' . route('login') . '"]',
            '@register' => 'a[href="' . route('register') . '"]',
        ];
    }

    /**
     * @param Browser $browser
     */
    public function assertIsGuest($browser)
    {
        $browser->assertMissing('@logout');
        $browser->assertVisible('@login');
    }

    /**
     * @param Browser $browser
     */
    public function assertIsLoggedIn($browser)
    {
        $browser->assertMissing('@login');
        $browser->assertVisible('@logout');
    }
}
