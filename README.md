# fp_datawarehouse

Implementasi data warehouse terkait OLTP dan OLAP.

## Setup Laravel 12 setelah clone

### 1. Prasyarat
Pastikan tools berikut sudah terpasang:
- PHP 8.2+
- Composer 2+
- Node.js 20+ dan npm
- Database (MySQL/PostgreSQL/SQLite)

### 2. Clone dan masuk ke folder proyek
```bash
git clone <url-repository>
cd fp_datawarehouse
```

### 3. Install dependency backend dan frontend
```bash
composer install
npm install
```

### 4. Siapkan file environment
```bash
cp .env.example .env
```

Lalu sesuaikan konfigurasi database pada file `.env`.

### 5. Generate application key
```bash
php artisan key:generate
```

### 6. Jalankan migrasi (dan seeder jika diperlukan)
```bash
php artisan migrate
# opsional
php artisan db:seed
```

### 7. Build asset frontend
```bash
npm run build
```

Untuk development, gunakan:
```bash
npm run dev
```

### 8. Jalankan aplikasi
```bash
php artisan serve
```

Aplikasi dapat diakses di `http://127.0.0.1:8000`.
