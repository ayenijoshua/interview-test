<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
// use App\Models\User;
// use Illuminate\Database\Eloquent\Factory as EloquentFactory;
// use Faker\Generator as FakerGenerator;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;

class UserTest extends TestCase
{

    // function __construct(){
    //     //parent::setUp();
    // }

    // function setUp(){
    //     $this->app->singleton(EloquentFactory::class,function($app){
    //         $faker = $app->make(FakerGenerator::class);
    //         return EloquentFactory::construct($faker,__DIR__.('/..database/factories'));
    //     });
    // }
    
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    /**
     * test for 
     */
    public function testGetAllUsers(){
        //parent::setUp();
        // $this->app->singleton(EloquentFactory::class,function($app){
        //     $faker = $app->make(FakerGenerator::class);
        //     return EloquentFactory::construct($faker,__DIR__.('/../database/factories'));
        // });
        \factory(\App\Models\User::class)->make();
        $response = $this->json('GET', '/api/users');
        $response->assertStatus(200);
        $response->assertJson([
            'id',
            'name',
            'email'
        ]);

    }
}
