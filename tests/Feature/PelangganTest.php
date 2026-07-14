<?php

namespace Tests\Feature;

use App\Models\Pelanggan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PelangganTest extends TestCase
{
    use RefreshDatabase;

    public function test_pelanggan_index_page_is_displayed_for_authenticated_user(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get('/pelanggan');

        $response->assertOk();
        $response->assertSee('Data Pelanggan');
    }

    public function test_authenticated_user_can_create_pelanggan(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->post('/pelanggan', [
                'id_pelanggan' => 'PEL-001',
                'nama_pelanggan' => 'Andi Prakoso',
                'nomor_whatsapp' => '081234567890',
                'tarif' => 'R1/450 VA',
                'daya' => '450',
                'alamat' => 'Jl. Soekarno Hatta No. 12',
                'peruntukan_listrik' => 'Rumah Tangga',
                'status_pelanggan' => 'Aktif',
            ]);

        $response
            ->assertRedirect('/pelanggan');

        $this->assertDatabaseHas('pelanggans', [
            'id_pelanggan' => 'PEL-001',
            'nama_pelanggan' => 'Andi Prakoso',
        ]);

        $this->assertInstanceOf(Pelanggan::class, Pelanggan::query()->first());
    }
}
