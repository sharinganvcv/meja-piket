@extends('layouts.app')

@section('content')
<style>
:root {
    --grad1: linear-gradient(135deg,#667eea,#764ba2);
    --grad2: linear-gradient(135deg,#f093fb,#f5576c);
    --grad3: linear-gradient(135deg,#4facfe,#00f2fe);
    --grad4: linear-gradient(135deg,#43e97b,#38f9d7);
    --grad5: linear-gradient(135deg,#fa709a,#fee140);
    --grad6: linear-gradient(135deg,#a18cd1,#fbc2eb);
    --grad7: linear-gradient(135deg,#ffecd2,#fcb69f);
    --grad8: linear-gradient(135deg,#ff9a9e,#fecfef);
    --c1:#667eea; --c2:#764ba2;
    --shadow-sm: 0 2px 4px rgba(0,0,0,0.05);
    --shadow-md: 0 4px 12px rgba(0,0,0,0.08);
    --shadow-lg: 0 8px 24px rgba(0,0,0,0.12);
    --shadow-xl: 0 12px 32px rgba(0,0,0,0.16);
}
.db-wrap{padding:0;animation:fadeUp .8s ease}
@keyframes fadeUp{from{opacity:0;transform:translateY(30px)}to{opacity:1;transform:translateY(0)}}
@keyframes slideIn{from{opacity:0;transform:translateX(-20px)}to{opacity:1;transform:translateX(0)}}
@keyframes pulse{0%,100%{transform:scale(1)}50%{transform:scale(1.05)}}
@keyframes shimmer{0%{background-position:-1000px 0}100%{background-position:1000px 0}}

/* TOP BAR */
.db-topbar{display:flex;justify-content:space-between;align-items:center;background:rgba(255,255,255,.98);backdrop-filter:blur(24px);border-radius:20px;padding:1.5rem 2rem;margin-bottom:2rem;box-shadow:var(--shadow-lg);border:1px solid rgba(255,255,255,.8);position:relative;overflow:hidden}
.db-topbar::before{content:'';position:absolute;top:0;left:0;right:0;height:3px;background:var(--grad1)}
.db-greeting h2{font-size:1.6rem;font-weight:800;background:var(--grad1);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;margin:0;animation:slideIn .6s ease}
.db-greeting p{color:#718096;font-size:.9rem;margin:0;opacity:.8}
.db-time{background:var(--grad1);color:#fff;padding:.75rem 1.5rem;border-radius:16px;font-weight:700;font-size:1rem;box-shadow:var(--shadow-md);transition:all .3s;cursor:pointer;position:relative;overflow:hidden}
.db-time:hover{transform:translateY(-2px);box-shadow:var(--shadow-xl)}
.db-time::after{content:'';position:absolute;top:50%;left:50%;width:0;height:0;background:rgba(255,255,255,.2);border-radius:50%;transform:translate(-50%,-50%);transition:width .6s,height .6s}
.db-time:active::after{width:200px;height:200px}

/* ROLE BANNER */
.role-banner{border-radius:20px;padding:1.5rem 2rem;margin-bottom:2rem;display:flex;align-items:center;gap:1.5rem;color:#fff;position:relative;overflow:hidden;box-shadow:var(--shadow-lg);transition:all .3s;cursor:pointer}
.role-banner:hover{transform:translateY(-3px);box-shadow:var(--shadow-xl)}
.role-banner.admin{background:var(--grad1)}
.role-banner.kepsek{background:var(--grad3)}
.role-banner.guru{background:var(--grad4)}
.role-banner i{font-size:2.5rem;opacity:.9;animation:pulse 2s infinite}
.role-banner h3{margin:0;font-size:1.4rem;font-weight:800}
.role-banner p{margin:0;font-size:.9rem;opacity:.95}
.role-banner::after{content:'';position:absolute;right:-40px;top:-40px;width:150px;height:150px;background:rgba(255,255,255,.15);border-radius:50%;animation:float 6s ease-in-out infinite}
@keyframes float{0%,100%{transform:translateY(0)}50%{transform:translateY(-10px)}}
.role-banner::before{content:'';position:absolute;left:-20px;bottom:-20px;width:80px;height:80px;background:rgba(255,255,255,.08);border-radius:50%}

/* STATS */
.stats-row{display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:1.5rem;margin-bottom:2rem}
.scard{background:#fff;border-radius:20px;padding:1.5rem;box-shadow:var(--shadow-md);border:1px solid rgba(0,0,0,.05);transition:all .4s;cursor:pointer;position:relative;overflow:hidden}
.scard:hover{transform:translateY(-8px);box-shadow:var(--shadow-xl)}
.scard::before{content:'';position:absolute;top:0;right:0;width:100px;height:100px;border-radius:0 0 0 100px;opacity:.1;transition:all .4s}
.scard:hover::before{opacity:.15}
.scard.s1::before{background:var(--grad1)}
.scard.s2::before{background:var(--grad4)}
.scard.s3::before{background:var(--grad5)}
.scard.s4::before{background:var(--grad2)}
.scard.s5::before{background:var(--grad3)}
.scard.s6::before{background:var(--grad6)}
.si{width:56px;height:56px;border-radius:16px;display:flex;align-items:center;justify-content:center;color:#fff;font-size:1.3rem;margin-bottom:1rem;box-shadow:var(--shadow-sm);transition:all .3s}
.scard:hover .si{transform:scale(1.1);box-shadow:var(--shadow-md)}
.scard.s1 .si{background:var(--grad1)}
.scard.s2 .si{background:var(--grad4)}
.scard.s3 .si{background:var(--grad5)}
.scard.s4 .si{background:var(--grad2)}
.scard.s5 .si{background:var(--grad3)}
.scard.s6 .si{background:var(--grad6)}
.sv{font-size:2.2rem;font-weight:900;color:#2d3748;line-height:1.2;margin-bottom:.3rem}
.sl{font-size:.82rem;color:#718096;font-weight:700;text-transform:uppercase;letter-spacing:.08em;margin-top:.3rem}
.stag{display:inline-flex;align-items:center;gap:.4rem;font-size:.75rem;font-weight:800;padding:.35rem .8rem;border-radius:24px;margin-top:.6rem;transition:all .3s}
.stag.up{background:linear-gradient(135deg,#d4f4dd,#e8f5e8);color:#276749;border:1px solid #c3e6cd}
.stag.dn{background:linear-gradient(135deg,#ffe5e5,#fff0f0);color:#9b2c2c;border:1px solid #ffd6d6}
.stag.neu{background:linear-gradient(135deg:#e6f3ff,#f0f7ff);color:#2b6cb0;border:1px solid #d4e9ff}

/* CHARTS */
.db-mid{display:grid;grid-template-columns:1fr 1fr;gap:1.5rem;margin-bottom:2rem}
.chart-box{background:#fff;border-radius:20px;padding:1.5rem;box-shadow:var(--shadow-md);border:1px solid rgba(0,0,0,.05);transition:all .3s}
.chart-box:hover{box-shadow:var(--shadow-lg)}
.chart-box h4{font-size:1rem;font-weight:800;color:#2d3748;margin:0 0 1.5rem;display:flex;align-items:center;gap:.75rem}
.chart-box h4 i{font-size:1.1rem;opacity:.8}
.chart-container{position:relative;height:250px}
.chart-loading{position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);display:flex;flex-direction:column;align-items:center;gap:1rem}
.spinner{width:40px;height:40px;border:3px solid #f3f4f6;border-top:3px solid var(--c1);border-radius:50%;animation:spin 1s linear infinite}
@keyframes spin{0%{transform:rotate(0deg)}100%{transform:rotate(360deg)}}

/* ACTIVITY */
.act-box{background:#fff;border-radius:20px;padding:1.5rem;box-shadow:var(--shadow-md);border:1px solid rgba(0,0,0,.05);transition:all .3s}
.act-box:hover{box-shadow:var(--shadow-lg)}
.act-box h4{font-size:1rem;font-weight:800;color:#2d3748;margin:0 0 1.5rem;display:flex;align-items:center;gap:.75rem}
.act-box h4 i{font-size:1.1rem;opacity:.8}
.act-item{display:flex;align-items:flex-start;gap:1rem;padding:1rem 0;border-bottom:1px solid #f7fafc;transition:all .3s}
.act-item:hover{background:linear-gradient(90deg,rgba(102,126,234,.05),transparent);padding-left:1rem;margin:0 -1rem;padding-right:1rem;border-radius:12px}
.act-item:last-child{border-bottom:none}
.act-dot{width:44px;height:44px;border-radius:12px;display:flex;align-items:center;justify-content:center;color:#fff;font-size:.9rem;flex-shrink:0;box-shadow:var(--shadow-sm);transition:all .3s}
.act-item:hover .act-dot{transform:scale(1.1);box-shadow:var(--shadow-md)}
.act-dot.g{background:var(--grad4)}
.act-dot.r{background:var(--grad2)}
.act-dot.b{background:var(--grad3)}
.act-dot.p{background:var(--grad1)}
.act-title{font-size:.9rem;font-weight:700;color:#2d3748;margin:0}
.act-sub{font-size:.8rem;color:#a0aec0;margin:0}
.act-time{font-size:.75rem;color:#a0aec0;margin-left:auto;white-space:nowrap;flex-shrink:0;font-weight:600;background:#f7fafc;padding:.25rem .6rem;border-radius:12px}

/* QUICK ACTIONS */
.qa-box{background:#fff;border-radius:20px;padding:1.5rem;box-shadow:var(--shadow-md);border:1px solid rgba(0,0,0,.05);margin-bottom:2rem;transition:all .3s}
.qa-box:hover{box-shadow:var(--shadow-lg)}
.qa-box h4{font-size:1rem;font-weight:800;color:#2d3748;margin:0 0 1.5rem;display:flex;align-items:center;gap:.75rem}
.qa-box h4 i{font-size:1.1rem;opacity:.8}
.qa-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(180px,1fr));gap:1rem}
.qa-item{display:flex;align-items:center;gap:1rem;padding:1.2rem 1.5rem;border-radius:16px;border:2px solid #f0f4ff;text-decoration:none;transition:all .4s;background:#fafbff;position:relative;overflow:hidden}
.qa-item::before{content:'';position:absolute;top:0;left:-100%;width:100%;height:100%;background:linear-gradient(90deg,transparent,rgba(102,126,234,.1),transparent);transition:left .6s}
.qa-item:hover::before{left:100%}
.qa-item:hover{border-color:var(--c1);background:var(--grad1);transform:translateY(-4px);box-shadow:var(--shadow-xl)}
.qa-item:hover .qa-icon,.qa-item:hover .qa-label{color:#fff}
.qa-icon{width:44px;height:44px;border-radius:12px;background:var(--grad1);display:flex;align-items:center;justify-content:center;color:#fff;font-size:1rem;flex-shrink:0;transition:all .4s;box-shadow:var(--shadow-sm)}
.qa-item:hover .qa-icon{background:rgba(255,255,255,.25);transform:scale(1.1)}
.qa-label{font-size:.88rem;font-weight:700;color:#4a5568;transition:color .4s}

/* TODAY HIGHLIGHT */
.today-row{display:grid;grid-template-columns:repeat(3,1fr);gap:1.5rem;margin-bottom:2rem}
.today-card{border-radius:18px;padding:1.5rem;text-align:center;color:#fff;position:relative;overflow:hidden;box-shadow:var(--shadow-md);transition:all .4s;cursor:pointer}
.today-card:hover{transform:translateY(-6px);box-shadow:var(--shadow-xl)}
.today-card.t1{background:var(--grad1)}
.today-card.t2{background:var(--grad2)}
.today-card.t3{background:var(--grad3)}
.today-card .tv{font-size:2.5rem;font-weight:900;margin-bottom:.5rem;animation:slideIn .8s ease}
.today-card .tl{font-size:.85rem;opacity:.95;font-weight:700;text-transform:uppercase;letter-spacing:.08em}
.today-card i{font-size:2rem;opacity:.7;margin-bottom:1rem;display:block;animation:pulse 3s infinite}
.today-card::after{content:'';position:absolute;top:-50%;right:-50%;width:200%;height:200%;background:linear-gradient(45deg,transparent,rgba(255,255,255,.1),transparent);transform:rotate(45deg);transition:all .6s}
.today-card:hover::after{animation:shimmer 1.5s ease-in-out}

        @media(max-width:1200px){
            .stats-row{grid-template-columns:repeat(auto-fit,minmax(200px,1fr));}
            .qa-grid{grid-template-columns:repeat(auto-fill,minmax(160px,1fr));}
        }
        
        @media(max-width:1024px){
            .db-mid{grid-template-columns:1fr; gap: 1.5rem;}
            .stats-row{grid-template-columns:repeat(auto-fit,minmax(180px,1fr));}
            .today-row{grid-template-columns:1fr 1fr;}
            .qa-grid{grid-template-columns:repeat(auto-fill,minmax(140px,1fr));}
        }
        
        @media(max-width:768px){
            .db-topbar{flex-direction:column;align-items:flex-start;gap:1rem;padding:1.25rem 1.5rem;}
            .db-greeting h2{font-size:1.4rem;}
            .db-time{align-self:flex-end;}
            
            .role-banner{padding:1.25rem 1.5rem;gap:1rem;}
            .role-banner i{font-size:2rem;}
            .role-banner h3{font-size:1.2rem;}
            .role-banner p{font-size:.85rem;}
            
            .today-row{grid-template-columns:1fr;}
            .today-card{padding:1.25rem;}
            .today-card .tv{font-size:2.2rem;}
            .today-card i{font-size:1.8rem;}
            
            .stats-row{grid-template-columns:1fr 1fr;gap:1rem;}
            .scard{padding:1.25rem;}
            .si{width:48px;height:48px;font-size:1.1rem;}
            .sv{font-size:2rem;}
            
            .qa-grid{grid-template-columns:1fr 1fr;gap:1rem;}
            .qa-item{padding:1rem;}
            .qa-icon{width:40px;height:40px;font-size:.9rem;}
            
            .chart-box{padding:1.25rem;}
            .chart-container{height:200px;}
            
            .act-box{padding:1.25rem;}
            .act-item{padding:.75rem 0;}
            .act-dot{width:40px;height:40px;font-size:.8rem;}
        }
        
        @media(max-width:480px){
            .db-topbar{padding:1rem;}
            .db-greeting h2{font-size:1.3rem;}
            .db-greeting p{font-size:.85rem;}
            .db-time{padding:.6rem 1.2rem;font-size:.9rem;}
            
            .role-banner{flex-direction:column;text-align:center;padding:1rem;}
            .role-banner i{font-size:1.8rem;}
            .role-banner h3{font-size:1.1rem;}
            
            .today-card{padding:1rem;}
            .today-card .tv{font-size:2rem;}
            .today-card i{font-size:1.5rem;}
            
            .stats-row{grid-template-columns:1fr;}
            .scard{padding:1rem;}
            .si{width:44px;height:44px;font-size:1rem;}
            .sv{font-size:1.8rem;}
            .sl{font-size:.78rem;}
            
            .qa-grid{grid-template-columns:1fr;}
            .qa-item{padding:.9rem 1rem;}
            .qa-icon{width:36px;height:36px;font-size:.85rem;}
            .qa-label{font-size:.85rem;}
            
            .chart-box{padding:1rem;}
            .chart-container{height:180px;}
            
            .act-box{padding:1rem;}
            .act-item{padding:.6rem 0;gap:.75rem;}
            .act-dot{width:36px;height:36px;font-size:.75rem;}
            .act-title{font-size:.85rem;}
            .act-sub{font-size:.75rem;}
            .act-time{font-size:.7rem;padding:.2rem .5rem;}
        }
        
        @media(max-width:360px){
            .db-greeting h2{font-size:1.2rem;}
            .role-banner h3{font-size:1rem;}
            .role-banner p{font-size:.8rem;}
            .today-card .tv{font-size:1.8rem;}
            .sv{font-size:1.6rem;}
            .qa-item{padding:.75rem .8rem;}
        }
    </style>

<div class="db-wrap">
    {{-- TOP BAR --}}
    <div class="db-topbar">
        <div class="db-greeting">
            <h2>Selamat Datang, {{ auth()->user()->name }} 👋</h2>
            <p>{{ now()->format('l, d F Y') }} &bull; Sistem Manajemen Sekolah Eduspace</p>
        </div>
        <div class="db-time" id="liveClock">{{ now()->format('H:i') }}</div>
    </div>

    {{-- ROLE BANNER --}}
    @if(auth()->user()->role === 'admin')
    <div class="role-banner admin">
        <i class="fas fa-shield-alt"></i>
        <div>
            <h3>Panel Administrator</h3>
            <p>Akses penuh ke seluruh fitur manajemen sekolah</p>
        </div>
    </div>
    @elseif(auth()->user()->role === 'kepsek')
    <div class="role-banner kepsek">
        <i class="fas fa-user-tie"></i>
        <div>
            <h3>Panel Kepala Sekolah</h3>
            <p>Monitoring dan laporan aktivitas sekolah</p>
        </div>
    </div>
    @else
    <div class="role-banner guru">
        <i class="fas fa-chalkboard-teacher"></i>
        <div>
            <h3>Panel Guru Piket</h3>
            <p>Pencatatan kehadiran, izin, dan pelanggaran siswa</p>
        </div>
    </div>
    @endif

    {{-- TODAY HIGHLIGHT --}}
    <div class="today-row">
        <div class="today-card t1">
            <i class="fas fa-door-open"></i>
            <div class="tv">{{ $todayIzin }}</div>
            <div class="tl">Izin Hari Ini</div>
        </div>
        <div class="today-card t2">
            <i class="fas fa-clock"></i>
            <div class="tv">{{ $todayLate }}</div>
            <div class="tl">Terlambat Hari Ini</div>
        </div>
        <div class="today-card t3">
            <i class="fas fa-calendar-check"></i>
            <div class="tv">{{ $todayPiket }}</div>
            <div class="tl">Piket Hari Ini</div>
        </div>
    </div>

    {{-- STATS --}}
    <div class="stats-row">
        <div class="scard s1">
            <div class="si"><i class="fas fa-users"></i></div>
            <div class="sv">{{ $totalSiswa }}</div>
            <div class="sl">Total Siswa</div>
            <span class="stag neu"><i class="fas fa-info-circle"></i> Terdaftar</span>
        </div>
        <div class="scard s2">
            <div class="si"><i class="fas fa-chalkboard-teacher"></i></div>
            <div class="sv">{{ $totalGuru }}</div>
            <div class="sl">Total Guru</div>
            <span class="stag up"><i class="fas fa-check"></i> Aktif</span>
        </div>
        <div class="scard s3">
            <div class="si"><i class="fas fa-clock"></i></div>
            <div class="sv">{{ $totalKeterlambatan }}</div>
            <div class="sl">Keterlambatan</div>
            <span class="stag dn"><i class="fas fa-arrow-up"></i> Total</span>
        </div>
        <div class="scard s4">
            <div class="si"><i class="fas fa-exclamation-triangle"></i></div>
            <div class="sv">{{ $totalPelanggaran }}</div>
            <div class="sl">Pelanggaran</div>
            <span class="stag dn"><i class="fas fa-flag"></i> Total</span>
        </div>
        <div class="scard s5">
            <div class="si"><i class="fas fa-door-open"></i></div>
            <div class="sv">{{ $totalIzin }}</div>
            <div class="sl">Izin Keluar</div>
            <span class="stag neu"><i class="fas fa-list"></i> Total</span>
        </div>
        <div class="scard s6">
            <div class="si"><i class="fas fa-calendar-alt"></i></div>
            <div class="sv">{{ $totalPiket }}</div>
            <div class="sl">Jadwal Piket</div>
            <span class="stag up"><i class="fas fa-check-circle"></i> Aktif</span>
        </div>
    </div>

    {{-- QUICK ACTIONS --}}
    <div class="qa-box">
        <h4><i class="fas fa-bolt"></i> Aksi Cepat</h4>
        <div class="qa-grid">
            @foreach($roleBasedData['quickActions'] as $action)
            @if($action['route'] !== 'dashboard')
            <a href="{{ route($action['route']) }}" class="qa-item">
                <div class="qa-icon"><i class="{{ $action['icon'] }}"></i></div>
                <span class="qa-label">{{ $action['title'] }}</span>
            </a>
            @endif
            @endforeach
        </div>
    </div>

    {{-- CHARTS --}}
    <div class="db-mid">
        <div class="chart-box">
            <h4><i class="fas fa-chart-line"></i> Trend Kehadiran</h4>
            <div class="chart-container">
                <canvas id="attendanceChart"></canvas>
            </div>
        </div>
        <div class="chart-box">
            <h4><i class="fas fa-chart-pie"></i> Distribusi Kelas</h4>
            <div class="chart-container">
                <canvas id="distributionChart"></canvas>
            </div>
        </div>
    </div>

    @if(auth()->user()->role === 'admin' || auth()->user()->role === 'kepsek')
    <div class="db-mid">
        <div class="chart-box">
            <h4><i class="fas fa-calendar-alt"></i> Statistik Piket</h4>
            <div class="chart-container">
                <canvas id="piketChart"></canvas>
            </div>
        </div>
        <div class="chart-box">
            <h4><i class="fas fa-exclamation-triangle"></i> Trend Keterlambatan</h4>
            <div class="chart-container">
                <canvas id="lateChart"></canvas>
            </div>
        </div>
    </div>
    @endif

    {{-- ACTIVITY --}}
    <div class="db-mid">
            <div class="act-box">
                <h4><i class="fas fa-history"></i> Izin Terkini</h4>
                @forelse($recentIzin as $izin)
                <div class="act-item">
                    <div class="act-dot b"><i class="fas fa-door-open"></i></div>
                    <div style="flex:1;min-width:0">
                        <p class="act-title">{{ $izin->siswa->nama ?? '-' }}</p>
                        <p class="act-sub">{{ $izin->alasan ?? 'Izin Keluar' }}</p>
                    </div>
                    <span class="act-time">{{ $izin->created_at->diffForHumans() }}</span>
                </div>
                @empty
                <div class="act-item">
                    <div class="act-dot g"><i class="fas fa-check"></i></div>
                    <div><p class="act-title">Tidak ada izin</p><p class="act-sub">Semua siswa hadir</p></div>
                </div>
                @endforelse
            </div>
            <div class="act-box">
                <h4><i class="fas fa-clock"></i> Keterlambatan Terkini</h4>
                @forelse($recentKeterlambatan as $tl)
                <div class="act-item">
                    <div class="act-dot r"><i class="fas fa-clock"></i></div>
                    <div style="flex:1;min-width:0">
                        <p class="act-title">{{ $tl->siswa->nama ?? '-' }}</p>
                        <p class="act-sub">{{ $tl->keterangan ?? 'Terlambat' }}</p>
                    </div>
                    <span class="act-time">{{ $tl->created_at->diffForHumans() }}</span>
                </div>
                @empty
                <div class="act-item">
                    <div class="act-dot g"><i class="fas fa-check"></i></div>
                    <div><p class="act-title">Tidak ada keterlambatan</p><p class="act-sub">Semua tepat waktu</p></div>
                </div>
                @endforelse
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Live clock
function updateClock(){
    const now=new Date();
    document.getElementById('liveClock').textContent=now.toLocaleTimeString('id-ID',{hour:'2-digit',minute:'2-digit',second:'2-digit'});
}
setInterval(updateClock,1000);

// Chart configuration
Chart.defaults.font.family = 'Inter, system-ui, sans-serif';
Chart.defaults.color = '#4a5568';

// Attendance Chart
const attendanceCtx = document.getElementById('attendanceChart').getContext('2d');
new Chart(attendanceCtx, {
    type: 'line',
    data: {
        labels: @json($attendanceData['labels']),
        datasets: [{
            label: 'Hadir',
            data: @json($attendanceData['hadir']),
            borderColor: '#667eea',
            backgroundColor: 'rgba(102, 126, 234, 0.1)',
            borderWidth: 3,
            fill: true,
            tension: 0.4,
            pointBackgroundColor: '#667eea',
            pointBorderColor: '#fff',
            pointBorderWidth: 2,
            pointRadius: 6,
            pointHoverRadius: 8
        }, {
            label: 'Tidak Hadir',
            data: @json($attendanceData['tidak_hadir']),
            borderColor: '#f093fb',
            backgroundColor: 'rgba(240, 147, 251, 0.1)',
            borderWidth: 3,
            fill: true,
            tension: 0.4,
            pointBackgroundColor: '#f093fb',
            pointBorderColor: '#fff',
            pointBorderWidth: 2,
            pointRadius: 6,
            pointHoverRadius: 8
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: true,
                position: 'bottom',
                labels: {
                    padding: 20,
                    usePointStyle: true,
                    font: {
                        size: 12,
                        weight: '600'
                    }
                }
            },
            tooltip: {
                backgroundColor: 'rgba(0, 0, 0, 0.8)',
                padding: 12,
                cornerRadius: 8,
                titleFont: {
                    size: 14,
                    weight: '600'
                },
                bodyFont: {
                    size: 13
                },
                callbacks: {
                    label: function(context) {
                        return context.dataset.label + ': ' + context.parsed.y + '%';
                    }
                }
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                max: 100,
                ticks: {
                    callback: function(value) {
                        return value + '%';
                    },
                    font: {
                        size: 11,
                        weight: '500'
                    }
                },
                grid: {
                    borderDash: [5, 5],
                    color: 'rgba(0, 0, 0, 0.05)'
                }
            },
            x: {
                ticks: {
                    font: {
                        size: 11,
                        weight: '500'
                    }
                },
                grid: {
                    display: false
                }
            }
        },
        interaction: {
            intersect: false,
            mode: 'index'
        },
        animation: {
            duration: 1500,
            easing: 'easeInOutQuart'
        }
    }
});

// Distribution Chart
const distributionCtx = document.getElementById('distributionChart').getContext('2d');
new Chart(distributionCtx, {
    type: 'doughnut',
    data: {
        labels: @json($classDistribution['labels']),
        datasets: [{
            data: @json($classDistribution['data']),
            backgroundColor: [
                '#667eea',
                '#43e97b',
                '#fa709a'
            ],
            borderWidth: 0,
            hoverOffset: 8
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: true,
                position: 'bottom',
                labels: {
                    padding: 20,
                    usePointStyle: true,
                    font: {
                        size: 12,
                        weight: '600'
                    }
                }
            },
            tooltip: {
                backgroundColor: 'rgba(0, 0, 0, 0.8)',
                padding: 12,
                cornerRadius: 8,
                titleFont: {
                    size: 14,
                    weight: '600'
                },
                bodyFont: {
                    size: 13
                },
                callbacks: {
                    label: function(context) {
                        const total = context.dataset.data.reduce((a, b) => a + b, 0);
                        const percentage = ((context.parsed / total) * 100).toFixed(1);
                        return context.label + ': ' + context.parsed + ' (' + percentage + '%)';
                    }
                }
            }
        },
        cutout: '65%',
        animation: {
            animateRotate: true,
            animateScale: true,
            duration: 1500,
            easing: 'easeInOutQuart'
        }
    }
});

@if(auth()->user()->role === 'admin' || auth()->user()->role === 'kepsek')
// Piket Chart
const piketCtx = document.getElementById('piketChart').getContext('2d');
new Chart(piketCtx, {
    type: 'bar',
    data: {
        labels: @json($piketStats['labels']),
        datasets: [{
            label: 'Jadwal Piket',
            data: @json($piketStats['data']),
            backgroundColor: 'rgba(79, 172, 254, 0.8)',
            borderColor: '#4facfe',
            borderWidth: 0,
            borderRadius: 8,
            hoverBackgroundColor: 'rgba(79, 172, 254, 1)'
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false
            },
            tooltip: {
                backgroundColor: 'rgba(0, 0, 0, 0.8)',
                padding: 12,
                cornerRadius: 8,
                titleFont: {
                    size: 14,
                    weight: '600'
                },
                bodyFont: {
                    size: 13
                },
                callbacks: {
                    label: function(context) {
                        return 'Total: ' + context.parsed.y + ' jadwal';
                    }
                }
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    stepSize: 1,
                    font: {
                        size: 11,
                        weight: '500'
                    }
                },
                grid: {
                    borderDash: [5, 5],
                    color: 'rgba(0, 0, 0, 0.05)'
                }
            },
            x: {
                ticks: {
                    font: {
                        size: 11,
                        weight: '500'
                    }
                },
                grid: {
                    display: false
                }
            }
        },
        animation: {
            duration: 1500,
            easing: 'easeInOutQuart',
            delay: (context) => {
                let delay = 0;
                if (context.type === 'data' && context.mode === 'default') {
                    delay = context.dataIndex * 100;
                }
                return delay;
            }
        }
    }
});

// Late Trend Chart
const lateCtx = document.getElementById('lateChart').getContext('2d');
new Chart(lateCtx, {
    type: 'line',
    data: {
        labels: @json($lateTrend['labels']),
        datasets: [{
            label: 'Keterlambatan',
            data: @json($lateTrend['data']),
            borderColor: '#f093fb',
            backgroundColor: 'rgba(240, 147, 251, 0.1)',
            borderWidth: 3,
            fill: true,
            tension: 0.4,
            pointBackgroundColor: '#f093fb',
            pointBorderColor: '#fff',
            pointBorderWidth: 2,
            pointRadius: 6,
            pointHoverRadius: 8
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false
            },
            tooltip: {
                backgroundColor: 'rgba(0, 0, 0, 0.8)',
                padding: 12,
                cornerRadius: 8,
                titleFont: {
                    size: 14,
                    weight: '600'
                },
                bodyFont: {
                    size: 13
                },
                callbacks: {
                    label: function(context) {
                        return 'Total: ' + context.parsed.y + ' siswa';
                    }
                }
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    stepSize: 1,
                    font: {
                        size: 11,
                        weight: '500'
                    }
                },
                grid: {
                    borderDash: [5, 5],
                    color: 'rgba(0, 0, 0, 0.05)'
                }
            },
            x: {
                ticks: {
                    font: {
                        size: 11,
                        weight: '500'
                    }
                },
                grid: {
                    display: false
                }
            }
        },
        interaction: {
            intersect: false,
            mode: 'index'
        },
        animation: {
            duration: 1500,
            easing: 'easeInOutQuart'
        }
    }
});
@endif

// Add interactive animations
document.addEventListener('DOMContentLoaded', function() {
    // Animate stats cards on scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.animation = 'slideIn 0.6s ease forwards';
            }
        });
    }, observerOptions);
    
    document.querySelectorAll('.scard').forEach(card => {
        observer.observe(card);
    });
    
    // Add ripple effect to clickable elements
    document.querySelectorAll('.scard, .today-card, .qa-item').forEach(element => {
        element.addEventListener('click', function(e) {
            const ripple = document.createElement('span');
            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = e.clientX - rect.left - size / 2;
            const y = e.clientY - rect.top - size / 2;
            
            ripple.style.width = ripple.style.height = size + 'px';
            ripple.style.left = x + 'px';
            ripple.style.top = y + 'px';
            ripple.classList.add('ripple');
            
            this.appendChild(ripple);
            
            setTimeout(() => {
                ripple.remove();
            }, 600);
        });
    });
});
</script>

<style>
.ripple {
    position: absolute;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.6);
    transform: scale(0);
    animation: ripple-animation 0.6s ease-out;
    pointer-events: none;
}

@keyframes ripple-animation {
    to {
        transform: scale(4);
        opacity: 0;
    }
}

.scard, .today-card, .qa-item {
    position: relative;
    overflow: hidden;
}
</style>
@endsection
