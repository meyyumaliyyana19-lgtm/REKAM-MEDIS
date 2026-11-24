<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RSUD Medika Utama Tuban - SIMRS Rekam Medis</title>
    <!-- Google Fonts Inter & Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@500;600;700;800&display=swap" rel="stylesheet">
    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome 6 Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    
    <style>
        :root {
            --hospital-navy: #0b132b;
            --hospital-navy-card: #1c2541;
            --hospital-blue: #0284c7;
            --hospital-blue-glow: rgba(2, 132, 199, 0.45);
            --hospital-teal: #0d9488;
            --hospital-bg: #f8fafc;
            --card-border-radius: 16px;
        }

        body {
            background-color: var(--hospital-bg);
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            color: #334155;
        }

        /* Glassmorphism Hospital Header */
        .hospital-header {
            background: linear-gradient(135deg, #0b132b 0%, #1c2541 60%, #0f172a 100%);
            border-bottom: 3px solid #0284c7;
            box-shadow: 0 10px 30px rgba(11, 19, 43, 0.4);
        }

        /* Logo Emblem RSUD Medika Utama */
        .hospital-logo-box {
            position: relative;
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .hospital-brand {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            color: #ffffff;
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .hospital-title {
            font-size: 1.25rem;
            line-height: 1.1;
            font-weight: 800;
            letter-spacing: 0.5px;
            background: linear-gradient(135deg, #ffffff 0%, #e0f2fe 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hospital-subtitle {
            font-size: 0.73rem;
            color: #94a3b8;
            font-weight: 400;
            display: flex;
            align-items: center;
            gap: 6px;
            margin-top: 2px;
        }

        /* Badges Tambahan RSUD (Akreditasi & IGD Call Center) */
        .badge-kars {
            background: linear-gradient(135deg, #fbbf24 0%, #d97706 100%);
            color: #1e1b4b;
            font-size: 0.68rem;
            font-weight: 800;
            padding: 3px 8px;
            border-radius: 6px;
            letter-spacing: 0.5px;
            box-shadow: 0 2px 6px rgba(245, 158, 11, 0.3);
        }

        .badge-igd {
            background: rgba(239, 68, 68, 0.15);
            border: 1px solid rgba(239, 68, 68, 0.4);
            color: #fca5a5;
            font-size: 0.72rem;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        /* Modern Pill Navigation Bar */
        .nav-hospital-bar {
            background: rgba(15, 23, 42, 0.6);
            padding: 6px;
            border-radius: 14px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            display: inline-flex;
            gap: 6px;
            width: 100%;
        }

        .nav-link-hospital {
            color: #94a3b8 !important;
            font-weight: 500;
            font-size: 0.9rem;
            padding: 10px 20px !important;
            border-radius: 10px;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            display: inline-flex;
            align-items: center;
            gap: 9px;
            text-decoration: none !important;
        }

        .nav-link-hospital:hover {
            color: #38bdf8 !important;
            background: rgba(255, 255, 255, 0.07);
            transform: translateY(-1px);
        }

        .nav-link-hospital.active {
            color: #ffffff !important;
            background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(2, 132, 199, 0.45);
        }

        .nav-link-hospital.active i {
            color: #ffffff !important;
        }

        /* Digital Live Clock Widget */
        .clock-pill {
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.12);
            padding: 7px 18px;
            border-radius: 30px;
            color: #ffffff;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.2);
        }

        .time-display {
            font-family: 'Poppins', monospace;
            font-weight: 700;
            color: #38bdf8;
            letter-spacing: 0.5px;
        }

        .hospital-banner {
            background: linear-gradient(135deg, #0b132b 0%, #1c2541 50%, #0284c7 100%);
            border-radius: var(--card-border-radius);
            color: white;
            padding: 28px 34px;
            box-shadow: 0 10px 25px rgba(15, 23, 42, 0.15);
            position: relative;
            overflow: hidden;
        }

        .card-hospital-stat {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: var(--card-border-radius);
            padding: 22px;
            transition: all 0.25s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
            text-decoration: none !important;
            display: block;
        }

        .card-hospital-stat:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 25px rgba(2, 132, 199, 0.15);
            border-color: #38bdf8;
        }

        .stat-icon-wrapper {
            width: 52px;
            height: 52px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
        }

        .bg-icon-pasien { background: #e0f2fe; color: #0284c7; }
        .bg-icon-dokter { background: #ccfbf1; color: #0d9488; }
        .bg-icon-obat   { background: #fef3c7; color: #d97706; }
        .bg-icon-rekam  { background: #f3e8ff; color: #7e22ce; }

        .stat-title { font-size: 0.82rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; color: #64748b; }
        .stat-value { font-family: 'Poppins', sans-serif; font-size: 2rem; font-weight: 700; color: #0f172a; line-height: 1.2; }

        .card-hospital-main {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: var(--card-border-radius);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
            padding: 26px;
        }

        .hospital-table-header { background: #0b132b; color: #ffffff; font-size: 0.85rem; font-weight: 600; text-transform: uppercase; }
        .hospital-table-header th { padding: 14px 16px; border: none; }
        .table > :not(caption) > * > * { padding: 14px 16px; border-bottom-color: #f1f5f9; }

        .badge-hospital { padding: 6px 12px; border-radius: 30px; font-weight: 600; font-size: 0.78rem; }
        .badge-rm { background-color: #e0f2fe; color: #0369a1; border: 1px solid #bae6fd; }
        .badge-dokter { background-color: #f0fdf4; color: #15803d; border: 1px solid #bbf7d0; }
        .badge-obat { background-color: #fefce8; color: #a16207; border: 1px solid #fef08a; }
        .badge-gender-l { background-color: #eff6ff; color: #1d4ed8; }
        .badge-gender-p { background-color: #fdf2f8; color: #be185d; }

        .hospital-search-input { border-radius: 10px; border: 1px solid #cbd5e1; padding: 9px 16px; font-size: 0.9rem; }
        .hospital-search-input:focus { border-color: #0284c7; box-shadow: 0 0 0 3px rgba(2, 132, 199, 0.15); }

        .btn-hospital-primary {
            background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
            color: white; border: none; border-radius: 9px; padding: 9px 18px; font-weight: 600; font-size: 0.88rem;
            box-shadow: 0 4px 10px rgba(2, 132, 199, 0.25); transition: all 0.2s ease;
        }
        .btn-hospital-primary:hover { color: white; transform: translateY(-1px); box-shadow: 0 6px 15px rgba(2, 132, 199, 0.35); }

        .btn-hospital-action { width: 34px; height: 34px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center; font-size: 0.88rem; transition: all 0.2s ease; border: none; }
        .btn-hospital-edit { background: #fef3c7; color: #d97706; }
        .btn-hospital-edit:hover { background: #fde68a; color: #b45309; }
        .btn-hospital-delete { background: #fee2e2; color: #dc2626; }
        .btn-hospital-delete:hover { background: #fca5a5; color: #b91c1c; }
        .btn-hospital-print { background: #e0e7ff; color: #4338ca; }
        .btn-hospital-print:hover { background: #c7d2fe; color: #3730a3; }

        .modal-content { border-radius: 18px; border: none; box-shadow: 0 25px 50px -12px rgba(11, 19, 43, 0.4); overflow: hidden; }
        .modal-header-hospital { background: linear-gradient(135deg, #0b132b 0%, #1c2541 100%); color: white; border-bottom: 3px solid #0284c7; padding: 20px 26px; }
        .modal-header-hospital .modal-title { font-family: 'Poppins', sans-serif; font-size: 1.15rem; font-weight: 600; }
        .modal-body { padding: 26px; background-color: #ffffff; }
        .modal-footer { background-color: #f8fafc; border-top: 1px solid #e2e8f0; padding: 16px 26px; }

        .form-label { font-size: 0.86rem; font-weight: 600; color: #1e293b; margin-bottom: 6px; }
        .form-control, .form-select { border-radius: 9px; border: 1px solid #cbd5e1; padding: 10px 14px; font-size: 0.9rem; }
        .form-control:focus, .form-select:focus { border-color: #0284c7; box-shadow: 0 0 0 3px rgba(2, 132, 199, 0.15); }
        .input-group-text { background-color: #f1f5f9; border-color: #cbd5e1; color: #64748b; border-radius: 9px 0 0 9px; }

        .status-dot { width: 9px; height: 9px; background-color: #22c55e; border-radius: 50%; display: inline-block; box-shadow: 0 0 10px #22c55e; }
    </style>
</head>
<body>

<?php $current_page = basename($_SERVER['PHP_SELF']); ?>

<header class="hospital-header sticky-top mb-4 py-2">
    <div class="container">
        <!-- Top Bar: Official Hospital Logo, Accreditation & Live Clock Widget -->
        <div class="d-flex justify-content-between align-items-center py-2 mb-2 border-bottom border-secondary border-opacity-25">
            <div class="hospital-brand">
                <!-- SVG Vector Official Hospital Emblem Logo -->
                <div class="hospital-logo-box">
                    <svg width="48" height="48" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="50" cy="50" r="46" fill="url(#hospitalGrad)" stroke="#38bdf8" stroke-width="3"/>
                        <!-- Shield Outline -->
                        <path d="M50 18 C30 18 22 28 22 46 C22 68 50 82 50 82 C50 82 78 68 78 46 C78 28 70 18 50 18 Z" fill="rgba(255,255,255,0.12)" stroke="white" stroke-width="2.5"/>
                        <!-- Medical Cross Symbol -->
                        <rect x="44" y="32" width="12" height="36" rx="3" fill="#ffffff"/>
                        <rect x="32" y="44" width="36" height="12" rx="3" fill="#ffffff"/>
                        <!-- Gold Star Center Accent -->
                        <circle cx="50" cy="50" r="4" fill="#facc15"/>
                        <!-- Heartbeat Line -->
                        <path d="M26 50 H36 L40 40 L46 60 L52 38 L58 54 L62 50 H74" stroke="#38bdf8" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <defs>
                            <linearGradient id="hospitalGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" stop-color="#0284c7" />
                                <stop offset="100%" stop-color="#0d9488" />
                            </linearGradient>
                        </defs>
                    </svg>
                </div>
                <div>
                    <div class="d-flex align-items-center gap-2">
                        <span class="hospital-title">RSUD MEDIKA UTAMA</span>
                        <span class="badge-kars"><i class="fa-solid fa-certificate me-1"></i>KARS PARIPURNA</span>
                    </div>
                    <div class="hospital-subtitle">
                        <span><i class="fa-solid fa-hospital-user text-info"></i> Sistem Informasi Manajemen Rekam Medis (SIMRS)</span>
                        <span class="text-white-50">|</span>
                        <span>SMK Negeri 3 Tuban</span>
                    </div>
                </div>
            </div>
            
            <div class="d-flex align-items-center gap-3">
                <!-- IGD Emergency Call Badge -->
                <div class="badge-igd d-none d-xl-flex">
                    <i class="fa-solid fa-phone-volume text-danger"></i>
                    <span>IGD 24 Jam: <strong>(0356) 321-999</strong></span>
                </div>

                <!-- Digital Real-Time Live Clock Pill -->
                <div class="clock-pill">
                    <i class="fa-regular fa-clock text-info"></i>
                    <span id="liveClockDate" class="d-none d-lg-inline text-white-50">Loading...</span>
                    <span id="liveClockTime" class="time-display">00:00:00 WIB</span>
                </div>

                <!-- Petugas Medis Badge -->
                <div class="d-none d-md-flex align-items-center gap-2 text-white opacity-90" style="font-size: 0.84rem;">
                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                        <i class="fa-solid fa-user-doctor"></i>
                    </div>
                    <div>
                        <div class="fw-semibold" style="line-height:1.1;">Admin SIMRS</div>
                        <small class="text-success" style="font-size:0.7rem;"><span class="status-dot me-1"></span>Online</small>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Bottom Bar: Modern Pill Navigation -->
        <nav class="navbar navbar-expand-lg navbar-dark p-0">
            <button class="navbar-toggler border-0 mb-2" type="button" data-bs-toggle="collapse" data-bs-target="#hospitalNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="hospitalNav">
                <div class="nav-hospital-bar">
                    <a class="nav-link-hospital <?= ($current_page == 'index.php') ? 'active' : ''; ?>" href="index.php">
                        <i class="fa-solid fa-chart-pie"></i> Dashboard
                    </a>
                    <a class="nav-link-hospital <?= ($current_page == 'pasien.php') ? 'active' : ''; ?>" href="pasien.php">
                        <i class="fa-solid fa-hospital-user"></i> Data Pasien
                    </a>
                    <a class="nav-link-hospital <?= ($current_page == 'dokter.php') ? 'active' : ''; ?>" href="dokter.php">
                        <i class="fa-solid fa-user-doctor"></i> Data Dokter
                    </a>
                    <a class="nav-link-hospital <?= ($current_page == 'obat.php') ? 'active' : ''; ?>" href="obat.php">
                        <i class="fa-solid fa-pills"></i> Data Obat / Farmasi
                    </a>
                    <a class="nav-link-hospital <?= ($current_page == 'rekam_medis.php') ? 'active' : ''; ?>" href="rekam_medis.php">
                        <i class="fa-solid fa-file-waveform"></i> Transaksi Rekam Medis
                    </a>
                </div>
            </div>
        </nav>
    </div>
</header>

<main class="container mb-5">