# SIM Klinik — Frontend

UI layer untuk SIM Klinik: Blade templates, CSS/JS, dan static assets.

## Isi folder

- `resources/views/` — template Blade (login, dashboard, layout)
- `resources/css/` & `resources/js/` — sumber Vite + Tailwind
- `public/assets/` — CSS, gambar, vendor (jQuery, DataTables)

## Development

```bash
npm install
npm run dev
```

Build production (output ke `../simklinik-backend/public/build`):

```bash
npm run build
```

> Jalankan perintah di atas dari folder ini. Backend Laravel harus berjalan di `../simklinik-backend`.

## Setup remote Git

```bash
git init   # jika belum
git remote add origin <url-repo-frontend>
git add .
git commit -m "Initial commit"
git push -u origin main
```
