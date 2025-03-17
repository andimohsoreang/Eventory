@extends('layouts.app')
@section('content')
@section('title', 'Detail Tipe')
@push('links')
    <!-- 3D Viewer Library - Three.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    <!-- STL Loader -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/examples/js/loaders/STLLoader.js"></script>
    <!-- OrbitControls untuk rotasi model -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/examples/js/controls/OrbitControls.js"></script>
    <!-- SweetAlert -->
    <link href="{{ asset('dist/assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
@endpush

<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box d-md-flex justify-content-md-between align-items-center">
            <h4 class="page-title">Detail Tipe</h4>
            <div class="">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#">Master</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('/tipe') }}">Tipe</a></li>
                    <li class="breadcrumb-item active">Detail</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h4 class="card-title">Informasi Tipe</h4>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered mb-0">
                        <tbody>
                            <tr>
                                <th width="35%">Nama Tipe</th>
                                <td>Type Example</td>
                            </tr>
                            <tr>
                                <th>Brand</th>
                                <td>Cisco</td>
                            </tr>
                            <tr>
                                <th>Kategori</th>
                                <td>Router</td>
                            </tr>
                            <tr>
                                <th>Ruckus</th>
                                <td>Yes</td>
                            </tr>
                            <tr>
                                <th>Icon</th>
                                <td><i class="fa-solid fa-file"></i> (fa-solid fa-file)</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h4 class="card-title">Deskripsi / Spesifikasi</h4>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="spec-content">
                    Router WiFi Dual-Band dengan port Gigabit. Mendukung WiFi 6 dengan kecepatan hingga 3000Mbps.
                    Dilengkapi dengan 4 port LAN Gigabit dan 1 port WAN. Memiliki fitur keamanan terbaru dan mendukung
                    VPN.
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h4 class="card-title">Model 3D</h4>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <!-- Jika ada model -->
                <div id="model-container"
                    style="width: 100%; height: 500px; background-color: #f0f0f0; border-radius: 8px;"></div>
                <div class="text-center mt-3">
                    <p class="text-muted">Gunakan mouse untuk memutar (klik dan geser), zoom (scroll), dan pan (klik
                        kanan dan geser)</p>
                </div>

                <!-- Jika tidak ada model, uncomment ini
                <div class="alert alert-info text-center">
                    <i class="fas fa-cube fa-4x mb-3"></i>
                    <p>Tidak ada model 3D yang tersedia untuk tipe ini.</p>
                </div>
                -->
            </div>
        </div>
    </div>
</div>

<div class="row mt-3">
    <div class="col-12">
        <div class="d-flex justify-content-between">
            <a href="{{ url('/admin/tipe') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i> Kembali
            </a>
        </div>
    </div>
</div>

@push('scripts')
    <script src="{{ asset('dist/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script>
        // Fungsi untuk konfirmasi hapus
        function confirmDelete(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect ke route delete atau kirim form delete
                    window.location.href = "{{ url('/tipe') }}";
                }
            });
        }

        // Kode JavaScript untuk menampilkan model 3D
        document.addEventListener('DOMContentLoaded', function() {
            const modelContainer = document.getElementById('model-container');
            let camera, scene, renderer, controls, model;

            init();
            animate();

            function init() {
                // Membuat scene
                scene = new THREE.Scene();
                scene.background = new THREE.Color(0xf0f0f0);

                // Membuat camera
                camera = new THREE.PerspectiveCamera(75, modelContainer.clientWidth / modelContainer.clientHeight,
                    0.1, 1000);
                camera.position.z = 5;

                // Membuat renderer
                renderer = new THREE.WebGLRenderer({
                    antialias: true
                });
                renderer.setSize(modelContainer.clientWidth, modelContainer.clientHeight);
                modelContainer.appendChild(renderer.domElement);

                // Menambahkan controls
                controls = new THREE.OrbitControls(camera, renderer.domElement);
                controls.enableDamping = true;
                controls.dampingFactor = 0.25;
                controls.screenSpacePanning = false;
                controls.minDistance = 1;
                controls.maxDistance = 20;

                // Menambahkan lights
                const ambientLight = new THREE.AmbientLight(0xffffff, 0.6);
                scene.add(ambientLight);

                const directionalLight = new THREE.DirectionalLight(0xffffff, 0.8);
                directionalLight.position.set(1, 1, 1);
                scene.add(directionalLight);

                const directionalLight2 = new THREE.DirectionalLight(0xffffff, 0.4);
                directionalLight2.position.set(-1, -1, -1);
                scene.add(directionalLight2);

                // Sample model path - ganti dengan path yang sesuai
                const modelPath = '{{ asset('dist/assets/samples/sample.stl') }}';

                // Load model STL
                const loader = new THREE.STLLoader();
                loader.load(modelPath, function(geometry) {
                    const material = new THREE.MeshPhongMaterial({
                        color: 0x0055ff,
                        specular: 0x111111,
                        shininess: 100
                    });
                    model = new THREE.Mesh(geometry, material);

                    // Center model
                    const box = new THREE.Box3().setFromObject(model);
                    const center = box.getCenter(new THREE.Vector3());
                    model.position.sub(center);

                    // Scale model to fit view
                    const size = box.getSize(new THREE.Vector3());
                    const maxDim = Math.max(size.x, size.y, size.z);
                    const scale = 2 / maxDim;
                    model.scale.set(scale, scale, scale);

                    scene.add(model);

                    // Adjust camera position based on model size
                    camera.position.z = maxDim * 2;
                    controls.update();
                });

                // Event listener untuk resize
                window.addEventListener('resize', onWindowResize);
            }

            function onWindowResize() {
                camera.aspect = modelContainer.clientWidth / modelContainer.clientHeight;
                camera.updateProjectionMatrix();
                renderer.setSize(modelContainer.clientWidth, modelContainer.clientHeight);
            }

            function animate() {
                requestAnimationFrame(animate);
                controls.update();
                renderer.render(scene, camera);
            }
        });
    </script>
@endpush
@endsection
