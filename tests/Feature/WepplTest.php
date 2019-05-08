<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use App\Models\State;
use App\Models\City;
use App\Models\NgoProfile;
use App\Models\NgoDocument;

class WepplTest extends TestCase
{
	use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function test_home_page()
    {
    	$response = $this->get('/');
    	$response->assertStatus(200);
    }

    // public function test_user_can_view_a_login_form()
    // {
    //     $response = $this->get('/login');
    //     $response->assertSuccessful();
    //     $response->assertViewIs('auth.login');
    // }

    // public function test_user_cannot_view_a_login_form_when_authenticated()
    // {
    //     $user = factory(User::class)->make();
    //     $response = $this->actingAs($user)->get('/login');
    //     $response->assertRedirect('/home');
    // }

    public function test_donor_register()
    {
    	$response = $this->get('/donor_register');
    	$response->assertSee('Donor Register');
    }

    public function test_beneficiary_lists()
    {
    	$response = $this->get('/beneficiary_lists');
    	$response->assertSee("FEATURED CAUSE'S");
    }


    //// Ngo test cases
    public function test_ngo_dashbord()
    {

		$user = new User(['email' =>'guru@gmail.com','password' => '123456']); 
        $this->be($user);
        $response = $this->call('GET', '/ngo/dashboard');
        $response->assertSee('General Form');
    }

    public function test_ngo_profile()
    {
    	$user = new User(['email' => 'guru@gmail.com', 'password' => '123456']);
    	$this->be($user);
    	$response = $this->call('GET', '/ngo/profile/general');
    	$response->assertSee('General Form');
    }

    public function test_ngo_get_city()
    {
    	$user = new User(['email' => 'guru@gmail.com', 'password' =>'123456']);
    	$this->be($user);
    	$response = $this->call('GET', '/ngo/profile/get_city');
    	$response->assertSee('General Form');
    }

    // public function test_ngo_update_profile()
    // {
    // 	$user = new User(['email' => 'guru@gmail.com', 'password' =>'123456']);
    // 	$this->be($user);
    // 	$response = $this->call('POST', '/ngo/ngo_profile_general');
    	
    // 	//$response->assertRedirect('/ngo/profile/general');
    // 	$response->assertSee('General');
    // }

    public function test_ngo_documents()
    {
    	$user = new User(['email' => 'guru@gmail.com', 'password' =>'123456']);
    	$this->be($user);
    	$response = $this->call('GET', '/ngo/profile/documents');
    	$response->assertSee('General Form');
    }

    public function test_ngo_beneficiary_create()
    {
    	$user = new User(['email' => 'guru@gmail.com', 'password' =>'123456']);
    	$this->be($user);
    	$response = $this->call('GET', '/ngo/beneficiary/create/{id}');
    	$response->assertSee('General Form');
    }

    public function test_ngo_beneficiary()
    {
    	$user = new User(['email' => 'admin@gmail.com', 'password' =>'123456']);

    	$this->be($user);
    	$response = $this->call('resource', '/ngo/beneficiary');
    	$response->assertSee('General Form');
    }

    public function test_ngo_users()
    {
    	$user = new User(['email' => 'admin@gmail.com', 'password' =>'123456']);

    	$this->be($user);
    	$response = $this->call('resource', '/ngo/users');
    	$response->assertSee('General Form');
    }


    ////Admin test cases

    public function  test_admin_dashboard()
    {
    	$user = new User(['email' => 'admin@gmail.com', 'password' =>'123456']);
    	$this->be($user);
    	$response = $this->call('GET', '/admin/dashboard');
    	$response->assertSee('General Form');
    }

    public function test_admin_beneficiary_approve()
    {
    	$user = new User(['email' => 'admin@gmail.com', 'password' =>'123456']);
    	$this->be($user);
    	$response = $this->call('GET', '/admin/beneficiary/approve/{id}');
    	$response->assertSee('General Form');
    }

    public function test_admin_beneficiary_reject()
    {
    	$user = new User(['email' => 'admin@gmail.com', 'password' =>'123456']);
    	$this->be($user);
    	$response = $this->call('GET', '/admin/beneficiary/reject/{id}');
    	$response->assertSee('General Form');
    }

    public function test_admin_category()
    {
    	$user = new User(['email' => 'admin@gmail.com', 'password' =>'123456']);

    	$this->be($user);
    	$response = $this->call('resource', '/admin/category');
    	$response->assertSee('Category');
    }

    public function test_admin_feature()
    {
    	$user = new User(['email' => 'admin@gmail.com', 'password' =>'123456']);

    	$this->be($user);
    	$response = $this->call('resource', '/admin/feature');
    	$response->assertSee('Feature');
    }

    public function test_admin_state()
    {
    	$user = new User(['email' => 'admin@gmail.com', 'password' =>'123456']);

    	$this->be($user);
    	$response = $this->call('resource', '/admin/state');
    	$response->assertSee('General Form');
    }

    public function test_admin_city()
    {
    	$user = new User(['email' => 'admin@gmail.com', 'password' =>'123456']);

    	$this->be($user);
    	$response = $this->call('resource', '/admin/city');
    	$response->assertSee('General Form');
    }


    // login for social media

    public function test_login_facabook()
    {
    	$user = new User(['email'=>'maha@gmail.com', 'password' => '']);
    	$this->be($user);
    	$response = $this->call('get', '/login/facebook');
    	$response->assertRedirect('/home');
    }

    // public function test_login_google()
    // {
    // 	// $user = new User(['email'=>'maha@gmail.com', 'password' => '']);
    // 	// $this->be($user);
    // 	$response = $this->call('get', '/google/redirect');
    // 	$response->assertRedirect('/home');
    // }

    public function test_ngo_profile_document_update()
    {
        $user = new User(['email' =>'demo@gmail.com', 'password' =>'']);
        $this->be($user);
        $response = $this->call('POST', ['/ngo/ngo_profile_document']);
        //$response->assertStatus(419);
        //$response->assertRedirect('/ngo/profile/documents');
        $response->assertSee('Ngo');
    }
   
 


}

