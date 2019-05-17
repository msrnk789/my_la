<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Auth;

class UserDocumentTest extends TestCase
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
   
    protected function authenticate(){
        // $user = User::create([
        //     'name' => 'test',
        //     'email' => 'test14@gmail.com',
        //     'password' => Hash::make('1234'),
        // ]);
        
        $user = User::where('phone','=', '8971301502')->first();
        $token = $user->createToken('MyApp')-> accessToken;
        return $token;
    }

    public function testDocument()
    {
        $token = $this->authenticate();
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $token,
        ])->json('POST',url('api/user_document_store'),[
            'document_type_id' => '1',
            'document_name_id' => '1',
            'number' => 'num123',
            'status_id' => '1'
            
        ]);
        $response->assertStatus(200);
        
    }

    public function test_bid_log()
    {
        $token = $this->authenticate();
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $token,
        ])->json('POST',url('api/biding_log'),[
            'vehicle_detail_id' => '1',
            'user_bid_price' => '10500'
        ]);
        $response->assertStatus(200);
    }

    public function test_bid_win()
    {
        $token = $this->authenticate();
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $token,
        ])->json('POST',url('api/biding_win'),[
            'bid_log_id' =>'1',
            'vehicle_detail_id' => '1',
            'bid_win_price' =>'20000'
        ]);
        $response->assertStatus(200);
    }

    public function test_user_profile()
    {
        $token = $this->authenticate();
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $token,
        ])->json('get',url('api/user_profile'));
        $response->assertStatus(200);
        
    }

}
