@extends('layouts.app')

@section('content')
<style>
    :root {
        --grad-blue: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
        --grad-pink: linear-gradient(135deg, #f472b6 0%, #db2777 100%);
        --grad-emerald: linear-gradient(135deg, #10b981 0%, #059669 100%);
        --grad-amber: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        --glass-white: rgba(255, 255, 255, 0.7);
    }

    .dashboard-container {
        animation: fadeIn 0.6s ease-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Welcome Header */
    .welcome-card {
        background: var(--grad-blue);
        border-radius: 24px;
        padding: 3rem;
        color: white;
        position: relative;
        overflow: hidden;
        margin-bottom: 2rem;
        box-shadow: 0 20px 25px -5px rgba(99, 102, 241, 0.2);
    }

    .welcome-card::after {
        content: '';
        position: absolute;
        top: 0; right: 0; bottom: 0; left: 0;
        background: url('https://www.transparenttextures.com/patterns/cubes.png');
        opacity: 0.1;
        pointer-events: none;
    }

    .welcome-card h2 {
        font-family: 'Outfit', sans-serif;
        font-size: 2.5rem;
        font-weight: 800;
        margin-bottom: 0.5rem;
    }

    .welcome-card p {
        font-size: 1.1rem;
        opacity: 0.9;
        max-width: 600px;
    }

    .clock-widget {
        position: absolute;
        right: 3rem;
        top: 50%;
        transform: translateY(-50%);
        text-align: right;
    }

    .clock-widget .time {
        font-size: 3.5rem;
        font-weight: 800;
        line-height: 1;
        font-family: 'Outfit', sans-serif;
    }

    .clock-widget .date {
        font-size: 1rem;
        opacity: 0.8;
        font-weight: 600;
    }

    /* Stats Grid */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2.5rem;
    }

    .stat-box {
        background: white;
        border-radius: 20px;
        padding: 1.5rem;
        display: flex;
        align-items: center;
        gap: 1.5rem;
        border: 1px solid #e2e8f0;
        transition: all 0.3s ease;
    }

    .stat-box:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);
    }

    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: white;
        box-shadow: 0 8px 16px rgba(0,0,0,0.1);
    }

    .stat-info h3 {
        font-size: 0.875rem;
        color: #64748b;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.25rem;
    }

    .stat-info div {
        font-size: 1.75rem;
        font-weight: 800;
        color: #0f172a;
        line-height: 1;
    }

    /* Main Grid Layout */
    .dashboard-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 2rem;
    }

    .card-title {
        font-family: 'Outfit', sans-serif;
        font-size: 1.25rem;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    /* Activity Feed */
    .activity-feed {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .activity-item {
        padding: 1rem;
        background: #f8fafc;
        border-radius: 16px;
        display: flex;
        align-items: center;
        gap: 1rem;
        transition: all 0.2s ease;
    }

    .activity-item:hover {
        background: #f1f5f9;
    }

    .activity-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
        color: white;
    }

    .activity-content { flex: 1; }
    .activity-name { font-weight: 700; font-size: 0.95rem; color: #1e293b; }
    .activity-meta { font-size: 0.8rem; color: #64748b; }
    .activity-time { font-size: 0.75rem; font-weight: 600; color: #94a3b8; }

    /* Quick Actions */
    .quick-actions {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
    }

    .action-btn {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 1.25rem;
        text-align: center;
        text-decoration: none;
        color: #1e293b;
        transition: all 0.3s ease;
    }

    .action-btn:hover {
        background: var(--grad-blue);
        color: white;
        border-color: transparent;
        transform: translateY(-3px);
        box-shadow: 0 10px 15px -3px rgba(99, 102, 241, 0.2);
    }

    .action-btn i { font-size: 1.25rem; margin-bottom: 0.5rem; display: block; }
    .action-btn span { font-size: 0.85rem; font-weight: 700; }

    /* Responsive */
    @media (max-width: 1280px) {
        .dashboard-grid { grid-template-columns: 1fr; }
    }

    @media (max-width: 768px) {
        .welcome-card { padding: 2rem; }
        .welcome-card h2 { font-size: 1.75rem; }
        .clock-widget { position: static; transform: none; text-align: left; margin-top: 1.5rem; }
        .clock-widget .time { font-size: 2.5rem; }
    }
</style>

<div class="dashboard-container">
    <!-- Header -->
    <div class="welcome-card">
        <div class="content">
            <h2>Hello, {{ auth()->user()->name }}! 👋</h2>
            <p>Selamat datang di portal manajemen Eduspace. Berikut adalah ringkasan aktivitas sekolah hari ini.</p>
        </div>
        <div class="clock-widget">
            <div class="time" id="liveClock">{{ now()->format('H:i') }}</div>
            <div class="date">{{ now()->format('l, d F Y') }}</div>
        </div>
    </div>

    <!-- Stats -->
    <div class="stats-grid">
        <div class="stat-box">
            <div class="stat-icon" style="background: var(--grad-blue);">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-info">
                <h3>Total Siswa</h3>
                <div>{{ $totalSiswa }}</div>
            </div>
        </div>
        <div class="stat-box">
            <div class="stat-icon" style="background: var(--grad-pink);">
                <i class="fas fa-clock"></i>
            </div>
            <div class="stat-info">
                <h3>Terlambat</h3>
                <div>{{ $todayLate }}</div>
            </div>
        </div>
        <div class="stat-box">
            <div class="stat-icon" style="background: var(--grad-emerald);">
                <i class="fas fa-door-open"></i>
            </div>
            <div class="stat-info">
                <h3>Izin Keluar</h3>
                <div>{{ $todayIzin }}</div>
            </div>
        </div>
        <div class="stat-box">
            <div class="stat-icon" style="background: var(--grad-amber);">
                <i class="fas fa-calendar-check"></i>
            </div>
            <div class="stat-info">
                <h3>Piket Aktif</h3>
                <div>{{ $todayPiket }}</div>
            </div>
        </div>
    </div>

    <!-- Main Grid -->
    <div class="dashboard-grid">
        <!-- Left Column: Charts & Activity -->
        <div class="left-col">
            <div class="card p-4 mb-4">
                <div class="card-title">
                    <i class="fas fa-chart-line text-primary"></i>
                    Statistik Mingguan
                </div>
                <div style="height: 300px;">
                    <canvas id="mainTrendChart"></canvas>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="card p-4 h-100">
                        <div class="card-title">
                            <i class="fas fa-history text-info"></i>
                            Izin Terkini
                        </div>
                        <div class="activity-feed">
                            @forelse($recentIzin as $izin)
                                <div class="activity-item">
                                    <div class="activity-icon" style="background: var(--grad-blue);">
                                        <i class="fas fa-door-open"></i>
                                    </div>
                                    <div class="activity-content">
                                        <div class="activity-name">{{ $izin->siswa->nama ?? 'Siswa' }}</div>
                                        <div class="activity-meta">{{ $izin->alasan }}</div>
                                    </div>
                                    <div class="activity-time">{{ $izin->created_at->diffForHumans() }}</div>
                                </div>
                            @empty
                                <p class="text-muted text-center py-4">Belum ada aktivitas izin.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card p-4 h-100">
                        <div class="card-title">
                            <i class="fas fa-clock text-danger"></i>
                            Terlambat
                        </div>
                        <div class="activity-feed">
                            @forelse($recentKeterlambatan as $tl)
                                <div class="activity-item">
                                    <div class="activity-icon" style="background: var(--grad-pink);">
                                        <i class="fas fa-clock"></i>
                                    </div>
                                    <div class="activity-content">
                                        <div class="activity-name">{{ $tl->siswa->nama ?? 'Siswa' }}</div>
                                        <div class="activity-meta">{{ $tl->keterangan }}</div>
                                    </div>
                                    <div class="activity-time">{{ $tl->created_at->diffForHumans() }}</div>
                                </div>
                            @empty
                                <p class="text-muted text-center py-4">Belum ada keterlambatan.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column: Quick Actions & More -->
        <div class="right-col">
            <div class="card p-4 mb-4">
                <div class="card-title">
                    <i class="fas fa-bolt text-warning"></i>
                    Aksi Cepat
                </div>
                <div class="quick-actions">
                    @foreach($roleBasedData['quickActions'] as $action)
                        <a href="{{ route($action['route']) }}" class="action-btn">
                            <i class="{{ $action['icon'] }}"></i>
                            <span>{{ $action['title'] }}</span>
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="card p-4">
                <div class="card-title">
                    <i class="fas fa-info-circle text-success"></i>
                    Status Sistem
                </div>
                <div class="system-status">
                    <div class="d-flex justify-content-between mb-3">
                        <span class="text-muted">Role Anda</span>
                        <span class="badge bg-primary rounded-pill">{{ strtoupper(auth()->user()->role) }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <span class="text-muted">Waktu Server</span>
                        <span class="text-dark font-monospace">{{ now()->format('H:i:s') }}</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="text-muted">Koneksi Database</span>
                        <span class="text-success"><i class="fas fa-check-circle me-1"></i> Stabil</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Live Clock
    function updateClock() {
        const now = new Date();
        const options = { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false };
        document.getElementById('liveClock').textContent = now.toLocaleTimeString('id-ID', options);
    }
    setInterval(updateClock, 1000);

    // Main Chart
    const ctx = document.getElementById('mainTrendChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($attendanceData['labels']),
            datasets: [{
                label: 'Trend Kehadiran',
                data: @json($attendanceData['hadir']),
                borderColor: '#6366f1',
                backgroundColor: 'rgba(99, 102, 241, 0.1)',
                fill: true,
                tension: 0.4,
                borderWidth: 4,
                pointRadius: 4,
                pointBackgroundColor: '#6366f1'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, grid: { color: '#f1f5f9' } },
                x: { grid: { display: false } }
            }
        }
    });
</script>
@endsection
