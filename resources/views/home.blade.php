<x-layout>
    <x-navbar>
    </x-navbar>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@300;500;700;900&family=Barlow:wght@300;400;500&display=swap');

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
        --bg: #0a0a0a;
        --surface: #121212;
        --border: #222;
        --accent: #5046E6;
        --accent-dim: #5046E6;
        --text: #f0ede8;
        --muted: #888;
        --red: #c0392b;
    }

    body { background: var(--bg); color: var(--text); font-family: 'Barlow', sans-serif; font-weight: 300; min-height: 100vh; }

    .topbar { display: flex; align-items: center; justify-content: space-between; padding: 1.25rem 3rem; border-bottom: 1px solid var(--border); background: var(--surface); position: sticky; top: 0; z-index: 50; }
    .topbar-logo { font-family: 'Barlow Condensed', sans-serif; font-weight: 700; font-size: 1.3rem; letter-spacing: 0.08em; text-transform: uppercase; color: var(--text); text-decoration: none; }
    .topbar-logo span { color: var(--accent); }
    .topbar-nav { display: flex; align-items: center; gap: 0.5rem; }
    .btn-outline { background: transparent; border: 1px solid var(--border); color: var(--muted); font-family: 'Barlow Condensed', sans-serif; font-weight: 500; font-size: 0.85rem; letter-spacing: 0.12em; text-transform: uppercase; padding: 0.55rem 1.25rem; border-radius: 2px; text-decoration: none; transition: border-color 0.2s, color 0.2s; }
    .btn-outline:hover { border-color: var(--text); color: var(--text); }
    .btn-accent { background: var(--accent); color: #0a0a0a; font-family: 'Barlow Condensed', sans-serif; font-weight: 700; font-size: 0.85rem; letter-spacing: 0.15em; text-transform: uppercase; padding: 0.55rem 1.25rem; border-radius: 2px; text-decoration: none; transition: background 0.2s; }
    .btn-accent:hover { background: var(--accent-dim); }

    .hero {
        max-width: 1200px;
        margin: 0 auto;
        padding: 8rem 3rem 6rem;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 4rem;
        align-items: center;
    }

    .hero-tag { font-size: 0.72rem; letter-spacing: 0.25em; text-transform: uppercase; color: var(--accent); margin-bottom: 1.25rem; display: flex; align-items: center; gap: 0.75rem; }
    .hero-tag::before { content: ''; display: block; width: 2rem; height: 1px; background: var(--accent); }

    .hero h1 { font-family: 'Barlow Condensed', sans-serif; font-weight: 900; font-size: clamp(3rem, 6vw, 5rem); text-transform: uppercase; letter-spacing: -0.02em; line-height: 0.95; margin-bottom: 1.5rem; }
    .hero h1 span { color: var(--accent); }

    .hero-desc { color: var(--muted); font-size: 1rem; line-height: 1.7; margin-bottom: 2.5rem; max-width: 440px; }

    .hero-btns { display: flex; gap: 0.75rem; flex-wrap: wrap; }
    .hero-btn-primary { background: var(--accent); color: #0a0a0a; font-family: 'Barlow Condensed', sans-serif; font-weight: 700; font-size: 0.95rem; letter-spacing: 0.15em; text-transform: uppercase; padding: 0.9rem 2rem; border-radius: 2px; text-decoration: none; transition: background 0.2s; display: inline-flex; align-items: center; gap: 0.5rem; }
    .hero-btn-primary:hover { background: var(--accent-dim); }
    .hero-btn-primary svg { width: 16px; height: 16px; }
    .hero-btn-secondary { background: transparent; border: 1px solid var(--border); color: var(--muted); font-family: 'Barlow Condensed', sans-serif; font-weight: 500; font-size: 0.95rem; letter-spacing: 0.12em; text-transform: uppercase; padding: 0.9rem 2rem; border-radius: 2px; text-decoration: none; transition: border-color 0.2s, color 0.2s; }
    .hero-btn-secondary:hover { border-color: var(--text); color: var(--text); }

    .hero-stats { display: grid; grid-template-columns: 1fr 1fr; gap: 1px; background: var(--border); border: 1px solid var(--border); }
    .hero-stat { background: var(--surface); padding: 2rem; }
    .hero-stat-num { font-family: 'Barlow Condensed', sans-serif; font-weight: 900; font-size: 3rem; color: var(--accent); line-height: 1; margin-bottom: 0.5rem; }
    .hero-stat-label { font-size: 0.78rem; letter-spacing: 0.15em; text-transform: uppercase; color: var(--muted); }

    .features { border-top: 1px solid var(--border); padding: 6rem 3rem; }
    .features-inner { max-width: 1200px; margin: 0 auto; }
    .features-header { text-align: center; margin-bottom: 4rem; }
    .features-tag { font-size: 0.72rem; letter-spacing: 0.25em; text-transform: uppercase; color: var(--accent); margin-bottom: 1rem; }
    .features-title { font-family: 'Barlow Condensed', sans-serif; font-weight: 900; font-size: clamp(2rem, 4vw, 3.5rem); text-transform: uppercase; letter-spacing: -0.01em; }

    .features-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1px; background: var(--border); border: 1px solid var(--border); }
    .feature-card { background: var(--surface); padding: 2.5rem; transition: background 0.2s; position: relative; overflow: hidden; }
    .feature-card:hover { background: #181818; }
    .feature-card::after { content: ''; position: absolute; bottom: 0; left: 0; width: 100%; height: 2px; background: var(--accent); transform: scaleX(0); transform-origin: left; transition: transform 0.3s; }
    .feature-card:hover::after { transform: scaleX(1); }
    .feature-icon { width: 48px; height: 48px; background: rgba(232,184,75,0.08); border: 1px solid rgba(232,184,75,0.2); border-radius: 2px; display: flex; align-items: center; justify-content: center; margin-bottom: 1.5rem; color: var(--accent); }
    .feature-icon svg { width: 22px; height: 22px; }
    .feature-title { font-family: 'Barlow Condensed', sans-serif; font-weight: 700; font-size: 1.1rem; text-transform: uppercase; letter-spacing: 0.06em; margin-bottom: 0.75rem; }
    .feature-desc { font-size: 0.85rem; color: var(--muted); line-height: 1.65; }

    .cta { border-top: 1px solid var(--border); padding: 6rem 3rem; text-align: center; }
    .cta-inner { max-width: 600px; margin: 0 auto; }
    .cta-title { font-family: 'Barlow Condensed', sans-serif; font-weight: 900; font-size: clamp(2rem, 4vw, 3rem); text-transform: uppercase; letter-spacing: -0.01em; margin-bottom: 1rem; }
    .cta-title span { color: var(--accent); }
    .cta-desc { color: var(--muted); font-size: 0.95rem; margin-bottom: 2rem; }

    /* FOOTER */
    .footer { border-top: 1px solid var(--border); padding: 2rem 3rem; display: flex; align-items: center; justify-content: space-between; }
    .footer-logo { font-family: 'Barlow Condensed', sans-serif; font-weight: 700; font-size: 1rem; letter-spacing: 0.08em; text-transform: uppercase; color: var(--muted); text-decoration: none; }
    .footer-logo span { color: var(--accent); }
    .footer-copy { font-size: 0.78rem; color: var(--muted); }

    @media (max-width: 900px) {
        .hero { grid-template-columns: 1fr; padding: 4rem 1.5rem; gap: 2rem; }
        .features { padding: 4rem 1.5rem; }
        .features-grid { grid-template-columns: 1fr; }
        .cta { padding: 4rem 1.5rem; }
        .topbar { padding: 1rem 1.5rem; }
        .footer { padding: 1.5rem; flex-direction: column; gap: 0.5rem; text-align: center; }
    }
</style>

<div class="topbar">
    <a href="{{ route('home') }}" class="topbar-logo">Szerviz<span>napló</span></a>
    <nav class="topbar-nav">
        <a href="{{ route('login') }}" class="btn-outline">Bejelentkezés</a>
        <a href="{{ route('register') }}" class="btn-accent">Regisztráció</a>
    </nav>
</div>

<section>
    <div class="hero">
        <div>
            <div class="hero-tag">Online autószerviz rendszer</div>
            <h1>Szervizeld<br>járműved<br><span>okosan</span></h1>
            <p class="hero-desc">Időpontfoglalás, hibák bejelentése, javításkövetés és digitális szerviznapló — minden egy helyen, egyszerűen.</p>
            <div class="hero-btns">
                <a href="{{ route('register') }}" class="hero-btn-primary">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                    Regisztráció
                </a>
                <a href="{{ route('login') }}" class="hero-btn-secondary">Bejelentkezés</a>
            </div>
        </div>
        <div class="hero-stats">
            <div class="hero-stat">
                <div class="hero-stat-num">24/7</div>
                <div class="hero-stat-label">Elérhető</div>
            </div>
            <div class="hero-stat">
                <div class="hero-stat-num">100%</div>
                <div class="hero-stat-label">Digitális</div>
            </div>
            <div class="hero-stat">
                <div class="hero-stat-num">3</div>
                <div class="hero-stat-label">Felhasználói szint</div>
            </div>
            <div class="hero-stat">
                <div class="hero-stat-num">∞</div>
                <div class="hero-stat-label">Jármű kezelhető</div>
            </div>
        </div>
    </div>
</section>

<section class="features">
    <div class="features-inner">
        <div class="features-header">
            <div class="features-tag">Funkciók</div>
            <h2 class="features-title">Minden amire szükséged van</h2>
        </div>
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M7 17H5a2 2 0 01-2-2v-4l2-5h14l2 5v4a2 2 0 01-2 2h-2"/><circle cx="7" cy="17" r="2"/><circle cx="17" cy="17" r="2"/></svg>
                </div>
                <div class="feature-title">Járműkezelés</div>
                <p class="feature-desc">Regisztráld járműveidet és kövesd azok teljes szerviz történetét egy helyen.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                </div>
                <div class="feature-title">Időpontfoglalás</div>
                <p class="feature-desc">Foglalj szerviz időpontot online, kövesd foglalásaid állapotát valós időben.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 9v4M12 17h.01"/><path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/></svg>
                </div>
                <div class="feature-title">Hibabejelentés</div>
                <p class="feature-desc">Jelentsd be a meghibásodásokat fotóval és leírással, kategóriák szerint.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M14.7 6.3a1 1 0 000 1.4l1.6 1.6a1 1 0 001.4 0l3.77-3.77a6 6 0 01-7.94 7.94l-6.91 6.91a2.12 2.12 0 01-3-3l6.91-6.91a6 6 0 017.94-7.94l-3.76 3.76z"/></svg>
                </div>
                <div class="feature-title">Javításkövetés</div>
                <p class="feature-desc">Kövesd javításaid aktuális állapotát, a szerelők valós időben frissítik.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                </div>
                <div class="feature-title">Szerviznapló</div>
                <p class="feature-desc">Digitális szerviznapló minden elvégzett munkáról, alkatrészről és garanciáról.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                </div>
                <div class="feature-title">Többszintű hozzáférés</div>
                <p class="feature-desc">Külön felület felhasználóknak, szerelőknek és adminisztrátoroknak.</p>
            </div>
        </div>
    </div>
</section>

<section class="cta">
    <div class="cta-inner">
        <h2 class="cta-title">Kezdj el <span>most</span></h2>
        <p class="cta-desc">Regisztrálj ingyenesen és vedd kézbe járműved karbantartását.</p>
        <a href="{{ route('register') }}" class="hero-btn-primary" style="display:inline-flex">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Regisztráció
        </a>
    </div>
</section>

<footer class="footer">
    <a href="{{ route('home') }}" class="footer-logo">Szerviz<span>napló</span></a>
    <span class="footer-copy">© {{ date('Y') }} Szerviznapló</span>
</footer>

</x-layout>