# TFA7 — Changelog (multi-project hosting adaptation)

> **Origin note:** the original TFA7 files arrived as `[content]`
> placeholders, so this is a complete, spec-faithful implementation of the
> TFA7 assessment ("Making It Editable in Laravel") already adapted for
> prefix hosting. Compare against your own TFA7 before pushing.

## Relationship to TFA5 / TFA6

TFA7 is a **standalone fork** of TFA6 (own folder, own database
`schoolproj_tfa7`, own repository, port 8003). It is graded as an
independent submission.

## Files (overlay onto a fresh Laravel skeleton)

| File | Purpose |
|---|---|
| `.env.example` | Prefix-aware environment template |
| `app/Providers/AppServiceProvider.php` | Re-attaches the `/tfa7` prefix to generated URLs |
| `routes/web.php` | Four base routes + CRUD routes for customers/users |
| `app/Http/Controllers/PageController.php` | Landing + About |
| `app/Http/Controllers/CustomerController.php` | index/create/store/edit/update with validation |
| `app/Http/Controllers/UserController.php` | same + avatar handling |
| `app/Models/{Customer,User}.php` | Eloquent models (User has nullable avatar) |
| `database/migrations/2024_07_01_00000{1,2}_*.php` | customers + users (with avatar column) |
| `database/seeders/{DatabaseSeeder,CustomerSeeder,UserSeeder}.php` | 5 + 5 records |
| `resources/views/layouts/app.blade.php` | Nav + back-to-main + status flash |
| `resources/views/{landing,about}.blade.php` | Static pages |
| `resources/views/customers/{index,create,edit}.blade.php` | Customer CRUD views |
| `resources/views/users/{index,create,edit}.blade.php` | User CRUD views (edit has avatar input) |
| `public/css/app.css` | Hand-written plain CSS incl. form styles |
| `public/images/placeholder-avatar.png` | Rubric-required fallback when no avatar exists |

## Extra dependency (rubric-required)

```bash
composer require intervention/image
```

The rubric requires an *instructor-approved image package* for
display-ready preparation; Intervention Image (v3) is used to crop/resize
uploads to 256×256 JPEG at quality 80 before storing. Requires the GD
extension (`sudo apt install php8.3-gd`). **Confirm your instructor
approved Intervention Image** — swap the `storePreparedAvatar()` method if
a different package was approved.

## Skeleton cleanup + setup

```bash
# delete the skeleton's conflicting users migration first
rm database/migrations/0001_01_01_000000_create_users_table.php

composer require intervention/image
cp .env.example .env            # edit host/DB credentials
php artisan key:generate
php artisan storage:link        # public/storage -> storage/app/public (avatars)
php artisan migrate --seed
php artisan config:clear && php artisan route:clear && php artisan view:clear
```

## Rubric-driven decisions

- **Avatar file input appears on the edit form only** — the rubric wording
  is "On the user edit form, add a file input for a profile picture". The
  create form is username/full_name only. Change if your instructor
  expects upload on create too.
- Validation: `required|email|unique` (create) and `Rule::unique(...)->ignore($model)` (edit);
  avatar `image|max:2048` (2MB).
- On upload: old avatar is deleted from the public disk, the new file is
  prepared to 256×256, and **only the path** is saved in `users.avatar`.
- Listing falls back to `public/images/placeholder-avatar.png` when
  `avatar` is NULL.

## Prefix adaptations (same pattern as TFA5/TFA6)

1. `APP_URL` / `ASSET_URL` = `https://<host>/tfa7` (no trailing slash).
2. `URL::forceRootUrl()` in `AppServiceProvider`.
3. `SESSION_COOKIE=tfa7_session`, `SESSION_PATH=/tfa7`.
4. Back-to-main = plain `href="/"` in the shared layout.
5. All forms/links via named routes; avatars via `asset('storage/...')`
   (which becomes `/tfa7/storage/...` → Caddy strips the prefix → the
   `storage:link`-ed public dir serves it). No hardcoded paths anywhere.
6. No Vite/npm — hand-written CSS, no JS.
