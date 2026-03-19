<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vialidad | Gestión Inteligente de Tránsito</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800&family=Inter:wght@400;700&display=swap" rel="stylesheet" />

    <style>
        :root {
            --gcba-yellow: #FEBC10;
            --gcba-black: #000000;
            --gcba-blue: #00B5E2;
            --bg-dark: #0A0A0A;
            --card-gray: rgba(255, 255, 255, 0.05);
            --transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background-color: #000000;
            color: #FFFFFF;
            overflow-x: hidden;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            text-rendering: optimizeLegibility;
        }

        header {
            width: 100%;
            padding: 2rem 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: fixed;
            top: 0;
            z-index: 100;
            background: linear-gradient(to bottom, var(--bg-dark) 0%, transparent 100%);
        }

        .logo {
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--gcba-yellow);
            letter-spacing: -1px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo i {
            display: inline-block;
            width: 30px;
            height: 30px;
            background: var(--gcba-yellow);
            border-radius: 4px;
            position: relative;
        }

        .logo i::before {
            content: '';
            position: absolute;
            width: 70%;
            height: 3px;
            background: black;
            top: 13px;
            left: 15%;
        }

        main {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 120px 5% 60px;
            text-align: center;
        }

        .hero-title {
            font-size: clamp(3rem, 8vw, 6rem);
            line-height: 1.15;
            font-weight: 800;
            margin-bottom: 1.5rem;
            background: linear-gradient(135deg, #FFF 60%, var(--gcba-yellow));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            opacity: 0;
            transform: translateY(30px);
            animation: fadeIn 1s forwards ease-out;
            padding-bottom: 0.1em; /* Extender espacio para descenders */
        }

        .hero-subtitle {
            font-size: 1.25rem;
            font-weight: 300;
            max-width: 650px;
            margin-bottom: 3rem;
            color: #AAAAAA;
            opacity: 0;
            transform: translateY(20px);
            animation: fadeIn 1s 0.3s forwards ease-out;
        }

        @keyframes fadeIn {
            to { opacity: 1; transform: translateY(0); }
        }

        .cta-container {
            opacity: 0;
            animation: fadeIn 1s 0.6s forwards ease-out;
        }

        .btn-modern {
            padding: 1.2rem 3rem;
            background-color: var(--gcba-yellow);
            color: black;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-radius: 12px;
            text-decoration: none;
            font-size: 1rem;
            position: relative;
            overflow: hidden;
            transition: var(--transition);
            box-shadow: 0 10px 30px -5px rgba(254, 188, 16, 0.4);
            display: inline-flex;
            align-items: center;
            gap: 12px;
        }

        .btn-modern:hover {
            transform: translateY(-5px) scale(1.02);
            box-shadow: 0 20px 40px -10px rgba(254, 188, 16, 0.6);
            background: white;
        }

        .btn-modern i {
            font-style: normal;
            font-size: 1.4rem;
        }

        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
            width: 100%;
            max-width: 1100px;
            margin-top: 6rem;
            opacity: 0;
            animation: fadeIn 1s 1s forwards ease-out;
        }

        .feature-card {
            background: var(--card-gray);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 2.5rem;
            border-radius: 24px;
            backdrop-filter: blur(10px);
            transition: var(--transition);
            text-align: left;
        }

        .feature-card:hover {
            border-color: var(--gcba-yellow);
            transform: translateY(-10px);
        }

        .feature-icon {
            width: 50px;
            height: 50px;
            background: rgba(254, 188, 16, 0.1);
            border: 1px solid var(--gcba-yellow);
            border-radius: 12px;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: var(--gcba-yellow);
        }

        .feature-card h3 {
            font-size: 1.4rem;
            margin-bottom: 1rem;
        }

        .feature-card p {
            color: #888;
            font-size: 0.95rem;
            line-height: 1.6;
        }

        footer {
            padding: 3rem 5%;
            text-align: center;
            font-size: 0.85rem;
            color: #555;
            background: linear-gradient(to top, var(--bg-dark) 50%, transparent 100%);
        }

        .badge-gcba {
            background: var(--gcba-black);
            border: 1px solid var(--gcba-yellow);
            color: var(--gcba-yellow);
            padding: 4px 12px;
            border-radius: 100px;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            margin-bottom: 1rem;
            display: inline-block;
        }
    </style>
</head>
<body>

    <header>
        <div class="logo">
            <i></i>
            Vialidad
        </div>
    </header>

    <main>
        <span class="badge-gcba">BUENOS AIRES</span>
        <h1 class="hero-title">Gestión Inteligente de Tránsito</h1>
        <p class="hero-subtitle">Optimizando la infraestructura vial de Buenos Aires con tecnología de última generación para una ciudad más segura y conectada.</p>
        
        <div class="cta-container">
            <a href="/app/login" class="btn-modern">
                Acceder al Panel
                <i>→</i>
            </a>
        </div>

        <section class="features">
            <div class="feature-card">
                <div class="feature-icon">🛡️</div>
                <h3>Seguridad Predictiva</h3>
                <p>Análisis en tiempo real para la prevención de siniestros y optimización de flujos vehiculares.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">⛓️</div>
                <h3>Blockchain Vial</h3>
                <p>Trazabilidad total en reportes, infracciones y mantenimiento urbano con registros inmutables.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">🏙️</div>
                <h3>Red Urbana</h3>
                <p>Conexión directa entre ciudadanos y autoridades para la resolución ágil de incidentes en vía pública.</p>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2026 ElectricatDataskate, todos los derechos reservados.</p>
    </footer>
</body>
</html>
