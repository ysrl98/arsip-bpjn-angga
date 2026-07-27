<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class UserEdit extends Component
{
    public $user_id, $nip, $nama_lengkap, $password, $role;
    public $jabatan, $unit_kerja;

    public function mount($id)
    {
        $user = User::findOrFail($id);
        $this->user_id = $user->id;
        $this->nip = $user->nip;
        $this->nama_lengkap = $user->nama_lengkap;
        $this->role = $user->role;
        $this->jabatan = $user->jabatan;
        $this->unit_kerja = $user->unit_kerja;
    }

    public function update()
    {
        $this->validate([
            'nama_lengkap' => 'required',
            'role' => 'required|in:admin,user,pimpinan',
        ]);

        $user = User::find($this->user_id);
        
        $data = [
            'nama_lengkap' => $this->nama_lengkap,
            'role' => $this->role,
            'jabatan' => $this->jabatan,
            'unit_kerja' => $this->unit_kerja,
        ];

        // Hanya update password jika admin mengisi kolom password baru
        if (!empty($this->password)) {
            $data['password'] = Hash::make($this->password);
        }

        $user->update($data);

        session()->flash('message', 'Data pegawai berhasil diperbarui.');
        return redirect()->route('users.index');
    }

    public function render()
    {
        return view('livewire.user-edit')->layout('layouts.app');
    }
}