@extends('layouts.admin')

@section('main')
    <style>
        * {
            /* border: 1px solid black; */
        }
    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="flex flex-col md:flex-row mb-4 gap-4">
                <!-- Banner -->
                <div class="w-full bg-blue-500 bg-opacity-20 p-4 rounded-lg">
                    <div class="flex justify-between items-center">
                        <!-- Kiri: Judul dan Breadcrumb -->
                        <div>
                            <h1 class="text-3xl font-semibold text-gray-800">Selamat Datang , Admin !</h1>
                            <nav class="mt-2">
                                <ol class="flex text-sm text-gray-600">
                                    <li><a href="{{ route('dashboard.index') }}" class="hover:text-blue-500">Dashboard</a>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                        <!-- Kanan: Gambar (Vector) -->
                        <div class="hidden md:block">
                            <img src="{{ asset('img/img-banner/dashboard.png') }}" alt="Gambar Banner"
                                class="w-48 h-auto object-contain">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="card h-100 bg-gradient-to-r from-blue-800 to-blue-400">
                    <div class="card-body d-flex align-items-center">
                        <!-- Icon Container with White Card and Medium Border Radius -->
                        <div class="me-3 p-3 bg-white rounded-md">
                            <i class="fas fa-wallet fa-3x text-primary"></i>
                        </div>
                        <div>
                            <h5 class="card-title text-white font-semibold">Total Pendapatan</h5>
                            <p class="card-text text-white font-normal">Rp. {{ number_format($Revenue, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 2: Total Penjualan -->
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="card h-100 bg-gradient-to-r from-blue-800 to-blue-400">
                    <div class="card-body d-flex align-items-center">
                        <!-- Icon Container with White Card and Medium Border Radius -->
                        <div class="me-3 p-3 bg-white rounded-md">
                            <i class="fas fa-archive fa-3x text-primary"></i>
                        </div>
                        <div>
                            <h5 class="card-title text-white font-semibold">Total Penjualan</h5>
                            @if ($totalItemsSold > 0)
                                <p class="card-text text-white font-normal">{{ $totalItemsSold }} Pesanan Selesai</p>
                            @else
                                <p class="card-text text-white font-normal">Tidak ada penjualan</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 3: Pelanggan Baru -->
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="card h-100 bg-gradient-to-r from-blue-800 to-blue-400">
                    <div class="card-body d-flex align-items-center">
                        <!-- Icon Container with White Card and Medium Border Radius -->
                        <div class="me-3 p-3 bg-white rounded-md">
                            <i class="fas fa-user-plus fa-3x text-primary"></i>
                        </div>
                        <div>
                            <h5 class="card-title text-white font-semibold mb-2">Pelanggan Baru</h5>
                            <p class="card-text text-white font-normal mb-0">
                                <span class="fw-bold fs-5 ">{{ $newuser }}</span>
                                <span class="text-muted text-white">/ dalam sebulan terakhir</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <!-- Card for Top 10 Produk Terlaris -->
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Grafik Top 10 Produk Terlaris</h5>
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
            <h5 class="card-title">Grafik Top 10 Kategori Produk Terlaris</h5>
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

    <!-- Card for Pendapatan -->
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Grafik Pendapatan</h5>
            <div class="d-flex justify-content-end mb-3">
                <div class="d-flex align-items-center">
                    <label for="year" class="me-2 small">Tahun</label>
                    <select id="yearFilter" class="form-select form-select-sm me-2">
                        @for ($i = now()->year; $i >= now()->year - 5; $i--)
                            <option value="{{ $i }}" {{ $i == $year ? 'selected' : '' }}>{{ $i }}
                            </option>
                        @endfor
                    </select>
                    <button id="filterButton" class="btn btn-sm btn-primary">Tampilkan</button>
                </div>
            </div>
            <canvas id="incomeChart"></canvas>
            <div id="noDataMessage" class="text-center text-muted mt-3 d-none">
                Tidak ada data yang tersedia.
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
                                    ticks: {
                                        stepSize: 1, // Menampilkan angka bulat saja
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
                            barPercentage: 0.5,
                            categoryPercentage: 0.5
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
                                ticks: {
                                    stepSize: 1, // Pastikan angka bulat
                                    font: {
                                        size: 12
                                    },
                                    color: '#000'
                                },
                                title: {
                                    display: true,
                                    text: 'Jumlah Barang',
                                    font: {
                                        size: 14
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

                // Add loading spinner to the button
                const submitButton = this.querySelector('button[type="submit"]');
                submitButton.innerHTML =
                    '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...';
                submitButton.disabled = true;

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
                    })
                    .finally(() => {
                        // Reset button state after data is loaded
                        submitButton.innerHTML = 'Tampilkan';
                        submitButton.disabled = false;
                    });
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('incomeChart').getContext('2d');
            let incomeChart;

            // Function to render the chart
            function renderChart(data, year) {
                if (incomeChart) {
                    incomeChart.destroy(); // Destroy old chart if exists
                }

                // Handle empty data
                if (!data || data.length === 0) {
                    incomeChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: ['Tidak ada data'],
                            datasets: [{
                                label: 'Pendapatan (Rp)',
                                data: [0],
                                backgroundColor: 'rgba(200, 200, 200, 0.2)',
                                borderColor: 'rgba(200, 200, 200, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                title: {
                                    display: true,
                                    text: 'Tidak ada data untuk tahun yang dipilih',
                                    font: {
                                        size: 16
                                    }
                                }
                            },
                            scales: {
                                x: {
                                    display: false
                                },
                                y: {
                                    display: false
                                }
                            }
                        }
                    });

                    // Show "No Data" message
                    document.getElementById('noDataMessage').classList.remove('d-none');
                    return;
                }

                incomeChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus',
                            'September', 'Oktober', 'November', 'Desember'
                        ],
                        datasets: [{
                            label: `Pendapatan Tahun ${year} (Rp)`,
                            data: data,
                            borderColor: 'rgba(75, 192, 192, 1)',
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            tension: 0.4,
                            fill: true,
                            pointBackgroundColor: 'rgba(75, 192, 192, 1)',
                            pointBorderWidth: 2,
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                display: true,
                                position: 'top'
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        return `Rp ${context.raw.toLocaleString('id-ID')}`;
                                    }
                                }
                            }
                        },
                        scales: {
                            x: {
                                title: {
                                    display: true,
                                    text: 'Bulan',
                                    font: {
                                        size: 14
                                    }
                                }
                            },
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Pendapatan (Rp)',
                                    font: {
                                        size: 14
                                    }
                                },
                                ticks: {
                                    callback: function(value) {
                                        return `Rp ${value.toLocaleString('id-ID')}`;
                                    }
                                }
                            }
                        }
                    }
                });

                // Hide "No Data" message if data exists
                document.getElementById('noDataMessage').classList.add('d-none');
            }

            // Initial chart render with available data
            renderChart(@json($revenues), {{ $year }});

            // Event listener for the "Tampilkan" button click
            document.getElementById('filterButton').addEventListener('click', function() {
                const selectedYear = document.getElementById('yearFilter').value;

                // Show loading state
                const filterButton = document.getElementById('filterButton');
                filterButton.disabled = true;
                filterButton.innerHTML =
                    '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...';

                // Send AJAX request
                fetch(`/admin/dashboard?year=${selectedYear}`, {
                        method: 'GET',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            renderChart(data.revenues, selectedYear);
                        } else {
                            // Show "No Data" message if no data available
                            document.getElementById('noDataMessage').classList.remove('d-none');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan saat memuat data. Silakan coba lagi.');
                    })
                    .finally(() => {
                        // Reset button state after request is complete
                        filterButton.disabled = false;
                        filterButton.innerHTML = 'Tampilkan';
                    });
            });
        });
    </script>
@endsection
