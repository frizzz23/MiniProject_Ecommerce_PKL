@extends('layouts.admin')

@section('main')
    <div class="container-fluid">
        <div class="row">
            <!-- Card 1: Total Pendapatan -->
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="card h-100">
                    <div class="card-body d-flex align-items-center">
                        <div class="me-3">
                            <i class="fas fa-dollar-sign fa-3x text-success"></i>
                        </div>
                        <div>
                            <h5 class="card-title">Total Pendapatan Bulan Ini</h5>
                            <p class="card-text">Rp. {{ number_format($Revenue, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Card 2: Order Terbaru -->
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="card h-100">
                    <div class="card-body d-flex align-items-center">
                        <!-- Ikon -->
                        <div class="me-3">
                            <i class="fas fa-box fa-3x text-primary"></i>
                        </div>
                        <!-- Teks Konten -->
                        <div>
                            <h5 class="card-title">Total Penjualan Bulan Ini</h5>
                            @if ($totalItemsSold > 0)
                                <p class="card-text">{{ $totalItemsSold }} Pesanan Selesai</p>
                            @else
                                <p class="card-text">Tidak ada penjualan</p>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
            <!-- Card 4: Pelanggan Baru -->
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body d-flex align-items-center">
                        <!-- Ikon -->
                        <div class="me-3">
                            <i class="fas fa-users fa-3x text-info"></i>
                        </div>
                        <!-- Teks Konten -->
                        <div>
                            <h5 class="card-title mb-2">Pelanggan Baru</h5>
                            <p class="card-text mb-0">
                                <span class="fw-bold fs-5 text-dark">{{ $newuser }}</span>
                                <span class="text-muted">/ dalam sebulan terakhir</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Card for Sales Chart -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Penjualan Chart</h5>
                <div class="d-flex justify-content-end mb-3">
                    <!-- Dropdown for period selection -->
                    <div class="relative inline-block text-left">
                        <button type="button" class="btn btn-primary dropdown-toggle btn-sm" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Pilih Periode
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <li><a class="dropdown-item" href="#" onclick="changePeriod('daily')">Harian</a></li>
                            <li><a class="dropdown-item" href="#" onclick="changePeriod('weekly')">Mingguan</a>
                            </li>
                            <li><a class="dropdown-item" href="#" onclick="changePeriod('monthly')">Bulanan</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Canvas for chart display -->
                <canvas id="salesChart"></canvas>
            </div>
        </div>

        <!-- Card for Top 10 Barang Paling Banyak Diorder -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Top 10 Barang Paling Banyak Diorder</h5>
                <div class="d-flex justify-content-end mb-3">
                    <form id="filterForm" class="d-flex align-items-center">
                        @csrf
                        <label for="month" class="me-2 small">Bulan</label>
                        <select id="month" name="month" class="form-select form-select-sm me-2">
                            @for ($i = 1; $i <= 12; $i++)
                                <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}"
                                    {{ $i == request('month', now()->format('m')) ? 'selected' : '' }}>
                                    {{ date('F', mktime(0, 0, 0, $i, 1)) }}
                                </option>
                            @endfor
                        </select>

                        <label for="year" class="me-2 small">Tahun</label>
                        <select id="year" name="year" class="form-select form-select-sm me-2">
                            @for ($i = now()->year; $i >= 2000; $i--)
                                <option value="{{ $i }}"
                                    {{ $i == request('year', now()->format('Y')) ? 'selected' : '' }}>
                                    {{ $i }}
                                </option>
                            @endfor
                        </select>

                        <button type="submit" class="btn btn-sm btn-primary">Tampilkan</button>
                    </form>
                </div>
                <canvas id="mostOrderedProductsChart"></canvas>
            </div>
        </div>

        <!-- Card for Top 10 Kategori Terlaris -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Top 10 Kategori Produk Terlaris</h5>
                <div class="d-flex justify-content-end mb-3">
                    <form id="categoryForm" class="d-flex align-items-center">
                        @csrf
                        <label for="month" class="me-2 small">Bulan</label>
                        <select id="month" name="month" class="form-select form-select-sm me-2">
                            @for ($i = 1; $i <= 12; $i++)
                                <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}"
                                    {{ $i == request('month', now()->format('m')) ? 'selected' : '' }}>
                                    {{ date('F', mktime(0, 0, 0, $i, 1)) }}
                                </option>
                            @endfor
                        </select>

                        <label for="year" class="me-2 small">Tahun</label>
                        <select id="year" name="year" class="form-select form-select-sm me-2">
                            @for ($i = now()->year; $i >= 2000; $i--)
                                <option value="{{ $i }}"
                                    {{ $i == request('year', now()->format('Y')) ? 'selected' : '' }}>
                                    {{ $i }}
                                </option>
                            @endfor
                        </select>

                        <button type="submit" class="btn btn-sm btn-primary">Tampilkan</button>
                    </form>
                </div>

                <div class="chart-container" style="position: relative; height: 400px;">
                    <canvas id="topCategoriesChart"></canvas>
                    <div id="chartLoading" class="chart-loading d-none">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                    <div id="chartMessage" class="d-none text-center text-muted mt-3">
                        Tidak ada data penjualan untuk periode yang dipilih.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        // Mengambil bulan dan tahun dari variabel Blade
        let month = "{{ $month }}"; // Ini akan diparsing dari variabel PHP
        let year = "{{ $year }}"; // Ini juga akan diparsing dari variabel PHP

        // Fungsi untuk mengubah periode chart
        function changePeriod(period) {
            // Mengirim permintaan AJAX untuk mengambil data berdasarkan periode yang dipilih
            fetch("{{ route('sales.chart') }}?period=" + period + "&month=" + month + "&year=" + year, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    // Memperbarui chart dengan data yang diterima dari server
                    updateChart(data);
                })
                .catch(error => console.error('Error fetching data:', error));
        }

        // Fungsi untuk memperbarui chart
        function updateChart(data) {
            let ctx = document.getElementById('salesChart').getContext('2d');
            let chart = new Chart(ctx, {
                type: 'line', // Jenis chart yang digunakan
                data: {
                    labels: data.labels, // Misalnya tanggal, minggu, atau bulan
                    datasets: [{
                        label: 'Total Penjualan',
                        data: data.total_sales, // Data penjualan
                        borderColor: 'rgba(75, 192, 192, 1)',
                        fill: false
                    }]
                }
            });
        }
    </script>

    <script>
        var chart = null;

        // Fungsi untuk memperbarui grafik berdasarkan periode
        function changePeriod(period) {
            // Mengirim request AJAX
            $.ajax({
                url: "{{ route('sales.chart') }}", // Gantilah dengan URL yang sesuai
                method: "GET",
                data: {
                    period: period
                },
                success: function(data) {
                    // Memperbarui grafik dengan data baru
                    updateChart(data, period);
                }
            });
        }

        // Fungsi untuk memperbarui grafik
        function updateChart(salesData, period) {
            // Memastikan grafik tidak digambar lebih dari sekali
            if (chart) {
                chart.destroy(); // Menghancurkan grafik lama
            }

            // Menyiapkan data untuk chart
            var labels = salesData.map(function(item) {
                if ('date' in item) return item.date; // For daily
                if ('week' in item) return 'Minggu ' + item.week; // For weekly
                if ('month' in item) return 'Bulan ' + item.month; // For monthly
            });

            var data = salesData.map(function(item) {
                return item.total_sales;
            });

            // Membuat grafik baru
            var ctx = document.getElementById('salesChart').getContext('2d');
            chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Total Penjualan',
                        data: data,
                        borderColor: 'rgb(75, 192, 192)',
                        fill: false,
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                    },
                    interaction: {
                        mode: 'index',
                        intersect: false,
                    },
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: period.charAt(0).toUpperCase() + period.slice(1)
                            }
                        },
                        y: {
                            title: {
                                display: true,
                                text: 'Total Penjualan'
                            },
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        // Memuat grafik pertama kali dengan data harian
        changePeriod('daily');
    </script>

    <script>
        $(document).ready(function() {
            let chartInstance = null;

            function initializeChart(data) {
                const ctx = document.getElementById('mostOrderedProductsChart').getContext('2d');

                // Hapus grafik yang ada jika sudah ada
                if (chartInstance) {
                    chartInstance.destroy();
                }

                // Cek apakah data kosong
                if (!data || data.length === 0) {
                    // Tampilkan pesan tidak ada data
                    chartInstance = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: ['Tidak ada data'],
                            datasets: [{
                                label: 'Jumlah Barang yang Diorder',
                                data: [0],
                                backgroundColor: 'rgba(200, 200, 200, 0.2)',
                                borderColor: 'rgba(200, 200, 200, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    display: false
                                },
                                title: {
                                    display: true,
                                    text: 'Tidak ada data penjualan untuk periode yang dipilih',
                                    font: {
                                        size: 16
                                    },
                                    padding: 20
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    max: 10
                                }
                            }
                        }
                    });
                    return;
                }

                const labels = data.map(item => item.product.name_product);
                const chartData = data.map(item => parseInt(item.total_quantity));

                chartInstance = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Jumlah Barang yang Diorder',
                            data: chartData,
                            backgroundColor: 'rgba(54, 162, 235, 0.8)',
                            borderColor: 'rgba(255, 255, 255, 1)',
                            borderWidth: 2,
                            borderRadius: 10,
                            borderSkipped: false,
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                display: true,
                                position: 'top',
                                labels: {
                                    font: {
                                        size: 14
                                    },
                                    color: '#000'
                                }
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        return `Jumlah: ${context.raw}`;
                                    }
                                }
                            }
                        },
                        scales: {
                            x: {
                                ticks: {
                                    font: {
                                        size: 12
                                    },
                                    color: '#000',
                                    maxRotation: 45,
                                    minRotation: 0
                                },
                                grid: {
                                    display: false
                                }
                            },
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Jumlah Barang',
                                    font: {
                                        size: 14
                                    },
                                    color: '#000'
                                },
                                ticks: {
                                    font: {
                                        size: 12
                                    },
                                    color: '#000'
                                },
                                grid: {
                                    color: 'rgba(200, 200, 200, 0.2)',
                                    borderColor: '#000'
                                }
                            }
                        }
                    }
                });
            }

            // Inisialisasi awal grafik
            initializeChart(@json($mostOrderedProducts));

            // Handle form submission
            $('#filterForm').on('submit', function(e) {
                e.preventDefault();
                const month = $('#month').val();
                const year = $('#year').val();

                // Show loading state
                const submitButton = $(this).find('button[type="submit"]');
                submitButton.prop('disabled', true)
                    .html(
                        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...'
                    );

                $.ajax({
                    url: "{{ route('dashboard.index') }}",
                    method: 'GET',
                    data: {
                        month: month,
                        year: year,
                        ajax: true
                    },
                    success: function(response) {
                        if (response.mostOrderedProducts) {
                            initializeChart(response.mostOrderedProducts);
                            // Tambahkan notifikasi jika data kosong
                            if (response.mostOrderedProducts.length === 0) {
                                // Optional: Tampilkan toast atau notifikasi
                                if (typeof Swal !== 'undefined') {
                                    Swal.fire({
                                        icon: 'info',
                                        title: 'Tidak Ada Data',
                                        text: 'Tidak ada data penjualan untuk periode yang dipilih',
                                        timer: 3000
                                    });
                                }
                            }
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                        if (typeof Swal !== 'undefined') {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Terjadi kesalahan saat memuat data. Silakan coba lagi.'
                            });
                        } else {
                            alert('Terjadi kesalahan saat memuat data. Silakan coba lagi.');
                        }
                    },
                    complete: function() {
                        // Reset button state
                        submitButton.prop('disabled', false).text('Tampilkan');
                    }
                });
            });
        });
    </script>
    
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let categoryChart = null;

            // Function to update the chart
            function updateChart(data) {
                const ctx = document.getElementById('topCategoriesChart').getContext('2d');

                // Destroy existing chart if it exists
                if (categoryChart) {
                    categoryChart.destroy();
                }

                // Check if data is empty
                if (!data || data.length === 0) {
                    document.getElementById('chartMessage').textContent =
                        'Tidak ada data penjualan untuk periode yang dipilih.';
                    document.getElementById('chartMessage').classList.remove('d-none');
                    return;
                } else {
                    document.getElementById('chartMessage').classList.add('d-none');
                }

                // Create new chart
                categoryChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: data.map(item => item.name_category),
                        datasets: [{
                            label: 'Jumlah Terjual',
                            data: data.map(item => item.total_quantity),
                            backgroundColor: [
                                'rgba(75, 192, 192, 0.6)',
                                'rgba(54, 162, 235, 0.6)',
                                'rgba(255, 206, 86, 0.6)',
                                'rgba(153, 102, 255, 0.6)',
                                'rgba(255, 159, 64, 0.6)',
                                'rgba(201, 203, 207, 0.6)',
                                'rgba(255, 99, 132, 0.6)',
                                'rgba(66, 135, 245, 0.6)',
                                'rgba(183, 28, 28, 0.6)',
                                'rgba(56, 142, 60, 0.6)',
                            ],
                        }],
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: true,
                                position: 'right',
                                labels: {
                                    font: {
                                        size: 12
                                    },
                                    padding: 20
                                }
                            },
                            tooltip: {
                                enabled: true,
                                callbacks: {
                                    label: function(context) {
                                        const label = context.label || '';
                                        const value = context.raw || 0;
                                        const total = context.dataset.data.reduce((acc, current) =>
                                            acc + current, 0);
                                        const percentage = ((value / total) * 100).toFixed(1);
                                        return `${label}: ${value} (${percentage}%)`;
                                    }
                                }
                            },
                        },
                    },
                });
            }

            // Initial chart creation with data from page load
            updateChart(@json($topCategories));

            // Handle form submission
            document.getElementById('categoryForm').addEventListener('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(this);
                const year = formData.get('year');
                const month = formData.get('month');

                fetch(`{{ route('dashboard.index') }}?year=${year}&month=${month}`, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.json())
                    .then(response => {
                        if (response.success) {
                            updateChart(response.topCategories || []);
                        } else {
                            throw new Error('Failed to fetch data');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        // Show error message to user
                        alert('Gagal memuat data. Silakan coba lagi.');
                    });
            });
        });
    </script>
@endsection
