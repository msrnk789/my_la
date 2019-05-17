<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class AuctionTest extends TestCase
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

    public function test_home_page()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function testRegister(){
        $data = [
            // 'email' => 'test@gmail.com',
            // 'name' => 'Test',
            // 'password' => 'secret1234',
            // 'password_confirmation' => 'secret1234',
            'phone' => '8971301502'
        ];
        $response = $this->json('POST',route('api.register'),$data);
        $response->assertStatus(201);
        //User::where('phone',8971301502)->delete();
    }

    public function test_register()
    {
        $data = [
            // 'email' => 'test@gmail.com',
            // 'name' => 'Test',
            // 'password' => 'secret1234',
            // 'password_confirmation' => 'secret1234',
            'phone' => '89713015021'
        ];
        $response = $this->json('POST',url('api/register'),$data);
        $response->assertStatus(201);
    }

    public function test_otp_verify()
    {
        $response = $this->json('POST',url('api/otp_verify'),[
            'mobile_number' => '8971301502',
            'otp' => '372544'
        ]);
        $response->assertStatus(200);
    }


    protected $user;
   
    protected function authenticate(){
        // $user = User::create([
        //     'name' => 'test',
        //     'email' => 'test13@gmail.com',
        //     'password' => Hash::make('1234'),
        // ]);
        
        $user = User::where('phone','=', '8971301502')->first();
        $token = $user->createToken('MyApp')-> accessToken;
        return $token;
    }

    public function test_set_password()
    {
        //Get token
        $token = $this->authenticate();
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $token,
        ])->json('POST',url('api/set_password'),[
            'password' => '123456'
            
        ]);
        $response->assertStatus(200);
    }


    public function testLogin()
    {
        $response = $this->json('POST',url('api/login'),[
            'mobile_number' => '8971301502',
            'password' => '123456'
        ]);
        $response->assertStatus(200);
        //User::where('phone',8971301502, 'password', 123456);
    }

    


}
