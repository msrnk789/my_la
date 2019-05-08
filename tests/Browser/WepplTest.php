<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Auth;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class WepplTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function test_wepp()
    {
        $this->browse(function ($browser){
            $browser->visit('/')
                    ->assertSee('Trending Causes');
        });
    }
    // public function testExample()
    // {
    //     $this->assertTrue(true);
    // }

    // public function testState_view()
    // {
    //     $this->browse(function ($browser){
    //         $browser->loginAs(Auth::user()->hasRole('admin'))
    //                 ->visit('/admin/state')
    //                 ->assertSee('State Name');

    //     });
    // }

    // public function test_state_create_new()
    // {
    //     $this->browse(function ($browser){
    //         $browser->loginAs(Auth::user())
    //                 ->visit('/admin/state')
    //                 ->type('state_name', 'dd')
    //                 ->type('status', '1')
    //                 ->press('Submit')
    //                 ->assertSee('State Name');

    //     });
    // }

    // public function test_city_create_new()
    // {
    //     $this->browse(function ($browser){
    //         $browser->loginAs(Auth::user())
    //                 ->visit('/admin/city')
    //                 ->type('state_id','1')
    //                 ->type('city_name', 'mysore')
    //                 ->type('status', '1')
    //                 ->press('Submit')
    //                 ->assertPathIs('/admin/city')
    //                 ->assertSee('State Name');
    //     });
    // }

    // public function setUp()
    // {
    //     parent::setUp();
    //     $this->browse(function ($browser) {
    //         $browser->loginAs(User::where('email', 'guru@gmail.com')->firstOrFail);
    //     });
    // }

    // public function test_ngo_profile_create()
    // {
    //     $user = User::all();
    //     $this->browse(function ($browser) use($user){
    //         $browser->loginAs($user)
    //                 ->visit('/ngo/profile/general')
    //                 ->assertSee('General Form')
    //                 ->type('name','guru')
    //                 ->type('state_name','karnataka')
    //                 ->type('city_id','1')
    //                 ->type('website_url','https://google.com')
    //                 ->type('mobile_no', '123456')
    //                 ->type('description', 'health')
    //                 ->type('contact_person_name', 'guru')
    //                 ->type('contact_person_designation', 'manager')
    //                 ->type('bank_name','canara bank')
    //                 ->type('account_number', '123456789')
    //                 ->type('account_type', 'savings')
    //                 ->type('ifsc_code', 'can12345')
    //                 ->type('terms', '1')
    //                 ->type('decalration', '1')
    //                 ->press('Update')
    //                 ->assertPathIs('ngo/ngo_profile_general')
    //                 ->assertSee('General');
    //     });
    // }

    // public function test_ngo_profile_document_update()
    // {
    //     $user = factory('App\User')->create();
    //     $this->browse(function ($browser) use($user){
    //         $browser->loginAs($user)
    //                 ->visit('/ngo/profile/documents')
    //                 ->assertSee('General Form')
    //                 ->type('pan_number', 'ABCD1234')
    //                 ->type('registration_document', '123456')
    //                 ->type('reg_12a_doc', 'document1')
    //                 ->type('reg_80g_doc', 'document2')
    //                 ->type('audi_statement', 'audi statement')
    //                 ->type('document_terms', '1')
    //                 ->type('document_agree', '1')
    //                 ->press('Save')
    //                 ->assertPathIs('ngo/ngo_profile_document')
    //                 ->assertSee('General Form');
    //     });
    // }

    public function test_contact_us()
    {
        $this->browse(function ($browser){
            $browser->visit('/contact')
                    ->assertSee('Contact Us')
                    ->type('first_name', 'guru')
                    ->type('last_name', 's')
                    ->type('email', 'guru@gmail.com')
                    ->type('phone', '123456')
                    ->type('message', 'hai')
                    ->press('Send message')
                    ->assertPathIs('/contact')
                    ->assertSee('Contact Us');
        });
    }

    public function test_career_page()
    {
        $this->browse(function ($browser){
            $browser->visit('/careers')
                    ->assertSee('Sign Up For Job Alerts')
                    ->type('name', 'maha')
                    ->type('surname', 's')
                    ->type('email', 'maha@gmail.com')
                    ->attach('document', __DIR__.'/public/img/11_img.jpg')
                    ->assertStatus(200);
        });
    }

}
