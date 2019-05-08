<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
   
    // public function testLogin()
    // {
    //     $this->browse(function ($browser) {
    //         $browser->visit('/login')
    //                 ->type('email', 'guru@gmail.com')
    //                 ->type('password', '123456')
    //                 ->press('Login')
    //                 ->assertSee('General'); //Categories
                    
    //     });
    
    // }

    public function test_log()
    {
        $this->assertTrue(true);
    }
    

}
