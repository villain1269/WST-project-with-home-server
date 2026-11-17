# IT0049 — Web System Technologies Portfolio

This repository contains a multi-framework web system portfolio (Laravel & CodeIgniter) hosted on a single home server using Tailscale Funnel and a Caddy reverse proxy.

## Live Hosted Portfolio
You can view the live, fully working version of all projects here: 
https://christian-ubuntu.tail8fce48.ts.net/

## Projects Included

### Summatives
* **TSA3 — Tasks for Today Management System (Laravel)** 
  * Path: /tsa3/
  * Description: A task manager demonstrating Laravel migrations, Eloquent models, seeders, and date filtering. The Welcome page shows today's tasks, the Task List shows all tasks, and the Profile page shows the single user record.

### Formatives
* **TFA5 — Laravel POS Foundations**
  * Path: /tfa5/
  * Description: The first Laravel application. Demonstrates routing, controllers, and Blade views using static PHP arrays as a temporary data source.
* **TFA6 — From Arrays to Eloquent**
  * Path: /tfa6/
  * Description: Replaces TFA5's static arrays with a real MySQL database. Includes migrations, seeders, and Eloquent models to retrieve customer and user records.
* **TFA7 — Making It Editable**
  * Path: /tfa7/
  * Description: Extends TFA6 by adding Create and Edit forms, server-side validation with old-input redisplay, and an avatar upload feature using display-ready image preparation via Intervention Image.

## Architecture & Hosting

Instead of paying for multiple hosting services, all projects are hosted on a single Ubuntu home server. 
* Tailscale Funnel provides the public HTTPS endpoint (no port forwarding required, bypasses CGNAT).
* Caddy acts as a reverse proxy on port 8000. It routes traffic based on path prefixes (e.g., /tfa5/) and strips the prefix before passing it to the internal application.
* Each framework runs independently on its own internal port:
  * TFA5: 8001
  * TFA6: 8002
  * TFA7: 8003
  * TSA3: 8004
* The main/ folder contains the static HTML/CSS landing page.

### Server Management Scripts
* start-stack.sh: Starts MySQL, boots all four apps in detached screen sessions, and starts Caddy.
* stop-stack.sh: Safely shuts down all apps, Caddy, and MySQL.
* Caddyfile: The reverse proxy configuration.

## Local Setup Instructions

If you want to run any of these projects locally without Caddy or Tailscale:

1. Navigate into the specific project folder (e.g., cd tfa6).
2. Install dependencies: composer install
3. Copy the environment template: cp .env.example .env
4. Generate the application key: php artisan key:generate
5. Create a local MySQL database (e.g., schoolproj_tfa6) and update your new .env file with your local database credentials.
6. Run the migrations and seeders: php artisan migrate --seed
7. Start the development server: php artisan serve
8. Open http://127.0.0.1:8000 in your browser. Note: If running locally, change APP_URL in your .env to http://127.0.0.1:8000 and remove the path prefixes.
