<div class="py-12">
    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm sm:rounded-lg p-6">
            <h2 class="text-xl font-bold mb-4">Tambah Pegawai Baru</h2>
            
            <form wire:submit="save">
                <div class="grid grid-cols-1 gap-4">
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700">NIP (Username Login)</label>
                        <input type="text" wire:model="nip" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        @error('nip') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                        <input type="text" wire:model="nama_lengkap" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        @error('nama_lengkap') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Jabatan</label>
                            <input type="text" wire:model="jabatan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Unit Kerja</label>
                            <input type="text" wire:model="unit_kerja" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Password Awal</label>
                        <input type="text" wire:model="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        @error('password') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Role Akses</label>
                        <select wire:model="role" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="user">User (Pegawai Biasa)</option>
                            <option value="pimpinan">Pimpinan</option>
                            <option value="admin">Administrator</option>
                        </select>
                    </div>

                    <div class="flex justify-end mt-4">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">Simpan Data</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>