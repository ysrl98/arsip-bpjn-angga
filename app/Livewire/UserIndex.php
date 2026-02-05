<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserIndex extends Component
{
    use WithPagination;

    public $search = '';

    // Proteksi: Hanya Admin yang boleh akses
    public function mount()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }
    }

    public function delete($id)
    {
        if ($id == auth()->id()) {
            session()->flash('error', 'Anda tidak bisa menghapus akun sendiri!');
            return;
        }

        $user = User::find($id);
        if ($user) {
            $user->delete();
            session()->flash('message', 'User berhasil dihapus.');
        }
    }

    public function render()
    {
        $users = User::where('nama_lengkap', 'like', '%' . $this->search . '%')
            ->orWhere('nip', 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate(10);

        return view('livewire.user-index', ['users' => $users])->layout('layouts.app');
    }
}