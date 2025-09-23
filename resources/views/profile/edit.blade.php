@extends('layouts.app')

@section('title', '- Profile')

@section('content')
<div class="min-h-screen py-12 transition-colors duration-300"
     :class="{ 'bg-gray-50': !darkMode, 'bg-gray-900': darkMode }">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold transition-colors duration-300"
                :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                Profile Settings
            </h1>
            <p class="mt-2 transition-colors duration-300"
               :class="{ 'text-gray-600': !darkMode, 'text-gray-400': darkMode }">
                Kelola informasi profil dan pengaturan akun Anda
            </p>
        </div>

        <div class="space-y-8">
            <!-- Profile Information -->
            <div class="rounded-2xl p-8 transition-colors duration-300"
                 :class="{ 'bg-white shadow-lg': !darkMode, 'bg-gray-800 shadow-xl': darkMode }">
                <h2 class="text-xl font-semibold mb-6 transition-colors duration-300"
                    :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                    Informasi Profil
                </h2>

                <form method="POST" action="{{ route('profile.update') }}" class="space-y-6">
                    @csrf
                    @method('patch')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input id="name" name="name" type="text" 
                                   class="form-input" 
                                   value="{{ old('name', $user->name) }}" 
                                   required autofocus>
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="form-label">Email</label>
                            <input id="email" name="email" type="email" 
                                   class="form-input" 
                                   value="{{ old('email', $user->email) }}" 
                                   required>
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="birth_date" class="form-label">Tanggal Lahir</label>
                            <input id="birth_date" name="birth_date" type="date" 
                                   class="form-input" 
                                   value="{{ old('birth_date', $user->birth_date?->format('Y-m-d')) }}">
                            @error('birth_date')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="gender" class="form-label">Jenis Kelamin</label>
                            <select id="gender" name="gender" class="form-select">
                                <option value="">Pilih jenis kelamin</option>
                                <option value="male" {{ old('gender', $user->gender) === 'male' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="female" {{ old('gender', $user->gender) === 'female' ? 'selected' : '' }}>Perempuan</option>
                                <option value="other" {{ old('gender', $user->gender) === 'other' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            @error('gender')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="phone" class="form-label">Nomor Telepon</label>
                            <input id="phone" name="phone" type="tel" 
                                   class="form-input" 
                                   value="{{ old('phone', $user->phone) }}">
                            @error('phone')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="bio" class="form-label">Bio</label>
                        <textarea id="bio" name="bio" rows="3" 
                                  class="form-textarea" 
                                  placeholder="Ceritakan sedikit tentang diri Anda...">{{ old('bio', $user->bio) }}</textarea>
                        @error('bio')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-end">
                        <button type="submit" class="btn-primary">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>

            <!-- Privacy Settings -->
            <div class="rounded-2xl p-8 transition-colors duration-300"
                 :class="{ 'bg-white shadow-lg': !darkMode, 'bg-gray-800 shadow-xl': darkMode }">
                <h2 class="text-xl font-semibold mb-6 transition-colors duration-300"
                    :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                    Pengaturan Privasi
                </h2>

                <form method="POST" action="{{ route('profile.update') }}" class="space-y-6">
                    @csrf
                    @method('patch')

                    <div class="space-y-4">
                        <div class="flex items-center">
                            <input id="anonymous_mode" name="anonymous_mode" type="checkbox" 
                                   class="form-checkbox" 
                                   value="1" 
                                   {{ old('anonymous_mode', $user->anonymous_mode) ? 'checked' : '' }}>
                            <label for="anonymous_mode" class="ml-3">
                                <span class="text-sm font-medium transition-colors duration-300"
                                      :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                                    Mode Anonim
                                </span>
                                <p class="text-sm transition-colors duration-300"
                                   :class="{ 'text-gray-500': !darkMode, 'text-gray-400': darkMode }">
                                    Gunakan username anonim dalam komunitas dan konseling
                                </p>
                            </label>
                        </div>

                        <div x-data="{ showAnonymous: {{ old('anonymous_mode', $user->anonymous_mode) ? 'true' : 'false' }} }">
                            <div x-show="showAnonymous" class="ml-6">
                                <label for="anonymous_username" class="form-label">Username Anonim</label>
                                <input id="anonymous_username" name="anonymous_username" type="text" 
                                       class="form-input" 
                                       value="{{ old('anonymous_username', $user->anonymous_username) }}"
                                       placeholder="Contoh: User123, Anonymous456">
                                @error('anonymous_username')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex items-center">
                            <input id="email_notifications" name="email_notifications" type="checkbox" 
                                   class="form-checkbox" 
                                   value="1" 
                                   {{ old('email_notifications', $user->email_notifications) ? 'checked' : '' }}>
                            <label for="email_notifications" class="ml-3">
                                <span class="text-sm font-medium transition-colors duration-300"
                                      :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                                    Notifikasi Email
                                </span>
                                <p class="text-sm transition-colors duration-300"
                                   :class="{ 'text-gray-500': !darkMode, 'text-gray-400': darkMode }">
                                    Terima reminder assessment dan update konten baru
                                </p>
                            </label>
                        </div>
                    </div>

                    <div class="flex items-center justify-end">
                        <button type="submit" class="btn-primary">
                            Simpan Pengaturan
                        </button>
                    </div>
                </form>
            </div>

            <!-- Delete Account -->
            <div class="rounded-2xl p-8 border-2 border-red-200 transition-colors duration-300"
                 :class="{ 'bg-red-50': !darkMode, 'bg-red-900/20 border-red-800': darkMode }">
                <h2 class="text-xl font-semibold mb-4 text-red-600">
                    Hapus Akun
                </h2>
                <p class="text-sm mb-6 transition-colors duration-300"
                   :class="{ 'text-gray-600': !darkMode, 'text-gray-300': darkMode }">
                    Setelah akun Anda dihapus, semua data dan informasi akan dihapus secara permanen. 
                    Sebelum menghapus akun, silakan unduh data yang ingin Anda simpan.
                </p>

                <button x-data="" 
                        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')" 
                        class="btn-danger">
                    Hapus Akun
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Account Modal -->
<div x-data="{ show: false }" 
     x-on:open-modal.window="$event.detail == 'confirm-user-deletion' ? show = true : null" 
     x-on:close-modal.window="$event.detail == 'confirm-user-deletion' ? show = false : null"
     x-show="show" 
     class="fixed inset-0 z-50 overflow-y-auto" 
     x-cloak>
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div x-show="show" 
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

        <div x-show="show" 
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             class="inline-block align-bottom rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
             :class="{ 'bg-white': !darkMode, 'bg-gray-800': darkMode }">
            
            <form method="post" action="{{ route('profile.destroy') }}">
                @csrf
                @method('delete')
                
                <div class="px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                            <i class="fas fa-exclamation-triangle text-red-600"></i>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium transition-colors duration-300"
                                :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                                Hapus Akun
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm transition-colors duration-300"
                                   :class="{ 'text-gray-500': !darkMode, 'text-gray-400': darkMode }">
                                    Apakah Anda yakin ingin menghapus akun? Setelah akun dihapus, 
                                    semua data akan hilang secara permanen.
                                </p>
                                
                                <div class="mt-4">
                                    <label for="password" class="form-label">Password</label>
                                    <input id="password" name="password" type="password" 
                                           class="form-input" 
                                           placeholder="Masukkan password untuk konfirmasi">
                                    @error('password', 'userDeletion')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="submit" 
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Hapus Akun
                    </button>
                    <button type="button" 
                            x-on:click="$dispatch('close-modal', 'confirm-user-deletion')"
                            class="mt-3 w-full inline-flex justify-center rounded-md border shadow-sm px-4 py-2 text-base font-medium focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition-colors duration-300"
                            :class="{ 'border-gray-300 bg-white text-gray-700 hover:bg-gray-50': !darkMode, 'border-gray-600 bg-gray-700 text-gray-300 hover:bg-gray-600': darkMode }">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('anonymousMode', () => ({
        enabled: @json(old('anonymous_mode', $user->anonymous_mode)),
        
        toggle() {
            this.enabled = !this.enabled;
            document.getElementById('anonymous_mode').checked = this.enabled;
        }
    }));
});
</script>
@endsection