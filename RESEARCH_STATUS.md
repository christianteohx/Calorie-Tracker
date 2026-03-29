# Calorie-Tracker — Project Status

## Overview

**"Something Fitness"** is a full-stack PHP/MySQL web application for tracking calories, fitness goals, and meal planning. Originally a university course project (CSE 442, University at Buffalo, Fall 2023), it has been set up for deployment on Vercel (via `vercel-php`).

## Tech Stack

| Layer | Technology |
|-------|------------|
| Backend | PHP 8.x (procedural) |
| Frontend | HTML, CSS, Vanilla JavaScript |
| Database | MySQL (hosted on `oceanus.cse.buffalo.edu`) |
| Deployment | Vercel (via `vercel-php` adapter) |
| AI Features | AI Coach chat (`static/ai_chat.php`) |

## Features (by Page)

- **`index.php`** — Landing/home page with navigation
- **`calorie-tracker.php`** — Log and view daily calorie intake
- **`daily.php`** — Daily goals tracker
- **`monthly.php`** — Monthly calorie/fitness summary
- **`yearly.php`** — Yearly overview
- **`profile.php`** — User profile management (14KB, substantial)
- **`recipeRecommendation.php`** — Recipe suggestions + save/load
- **`register.php`** / **`login.php`** / **`reset.php`** — Full auth flow
- **`faq.php`** — FAQ page
- **`static/ai_chat.php`** — AI Coach chat interface
- **`completed.php`** — Goal completion page

## Completion Assessment

- **~80% feature-complete.** Core CRUD for calories, goals, recipes, and user auth are all implemented.
- No `README.md` exists — onboarding docs are missing.
- No test suite visible (`*.test.php`, `tests/` folder, or CI config).
- Git history is sparse: only 4 commits (initial, vercel config, revert, second revert). No feature branches.
- **`DB_connect.php` and `calorie-tracker-db.php` use hardcoded credentials** — two different database users/credentials are in the codebase. This is a security risk for production.
- No `.env` or environment variable management for secrets.

## Missing Pieces / Risks

1. **Hardcoded DB credentials** in two PHP files — must be moved to environment variables before any production deployment.
2. **No `README.md`** — new developers have no idea how to set up locally.
3. **No tests** — no PHPUnit, no JS tests, no CI pipeline.
4. **Vercel deployment uncertainty** — the PHP adapter approach may have limitations (stateless execution, MySQL network access from Vercel's cloud).
5. **No `composer.json`** — project doesn't use a dependency manager; no autoloading standard.
6. **Procedural PHP** — no framework (Laravel, Slim, etc.). Scaling or adding features will become harder.
7. **No API layer** — all logic is mixed into page files; no REST/JSON API for the calorie tracker.

## Suggestions for Improvements

1. **Add `README.md`** with local setup steps (PHP, MySQL, environment vars).
2. **Move secrets to `.env`** — use `getenv()` or `$_ENV` instead of hardcoded credentials.
3. **Add a basic test suite** (PHPUnit for backend, maybe a simple JS test runner).
4. **Set up GitHub Actions** for CI on pull requests.
5. **Consider migrating to a lightweight framework** (Laravel or Slim) for structure and scalability.
6. **Fix Vercel MySQL connectivity** — `oceanus.cse.buffalo.edu` is a university server; it likely won't be accessible from Vercel's cloud. A hosted DB (PlanetScale, Railway, Supabase) would be needed.
7. **API-first refactor** — extract calorie/goal/recipe logic into a JSON API to enable a future mobile app or SPA frontend.
8. **Responsive design pass** — check mobile usability on the tracker pages.

---

_Last reviewed: 2026-03-28_
