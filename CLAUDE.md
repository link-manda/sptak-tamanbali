# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project

SPTAK Tamanbali — transparency portal for Desa Adat Tamanbali (a Balinese customary village). Public-facing informational site + Filament admin panel for managing village finances, members, letters, and governance data. UI text and code comments are in Indonesian.

Stack: Laravel 13, PHP 8.3, Filament 5, Tailwind 4 + Vite, MySQL (dev/prod), SQLite `:memory:` (tests).

## Commands

```bash
composer dev          # run server + queue + pail logs + vite concurrently (primary dev command)
composer test         # clears config, runs phpunit
composer setup        # install deps, copy .env, key:gen, migrate, npm build

php artisan test --filter=TestName     # single test
php artisan migrate:fresh --seed       # rebuild DB with seeders
./vendor/bin/pint                      # format PHP (Laravel Pint)
npm run build                          # production asset build
```

## Architecture

Two surfaces over the same Eloquent models:

1. **Public site** — `routes/web.php` → `PublicController` → `resources/views/public/*.blade.php`. Read-only views (home, keuangan/finance, surat/letters, profil, prajuru, awig-awig, pararem). All public Blade extends `public/layout.blade.php`.

2. **Admin panel** — Filament at `/admin`, configured in `app/Providers/Filament/AdminPanelProvider.php`. Resources/Pages/Widgets are auto-discovered from `app/Filament/`. Custom login + profile pages live in `app/Filament/Pages/Auth/`.

### Filament resource layout

Filament 5 splits each resource into subdirectories rather than monolithic files. For resource `Foo` under `app/Filament/Resources/Foos/`:
- `FooResource.php` — declares model, navigation, wires up Form/Table/Pages
- `Schemas/FooForm.php` — form schema (`configure(Schema $schema)`)
- `Tables/FoosTable.php` — table schema (`configure(Table $table)`)
- `Pages/` — List/Create/Edit page classes

When adding fields or columns, edit the `Schemas/` and `Tables/` classes, not the `*Resource.php`.

### Authorization

Role-based, not permission-based. `User::ROLES` defines all roles; `User::PANEL_ROLES` gates `canAccessPanel()`. Roles: `admin`, `staf_admin`, `staf_keuangan`, `petajuh`, `juru_raksa`, `masyarakat` (public-only). `role` is a plain string column (see migration `..._change_role_column_in_users_table`).

Per-model access is enforced by Policies in `app/Policies/`, registered explicitly in `AppServiceProvider::boot()` via `Gate::policy()`. Policy methods check `in_array($user->role, [...])`. **A new policy must be registered in `AppServiceProvider` — there is no auto-discovery here.**

### Domain models

- `Transaksi` + `KategoriTransaksi` — village finances (jenis: pemasukan/pengeluaran). Drives finance widgets and public keuangan page.
- `Krama` + `Banjar` — village members grouped by hamlet.
- `Prajuru` — village officials as a self-referential tree (`parent_id`/`children`), categorized via `kategoriOptions()`/`jabatanOptions()`.
- `SuratMasuk` / `SuratKeluar` — incoming/outgoing letters.
- `ProfilDesa`, `TimelineDesa`, `AwigAwig`, `Pararem` — single-purpose content models for profile, history timeline, customary law, and regulations.

Data export via `app/Filament/Exports/TransaksiExporter.php`. Dashboard widgets in `app/Filament/Widgets/`.

## Conventions

- Model/table names use Indonesian plurals (`Transaksis`, `Kramas`, `Panarems`); don't "correct" them.
- Uploaded files (avatars, foto, bukti) use the `public` disk; URL accessors fall back to `ui-avatars.com` placeholders.
- Queue/cache/session default to the `database`/`file` drivers (see `.env`).
