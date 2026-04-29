<div class="fi-custom-login-wrapper">
    <div class="split-container">
        {{-- Sisi Kiri: Visual & Branding --}}
        <div class="side-visual">
            <img class="bg-image" 
                src="https://lh3.googleusercontent.com/aida-public/AB6AXuBpkzzwEGC1EnzqF-7wpMN7RH41QiC69dplcVoThwFbpSdq1AGEfPJfmspKhtMNad0l9jhbboViDmufgoKOE9o1U-GmM0rfFxv3RJB3uWDeg-QK-E3M-pZ2AxgemuE7jEF0Xv-DwFxgLFgLQXBqk0IEv-YJTWezlHh3ckcblDsSlbyygWa9q5yehYV8I1UREVLnGxsXEhf6seH5ouk31ep_jmISdyg0aBfHHYevLEibDLmocIpp6tt93sXO9FE4eGRaRwdpcM9CUkU" 
                alt="Pura Desa Adat Tamanbali">
            <div class="bg-overlay"></div>
            
            <div class="visual-content">
                <div class="brand-badge">
                    <span class="material-symbols-outlined icon">temple_hindu</span>
                    <span class="brand-name">SPTAK Tamanbali</span>
                </div>
                <h2 class="welcome-text">Rahajeng Rauh, <br><span class="highlight">Prajuru Desa Adat</span></h2>
                <p class="slogan">Sistem Perangkat Tata Kelola Digital untuk transparansi dan efisiensi administrasi Desa Adat Tamanbali.</p>
                
                <div class="stats-row">
                    <div class="stat-item">
                        <span class="stat-value">100%</span>
                        <span class="stat-label">Transparan</span>
                    </div>
                    <div class="divider"></div>
                    <div class="stat-item">
                        <span class="stat-value">Real-time</span>
                        <span class="stat-label">Integrasi</span>
                    </div>
                </div>
            </div>
            
            <div class="copyright">
                &copy; {{ date('Y') }} Desa Adat Tamanbali. The Digital Banjar.
            </div>
        </div>

        {{-- Sisi Kanan: Form Login --}}
        <div class="side-form">
            <div class="form-container">
                <div class="form-header">
                    {{-- Back to Home --}}
                    <a href="/" class="back-link">
                        <span class="material-symbols-outlined">arrow_back</span>
                        Kembali ke Beranda
                    </a>

                    <div class="mobile-brand">
                        <span class="material-symbols-outlined icon">temple_hindu</span>
                        <span class="brand-name">SPTAK Tamanbali</span>
                    </div>

                    <h2 class="form-title">Masuk Dashboard</h2>
                    <p class="form-subtitle">Silakan masukkan akun prajuru Anda untuk mengelola data desa.</p>
                </div>

                <div class="form-content">
                    {{ $this->content }}
                </div>
            </div>
        </div>
    </div>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&family=Inter:wght@400;500;600&family=Material+Symbols+Outlined&display=swap');

        .fi-custom-login-wrapper {
            --primary-color: #00236f;
            --secondary-color: #fed65b;
            --text-main: #0f172a;
            --text-muted: #64748b;
            --bg-main: white;
            --bg-form: white;
            
            font-family: 'Inter', sans-serif;
            background: var(--bg-main);
            min-height: 100vh;
            margin: 0; padding: 0;
            color: var(--text-main);
            transition: background-color 0.3s, color 0.3s;
        }

        /* Dark Mode Overrides */
        .dark .fi-custom-login-wrapper,
        :root:has(.dark) .fi-custom-login-wrapper {
            --primary-color: #3b82f6; /* Lighter blue for dark mode */
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
            --bg-main: #09090b;
            --bg-form: #09090b;
        }

        .split-container {
            display: flex;
            min-height: 100vh;
        }

        /* --- Sisi Kiri (Visual) --- */
        .side-visual {
            position: relative;
            flex: 1;
            display: none;
            overflow: hidden;
        }

        @media (min-width: 1024px) {
            .side-visual { display: block; }
        }

        .bg-image {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .bg-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(0, 35, 111, 0.95), rgba(30, 58, 138, 0.5));
            backdrop-filter: blur(1px);
        }

        .dark .bg-overlay {
            background: linear-gradient(135deg, rgba(0, 10, 30, 0.95), rgba(9, 9, 11, 0.8));
        }

        .visual-content {
            position: relative;
            z-index: 10;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 0 5rem;
            color: white;
        }

        .brand-badge {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 2rem;
        }

        .brand-badge .icon { font-size: 2.5rem; color: var(--secondary-color); }
        .brand-badge .brand-name { 
            font-family: 'Manrope', sans-serif; 
            font-size: 2rem; 
            font-weight: 800; 
            letter-spacing: -0.025em; 
        }

        .welcome-text {
            font-family: 'Manrope', sans-serif;
            font-size: 4rem;
            font-weight: 800;
            line-height: 1.1;
            margin-bottom: 2rem;
        }

        .welcome-text .highlight { color: var(--secondary-color); }

        .slogan {
            font-size: 1.25rem;
            line-height: 1.6;
            color: rgba(255, 255, 255, 0.8);
            max-width: 32rem;
            margin-bottom: 3rem;
        }

        .stats-row {
            display: flex;
            gap: 2rem;
            align-items: center;
        }

        .stat-item { display: flex; flex-direction: column; }
        .stat-value { font-size: 2rem; font-weight: 700; }
        .stat-label { font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.1em; color: rgba(255, 255, 255, 0.6); }

        .divider { width: 1px; height: 3rem; background: rgba(255, 255, 255, 0.2); }

        .copyright {
            position: absolute;
            bottom: 2.5rem;
            left: 5rem;
            font-size: 0.875rem;
            color: rgba(255, 255, 255, 0.5);
        }

        /* --- Sisi Kanan (Form) --- */
        .side-form {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            background: var(--bg-form);
        }

        .form-container {
            width: 100%;
            max-width: 24rem;
        }

        .back-link {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.875rem;
            font-weight: 700;
            color: var(--text-muted);
            text-decoration: none;
            margin-bottom: 2.5rem;
            transition: color 0.3s;
        }

        .back-link:hover { color: var(--primary-color); }

        .mobile-brand {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--primary-color);
            margin-bottom: 2rem;
        }

        @media (min-width: 1024px) { .mobile-brand { display: none; } }

        .form-title {
            font-family: 'Manrope', sans-serif;
            font-size: 1.875rem;
            font-weight: 800;
            color: var(--text-main);
            margin-bottom: 0.5rem;
        }

        .form-subtitle {
            color: var(--text-muted);
            font-size: 0.875rem;
            margin-bottom: 2.5rem;
        }

        /* --- Filament Overrides --- */
        .fi-btn {
            border-radius: 0.75rem !important;
            padding: 0.75rem !important;
            font-family: 'Manrope', sans-serif !important;
            font-weight: 700 !important;
            transition: all 0.3s !important;
        }

        .fi-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 35, 111, 0.2) !important;
        }

        .dark .fi-btn:hover {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.5) !important;
        }

        .fi-input-wrapper {
            border-radius: 0.75rem !important;
        }
    </style>
</div>
