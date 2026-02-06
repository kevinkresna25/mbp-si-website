<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Transaction;
use App\Enums\TransactionStatus;
use App\Livewire\TransactionForm;
use App\Livewire\ApprovalTable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class ApprovalWorkflowTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Reset permission cache
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create roles
        Role::create(['name' => 'admin', 'guard_name' => 'web']);
        Role::create(['name' => 'bendahara', 'guard_name' => 'web']);
        Role::create(['name' => 'takmir_inti', 'guard_name' => 'web']);
        Role::create(['name' => 'media', 'guard_name' => 'web']);
        Role::create(['name' => 'jamaah', 'guard_name' => 'web']);

        // Create permissions
        $permissions = [
            'manage transactions', 'approve transactions', 'view transactions',
            'manage articles', 'manage galleries', 'manage kegiatan',
            'manage pembangunan', 'manage pengumuman', 'manage struktur',
            'manage users', 'view audit log',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        Role::findByName('admin')->givePermissionTo(Permission::all());
        Role::findByName('takmir_inti')->givePermissionTo([
            'approve transactions', 'view transactions',
            'manage articles', 'manage galleries', 'manage kegiatan',
            'manage pembangunan', 'manage pengumuman', 'manage struktur',
            'view audit log',
        ]);
        Role::findByName('bendahara')->givePermissionTo([
            'manage transactions', 'view transactions',
        ]);
        Role::findByName('media')->givePermissionTo([
            'manage articles', 'manage galleries', 'manage kegiatan',
        ]);
    }

    public function test_bendahara_can_access_create_transaction_page(): void
    {
        $bendahara = User::factory()->create();
        $bendahara->assignRole('bendahara');

        $response = $this->actingAs($bendahara)->get(route('admin.transactions.create'));
        $response->assertStatus(200);
    }

    public function test_bendahara_can_create_transaction_via_livewire(): void
    {
        $bendahara = User::factory()->create();
        $bendahara->assignRole('bendahara');

        $this->actingAs($bendahara);

        Livewire::test(TransactionForm::class)
            ->set('tanggal', now()->format('Y-m-d'))
            ->set('type', 'debit')
            ->set('category_ziswaf', 'infaq')
            ->set('category_detail', 'Infaq Jumat')
            ->set('nominal', '500000')
            ->set('keterangan', 'Test transaction')
            ->call('save');

        $this->assertDatabaseHas('transactions', [
            'category_detail' => 'Infaq Jumat',
            'status' => 'draft',
        ]);
    }

    public function test_bendahara_can_submit_draft_transaction(): void
    {
        $bendahara = User::factory()->create();
        $bendahara->assignRole('bendahara');

        $transaction = Transaction::create([
            'transaction_code' => 'TRX-TEST-010',
            'tanggal' => now(),
            'type' => 'debit',
            'category_ziswaf' => 'infaq',
            'category_detail' => 'Test',
            'nominal' => 100000,
            'status' => 'draft',
            'created_by' => $bendahara->id,
        ]);

        $response = $this->actingAs($bendahara)->patch(
            route('admin.transactions.submit', $transaction->id)
        );

        $response->assertRedirect();
        $this->assertEquals('submitted', $transaction->fresh()->status->value);
    }

    public function test_takmir_can_access_approval_page(): void
    {
        $takmir = User::factory()->create();
        $takmir->assignRole('takmir_inti');

        $response = $this->actingAs($takmir)->get(route('admin.approval.index'));
        $response->assertStatus(200);
    }

    public function test_bendahara_cannot_access_approval_page(): void
    {
        $bendahara = User::factory()->create();
        $bendahara->assignRole('bendahara');

        $response = $this->actingAs($bendahara)->get(route('admin.approval.index'));
        $response->assertStatus(403);
    }

    public function test_admin_can_access_approval_page(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $response = $this->actingAs($admin)->get(route('admin.approval.index'));
        $response->assertStatus(200);
    }

    public function test_public_can_view_financial_dashboard(): void
    {
        $response = $this->get('/keuangan');
        $response->assertStatus(200);
    }

    public function test_unauthenticated_cannot_access_admin(): void
    {
        $response = $this->get('/admin/dashboard');
        $response->assertRedirect('/login');
    }

    public function test_jamaah_cannot_access_admin_transactions(): void
    {
        $jamaah = User::factory()->create();
        $jamaah->assignRole('jamaah');

        $response = $this->actingAs($jamaah)->get(route('admin.transactions.index'));
        $response->assertStatus(403);
    }

    public function test_media_cannot_access_transactions(): void
    {
        $media = User::factory()->create();
        $media->assignRole('media');

        $response = $this->actingAs($media)->get(route('admin.transactions.index'));
        $response->assertStatus(403);
    }

    public function test_transaction_status_transitions(): void
    {
        $this->assertTrue(TransactionStatus::Draft->canTransitionTo(TransactionStatus::Submitted));
        $this->assertFalse(TransactionStatus::Draft->canTransitionTo(TransactionStatus::Approved));
        $this->assertTrue(TransactionStatus::Submitted->canTransitionTo(TransactionStatus::Approved));
        $this->assertTrue(TransactionStatus::Submitted->canTransitionTo(TransactionStatus::Rejected));
        $this->assertFalse(TransactionStatus::Approved->canTransitionTo(TransactionStatus::Draft));
        $this->assertTrue(TransactionStatus::Rejected->canTransitionTo(TransactionStatus::Submitted));
    }

    public function test_only_draft_transactions_can_be_deleted(): void
    {
        $bendahara = User::factory()->create();
        $bendahara->assignRole('bendahara');

        $approvedTransaction = Transaction::create([
            'transaction_code' => 'TRX-TEST-020',
            'tanggal' => now(),
            'type' => 'debit',
            'category_ziswaf' => 'infaq',
            'category_detail' => 'Approved Transaction',
            'nominal' => 100000,
            'status' => 'approved',
            'created_by' => $bendahara->id,
            'approved_by' => $bendahara->id,
            'approved_at' => now(),
        ]);

        $response = $this->actingAs($bendahara)->delete(
            route('admin.transactions.destroy', $approvedTransaction->id)
        );

        // Should redirect with error, transaction still exists
        $response->assertRedirect();
        $this->assertDatabaseHas('transactions', ['id' => $approvedTransaction->id]);
    }
}
