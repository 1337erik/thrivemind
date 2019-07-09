<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class LoggedUserControllerTest extends TestCase
{

    use RefreshDatabase;

    /**
     * @test
     * 
     * @return void
     */
    public function user_can_update_his_own_info()
    {
        $user = factory( User::class )->create();
        $this->actingAs( $user, 'api' );

        $response = $this->json( 'PUT', 'api/v1/user', $attr = [

            'email' => 'testauser@aol.com',
            'name'  => 'Joseph Riano'
        ]);

        $response->assertSuccessful();

        $response->assertJson( $attr );

        $user = User::find( $user->id );

        $this->assertEquals( $attr[ 'name'  ], $user->name );
        $this->assertEquals( $attr[ 'email' ], $user->email );
    }
}
