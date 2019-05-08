<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class RegisterTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     *
     * @return void
     */
    // public function testRegister()
    // {
    //      $this->browse(function ($browser) {
    //         $browser->visit('/donor_register')
    //         		   ->type('name', 'maha')
    //                 ->type('email', 'maha1@gmail.com')
    //                 ->type('mobile_no', '1234567890')
    //                 ->type('password', '123456')
    //                 ->type('password_confirmation', '123456')
    //                 ->press('Create Account')
    //                 ->assertSee('Categories');
                    
                    
    //     });
    // }

    // public function test_ngo_register()
    // {
    // 	$this->browse(function ($browser){
    //         $browser->visit('/register')
    //                 ->type('name', 'demo')
    //                 ->type('email', 'demo@gmail.com')
    //                 ->type('mobile_no', '123456')
    //                 ->type('password', '123456')
    //                 ->type('password_confirmation', '123456')
    //                 ->press('Create Account')
    //                 ->assertSee('General Form');
    //     });
    // }
    public function test_log()
    {
        $this->assertTrue(true);
    }
}
