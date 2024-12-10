<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Login</title>
</head>

<body class="font-jakarta-sans">
    <div class="grid grid-cols-2 h-screen"
        style="background-image: url('{{ asset('assets/auth_bg.jpg') }}'); background-size: cover; background-position: center;">
        <div class="min-w-[700px] bg-gray-100 py-20 px-[120px] rounded-r-3xl">
            <div class="flex flex-col justify-center h-full gap-6">
                <div class="flex flex-col gap-2">
                    <h1 class="font-bold text-4xl">Selamat Datang!</h1>
                    <p class="font-medium">Masukkan nama pengguna dan kata sandi Anda untuk masuk ke halaman
                        selanjutnya.
                    </p>
                </div>
                <div class="flex flex-col gap-2">
                    <form action="{{ route('login') }}" method="POST" class="flex flex-col gap-10">
                        @csrf
                        <div class="flex flex-col gap-6">
                            <div class="flex flex-col gap-2">
                                <label for="nama" class="text-sm font-bold">Nama Lengkap</label>
                                <input type="text" name="nama" id="nama"
                                    class="p-2 border border-black rounded-md">
                            </div>
                            <div class="flex flex-col gap-2">
                                <label for="alamat" class="text-sm font-bold">Alamat</label>
                                <input type="text" name="alamat" id="alamat"
                                    class="p-2 border border-black rounded-md">
                            </div>
                            {{-- <div class="flex flex-col gap-2">
                                <label for="password" class="text-sm font-bold">Kata Sandi</label>
                                <div class="relative">
                                    <input type="password" name="password" id="password"
                                        class="p-2 border border-black rounded-md w-full">
                                    <button type="button" id="toggle-password" class="absolute right-2 py-2"
                                        aria-label="Toggle password visibility">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0_2382_57)">
                                                <path
                                                    d="M12 6C15.79 6 19.17 8.13 20.82 11.5C19.17 14.87 15.79 17 12 17C8.21 17 4.83 14.87 3.18 11.5C4.83 8.13 8.21 6 12 6ZM12 4C7 4 2.73 7.11 1 11.5C2.73 15.89 7 19 12 19C17 19 21.27 15.89 23 11.5C21.27 7.11 17 4 12 4ZM12 9C13.38 9 14.5 10.12 14.5 11.5C14.5 12.88 13.38 14 12 14C10.62 14 9.5 12.88 9.5 11.5C9.5 10.12 10.62 9 12 9ZM12 7C9.52 7 7.5 9.02 7.5 11.5C7.5 13.98 9.52 16 12 16C14.48 16 16.5 13.98 16.5 11.5C16.5 9.02 14.48 7 12 7Z"
                                                    fill="#777777" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_2382_57">
                                                    <rect width="24" height="24" fill="white" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                    </button>
                                </div>
                            </div> --}}
                        </div>
                        <div class="flex flex-col gap-2">
                            <button type="submit" class="p-2 bg-gray-500 text-white rounded-md">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    const passwordInput = document.getElementById('password');
    const toggleButton = document.getElementById('toggle-password');

    toggleButton.addEventListener('click', () => {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
    });
</script>

</html>
