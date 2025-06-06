<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>
        Pelangi Laundry
    </title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&amp;display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-[#f5f9f6] m-0 p-0">
    <header class="bg-[FA4659]">
        <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12">
            <nav class="flex items-center justify-between h-20">
                <div class="flex items-center space-x-3">
                    <img alt="Heeltoe Shoe Cleaning logo, circular emblem with shoe cleaning theme" class="w-10 h-10"
                        height="40" src="{{ asset('storage/pelangi.png') }}" width="40" />
                    <span class="text-white font-extrabold text-lg leading-none select-none">
                        Pelangi Laundry Cilacap
                        <span class="text-[#9db3a7] text-2xl font-extrabold leading-none">

                        </span>
                    </span>
                </div>
                <ul class="hidden md:flex space-x-8 text-white font-semibold text-sm">
                    <li>
                        <a class="hover:underline" href="#">
                            Home
                        </a>
                    </li>
                    <li>
                        <a class="hover:underline" href="#">
                            Menu
                        </a>
                    </li>
                    <li>
                        <a class="hover:underline" href="#">
                            About us
                        </a>
                    </li>
                    <li>
                        <a class="hover:underline" href="#">
                            Services
                        </a>
                    </li>
                    <li class="relative group cursor-pointer">
                        <span class="inline-flex items-center">
                            Other
                            <svg class="ml-1 w-3 h-3 fill-white" viewbox="0 0 320 512"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M96 192l128 128-128 128z">
                                </path>
                            </svg>
                        </span>
                        <ul
                            class="absolute top-full left-0 mt-1 w-32 bg-white text-black rounded shadow-lg opacity-0 group-hover:opacity-100 invisible group-hover:visible transition-opacity">
                            <li>
                                <a class="block px-4 py-2 hover:bg-gray-100" href="#">
                                    Option 1
                                </a>
                            </li>
                            <li>
                                <a class="block px-4 py-2 hover:bg-gray-100" href="#">
                                    Option 2
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a class="hover:underline" href="#">
                            Login
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>
    <main class="bg-[FA4659]">
        <div
            class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12 py-16 flex flex-col md:flex-row items-center justify-between">
            <div class="text-white max-w-xl md:max-w-lg">
                <h1 class="font-extrabold text-4xl leading-tight mb-4">
                    Bersihkan &amp;
                    <br />
                    Cuci Baju
                    <br />
                    Kamu
                </h1>
                <p class="text-[#9db3a7] text-xs leading-relaxed mb-6 max-w-[320px]">
                    Yuk, percayakan sepatu kesayangan kamu ke kita. Biar kinclong lagi dan keliatan kayak baru. Layanan
                    top dengan hasil maksimal!
                </p>
                <button
                    class="bg-[F0FFF3] text-[#4b3f00] font-semibold text-xs px-5 py-2 rounded-full hover:bg-yellow-400 transition"
                    type="button">
                    Pesan Sekarang
                </button>
            </div>
            <div class="mt-12 md:mt-0 relative">
                <img alt="3D illustration of a green shoe with yellow buckle and brown sole"
                    class="w-[300px] h-[180px] object-contain" height="180"
                    src="https://storage.googleapis.com/a1aa/image/5fdca804-5141-4f94-67a1-e028b2a5d7c2.jpg"
                    width="300" />
                <div class="absolute right-0 top-1/2 transform -translate-y-1/2 flex flex-col space-y-3 opacity-30">
                    <span class="block w-1.5 h-1.5 rounded-full bg-[#9db3a7]">
                    </span>
                    <span class="block w-1.5 h-1.5 rounded-full bg-[#9db3a7]">
                    </span>
                    <span class="block w-1.5 h-1.5 rounded-full bg-[#9db3a7]">
                    </span>
                    <span class="block w-1.5 h-1.5 rounded-full bg-[#9db3a7]">
                    </span>
                    <span class="block w-1.5 h-1.5 rounded-full bg-[#9db3a7]">
                    </span>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
