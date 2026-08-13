# DFD Sistem SPTAK Tamanbali

Dokumen ini menggambarkan arus data utama sistem SPTAK Tamanbali: portal publik dan panel admin Filament.

## Entitas Eksternal

- **Masyarakat / Publik**: mengakses informasi desa, keuangan, surat, prajuru, awig-awig, dan pararem.
- **Prajuru / Admin**: login ke panel admin dan mengelola data desa.
- **Sistem File Publik**: menyimpan file unggahan seperti avatar, bukti transaksi, foto prajuru, dan dokumen surat.

## Data Store

- **D1 Database Aplikasi**: tabel users, transaksis, kategori_transaksis, banjars, kramas, surat_masuks, surat_keluars, prajurus, profil_desas, timeline_desas, awig_awigs, panarems.
- **D2 Storage Publik**: `storage/app/public` yang diakses lewat `/storage/...`.

## DFD Level 0 — Context Diagram

```mermaid
flowchart LR
    Publik["Masyarakat / Publik"]
    Admin["Prajuru / Admin"]
    SPTAK(("SPTAK Tamanbali"))
    DB[("D1 Database Aplikasi")]
    Storage[("D2 Storage Publik")]

    Publik -->|Permintaan informasi publik| SPTAK
    SPTAK -->|Profil, keuangan, surat, prajuru, awig-awig, pararem| Publik

    Admin -->|Login dan input data desa| SPTAK
    SPTAK -->|Dashboard, tabel data, notifikasi, ekspor| Admin

    SPTAK <--> |Baca / tulis data terstruktur| DB
    SPTAK <--> |Upload / baca file publik| Storage
```

## DFD Level 1 — Proses Utama

```mermaid
flowchart LR
    Publik["Masyarakat / Publik"]
    Admin["Prajuru / Admin"]

    P1(("1.0 Publikasi Informasi"))
    P2(("2.0 Autentikasi Admin"))
    P3(("3.0 Pengelolaan Data Master"))
    P4(("4.0 Pengelolaan Keuangan"))
    P5(("5.0 Pengelolaan Persuratan"))
    P6(("6.0 Pengelolaan Konten Adat"))
    P7(("7.0 Dashboard & Laporan"))

    DB[("D1 Database Aplikasi")]
    Storage[("D2 Storage Publik")]

    Publik -->|Akses halaman publik| P1
    P1 -->|Informasi desa, kas, arsip surat, hukum adat| Publik
    P1 -->|Ambil data publik| DB
    P1 -->|Ambil dokumen / foto| Storage

    Admin -->|Email dan password| P2
    P2 -->|Status login / akses panel| Admin
    P2 -->|Validasi user dan role| DB

    Admin -->|Kelola banjar, krama, user, prajuru| P3
    P3 -->|Simpan / ubah / hapus data master| DB
    P3 -->|Upload avatar / foto prajuru| Storage

    Admin -->|Input kategori dan transaksi| P4
    P4 -->|Simpan transaksi dan kategori| DB
    P4 -->|Upload bukti transaksi| Storage

    Admin -->|Input surat masuk dan keluar| P5
    P5 -->|Simpan data surat| DB
    P5 -->|Upload file surat| Storage

    Admin -->|Kelola profil, timeline, awig-awig, pararem| P6
    P6 -->|Simpan konten adat| DB
    P6 -->|Upload dokumen pendukung| Storage

    Admin -->|Minta ringkasan / laporan| P7
    P7 -->|Statistik, grafik, ekspor transaksi, PDF laporan| Admin
    P7 -->|Ambil data transaksi, surat, krama| DB
```

## DFD Level 2 — Portal Publik

