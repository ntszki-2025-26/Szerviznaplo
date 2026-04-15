# Szerviznaplo
Szervíznapló
A Szerviznapló projekt célja, hogy egy modern, webalapú alkalmazással kiváltsa az elavult megoldásokat. A rendszer egyetlen, egységes felületen keresztül biztosítja az összes érintett fél számára a szükséges funkciókat: az ügyfelek kezelhetik járműveiket és nyomon követhetik azok szervizelőzményeit. A szerelők valós időben frissíthetik a javítások állapotát, az adminisztrátorok pedig felügyelhetik az egész rendszer működését.
Mivel a projektet php laravelben készítettük el így néhány parancsot le kell futtatni a terminálba. 
## Telepítés és indítás

### Követelmények
- PHP >= 8.4
- Composer
- Node.js & npm
- SQLite

### Lépések
```bash
# 1. Függőségek telepítése
composer install

# 2. Környezeti fájl
cp .env.example .env
# → Töltsd ki az adatbázis- és egyéb beállításokat

# 3. Alkalmazáskulcs generálása
php artisan key:generate

# 4. Adatbázis migrálása
php artisan migrate --seed

# 5. Frontend build
npm install && npm run dev

# 6. Fejlesztői szerver
php artisan serve
```
Az alkalmazás ezután elérhető: http://localhost:8000

### Alapértelmezett felhasználók

A seed után az alábbi teszt felhasználók érhetők el:

|    Szerepkör    |          Email          |     Jelszó      |
|-----------------|-------------------------|-----------------|
| Felhasználó     | user@gmail.com          | User12345       |
| Szerelő         | mechanic@gmail.com      | Mechanic12345   |
| Admin           | admin@gmail.com         | Admin12345      |