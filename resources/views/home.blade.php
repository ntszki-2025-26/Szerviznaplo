<x-layout sitecss="home">
    <x-navbar title="home" />
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

<x-features />

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