```mermaid
flowchart TB
    Publik["Masyarakat / Publik"]

    P11(("1.1 Beranda"))
    P12(("1.2 Keuangan Publik"))
    P13(("1.3 Arsip Surat"))
    P14(("1.4 Profil & Prajuru"))
    P15(("1.5 Awig-Awig & Pararem"))
    P16(("1.6 Preview Dokumen PDF"))

    DB[("D1 Database Aplikasi")]
    Storage[("D2 Storage Publik")]

    Publik -->|Buka /| P11
    P11 -->|Metrik kas, banjar, dokumen, ringkasan konten| Publik
    P11 -->|Transaksi terbaru, banjar, surat| DB

    Publik -->|Filter tahun dan scope keuangan| P12
    P12 -->|Total pemasukan, pengeluaran, saldo, riwayat anggaran| Publik
    P12 -->|Data transaksi dan kategori| DB

    Publik -->|Filter jenis, tanggal, pencarian surat| P13
    P13 -->|Daftar surat dan status arsip| Publik
    P13 -->|Surat masuk dan surat keluar| DB
    P13 -->|File surat| Storage

    Publik -->|Buka profil dan susunan prajuru| P14
    P14 -->|Profil desa, timeline, struktur prajuru, banjar| Publik
    P14 -->|ProfilDesa, TimelineDesa, Prajuru, Banjar, Krama| DB
    P14 -->|Foto prajuru| Storage

    Publik -->|Buka awig-awig / pararem| P15
    P15 -->|Daftar awig-awig dan pararem| Publik
    P15 -->|AwigAwig dan Pararem| DB
    P15 -->|Dokumen pendukung| Storage

    Publik -->|Klik preview dokumen| P16
    P16 -->|Tampilan PDF inline| Publik
    P16 -->|File PDF / dokumen| Storage
```

## DFD Level 2 — Panel Admin Filament

```mermaid
flowchart TB
    Admin["Prajuru / Admin"]

    P21(("2.1 Login Panel"))
    P22(("2.2 Kelola User & Role"))
    P23(("2.3 Kelola Banjar & Krama"))
    P24(("2.4 Kelola Transaksi"))
    P25(("2.5 Kelola Surat"))
    P26(("2.6 Kelola Konten Desa"))
    P27(("2.7 Widget & Ekspor"))

    DB[("D1 Database Aplikasi")]
    Storage[("D2 Storage Publik")]

    Admin -->|Email, password| P21
    P21 -->|Session admin jika role diizinkan| Admin
    P21 -->|Cek user, password, role| DB

    Admin -->|Tambah / ubah user dan role| P22
    P22 -->|Data user tersimpan| DB
    P22 -->|Avatar| Storage

    Admin -->|Tambah / ubah banjar dan krama| P23
    P23 -->|Data banjar dan krama tersimpan| DB

    Admin -->|Tambah / ubah kategori dan transaksi| P24
    P24 -->|Data transaksi tersimpan| DB
    P24 -->|Bukti transaksi| Storage

    Admin -->|Tambah / ubah surat masuk dan keluar| P25
    P25 -->|Data surat tersimpan| DB
    P25 -->|File surat| Storage

    Admin -->|Tambah / ubah profil, timeline, prajuru, awig-awig, pararem| P26
    P26 -->|Konten desa tersimpan| DB
    P26 -->|Foto / dokumen konten| Storage

    Admin -->|Buka dashboard atau ekspor transaksi| P27
    P27 -->|Ringkasan, grafik, dokumen ekspor| Admin
    P27 -->|Agregasi transaksi, surat, krama| DB
```

## Catatan Implementasi Sistem

- Portal publik dikendalikan oleh `routes/web.php` dan `app/Http/Controllers/PublicController.php`.
- Panel admin dikonfigurasi di `app/Providers/Filament/AdminPanelProvider.php`.
- Resource admin berada di `app/Filament/Resources/*`.
- Model domain berada di `app/Models/*`.
- Authorization admin berbasis role di `App\Models\User` dan policy manual di `AppServiceProvider`.
- File upload memakai disk `public`, lalu dibaca dari URL `/storage/...`.
