<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class UserCreate extends Component
{
    public $nip, $nama_lengkap, $password, $role = 'user';
    public $jabatan, $unit_kerja, $no_hp, $email;

    public function save()
    {
        $this->validate([
            'nip' => 'required|unique:users,nip',
            'nama_lengkap' => 'required',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,user',
        ]);

        User::create([
            'nip' => $this->nip,
            'nama_lengkap' => $this->nama_lengkap,
            'password' => Hash::make($this->password),
            'role' => $this->role,
            'jabatan' => $this->jabatan,
            'unit_kerja' => $this->unit_kerja,
            'no_hp' => $this->no_hp,
            'email' => $this->email,
        ]);

        session()->flash('message', 'Pegawai berhasil ditambahkan.');
        return redirect()->route('users.index');
    }

    public function render()
    {
        return view('livewire.user-create')->layout('layouts.app');
    }
}