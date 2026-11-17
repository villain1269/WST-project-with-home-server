# TSA3 — Changelog (multi-project hosting adaptation)

> **Origin note:** this project replaces the earlier CodeIgniter "TSA2"
> placeholder in the hosting setup. It implements the attached TSA3 spec
> (*Tasks for Today Management System, Laravel*) and is adapted for
> prefix hosting from scratch — nothing was merged from the other
> projects' codebases.

## Spec compliance (IT0049 TSA3)

| Requirement | Where |
|---|---|
| Migrations: tasks (title, status default 'pending', task_date, timestamps) + users (username unique, full_name, email) | `database/migrations/2024_08_01_00000{1,2}_*.php` |
| Seeder: 8 tasks across 3 dates incl. today, exactly 1 user | `database/seeders/{TaskSeeder,UserSeeder}.php` |
| Task and User Eloquent models | `app/Models/{Task,User}.php` |
| Welcome `/` — today's tasks only | `TaskController::welcome` + `resources/views/welcome.blade.php` |
| Task List `/tasks` — all, ordered by date | `TaskController::index` + `resources/views/tasks.blade.php` |
| Profile `/profile` — the single user record | `PageController::profile` + `resources/views/profile.blade.php` |
| About `/about` — developer identification | `resources/views/about.blade.php` |

## Files (overlay onto a fresh Laravel skeleton)

Skeleton: `composer create-project laravel/laravel tsa3`

| File | Purpose |
|---|---|
| `.env.example` | Prefix-aware env (DB `schoolproj_tsa3`, `APP_TIMEZONE=Asia/Manila`) |
| `app/Providers/AppServiceProvider.php` | Re-attaches the `/tsa3` prefix to generated URLs |
| `routes/web.php` | The four routes, all named |
| `app/Http/Controllers/TaskController.php` | Welcome (whereDate today) + Task List |
| `app/Http/Controllers/PageController.php` | Profile + About |
| `app/Models/{Task,User}.php` | Eloquent models |
| `database/seeders/{DatabaseSeeder,TaskSeeder,UserSeeder}.php` | Sample data |
| `resources/views/layouts/app.blade.php` | Nav + "← Back to Main" on every page |
| `resources/views/{welcome,tasks,profile,about}.blade.php` | The four pages |
| `public/css/app.css` | Hand-written plain CSS (incl. status badges) |

## Prefix adaptations (same pattern as TFA6)

1. `APP_URL` / `ASSET_URL` = `https://<host>/tsa3` (no trailing slash).
2. `URL::forceRootUrl()` in `AppServiceProvider` — prefixed `route()`, `url()`, `asset()`.
3. `SESSION_COOKIE=tsa3_session`, `SESSION_PATH=/tsa3` — no cookie/session collisions with sibling projects.
4. Back-to-main = plain `href="/"` in the shared layout.
5. All links via named routes; assets via `asset()`; no hardcoded paths; no Vite/npm.

## Timezone

`APP_TIMEZONE=Asia/Manila` in `.env` makes `now()` (and therefore the
seeder's "today" tasks and the `whereDate('task_date', $today)` query)
run in Manila time, matching the assessment's intent.

## Setup

```bash
composer create-project laravel/laravel tsa3-fresh
# overlay this project's app/routes/resources/database/public files,
# then inside the final folder:
rm database/migrations/0001_01_01_000000_create_users_table.php   # skeleton conflict
cp .env.example .env            # edit host/DB credentials
php artisan key:generate
php artisan migrate --seed
php artisan config:clear && php artisan route:clear && php artisan view:clear
```

## REVIEW BEFORE SUBMITTING

- `UserSeeder` placeholders (`your-username`, `Your Full Name`,
  `you@example.com`) and the About page's developer name must be replaced
  with your real details.
- `database/seeders` compute "today" at seed time — re-run
  `php artisan migrate:fresh --seed` on demo day so the Welcome page has
  tasks to show.
