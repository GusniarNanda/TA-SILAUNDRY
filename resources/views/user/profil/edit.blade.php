@extends('layouts.dashboard')

@section('judul', 'Edit Profil')
@section('subjudul', 'Perbarui informasi akun Anda')

@section('content')
    <div class="container mt-4">
        <div class="card shadow-sm">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">Edit Profil</h5>
            </div>
            <div class="card-body">

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif


                <form method="POST" action="{{ route('user.profil.update') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" name="nama" id="nama"
                            class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama', $user->name) }}"
                            required>
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email"
                            class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email', $user->email) }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="no_telepon" class="form-label">No Telepon</label>
                        <textarea name="no_telepon" id="no_telepon" rows="3"
                            class="form-control @error('no_telepon') is-invalid @enderror">{{ old('no_telepon', $user->no_telepon) }}</textarea>
                        @error('no_telepon')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea name="alamat" id="alamat" rows="3" class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat', $user->alamat) }}</textarea>
                        @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        @error('lat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        @error('lon')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div> --}}

                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea name="alamat" id="alamat" rows="3" class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat', $user->alamat) }}</textarea>

                        {{-- Label status jangkauan --}}
                        <div id="status-jangkauan" class="mt-2 fw-bold"></div>

                        @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        @error('lat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        @error('lon')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                    <input type="hidden" name="lat" id="lat" value="{{ old('lat', $user->lat) }}">
                    <input type="hidden" name="lon" id="lon" value="{{ old('lon', $user->lon) }}">
                    <div id="map" style="height: 400px;"></div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        //INISIALISASI KOORDINAT AWAL 
        const defaultLatLng = [-2.5489, 118.0149]; // Indonesia
        // Ambil dari PHP (user)
        const latFromUser = {{ $user->latitude ?? 'null' }};
        const lonFromUser = {{ $user->longitude ?? 'null' }};

        // PENGATURAN MAP SUPAYA MENAPILKAN LOKASI DARI USER (KALAU ADA) KALO GA ADA BERARTI TAMPILAN DEFAULT MAP INDONESIA
        const userHasCoords = latFromUser !== null && lonFromUser !== null;
        const map = L.map('map').setView(userHasCoords ? [latFromUser, lonFromUser] : defaultLatLng, userHasCoords ? 15 :
            5);

        //MENAMPILKAN PETA DADSAR DARI OPEN STREET MAP 
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        //JIKA USER PUNYA KOORDINAT MAKA MENAMPILKAN TANDA DI MAP DI LOKASI USER 
        let marker;
        if (userHasCoords) {
            marker = L.marker([latFromUser, lonFromUser]).addTo(map);
        }
        // AMBIL ALAMAT LENGKAP BERDASARKAN TITIK KOORDINAT YANG DI KLIK 
        async function getAddressFromCoords(lat, lon) {
            const url = `https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lon}&format=json`;
            const response = await fetch(url);
            const data = await response.json();
            return data.display_name;
        }

        // MENGUBAH INPUT ALAMAT JADI KOORDINAT 
        async function getCoordsFromAddress(address) {
            const url =
                `https://nominatim.openstreetmap.org/search?q=${encodeURIComponent(address)}&format=json&limit=1`;
            const response = await fetch(url);
            const data = await response.json();
            if (data.length > 0) {
                return [parseFloat(data[0].lat), parseFloat(data[0].lon)];
            }
            return null;
        }

        // SAAT USER KLIK MAP MAKA TANDA PINDAH KE LOKASI 
        map.on('click', async function(e) {
            const {
                lat,
                lng
            } = e.latlng;

            if (marker) {
                marker.setLatLng([lat, lng]);
            } else {
                marker = L.marker([lat, lng]).addTo(map);
            }

            const alamat = await getAddressFromCoords(lat, lng);
            document.getElementById('alamat').value = alamat;
            document.getElementById('lat').value = lat;
            document.getElementById('lon').value = lng;

            cekJangkauan(lat, lng); // Tambahkan ini
        });


        // JIKA USER TIDAK MENGETIKKAN ALAMAT LEBIH DARI 250ms MAKA ALAMAT AKAN DIUBAH JADI KOORDINAT 
        function debounce(fn, delay) {
            let timeout;
            return function(...args) {
                clearTimeout(timeout);
                timeout = setTimeout(() => fn.apply(this, args), delay);
            };
        }

        // MENGUBAH INPUT ALAMAT DARI TEKS DARI USER MENJADI LOKASI DALAM BENTUK KOORDINAT DI PETA SECARA OTOMATIS 
        const alamatInput = document.getElementById('alamat'); //MENANGKAP INPUTAN ALAMAT 
        alamatInput.addEventListener('input', debounce(async function() {
            const alamat = this.value.trim();
            if (alamat.length < 5) return; // hindari request untuk input terlalu pendek

            const coords = await getCoordsFromAddress(alamat);

            if (coords) {
                const [lat, lng] = coords;
                map.setView([lat, lng], 15);

                if (marker) {
                    marker.setLatLng([lat, lng]);
                } else {
                    marker = L.marker([lat, lng]).addTo(map);
                }

                document.getElementById('lat').value = lat;
                document.getElementById('lon').value = lng;

                cekJangkauan(lat, lng);
            }

        }, 250)); // debounce delay 800ms



        const laundryLat = -7.717554;
        const laundryLon = 109.005774;
        //FUNGSI UNTUK PERHITUNGAN JARAK DENGAN FUNGSI HAVERSINE UNTUK MENENTUKAN JARAK DARI LOKASI USER KE LOKASI LAUNDRY
        function haversineDistance(lat1, lon1, lat2, lon2) {
            function toRad(x) {
                return x * Math.PI / 180;
            }

            const R = 6371;
            const dLat = toRad(lat2 - lat1);
            const dLon = toRad(lon2 - lon1);
            const a = Math.sin(dLat / 2) ** 2 +
                Math.cos(toRad(lat1)) * Math.cos(toRad(lat2)) *
                Math.sin(dLon / 2) ** 2;
            const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
            return R * c;
        }

        //FUNGSI UNTUK MENGECEK JANGKAUAN LAYANAN LAUNDRY
        function cekJangkauan(lat, lon) {
            const jarak = haversineDistance(laundryLat, laundryLon, lat, lon);
            const label = document.getElementById('status-jangkauan');

            if (jarak <= 5) {
                label.innerText = `✅ Lokasi dalam jangkauan (${jarak.toFixed(2)} km)`;
                label.classList.remove('text-danger');
                label.classList.add('text-success');
            } else {
                label.innerText = `❌ Lokasi di luar jangkauan (${jarak.toFixed(2)} km)`;
                label.classList.remove('text-success');
                label.classList.add('text-danger');
            }
        }
    </script>
@endpush
