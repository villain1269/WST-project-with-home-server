# TFA5 — Changelog (multi-project hosting adaptation)

> **Origin note:** the original TFA5 files arrived as `[content]`
> placeholders, so this is a complete, spec-faithful implementation of the
> TFA5 assessment ("From Zero to Four Pages, Again") already adapted for
> prefix hosting — not a diff of your existing repo. Compare against your
> own TFA5 before pushing.

## Files (overlay onto a fresh Laravel skeleton)

These files are the application layer. Everything else (composer.json,
bootstrap/, config/, vendor/, etc.) comes from a standard
`composer create-project laravel/laravel tfa5` skeleton.

| File | Purpose |
|---|---|
| `.env.example` | Prefix-aware environment template |
| `app/Providers/AppServiceProvider.php` | Re-attaches the `/tfa5` prefix to all generated URLs |
| `routes/web.php` | The four TFA5 routes, all named |
| `app/Http/Controllers/PageController.php` | Landing + About |
| `app/Http/Controllers/CustomerController.php` | Static array of 5 customers |
| `app/Http/Controllers/UserController.php` | Static array of 5 users |
| `resources/views/layouts/app.blade.php` | Shared layout: nav + "← Back to Main" on every page |
| `resources/views/landing.blade.php` | `/` |
| `resources/views/about.blade.php` | `/about` |
| `resources/views/customers.blade.php` | `/customers` (array + `@foreach`) |
| `resources/views/users.blade.php` | `/users` (array + `@foreach`) |
| `public/css/app.css` | Hand-written plain CSS (no Vite build) |

## What was adapted for the /tfa5 prefix, and why

1. **`APP_URL` / `ASSET_URL` set to `https://<host>/tfa5`** (no trailing
   slash). Laravel's URL generators are request-root based, which would
   produce prefix-less URLs behind Caddy.
2. **`URL::forceRootUrl(config('app.url'))` in `AppServiceProvider`** —
   makes `route()`, `url()` and `asset()` emit prefixed URLs. Scheme forced
   to https when APP_URL is https, because `php artisan serve` sees plain
   HTTP from Caddy. When APP_URL is `http://127.0.0.1:8001` (local dev),
   nothing is forced and the app behaves normally.
3. **`SESSION_COOKIE=tfa5_session` and `SESSION_PATH=/tfa5`** — cookies are
   scoped to this project only, so sessions never collide with TFA6/TFA7
   served on the same hostname.
4. **Back-to-main link** — plain `href="/"` in the shared layout. Under the
   funnel, `/` is the Caddy landing page (the origin root), not the app
   root. No hardcoded hostname needed.
5. **All internal links use `route(...)`** — no hardcoded `/customers`
   style paths anywhere; assets use `asset('css/app.css')`, never
   `/css/app.css`.
6. **No build tooling** — deleted any reference to Vite/npm; the layout
   links a hand-written `public/css/app.css` directly.

## After changing config

```bash
php artisan config:clear && php artisan route:clear && php artisan view:clear
```
