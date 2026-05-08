# Pothole Fixer BE 🚧

## Concept en Relevantie
Belgie staat er, spijtig genoeg, om bekend dat de kwaliteit van de wegen te verbeteren valt, met name door de vele kuilen. Zelfs vandaag toen ik mijn ouders naar de luchthaven in Eindhoven bracht voelde je de overgang van Belgie naar Nederland, een verschil van dag en nacht. Met de app “Pothole Fixer” kunnen gebruikers snel en eenvoudig kuilen melden. Door deze rapporten, inclusief de ernst en de locatie te centraliseren, kunnen gemeenten effectief prioriteiten stellen bij herstelwerkzaamheden en zo zorgen voor veiligere wegen.

## Installation

1. **Clone the repository:**
   ```bash
   git clone https://github.com/SirRicharod/momentum_exam
   cd momentum_exam
   ```

2. **Install dependencies:**
   ```bash
   composer install
   ```

3. **Configure Environment:**
Kopieer het bestand `.env.example` en configureer je database. Vergeet niet het nieuwe `.env`‑bestand aan te passen (bijv. `DB_CONNECTION=sqlite` en `DB_DATABASE=./database/database.sqlite`).
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
Standaard is het ingesteld om SQLite te gebruiken.
<small>*Bij het verwijderen van een rapport wordt gebruikgemaakt van **soft deletes** – het record wordt niet uit de database verwijderd, maar er wordt alleen een timestamp `deleted_at` ingesteld, waardoor het later weer kan worden hersteld.*</small>

4. **Run Migrations and Seeders:**
Dummy-data met de belangrijkste Belgische steden en realistische meldingen van kuilen in het wegdek.   
   ```bash
   php artisan migrate:fresh --seed
   ```

5. **Start the server:**
   ```bash
   php artisan serve
   ```
   De development server is beschikbaar op `http://127.0.0.1:8000`.
<small>*Als je Vite‑dependencies hebt, voer eerst `npm install` uit en daarna `npm run dev` in een apart venster.*</small>

## Gebruik
- **Dashboard:** Ga naar `http://localhost:8000/` om alle huidige meldingen van kuilen te bekijken. De lijst is **in pagina’s ingedeeld (6 meldingen per pagina)**; gebruik de paginanummers onderaan om te navigeren.

- **Meldingen:** Klik op de knop “Report Pothole” om een nieuwe melding in te dienen.

- **Bijwerken/verwijderen:** Je kunt de details bewerken of een report **soft deleten** (deze wordt verborgen, maar kan later worden hersteld).

- **Status wijzigen:** Meldingen kunnen direct vanuit het dashboard worden gemarkeerd als `Fixed` om de community snel op de hoogte te houden.

- **Hoge prioriteit:** Gebruik de knop “⚠️ Hoge prioriteit” om meldingen met een prio van 4 of hoger te filteren.

## Momentumfactor & schaalbaarheid
Momenteel kan iedereen in de app een kuil als "fixed" markeren, wat een beveiligingsprobleem is dat later moet worden opgelost. In toekomstige versies zullen we authenticatie en rolgebaseerde permissies implementeren om deze actie te beperken.
Naarmate het systeem opschaalbaar wordt:

- **Authenticatie & rollen:** We kunnen de actie "Mark as Fixed" eenvoudig beperken tot gemeentelijke accounts (zoals `admin`).

- **Geolocatie:** Integraties met Google Maps kunnen de exacte coördinaten vastleggen.

- **Automatisering:** We kunnen meldingen toevoegen (bijv. e-mail of sms) wanneer kuilen met een hoge ernst worden gemeld of opgelost.

### Toekomstige verbeteringen
- **Eindpunt voor herstel:** Voeg een route/controller-methode toe om soft-deleted rapporten te herstellen.

- **Kaartondersteuning:** Sla lengte- en breedtegraad op in de tabel `locations` voor weergave op de kaart.

- **Op rollen gebaseerde toegangscontrole:** Bewerkings- en verwijderingsacties beperken tot geautoriseerde gebruikers.

### Technische opmerkingen
- Vereist **PHP 8.x** en **Laravel 10** (of nieuwer) om te kunnen werken.

- Maakt gebruik van **Bootstrap 5** voor UI.
