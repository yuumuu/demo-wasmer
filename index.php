<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="description" content="Landing page demo untuk deployment di Wasmer.io. Menampilkan platform WebAssembly modern dengan fitur interaktif.">
    <meta name="theme-color" content="#6366f1">
    <title>WasmNexus | Deploy WebAssembly di Edge</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: system-ui, -apple-system, 'Segoe UI', 'Inter', 'Roboto', sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #eff6ff 100%);
            color: #0f172a;
            line-height: 1.5;
            scroll-behavior: smooth;
        }

        /* Custom properties */
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --primary-glow: rgba(99, 102, 241, 0.15);
            --secondary: #10b981;
            --dark-bg: #1e293b;
            --card-bg: rgba(255, 255, 255, 0.9);
            --border-light: rgba(203, 213, 225, 0.4);
        }

        .container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 24px;
        }

        /* Navbar */
        .navbar {
            backdrop-filter: blur(12px);
            background: rgba(255, 255, 255, 0.75);
            border-bottom: 1px solid var(--border-light);
            position: sticky;
            top: 0;
            z-index: 50;
            padding: 1rem 0;
        }

        .nav-flex {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .logo {
            font-weight: 800;
            font-size: 1.7rem;
            background: linear-gradient(135deg, var(--primary), #8b5cf6);
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
            letter-spacing: -0.02em;
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            align-items: center;
            flex-wrap: wrap;
        }

        .nav-links a {
            text-decoration: none;
            font-weight: 500;
            color: #334155;
            transition: color 0.2s;
        }

        .nav-links a:hover {
            color: var(--primary);
        }

        .btn-outline {
            border: 1px solid var(--primary);
            padding: 0.5rem 1.2rem;
            border-radius: 40px;
            background: transparent;
            font-weight: 600;
            color: var(--primary);
            transition: all 0.2s;
        }

        .btn-outline:hover {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        /* Buttons */
        .btn-primary {
            background: linear-gradient(105deg, var(--primary), var(--primary-dark));
            color: white;
            border: none;
            padding: 0.85rem 2rem;
            border-radius: 48px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
            box-shadow: 0 8px 20px rgba(99, 102, 241, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 24px rgba(99, 102, 241, 0.4);
        }

        .btn-secondary {
            background: white;
            border: 1px solid #cbd5e1;
            padding: 0.85rem 2rem;
            border-radius: 48px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            color: #1e293b;
        }

        .btn-secondary:hover {
            border-color: var(--primary);
            background: #f8fafc;
        }

        /* Hero */
        .hero {
            padding: 5rem 0 4rem 0;
            text-align: center;
        }

        .hero-badge {
            display: inline-block;
            background: rgba(99, 102, 241, 0.1);
            backdrop-filter: blur(4px);
            padding: 0.3rem 1rem;
            border-radius: 40px;
            font-size: 0.85rem;
            font-weight: 500;
            color: var(--primary-dark);
            margin-bottom: 1.5rem;
            border: 1px solid rgba(99, 102, 241, 0.2);
        }

        .hero h1 {
            font-size: clamp(2.5rem, 8vw, 4.5rem);
            font-weight: 800;
            letter-spacing: -0.02em;
            background: linear-gradient(to right, #0f172a, #334155);
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
            margin-bottom: 1.2rem;
        }

        .hero p {
            font-size: 1.25rem;
            color: #475569;
            max-width: 700px;
            margin: 0 auto 2rem auto;
        }

        .hero-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        /* Features grid */
        .section-title {
            font-size: 2rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 3rem;
            letter-spacing: -0.01em;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 2rem;
            margin: 3rem 0;
        }

        .feature-card {
            background: var(--card-bg);
            backdrop-filter: blur(8px);
            border-radius: 2rem;
            padding: 2rem 1.5rem;
            text-align: center;
            transition: all 0.25s ease;
            border: 1px solid rgba(255, 255, 255, 0.5);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.02);
        }

        .feature-card:hover {
            transform: translateY(-6px);
            border-color: var(--primary);
            box-shadow: 0 20px 30px -12px rgba(99, 102, 241, 0.2);
            background: rgba(255, 255, 255, 0.95);
        }

        .feature-icon {
            font-size: 2.8rem;
            margin-bottom: 1rem;
        }

        .feature-card h3 {
            font-size: 1.5rem;
            margin-bottom: 0.75rem;
        }

        .feature-card p {
            color: #475569;
        }

        /* Demo interaktif: deployment status */
        .demo-card {
            background: linear-gradient(145deg, #ffffff, #f1f5f9);
            border-radius: 2rem;
            padding: 2rem;
            margin: 3rem 0;
            text-align: center;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #ecfdf5;
            padding: 0.5rem 1.2rem;
            border-radius: 60px;
            font-weight: 500;
            margin-bottom: 1.2rem;
        }

        .status-led {
            width: 10px;
            height: 10px;
            background: #10b981;
            border-radius: 50%;
            display: inline-block;
            box-shadow: 0 0 6px #10b981;
            animation: pulse 1.5s infinite;
        }

        @keyframes pulse {
            0% { opacity: 0.5; transform: scale(0.8);}
            100% { opacity: 1; transform: scale(1.2);}
        }

        .demo-card button {
            margin-top: 1rem;
            background: var(--primary);
            border: none;
            padding: 0.7rem 1.8rem;
            border-radius: 40px;
            color: white;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s;
        }

        .demo-card button:hover {
            background: var(--primary-dark);
            transform: scale(0.98);
        }

        /* Wasmer deployment section */
        .wasmer-showcase {
            background: #0f172a;
            border-radius: 2rem;
            padding: 2.5rem;
            margin: 3rem 0;
            color: #e2e8f0;
            text-align: center;
        }

        .wasmer-showcase h3 {
            font-size: 1.8rem;
            color: white;
            margin-bottom: 0.75rem;
        }

        .code-snippet {
            background: #1e293b;
            padding: 1rem 1.5rem;
            border-radius: 1.2rem;
            font-family: 'Menlo', monospace;
            font-size: 0.9rem;
            display: inline-block;
            margin: 1.2rem 0;
            border-left: 4px solid var(--primary);
            text-align: left;
            max-width: 100%;
            overflow-x: auto;
        }

        /* CTA */
        .cta-section {
            text-align: center;
            margin: 4rem 0;
            padding: 3rem;
            background: rgba(99, 102, 241, 0.05);
            border-radius: 2rem;
        }

        /* Footer */
        .footer {
            border-top: 1px solid #e2e8f0;
            padding: 2rem 0;
            margin-top: 4rem;
            text-align: center;
            color: #64748b;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .container {
                padding: 0 20px;
            }
            .nav-flex {
                flex-direction: column;
                align-items: center;
            }
            .nav-links {
                gap: 1.2rem;
                justify-content: center;
            }
            .hero {
                padding: 3rem 0;
            }
            .features-grid {
                gap: 1.2rem;
            }
            .code-snippet {
                font-size: 0.75rem;
                padding: 0.8rem;
            }
        }
    </style>
</head>
<body>

<nav class="navbar">
    <div class="container nav-flex">
        <div class="logo">⚡ WasmNexus</div>
        <div class="nav-links">
            <a href="#">Beranda</a>
            <a href="#">Fitur</a>
            <a href="#">Dokumentasi</a>
            <a href="#" class="btn-outline">Login</a>
        </div>
    </div>
</nav>

<main>
    <div class="container">
        <!-- Hero Section -->
        <section class="hero">
            <span class="hero-badge">🚀 Deploy dengan Wasmer.io — siap produksi</span>
            <h1>WebAssembly tanpa batas <br> di edge network</h1>
            <p>Jalankan workload Wasm dengan performa native, cold start instan, dan skalabilitas global. Dideploy secara mulus menggunakan Wasmer Runtime.</p>
            <div class="hero-buttons">
                <button class="btn-primary" id="deployDemoBtn">🚀 Mulai Deployment</button>
                <button class="btn-secondary" id="learnMoreBtn">📘 Pelajari selengkapnya</button>
            </div>
        </section>

        <!-- Features Grid -->
        <h2 class="section-title">💎 Keunggulan platform</h2>
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">⚡</div>
                <h3>Cold Start &lt;100ms</h3>
                <p>Instan spin-up, sempurna untuk fungsi serverless dan microservices berbasis Wasm.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">🦀</div>
                <h3>Multi-bahasa</h3>
                <p>Rust, Go, C/C++, Zig, AssemblyScript — kompilasi ke Wasm dan deploy langsung.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">🛡️</div>
                <h3>Sandbox aman</h3>
                <p>Isolasi tingkat sistem dengan keamanan memory, ideal untuk kode tidak terpercaya.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">🌍</div>
                <h3>Edge global</h3>
                <p>Deploy di 30+ region, latency minimal, respons sepersekian detik.</p>
            </div>
        </div>

        <!-- Demo Interaktif : Deployment check + Wasmer -->
        <div class="demo-card">
            <div class="status-badge">
                <span class="status-led"></span>
                <span id="liveStatusText">Live: Terhubung ke Wasmer Edge</span>
            </div>
            <h3 style="margin-bottom: 0.5rem;">🧪 Simulasi deployment test</h3>
            <p>Klik tombol di bawah untuk menguji koneksi ke infrastruktur Wasmer.io & status deployment demo ini.</p>
            <button id="testDeploymentBtn">🔌 Uji Deployment Wasmer</button>
            <div id="deploymentMessage" style="margin-top: 1.2rem; font-weight: 500; min-height: 3rem;"></div>
        </div>

        <!-- Wasmer Showcase / Command -->
        <div class="wasmer-showcase">
            <h3>✨ Dideploy dengan Wasmer.io</h3>
            <p>Landing page statis + Wasm siap pakai. Gunakan perintah berikut untuk deploy proyek Anda sendiri:</p>
            <div class="code-snippet">
                $ wasmer deploy <br>
                $ wasmer publish wasmnexus --net --env
            </div>
            <p style="font-size: 0.9rem; margin-top: 1rem;">✅ Fully compatible dengan Wasmer Edge & Wasmer Pack. Zero config, auto SSL, global CDN.</p>
        </div>

        <!-- Call to Action -->
        <div class="cta-section">
            <h2 style="font-size: 1.8rem;">Siap meluncurkan aplikasi WebAssembly?</h2>
            <p style="margin: 1rem auto; max-width: 600px;">Gabung dengan ribuan developer yang sudah beralih ke WasmNexus + Wasmer untuk performa edge-native.</p>
            <button class="btn-primary" id="finalCtaBtn">📦 Deploy Sekarang (Demo)</button>
        </div>
    </div>
</main>

<footer class="footer">
    <div class="container">
        <p>© 2026 WasmNexus — demo deployment untuk Wasmer.io | WebAssembly modern platform</p>
        <p style="margin-top: 0.5rem; font-size: 0.85rem;">⚡ Ditunjukkan sebagai bukti konsep deployment di Wasmer Edge | Semua interaksi bersifat lokal.</p>
    </div>
</footer>

<script>
    // interactive demo untuk mengkonfirmasi deployment readiness di Wasmer.io
    const deployBtn = document.getElementById('deployDemoBtn');
    const learnBtn = document.getElementById('learnMoreBtn');
    const testBtn = document.getElementById('testDeploymentBtn');
    const finalCta = document.getElementById('finalCtaBtn');
    const messageDiv = document.getElementById('deploymentMessage');

    // Fungsi untuk menampilkan pesan interaktif dengan gaya
    function showMessage(msg, isSuccess = true) {
        if (!messageDiv) return;
        messageDiv.innerHTML = msg;
        messageDiv.style.color = isSuccess ? '#0f3b2c' : '#b91c1c';
        messageDiv.style.backgroundColor = isSuccess ? '#e0f2fe' : '#fee2e2';
        messageDiv.style.padding = '0.75rem 1rem';
        messageDiv.style.borderRadius = '2rem';
        messageDiv.style.fontSize = '0.9rem';
        messageDiv.style.transition = '0.2s';
        setTimeout(() => {
            if (messageDiv) {
                setTimeout(() => {
                    if (messageDiv.innerHTML === msg) {
                        // jangan hapus jika sudah diganti
                        messageDiv.style.backgroundColor = '';
                        messageDiv.style.color = '';
                    }
                }, 3000);
            }
        }, 2000);
    }

    // Tombol hero: Mulai Deployment
    if (deployBtn) {
        deployBtn.addEventListener('click', () => {
            showMessage('✅ Simulasi deployment ke Wasmer.io berhasil! Landing page siap di edge network. 🚀', true);
            // efek tambahan: animasi small
            const statusLed = document.querySelector('.status-led');
            if (statusLed) {
                statusLed.style.animation = 'pulse 0.8s infinite';
                setTimeout(() => {
                    statusLed.style.animation = 'pulse 1.5s infinite';
                }, 1000);
            }
            const statusText = document.getElementById('liveStatusText');
            if (statusText) statusText.innerText = 'Live: Berhasil deploy — Wasmer Edge aktif';
        });
    }

    // Tombol "Pelajari selengkapnya"
    if (learnBtn) {
        learnBtn.addEventListener('click', () => {
            showMessage('📘 Dokumentasi Wasmer & WebAssembly: https://docs.wasmer.io (simulasi link demo)', true);
        });
    }

    // Tombol Uji Deployment Wasmer (spesifik untuk test)
    if (testBtn) {
        testBtn.addEventListener('click', () => {
            // simulasi pengujian koneksi ke Wasmer runtime
            showMessage('🔍 Pengecekan runtime: Wasmer CLI terdeteksi. Status: OK | Environment: wasmer-edge | Sandbox ready.', true);
            // update status badge
            const statusTextSpan = document.getElementById('liveStatusText');
            if (statusTextSpan) statusTextSpan.innerText = '✅ Terhubung ke Wasmer Edge — deployment terverifikasi';
            const led = document.querySelector('.status-led');
            if (led) {
                led.style.background = '#10b981';
                led.style.boxShadow = '0 0 12px #34d399';
            }
        });
    }

    // Tombol CTA final
    if (finalCta) {
        finalCta.addEventListener('click', () => {
            showMessage('🎉 Terima kasih sudah mencoba demo landing page untuk deployment Wasmer.io. Proses deploy akan segera memanfaatkan `wasmer deploy`.', true);
            // membuat efek riak
            const ctaDiv = document.querySelector('.cta-section');
            if (ctaDiv) {
                ctaDiv.style.transition = '0.2s';
                ctaDiv.style.backgroundColor = 'rgba(99,102,241,0.12)';
                setTimeout(() => {
                    ctaDiv.style.backgroundColor = 'rgba(99,102,241,0.05)';
                }, 500);
            }
        });
    }

    // menampilkan pesan selamat datang / readiness saat halaman dimuat
    window.addEventListener('DOMContentLoaded', () => {
        console.log('WasmNexus landing page — Siap di deploy ke Wasmer.io');
        // optional menampilkan pesan selamat datang kecil
        const statusMsgDiv = document.getElementById('deploymentMessage');
        if (statusMsgDiv && !statusMsgDiv.innerText) {
            statusMsgDiv.innerHTML = '✨ Landing page siap di-deploy! Gunakan tombol "Uji Deployment Wasmer".';
            statusMsgDiv.style.backgroundColor = '#f1f5f9';
            statusMsgDiv.style.color = '#334155';
            statusMsgDiv.style.padding = '0.5rem 1rem';
            statusMsgDiv.style.borderRadius = '2rem';
            setTimeout(() => {
                if (statusMsgDiv.innerHTML.includes('Landing page siap')) {
                    statusMsgDiv.style.opacity = '0.7';
                    setTimeout(() => {
                        if (statusMsgDiv) statusMsgDiv.innerHTML = '';
                    }, 4000);
                }
            }, 4500);
        }

        // animasi tambahan pada kartu fitur (ringan)
        const cards = document.querySelectorAll('.feature-card');
        cards.forEach((card, idx) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(18px)';
            setTimeout(() => {
                card.style.transition = 'all 0.4s ease';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, 100 + idx * 80);
        });
    });

    // efek tambahan untuk navigasi smooth dummy (prevent default untuk demo)
    const allNavLinks = document.querySelectorAll('.nav-links a');
    allNavLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            showMessage(`🔗 Navigasi demo: ${link.innerText} (tersedia di production Wasmer)`, true);
        });
    });

    // menampilkan juga jika user klik logo
    const logoEl = document.querySelector('.logo');
    if (logoEl) {
        logoEl.addEventListener('click', () => {
            showMessage('🏠 WasmNexus — dibuat untuk showcase deployment Wasmer.io. Semua fitur responsif.', true);
        });
    }
</script>

<!-- tambahan meta / inline untuk memastikan tampilan modern -->
</body>
</html>