<?php

namespace Tests\Feature;

use App\Models\BidMake;
use App\User;
use Auth;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function test_login_form()
    {
        $response = $this->get('/login');
        $response->assertSuccessful();
        $response->assertViewIs('auth.login');
    }

    public function test_admin()
    {
        $admin = User::where('email','=','admin1@auctions.com')->first();
        $this->assertTrue($admin->hasRole('admin'));

    }

    public function test_make()
    {
        $admin = User::where('email','=','admin@auctions.com')->first();
        $make = BidMake::find('1');
        $this->actingAs($admin);
        //$response = $this->get('/admin/bidmake');
        //$response->assertSee($make->name);
        //$response->assertStatus(200);
        $response = $this->get('admin/bidmake');
        $response->assertSee($make->name);
    }

    public function test_make_create()
    {
        $admin = User::where('email','=','admin@auctions.com')->first();
        $this->actingAs($admin);
        // $data = BidMake::create([
        //     'name' => 'honda',
        //     'status' => '1'
        // ]);
        $data = [
            'name' => 'Isuzu'
        ];
        $response = $this->post('admin/bidmake', $data);
        $response->assertStatus(200);

    }

    public function test_make_edit()
    {
        $admin = User::where('email','=','admin@auctions.com')->first();
        $this->actingAs($admin);
        $id= '10';

        $response = $this->get('admin/bidmake/'.$id);
        $response->assertStatus(200);
    }

    public function test_make_update()
    {
        $admin = User::where('email','=','admin@auctions.com')->first();
        $this->actingAs($admin);

        $data = [
            'name' => 'isu'
        ];
        $id= '15';
        $response = $this->put('admin/bidmake/'.$id, $data);
        $response->assertStatus(200);
    }

    public function test_make_delete()
    {
        $admin = User::where('email','=','admin@auctions.com')->first();
        $this->actingAs($admin);

        $id =  '14';
        $response =  $this->delete('admin/bidmake/'.$id);
        $response->assertStatus(200);
    }


    //url testing
    public function test_make_page()
    {
        
        $admin = User::where('email','=','admin@auctions.com')->first();
        $this->be($admin);
        $response = $this->call('GET', '/admin/bidmake');
        //$response->assertSee('Make');
        $response->assertStatus(200);
    }

    
}
