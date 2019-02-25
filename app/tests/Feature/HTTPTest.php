<?php

namespace Tests\Feature;

use App\User;
use Laravel\Passport\Passport;
use Tests\TestCase;

class HTTPTest extends TestCase
{

    public function testGetProduct()
    {
        $response = $this->get('/products/xxx');
        $response->assertStatus(404);
    }

    public function testGetProducts()
    {
        $response = $this->get('/products');
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'sku',
                    'title',
                    'url',
                    'abstract',
                    'description',
                    'price',
                    'image_url',
                    'stock',
                    'created_at',
                    'updated_at',
                ]
            ],
            'links' => [
                'self',
                'next',
                'last'
            ]
        ]);
        $response->assertStatus(200);
    }

    public function testPostProductNOToken()
    {
        $response = $this->json('POST', '/products', []);
        $response->assertStatus(401);
    }

    public function testPostProductNOData()
    {
        Passport::actingAs(
            factory(User::class)->create(),
            ['product.post']
        );

        $response = $this->json('POST', '/products', []);
        $response->assertStatus(422);
    }

    public function testPostProduct()
    {

        Passport::actingAs(
            factory(User::class)->create(),
            ['product.post']
        );

        $response = $this->json('POST', '/products', [
            'title' => 'test_case',
            'sku' => '123',
            'url' => 'http://luctus.com/et/ultrices/posuere/cubilia/curae/donec.jsp',
            'description' => 'ipsum ac tellus semper interdum mauris ullamcorper purus sit amet nulla',
            'price' => 1,
            'stock' => 20,
            'image_url' => 'http://luctus.com/et/ultrices/posuere/cubilia/curae/donec.jsp',
            'abstract' => 'ipsum ac tellus semper interdum mauris ullamcorper purus sit amet nulla',
        ]);
        $response->assertStatus(200);
    }
}
