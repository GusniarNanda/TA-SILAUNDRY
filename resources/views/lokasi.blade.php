@extends('layouts.main')

@section('title', 'Lokasi Kami')
@section('lokasi_active', 'active')

@section('content')
    <div
        class="max-w-5xl mx-auto bg-gradient-to-br from-blue-50 via-white to-blue-100
        rounded-2xl shadow-lg border border-blue-200 ring-1 ring-blue-300/40 px-4 sm:px-8 py-8">

        <div class="mb-8">
            <h1 class="text-4xl font-bold text-blue-800 flex items-center gap-3">
                📍 Lokasi Kami
            </h1>
            <p class="text-gray-700 mt-2 text-lg">
                Kami berada di lokasi strategis yang mudah dijangkau di pusat kota Cilacap.
            </p>
        </div>

        <div class="overflow-hidden rounded-xl shadow-md border border-blue-200 mb-6">
            <iframe
                src="https://maps.google.com/maps?q=Jalan%20MT%20Haryono%2C%20Cilacap&t=&z=15&ie=UTF8&iwloc=&output=embed"
                width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 text-gray-800">
            <div>
                <h2 class="text-xl font-semibold text-blue-700 mb-2">Alamat</h2>
                <p class="text-md">Jl. MT Haryono, Cilacap, Jawa Tengah, Indonesia</p>
            </div>
            <div>
                <h2 class="text-xl font-semibold text-blue-700 mb-2">Kontak</h2>
                <p class="text-md">
                    Telepon: <a href="tel:+62000000000" class="text-blue-600 hover:underline">+62 000-0000-000</a>
                </p>
                <p class="text-md">
                    Email: <a href="mailto:info@pelangilaundry.com"
                        class="text-blue-600 hover:underline">info@pelangilaundry.com</a>
                </p>
            </div>
        </div>
    </div>
@endsection
