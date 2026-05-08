<style>
/* ===== GLOBAL PAGE STYLES ===== */
:root{--p:#667eea;--p2:#764ba2;--s:#43e97b;--s2:#38f9d7;--w:#fa709a;--w2:#fee140;--d:#f5576c;--d2:#f093fb;--i:#4facfe;--i2:#00f2fe;--grad:linear-gradient(135deg,#667eea,#764ba2);--shadow:0 4px 24px rgba(102,126,234,.12);--radius:16px}
.pg-wrap{padding:.25rem 0;animation:pgIn .5s ease}
@keyframes pgIn{from{opacity:0;transform:translateY(16px)}to{opacity:1;transform:translateY(0)}}

/* PAGE HEADER */
.pg-header{display:flex;justify-content:space-between;align-items:center;background:#fff;border-radius:var(--radius);padding:1.25rem 1.5rem;margin-bottom:1.25rem;box-shadow:var(--shadow);border:1px solid rgba(102,126,234,.08)}
.pg-title{display:flex;align-items:center;gap:.75rem}
.pg-title .icon{width:44px;height:44px;border-radius:12px;background:var(--grad);display:flex;align-items:center;justify-content:center;color:#fff;font-size:1.1rem;flex-shrink:0}
.pg-title h1{font-size:1.3rem;font-weight:800;color:#2d3748;margin:0}
.pg-title p{font-size:.8rem;color:#a0aec0;margin:0}
.pg-actions{display:flex;gap:.5rem;flex-wrap:wrap}

/* BUTTONS */
.btn-prim{display:inline-flex;align-items:center;gap:.4rem;padding:.55rem 1.1rem;border-radius:10px;background:var(--grad);color:#fff;border:none;font-weight:600;font-size:.85rem;text-decoration:none;transition:all .25s;cursor:pointer}
.btn-prim:hover{transform:translateY(-2px);box-shadow:0 8px 20px rgba(102,126,234,.3);color:#fff}
.btn-sec{display:inline-flex;align-items:center;gap:.4rem;padding:.55rem 1.1rem;border-radius:10px;background:#fff;color:#667eea;border:2px solid #667eea;font-weight:600;font-size:.85rem;text-decoration:none;transition:all .25s;cursor:pointer}
.btn-sec:hover{background:var(--grad);color:#fff;border-color:transparent;transform:translateY(-2px)}
.btn-danger{display:inline-flex;align-items:center;gap:.4rem;padding:.5rem 1rem;border-radius:10px;background:linear-gradient(135deg,#f5576c,#f093fb);color:#fff;border:none;font-weight:600;font-size:.82rem;text-decoration:none;transition:all .25s;cursor:pointer}
.btn-danger:hover{transform:translateY(-2px);box-shadow:0 6px 16px rgba(245,87,108,.3);color:#fff}
.btn-warn{display:inline-flex;align-items:center;gap:.4rem;padding:.5rem 1rem;border-radius:10px;background:linear-gradient(135deg,#fa709a,#fee140);color:#fff;border:none;font-weight:600;font-size:.82rem;text-decoration:none;transition:all .25s;cursor:pointer}
.btn-warn:hover{transform:translateY(-2px);box-shadow:0 6px 16px rgba(250,112,154,.3);color:#fff}
.btn-info{display:inline-flex;align-items:center;gap:.4rem;padding:.5rem 1rem;border-radius:10px;background:linear-gradient(135deg,#4facfe,#00f2fe);color:#fff;border:none;font-weight:600;font-size:.82rem;text-decoration:none;transition:all .25s;cursor:pointer}
.btn-info:hover{transform:translateY(-2px);box-shadow:0 6px 16px rgba(79,172,254,.3);color:#fff}

/* MINI STATS */
.mini-stats{display:grid;grid-template-columns:repeat(auto-fit,minmax(170px,1fr));gap:1rem;margin-bottom:1.25rem}
.ms-card{background:#fff;border-radius:14px;padding:1rem 1.25rem;box-shadow:var(--shadow);border:1px solid rgba(0,0,0,.04);display:flex;align-items:center;gap:.9rem;transition:all .3s}
.ms-card:hover{transform:translateY(-4px);box-shadow:0 12px 32px rgba(102,126,234,.18)}
.ms-icon{width:42px;height:42px;border-radius:11px;display:flex;align-items:center;justify-content:center;color:#fff;font-size:1rem;flex-shrink:0}
.ms-icon.p{background:var(--grad)}.ms-icon.s{background:linear-gradient(135deg,#43e97b,#38f9d7)}.ms-icon.w{background:linear-gradient(135deg,#fa709a,#fee140)}.ms-icon.d{background:linear-gradient(135deg,#f5576c,#f093fb)}.ms-icon.i{background:linear-gradient(135deg,#4facfe,#00f2fe)}
.ms-val{font-size:1.5rem;font-weight:800;color:#2d3748;line-height:1}
.ms-lbl{font-size:.72rem;color:#a0aec0;font-weight:600;text-transform:uppercase;letter-spacing:.05em}

/* FILTER BOX */
.filter-box{background:#fff;border-radius:var(--radius);padding:1rem 1.25rem;margin-bottom:1.25rem;box-shadow:var(--shadow);border:1px solid rgba(102,126,234,.08);display:flex;gap:.75rem;flex-wrap:wrap;align-items:center}
.filter-search{flex:1;min-width:220px;position:relative}
.filter-search i{position:absolute;left:.85rem;top:50%;transform:translateY(-50%);color:#a0aec0}
.filter-search input{width:100%;padding:.6rem .75rem .6rem 2.2rem;border:2px solid #e8ecf4;border-radius:10px;font-size:.85rem;color:#2d3748;outline:none;transition:border .2s}
.filter-search input:focus{border-color:#667eea}
.filter-sel select{padding:.6rem .9rem;border:2px solid #e8ecf4;border-radius:10px;font-size:.85rem;color:#2d3748;outline:none;transition:border .2s;background:#fff;min-width:140px}
.filter-sel select:focus{border-color:#667eea}
.filter-info{margin-left:auto;font-size:.82rem;color:#a0aec0;font-weight:500}

/* TABLE CARD */
.tbl-card{background:#fff;border-radius:var(--radius);box-shadow:var(--shadow);border:1px solid rgba(102,126,234,.08);overflow:hidden}
.tbl-head{display:flex;justify-content:space-between;align-items:center;padding:1rem 1.25rem;border-bottom:1px solid #f0f4ff}
.tbl-head h5{font-size:.95rem;font-weight:700;color:#2d3748;margin:0;display:flex;align-items:center;gap:.5rem}
.tbl-head h5 i{color:#667eea}
.pro-table{width:100%;border-collapse:collapse}
.pro-table thead tr{background:linear-gradient(135deg,#667eea,#764ba2)}
.pro-table thead th{padding:.85rem 1rem;color:#fff;font-size:.78rem;font-weight:700;text-transform:uppercase;letter-spacing:.06em;border:none;white-space:nowrap}
.pro-table tbody tr{border-bottom:1px solid #f7faff;transition:background .2s}
.pro-table tbody tr:hover{background:#f8f9ff}
.pro-table tbody tr:last-child{border-bottom:none}
.pro-table td{padding:.85rem 1rem;font-size:.88rem;color:#4a5568;vertical-align:middle}
.tbl-foot{padding:.85rem 1.25rem;border-top:1px solid #f0f4ff;display:flex;justify-content:space-between;align-items:center}
.tbl-foot .info{font-size:.8rem;color:#a0aec0}

/* BADGES */
.tag{display:inline-flex;align-items:center;padding:.25rem .7rem;border-radius:20px;font-size:.75rem;font-weight:700}
.tag.p{background:#ede9fe;color:#6d28d9}.tag.s{background:#d1fae5;color:#065f46}.tag.w{background:#fef3c7;color:#92400e}.tag.d{background:#fee2e2;color:#991b1b}.tag.i{background:#dbeafe;color:#1e40af}.tag.neu{background:#f3f4f6;color:#374151}

/* AVATAR */
.av{width:34px;height:34px;border-radius:10px;background:var(--grad);display:flex;align-items:center;justify-content:center;color:#fff;font-size:.75rem;font-weight:700;flex-shrink:0}

/* ACTION BTNS in table */
.act-btns{display:flex;gap:.35rem;flex-wrap:nowrap}
.ab{width:32px;height:32px;border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:.78rem;border:none;cursor:pointer;transition:all .2s;text-decoration:none}
.ab.view{background:#ede9fe;color:#6d28d9}.ab.view:hover{background:#6d28d9;color:#fff}
.ab.edit{background:#fef3c7;color:#92400e}.ab.edit:hover{background:#f59e0b;color:#fff}
.ab.del{background:#fee2e2;color:#991b1b}.ab.del:hover{background:#ef4444;color:#fff}
.ab.ok{background:#d1fae5;color:#065f46}.ab.ok:hover{background:#10b981;color:#fff}

/* FORM CARD */
.form-card{background:#fff;border-radius:var(--radius);box-shadow:var(--shadow);border:1px solid rgba(102,126,234,.08);padding:1.5rem}
.form-section{margin-bottom:1.5rem;padding-bottom:1.5rem;border-bottom:1px solid #f0f4ff}
.form-section:last-child{margin-bottom:0;padding-bottom:0;border-bottom:none}
.form-section-title{font-size:.8rem;font-weight:700;text-transform:uppercase;letter-spacing:.06em;color:#667eea;margin-bottom:1rem}
.pro-label{font-size:.82rem;font-weight:600;color:#4a5568;margin-bottom:.4rem;display:block}
.pro-input{width:100%;padding:.65rem .9rem;border:2px solid #e8ecf4;border-radius:10px;font-size:.88rem;color:#2d3748;outline:none;transition:border .2s;background:#fff}
.pro-input:focus{border-color:#667eea;box-shadow:0 0 0 3px rgba(102,126,234,.1)}
.pro-select{width:100%;padding:.65rem .9rem;border:2px solid #e8ecf4;border-radius:10px;font-size:.88rem;color:#2d3748;outline:none;background:#fff;transition:border .2s}
.pro-select:focus{border-color:#667eea}
.pro-textarea{width:100%;padding:.65rem .9rem;border:2px solid #e8ecf4;border-radius:10px;font-size:.88rem;color:#2d3748;outline:none;resize:vertical;min-height:90px;transition:border .2s}
.pro-textarea:focus{border-color:#667eea}
.err-msg{font-size:.78rem;color:#ef4444;margin-top:.3rem}

/* EMPTY STATE */
.empty-state{text-align:center;padding:3rem 1rem}
.empty-state i{font-size:3rem;color:#e2e8f0;margin-bottom:1rem;display:block}
.empty-state h5{color:#a0aec0;font-weight:600;margin-bottom:.5rem}
.empty-state p{color:#cbd5e0;font-size:.85rem}

/* ALERT */
.pro-alert{border-radius:12px;padding:.9rem 1.1rem;margin-bottom:1rem;display:flex;align-items:center;gap:.75rem;font-size:.88rem;font-weight:500}
.pro-alert.success{background:#d1fae5;color:#065f46;border:1px solid #a7f3d0}
.pro-alert.danger{background:#fee2e2;color:#991b1b;border:1px solid #fca5a5}
.pro-alert.warning{background:#fef3c7;color:#92400e;border:1px solid #fde68a}
.pro-alert.info{background:#dbeafe;color:#1e40af;border:1px solid #bfdbfe}

/* RESPONSIVE */
@media screen and (max-width:768px){.pg-header{flex-direction:column;align-items:flex-start;gap:.75rem}.filter-box{flex-direction:column}.filter-info{margin-left:0}.pro-table thead{display:none}.pro-table td{display:block;padding:.5rem 1rem}.pro-table td::before{content:attr(data-label);font-weight:700;color:#667eea;display:block;font-size:.72rem;text-transform:uppercase;margin-bottom:.2rem}}
@media print{
    body{background:#fff!important;color:#000!important}
    .sidebar,.navbar,.pg-actions,.filter-box,.btn-prim,.btn-sec,.btn-warn,.btn-danger,.btn-info{display:none!important}
    .main-content{margin:0!important;padding:0!important;width:100%!important}
    .pro-table th,.pro-table td{border:1px solid #000!important;padding:.5rem!important;color:#000!important}
    .pro-table thead tr{background:transparent!important;color:#000!important}
    .pro-table thead th{color:#000!important;background:transparent!important}
    .tag{border:1px solid #000;background:transparent!important;color:#000!important}
    .ms-card{box-shadow:none!important;border:1px solid #000!important;break-inside:avoid}
    .tbl-card{box-shadow:none!important;border:none!important}
}
</style>
<?php /**PATH C:\antigravity\website-sekolah-main\resources\views/components/page-styles.blade.php ENDPATH**/ ?>