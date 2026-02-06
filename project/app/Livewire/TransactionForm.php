<?php

namespace App\Livewire;

use App\Enums\CategoryZiswaf;
use App\Enums\TransactionStatus;
use App\Enums\TransactionType;
use App\Models\Transaction;
use App\Services\ApprovalService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class TransactionForm extends Component
{
    use WithFileUploads;

    public ?Transaction $transaction = null;
    public bool $editMode = false;

    public string $tanggal = '';
    public string $type = '';
    public string $category_ziswaf = '';
    public string $category_detail = '';
    public string $nominal = '';
    public string $keterangan = '';
    public $bukti_foto = null;
    public ?string $existing_bukti_foto = null;

    protected function rules(): array
    {
        return [
            'tanggal' => 'required|date|before_or_equal:today',
            'type' => 'required|in:debit,credit',
            'category_ziswaf' => 'required|in:' . implode(',', array_column(CategoryZiswaf::cases(), 'value')),
            'category_detail' => 'required|string|max:255',
            'nominal' => 'required|numeric|min:1',
            'keterangan' => 'nullable|string|max:1000',
            'bukti_foto' => $this->editMode && !$this->bukti_foto ? 'nullable' : 'nullable|image|max:2048',
        ];
    }

    protected function messages(): array
    {
        return [
            'tanggal.required' => 'Tanggal wajib diisi.',
            'tanggal.before_or_equal' => 'Tanggal tidak boleh lebih dari hari ini.',
            'type.required' => 'Jenis transaksi wajib dipilih.',
            'category_ziswaf.required' => 'Kategori ZISWAF wajib dipilih.',
            'category_detail.required' => 'Detail kategori wajib diisi.',
            'nominal.required' => 'Nominal wajib diisi.',
            'nominal.min' => 'Nominal minimal Rp 1.',
            'bukti_foto.image' => 'File harus berupa gambar.',
            'bukti_foto.max' => 'Ukuran maksimal 2MB.',
        ];
    }

    public function mount(?Transaction $transaction = null): void
    {
        if ($transaction && $transaction->exists) {
            $this->transaction = $transaction;
            $this->editMode = true;
            $this->tanggal = $transaction->tanggal->format('Y-m-d');
            $this->type = $transaction->type->value;
            $this->category_ziswaf = $transaction->category_ziswaf->value;
            $this->category_detail = $transaction->category_detail;
            $this->nominal = (string) $transaction->nominal;
            $this->keterangan = $transaction->keterangan ?? '';
            $this->existing_bukti_foto = $transaction->bukti_foto;
        } else {
            $this->tanggal = now()->format('Y-m-d');
        }
    }

    public function save(): void
    {
        $validated = $this->validate();

        $data = [
            'tanggal' => $validated['tanggal'],
            'type' => $validated['type'],
            'category_ziswaf' => $validated['category_ziswaf'],
            'category_detail' => $validated['category_detail'],
            'nominal' => $validated['nominal'],
            'keterangan' => $validated['keterangan'] ?? null,
        ];

        if ($this->bukti_foto) {
            $path = $this->bukti_foto->store('bukti-transaksi', 'public');
            $data['bukti_foto'] = $path;

            // Delete old file if editing
            if ($this->editMode && $this->existing_bukti_foto) {
                Storage::disk('public')->delete($this->existing_bukti_foto);
            }
        }

        if ($this->editMode && $this->transaction) {
            $this->transaction->update($data);
            session()->flash('success', 'Transaksi berhasil diperbarui.');
        } else {
            $data['created_by'] = Auth::id();
            $data['status'] = TransactionStatus::Draft->value;
            Transaction::create($data);
            session()->flash('success', 'Transaksi berhasil ditambahkan.');
        }

        $this->redirect(route('admin.transactions.index'), navigate: true);
    }

    public function getTransactionTypesProperty(): array
    {
        return TransactionType::cases();
    }

    public function getCategoryZiswafOptionsProperty(): array
    {
        return CategoryZiswaf::cases();
    }

    public function render()
    {
        return view('livewire.transaction-form');
    }
}
