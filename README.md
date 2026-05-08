# Pothole Fixer BE 🚧

## Concept & Relevance to Belgium
Belgium is somewhat notorious for the quality of its roads, particularly the frequent appearance of potholes after harsh winters or heavy rain. This "Pothole Fixer" application provides a rapid, frictionless way for citizens to report potholes. By centralizing these reports with severities and locations (using major Belgian cities), municipalities can prioritize repairs effectively, ensuring safer roads.

## Installation

1. **Clone the repository:**
   ```bash
   git clone <your-repo-url>
   cd momentum_exam
   ```

2. **Install dependencies:**
   ```bash
   composer install
   npm install
   ```

3. **Configure Environment:**
   Copy the `.env.example` file and configure your database.
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   By default, it's set up to use SQLite. You can create the database file by running:
   ```bash
   touch database/database.sqlite
   ```

4. **Run Migrations and Seeders:**
   We have provided dummy data featuring major Belgian cities and realistic pothole reports.
   ```bash
   php artisan migrate:fresh --seed
   ```

5. **Start the server:**
   ```bash
   php artisan serve
   ```
   *Note: If you have Vite dependencies, you can also run `npm run dev` in a separate terminal.*

## Usage
- **Dashboard:** Visit `http://localhost:8000/` to see all current pothole reports.
- **Reporting:** Click "Report New Pothole" to submit a new entry.
- **Updating/Deleting:** You can edit the details or remove a false report.
- **Status Toggling:** Reports can be marked as "Fixed" right from the dashboard to quickly keep the community up-to-date.
- **High Priority:** Use the "⚠️ High Priority" button to filter out reports with a severity of 4 or higher.

## Momentum Factor & Scaling
Currently, the application allows anyone to mark a pothole as fixed. This frictionless approach creates a massive momentum loop. As it scales:
- **Authentication & Roles:** We can easily gate the "Mark Fixed" action behind municipality accounts (like `admin`).
- **Geolocation:** Integrations with Google Maps / Mapbox can place the exact coordinates.
- **Automation:** We could add notifications (e.g. email or SMS) when high-severity potholes are reported or resolved.
- **National Infrastructure Tool:** This MVP scales from a local municipality board to a national dashboard for overseeing public road works.
