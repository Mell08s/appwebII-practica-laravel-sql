<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Paralelo;
use App\Models\Estudiante;

class ParaleloTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        //Paralelos Prueba
        Paralelo::factory()->create(['nombre' => 'P1']);
        Paralelo::factory()->create(['nombre' => 'P2']);

        //Cambiar ruta raiz por la ruta parelelo
        //$response = $this->get('/');
        $response = $this->getJson('/api/paralelos');

        // enviamos respuesta 
        $response->assertStatus(200)
        ->asssertJsonFragment(['nombre' => 'P1'])
        ->asssertJsonFragment(['nombre' => 'P2']);
    }
}
