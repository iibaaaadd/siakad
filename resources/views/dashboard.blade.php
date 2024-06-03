@extends('layout.app')

@section('content')
    <div class="page-heading">
        <h3>Dashboard</h3>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-4">
                        <a href="{{ route('gurus.index') }}" class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row py-2">
                                    <div class="col-md-4 col-lg-12 col-xxl-5 d-flex justify-content-start ">
                                        <div class="stats-icon purple mb-2">
                                            <i class="iconly-boldShow"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Jumlah Guru</h6>
                                        <h6 class="font-extrabold mb-0">{{ $guru }}</h6>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ route('siswas.index') }}" class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row py-2">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                        <div class="stats-icon blue mb-2">
                                            <i class="iconly-boldProfile"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Jumlah Siswa</h6>
                                        <h6 class="font-extrabold mb-0">{{ $siswa }}</h6>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ route('mapel.index') }}" class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row py-2">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                        <div class="stats-icon green mb-2">
                                            <i class="iconly-boldAdd-User"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Jumlah Mapel</h6>
                                        <h6 class="font-extrabold mb-0">{{ $mapels }}</h6>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 text-muted font-semibold>Guru</h3>
                            </div>
                            <div class="card-body">
                                <div id="chart-siswa"></div>
                            </div>
                        </div>
                    </div>

                    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            var maleCount = {{ $gurus->where('jenis_kelamin', 'L')->count() }};
                            var femaleCount = {{ $gurus->where('jenis_kelamin', 'P')->count() }};

                            var options = {
                                chart: {
                                    type: 'donut',
                                    width: '450px',
                                    height: '450px'
                                },
                                series: [maleCount, femaleCount],
                                labels: ['Laki-Laki', 'Perempuan'],
                                colors: ['#435EBE', '#55C6E8'],
                                plotOptions: {
                                    pie: {
                                        donut: {
                                            size: '40%' // Adjust this percentage to make the inner circle smaller or larger
                                        }
                                    }
                                },
                                dataLabels: {
                                    enabled: true,
                                    formatter: function(val, opts) {
                                        return val.toFixed(1) + "%";
                                    }
                                },
                                legend: {
                                    position: 'right'
                                },
                                tooltip: {
                                    enabled: true,
                                    theme: 'dark',
                                    y: {
                                        formatter: function(val) {
                                            return val;
                                        }
                                    }
                                }
                            };

                            var chart = new ApexCharts(document.querySelector("#chart-siswa"), options);
                            chart.render();
                        });
                    </script>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 text-muted font-semibold>Siswa</h3>
                            </div>
                            <div class="card-body">
                                <div id="chart-guru"></div>
                            </div>
                        </div>
                    </div>

                    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            // Variabel dari PHP
                            var count10IPA = <?php echo $siswas->where('kelas.nama', '10 IPA')->count(); ?>;
                            var count10IPS = <?php echo $siswas->where('kelas.nama', '10 IPS')->count(); ?>;
                            var count11IPA = <?php echo $siswas->where('kelas.nama', '11 IPA')->count(); ?>;
                            var count11IPS = <?php echo $siswas->where('kelas.nama', '11 IPS')->count(); ?>;
                            var count12IPA = <?php echo $siswas->where('kelas.nama', '12 IPA')->count(); ?>;
                            var count12IPS = <?php echo $siswas->where('kelas.nama', '12 IPS')->count(); ?>;

                            var options = {
                                chart: {
                                    type: 'donut',
                                    width: '424px',
                                    height: '424px'
                                },
                                series: [count10IPA, count10IPS, count11IPA, count11IPS, count12IPA, count12IPS],
                                labels: ['10 IPA', '10 IPS', '11 IPA', '11 IPS', '12 IPA', '12 IPS'],
                                colors: ['#435EBE', '#55C6E8', '#FF4560', '#FEB019', '#00E396', '#775DD0'],
                                plotOptions: {
                                    pie: {
                                        donut: {
                                            size: '40%' // Sesuaikan persentase ini untuk membuat lingkaran dalam lebih kecil atau lebih besar
                                        }
                                    }
                                },
                                dataLabels: {
                                    enabled: true,
                                    formatter: function(val, opts) {
                                        return val.toFixed(1) + "%";
                                    }
                                },
                                legend: {
                                    position: 'right'
                                },
                                tooltip: {
                                    enabled: true,
                                    theme: 'dark',
                                    y: {
                                        formatter: function(val) {
                                            return val;
                                        }
                                    }
                                }
                            };

                            var chart = new ApexCharts(document.querySelector("#chart-guru"), options);
                            chart.render();
                        });
                    </script>
                    
                    <div class="col-md-6">
                        <a href="#" class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                        <div class="stats-icon red mb-2">
                                            <i class="iconly-boldBookmark"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Saved Post</h6>
                                        <h6 class="font-extrabold mb-0">112</h6>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                        <div class="stats-icon red mb-2">
                                            <i class="iconly-boldBookmark"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Saved Post</h6>
                                        <h6 class="font-extrabold mb-0">112</h6>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                        <div class="stats-icon red mb-2">
                                            <i class="iconly-boldBookmark"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Saved Post</h6>
                                        <h6 class="font-extrabold mb-0">112</h6>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Profile Visit</h4>
                            </div>
                            <div class="card-body">
                                <div id="chart-profile-visit"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-xl-4">
                        <div class="card">
                            <div class="card-header">
                                <h4>Profile Visit</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-7">
                                        <div class="d-flex align-items-center">
                                            <svg class="bi text-primary" width="32" height="32" fill="blue"
                                                style="width:10px">
                                                <use xlink:href="assets/static/images/bootstrap-icons.svg#circle-fill" />
                                            </svg>
                                            <h5 class="mb-0 ms-3">Europe</h5>
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <h5 class="mb-0 text-end">862</h5>
                                    </div>
                                    <div class="col-12">
                                        <div id="chart-europe"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-7">
                                        <div class="d-flex align-items-center">
                                            <svg class="bi text-success" width="32" height="32" fill="blue"
                                                style="width:10px">
                                                <use xlink:href="assets/static/images/bootstrap-icons.svg#circle-fill" />
                                            </svg>
                                            <h5 class="mb-0 ms-3">America</h5>
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <h5 class="mb-0 text-end">375</h5>
                                    </div>
                                    <div class="col-12">
                                        <div id="chart-america"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-7">
                                        <div class="d-flex align-items-center">
                                            <svg class="bi text-danger" width="32" height="32" fill="blue"
                                                style="width:10px">
                                                <use xlink:href="assets/static/images/bootstrap-icons.svg#circle-fill" />
                                            </svg>
                                            <h5 class="mb-0 ms-3">Indonesia</h5>
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <h5 class="mb-0 text-end">1025</h5>
                                    </div>
                                    <div class="col-12">
                                        <div id="chart-indonesia"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-xl-8">
                        <div class="card">
                            <div class="card-header">
                                <h4>Latest Comments</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-lg">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Comment</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="col-3">
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar avatar-md">
                                                            <img src="./assets/compiled/jpg/5.jpg">
                                                        </div>
                                                        <p class="font-bold ms-3 mb-0">Si Cantik</p>
                                                    </div>
                                                </td>
                                                <td class="col-auto">
                                                    <p class=" mb-0">Congratulations on your graduation!</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="col-3">
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar avatar-md">
                                                            <img src="./assets/compiled/jpg/2.jpg">
                                                        </div>
                                                        <p class="font-bold ms-3 mb-0">Si Ganteng</p>
                                                    </div>
                                                </td>
                                                <td class="col-auto">
                                                    <p class=" mb-0">Wow amazing design! Can you make another tutorial for
                                                        this design?</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
