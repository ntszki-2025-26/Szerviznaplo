<x-layout>
    <x-navbar>
    </x-navbar>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@500;700;900&family=Barlow:wght@300;400;500&display=swap');

        :root {
            --bg: #0a0a0a;
            --surface: #121212;
            --border: #222;
            --accent: #5046E6;
            --accent-hover: #7c73ff;
            --text: #f0ede8;
            --muted: #888;
            --red: #c0392b;
            --green: #27ae60;
        }

        body {
            background: var(--bg);
            color: var(--text);
            font-family: 'Barlow', sans-serif;
            min-height: 100vh;
        }

        .page-wrap {
            max-width: 1000px;
            margin: 0 auto;
            padding: 3rem 2rem;
        }

        .page-header {
            margin-bottom: 2.5rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid var(--border);
        }

        .page-tag {
            font-size: 0.7rem;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: var(--accent);
            margin-bottom: 0.5rem;
        }

        .page-title {
            font-family: 'Barlow Condensed';
            font-weight: 900;
            font-size: 2.5rem;
            text-transform: uppercase;
        }

        .profile-card {
            display: flex;
            flex-wrap: wrap;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 2rem;
            margin-bottom: 2rem;
            gap: 2rem;
            align-items: center;
        }

        .profile-left {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            flex: 1;
            min-width: 250px;
        }

        .avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--accent), var(--accent-hover));
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Barlow Condensed';
            font-weight: 700;
            font-size: 1.8rem;
            color: #0a0a0a;
        }

        .profile-info {
            display: flex;
            flex-direction: column;
            gap: 0.2rem;
        }

        .profile-name {
            font-size: 1.5rem;
            font-weight: 700;
        }

        .profile-email {
            font-size: 0.9rem;
            color: var(--muted);
        }

        .profile-actions {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .btn {
            padding: 0.7rem 1.5rem;
            border-radius: 4px;
            text-transform: uppercase;
            font-family: 'Barlow Condensed';
            font-weight: 600;
            letter-spacing: 0.08em;
            cursor: pointer;
            border: none;
            transition: transform 0.1s, background 0.2s;
        }

        .btn-primary {
            background: var(--accent);
            color: #0a0a0a;
        }

        .btn-primary:hover {
            background: var(--accent-hover);
            transform: translateY(-1px);
        }

        .btn-danger {
            background: transparent;
            border: 1px solid var(--border);
            color: var(--muted);
        }

        .btn-danger:hover {
            border-color: var(--red);
            color: var(--red);
            transform: translateY(-1px);
        }

        .vehicles-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 2rem;
        }

        .vehicles-card h3 {
            margin-bottom: 1rem;
        }

        .vehicle-table {
            width: 100%;
            border-collapse: collapse;
        }

        .vehicle-table th,
        .vehicle-table td {
            padding: 0.8rem 1rem;
            border-bottom: 1px solid var(--border);
            text-align: left;
        }

        .vehicle-table th {
            color: var(--muted);
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
        }

        .vehicle-table tr:hover {
            background: var(--border);
        }

        @media (max-width: 768px) {
            .profile-card {
                flex-direction: column;
                align-items: flex-start;
            }

            .profile-actions {
                width: 100%;
                justify-content: flex-start;
            }
        }
    </style>

    <div class="page-wrap">
        <div class="page-header">
            <div class="page-tag">Profil</div>
            <h1 class="page-title">
                <div class="profile-name">
                    {{ Auth::user()->last_name }} {{ Auth::user()->first_name }}
                </div>
            </h1>
        </div>

        <div class="profile-card">
            <div class="profile-left">
                <div class="avatar">U</div>
                <div class="profile-info">
                    <div class="profile-name">
                        {{ Auth::user()->last_name }} {{ Auth::user()->first_name }}
                    </div>

                    <div class="profile-email">
                        {{ Auth::user()->email }}
                    </div>
                </div>
            </div>

            <div class="profile-actions">
                <button type="button" class="btn btn-primary">Profil módosítása</button>
                <button type="button" class="btn btn-danger">Fiók törlése</button>
                <button type="button" class="btn btn-danger">Kijelentkezés</button>
            </div>
        </div>

        <div class="vehicles-card">
            <h3>Járműveid</h3>
            <table class="vehicle-table">
                <thead>
                    <tr>
                        <th>Gyártmány</th>
                        <th>Modell</th>
                        <th>Rendszám</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>—</td>
                        <td>—</td>
                        <td>—</td>
                    </tr>
                    <tr>
                        <td>—</td>
                        <td>—</td>
                        <td>—</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</x-layout>