# TFA6 — Changelog (multi-project hosting adaptation)

> **Origin note:** the original TFA6 files arrived as `[content]`
> placeholders, so this is a complete, spec-faithful implementation of the
> TFA6 assessment ("From Arrays to Eloquent") already adapted for prefix
> hosting. Compare against your own TFA6 before pushing.

## Relationship to TFA5

TFA6 is a **standalone fork** of TFA5 (own folder, own database, own
repository, port 8002). It is not served from, or linked to, TFA5 at
runtime — each is graded as an independent submission.

## Files (overlay onto a fresh Laravel skeleton)

| File | Purpose |
|---|---|
| `.env.example` | Prefix-aware environment template (DB `schoolproj_tfa6`) |
| `app/Providers/AppServiceProvider.php` | Re-attaches the `/tfa6` prefix to generated URLs |
| `routes/web.php` | The four routes, named |
| `app/Http/Controllers/PageController.php` | Landing + About |
| `app/Http/Controllers/CustomerController.php` | Eloquent retrieval (replaces TFA5's static array) |
| `app/Http/Controllers/UserController.php` | Eloquent retrieval (replaces TFA5's static array) |
| `app/Models/Customer.php` | Eloquent model |
| `app/Models/User.php` | Eloquent model (replaces the skeleton's auth User model) |
| `database/migrations/2024_06_01_000001_create_customers_table.php` | full_name, email, phone |
| `database/migrations/2024_06_01_000002_create_users_table.php` | username unique, full_name |
| `database/seeders/DatabaseSeeder.php` | Calls the two seeders |
| `database/seeders/CustomerSeeder.php` | 5 realistic customers |
| `database/seeders/UserSeeder.php` | 5 realistic users |
| `resources/views/layouts/app.blade.php` | Nav + "← Back to Main" on every page |
| `resources/views/{landing,about,customers,users}.blade.php` | Same pages as TFA5, object properties instead of array keys |
| `public/css/app.css` | Hand-written plain CSS |

## Skeleton cleanup required (important)

The default Laravel skeleton ships its own users-table migration and an
auth-oriented `User` model. Before migrating:

```bash
# inside tfa6/ — delete the skeleton's conflicting migrations
rm database/migrations/0001_01_01_000000_create_users_table.php \
   database/migrations/0001_01_01_000001_create_cache_table.php \
   database/migrations/0001_01_01_000002_create_jobs_table.php   # optional, keep if wanted
```

(Keep cache/jobs tables if you prefer; only the users one conflicts.)
The provided `app/Models/User.php` fully replaces the skeleton's.

## Database setup

```sql
CREATE DATABASE schoolproj_tfa6 CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```
```bash
cp .env.example .env        # then edit host/DB credentials
php artisan key:generate
php artisan migrate --seed
php artisan config:clear && php artisan route:clear && php artisan view:clear
```

## Prefix adaptations (same pattern as TFA5)

1. `APP_URL` / `ASSET_URL` = `https://<host>/tfa6` (no trailing slash).
2. `URL::forceRootUrl()` in `AppServiceProvider` — prefixed `route()`, `url()`, `asset()`.
3. `SESSION_COOKIE=tfa6_session`, `SESSION_PATH=/tfa6` — no cookie/session collisions with sibling projects.
4. Back-to-main = plain `href="/"` in the shared layout.
5. All links via named routes; assets via `asset()`; no hardcoded paths.
6. No Vite/npm — hand-written `public/css/app.css`.
