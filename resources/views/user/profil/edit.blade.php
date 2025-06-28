@extends('layouts.dashboard')

@section('judul', 'Edit Profil')
@section('subjudul', 'Perbarui informasi akun Anda')

@section('content')
    <div class="container mt-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
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

                    <div class="mb-3">
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
                    </div>

                    <input type="hidden" name="lat" id="lat" value="{{ old('lat', $user->lat) }}">
                    <input type="hidden" name="lon" id="lon" value="{{ old('lon', $user->lon) }}">
                    <div id="map" style="height: 400px;"></div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        const defaultLatLng = [-2.5489, 118.0149]; // Indonesia
        // Ambil dari PHP (user)
    const latFromUser = {{ $user->latitude ?? 'null' }};
    const lonFromUser = {{ $user->longitude ?? 'null' }};

    // Lokasi fallback kalau user belum punya koordinat
    const userHasCoords = latFromUser !== null && lonFromUser !== null;

    const map = L.map('map').setView(userHasCoords ? [latFromUser, lonFromUser] : defaultLatLng, userHasCoords ? 15 : 5);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    let marker;
    if (userHasCoords) {
        marker = L.marker([latFromUser, lonFromUser]).addTo(map);
    }
        // Fungsi ambil alamat dari koordinat (reverse geocoding)
        async function getAddressFromCoords(lat, lon) {
            const url = `https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lon}&format=json`;
            const response = await fetch(url);
            const data = await response.json();
            return data.display_name;
        }

        // Fungsi ambil koordinat dari alamat (forward geocoding)
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

        // Saat user klik di map
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
        });

        // Debounce function
        function debounce(fn, delay) {
            let timeout;
            return function(...args) {
                clearTimeout(timeout);
                timeout = setTimeout(() => fn.apply(this, args), delay);
            };
        }

        // Saat input textarea diketik
        const alamatInput = document.getElementById('alamat');
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
            }
        }, 250)); // debounce delay 800ms
    </script>
@endpush
