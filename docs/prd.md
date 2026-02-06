# Product Requirements Document (PRD)
# Masjid Bukit Palma Web Application

---

## Document Information

| **Attribute** | **Details** |
|---------------|-------------|
| **Product Name** | Masjid Bukit Palma Web Application |
| **Version** | 1.0.0 (MVP) |
| **Document Owner** | Product Manager |
| **Last Updated** | February 2, 2026 |
| **Project Type** | Web Application (Laravel-based) |
| **Target Launch** | Q2 2026 (Phase 1-3 Progressive Rollout) |
| **Domain** | https://masjidbukitpalma.or.id |

---

## Table of Contents

1. [Executive Summary](#1-executive-summary)
2. [Problem Statement & Opportunity](#2-problem-statement--opportunity)
3. [Goals & Success Metrics](#3-goals--success-metrics)
4. [User Personas & Roles](#4-user-personas--roles)
5. [Functional Requirements](#5-functional-requirements)
6. [Non-Functional Requirements](#6-non-functional-requirements)
7. [User Flows](#7-user-flows)
8. [UI/UX Guidelines](#8-uiux-guidelines)
9. [Security & Permissions Matrix](#9-security--permissions-matrix)
10. [Development Roadmap (3 Phases)](#10-development-roadmap-3-phases)
11. [Launch Strategy](#11-launch-strategy)
12. [Success Criteria & KPIs](#12-success-criteria--kpis)
13. [Open Questions & Risks](#13-open-questions--risks)
14. [Appendix](#14-appendix)

---

## 1. Executive Summary

### 1.1 Product Overview

**Masjid Bukit Palma Web Application** adalah platform digital yang dirancang untuk meningkatkan transparansi, kepercayaan, dan engagement jamaah terhadap Masjid Bukit Palma, Surabaya. Aplikasi ini menyediakan akses informasi real-time mengenai keuangan masjid, kegiatan, program, dan layanan jamaah secara transparan dan terstruktur.

### 1.2 Core Value Proposition

> **"Membangun Kepercayaan Jamaah Melalui Transparansi Digital"**

Platform ini menjawab kebutuhan jamaah akan:
- ✅ **Transparansi Keuangan** - Laporan keuangan bulanan yang jelas dan teraudit
- ✅ **Akses Informasi Real-time** - Jadwal sholat, kegiatan, dan pengumuman terkini
- ✅ **Akuntabilitas Pengelolaan** - Tracking progress pembangunan dan penggunaan dana
- ✅ **Kemudahan Berdonasi** - Sistem donasi online dengan QRIS terintegrasi

### 1.3 Target Users

| User Type | Quantity (Estimate) | Primary Needs |
|-----------|---------------------|---------------|
| **Jamaah (Public)** | 300-500 aktif | Informasi, jadwal, donasi |
| **Takmir Inti** | 3-5 orang | Monitoring, approval, oversight |
| **Bendahara** | 2-3 orang | Kelola keuangan, laporan |
| **Media Team** | 2-3 orang | Publikasi konten, dokumentasi |
| **Administrator** | 1-2 orang | System management, support |

---

## 2. Problem Statement & Opportunity

### 2.1 Current Challenges

**Problem 1: Lack of Financial Transparency**
- Jamaah tidak memiliki akses real-time ke laporan keuangan masjid
- Pertanyaan berulang tentang penggunaan dana donasi
- Kesulitan tracking progress pembangunan masjid

**Problem 2: Information Fragmentation**
- Informasi tersebar di WhatsApp groups, pengumuman manual, dan media sosial
- Tidak ada satu sumber kebenaran (single source of truth)
- Jadwal kegiatan sering terlewat atau tidak ter-update

**Problem 3: Manual Administrative Processes**
- Input dan approve transaksi keuangan masih manual
- Laporan keuangan dibuat dengan spreadsheet terpisah
- Sulit melacak riwayat perubahan dan approval

### 2.2 Opportunity

Dengan membangun platform digital yang transparan, Masjid Bukit Palma dapat:
- ✅ Meningkatkan kepercayaan jamaah hingga **40%** (measured by survey)
- ✅ Meningkatkan donasi bulanan hingga **25%** (transparency effect)
- ✅ Mengurangi pertanyaan administratif hingga **60%** (self-service info)
- ✅ Mempercepat proses approval dan reporting hingga **70%**

---

## 3. Goals & Success Metrics

### 3.1 Primary Goals

| Goal | Description | Success Metric |
|------|-------------|----------------|
| **G1: Financial Transparency** | Semua transaksi keuangan visible ke jamaah dalam 24 jam | 100% laporan keuangan published monthly |
| **G2: Increase Trust** | Meningkatkan confidence score jamaah | Trust score > 4.5/5.0 (quarterly survey) |
| **G3: Digital Engagement** | Jamaah aktif menggunakan platform | 60% jamaah aktif akses website monthly |
| **G4: Operational Efficiency** | Reduce admin workload | 50% reduction in manual reporting time |

### 3.2 Key Performance Indicators (KPIs)

**Phase 1 (Month 1-2):**
- ✅ 200+ unique visitors/month
- ✅ 100% financial reports uploaded on-time
- ✅ 80% admin adoption rate

**Phase 2 (Month 3-4):**
- ✅ 400+ unique visitors/month
- ✅ 50+ donation transactions via QRIS
- ✅ 90% content published within 48 hours

**Phase 3 (Month 5-6):**
- ✅ 600+ unique visitors/month
- ✅ 100+ active engagement (comments, shares)
- ✅ 70% jamaah awareness (through survey)

---

## 4. User Personas & Roles

### 4.1 Persona 1: Jamaah (Public User)

**Profile:**
- **Name:** Pak Budi (35-55 tahun)
- **Occupation:** Professional, business owner
- **Tech Savviness:** Medium (uses smartphone, WhatsApp, social media)
- **Frequency:** Checks masjid info 2-3x/week

**Goals:**
- ✅ Lihat jadwal sholat hari ini dengan cepat
- ✅ Cek laporan keuangan masjid bulan lalu
- ✅ Donasi untuk program wakaf pembangunan
- ✅ Daftar anaknya untuk Belajar Mengaji

**Pain Points:**
- ❌ Informasi keuangan tidak jelas
- ❌ Tidak tahu kemana donasi digunakan
- ❌ Susah kontak pengurus untuk layanan

**User Stories:**
```
US-001: Sebagai jamaah, saya ingin melihat jadwal sholat hari ini 
        agar saya bisa datang tepat waktu.

US-002: Sebagai donatur, saya ingin melihat laporan keuangan bulanan 
        agar saya percaya dana saya dikelola dengan baik.

US-003: Sebagai jamaah, saya ingin berdonasi dengan QRIS 
        agar lebih praktis tanpa bawa uang tunai.
```

---

### 4.2 Persona 2: Bendahara

**Profile:**
- **Name:** Pak Ahmad (40-60 tahun)
- **Role:** Bendahara Masjid (volunteer)
- **Tech Savviness:** Medium-Low (uses Excel, WhatsApp)
- **Frequency:** Daily input (1-2 hours/day)

**Goals:**
- ✅ Input transaksi harian dengan cepat
- ✅ Generate laporan keuangan bulanan otomatis
- ✅ Submit ke Takmir Inti untuk approval
- ✅ Track donasi berdasarkan kategori ZISWAF

**Pain Points:**
- ❌ Input manual di Excel memakan waktu
- ❌ Kesalahan perhitungan sering terjadi
- ❌ Sulit pisahkan dana Zakat vs Operasional

**User Stories:**
```
US-004: Sebagai bendahara, saya ingin input transaksi dengan form sederhana 
        agar tidak perlu buka Excel.

US-005: Sebagai bendahara, saya ingin sistem otomatis pisahkan dana ZISWAF 
        agar tidak salah alokasi.

US-006: Sebagai bendahara, saya ingin export laporan ke PDF 
        agar bisa print untuk pengumuman offline.
```

---

### 4.3 Persona 3: Media Team

**Profile:**
- **Name:** Mas Cahyo (25-40 tahun)
- **Role:** Tim Media & Dokumentasi
- **Tech Savviness:** High (uses Instagram, YouTube, editing tools)
- **Frequency:** 3-4x/week (upload konten baru)

**Goals:**
- ✅ Upload artikel dakwah dengan mudah
- ✅ Publish galeri foto kegiatan terbaru
- ✅ Embed video ceramah dari YouTube
- ✅ Buat kategori artikel sendiri

**Pain Points:**
- ❌ Harus koordinasi dengan admin untuk publish
- ❌ Tidak bisa manage kategori sendiri
- ❌ Upload foto satu-satu memakan waktu

**User Stories:**
```
US-007: Sebagai media team, saya ingin upload multiple photos sekaligus 
        agar tidak perlu satu-satu.

US-008: Sebagai media team, saya ingin buat kategori artikel baru 
        agar konten lebih terorganisir.

US-009: Sebagai media team, saya ingin embed video YouTube dengan thumbnail 
        agar jamaah bisa langsung klik ke channel.
```

---

### 4.4 Persona 4: Takmir Inti

**Profile:**
- **Name:** Pak Hasan (45-65 tahun)
- **Role:** Ketua Takmir / Pengurus Inti
- **Tech Savviness:** Medium (uses smartphone, basic web browsing)
- **Frequency:** Daily monitoring (30-60 minutes/day)

**Goals:**
- ✅ Monitor semua aktivitas di website
- ✅ Approve laporan keuangan sebelum publish
- ✅ Update progress pembangunan masjid
- ✅ Lihat audit trail untuk akuntabilitas

**Pain Points:**
- ❌ Tidak ada dashboard untuk monitoring real-time
- ❌ Harus approve manual via WhatsApp
- ❌ Sulit track siapa yang input apa

**User Stories:**
```
US-010: Sebagai takmir inti, saya ingin lihat dashboard semua transaksi pending 
        agar bisa approve dengan cepat.

US-011: Sebagai takmir inti, saya ingin update progress pembangunan (%) 
        agar jamaah tahu perkembangan terkini.

US-012: Sebagai takmir inti, saya ingin lihat audit trail 
        agar tahu siapa yang input transaksi tertentu.
```

---

### 4.5 Persona 5: Administrator (Developer/IT)

**Profile:**
- **Name:** Developer Team
- **Role:** System Administrator
- **Tech Savviness:** Expert
- **Frequency:** On-demand (maintenance, support)

**Goals:**
- ✅ Manage user accounts dan roles
- ✅ Monitor system performance
- ✅ Handle bug fixes dan feature requests
- ✅ Backup database secara teratur

**User Stories:**
```
US-013: Sebagai admin, saya ingin assign multiple roles ke 1 user 
        agar pengurus bisa punya akses Bendahara + Takmir Inti.

US-014: Sebagai admin, saya ingin lihat error logs 
        agar bisa troubleshoot masalah dengan cepat.
```

---

## 5. Functional Requirements

### 5.1 Module 1: Beranda (Homepage)

**Description:** Halaman utama yang menampilkan overview masjid, sambutan ketua takmir, dan informasi penting hari ini.

#### Features:

**F-001: Sambutan Ketua Takmir**
- **Priority:** P0 (Must Have)
- **Description:** Section berisi foto, nama, dan pesan sambutan dari ketua takmir
- **User Roles:** Jamaah (view), Takmir Inti (edit)
- **Acceptance Criteria:**
  - ✅ Tampilkan foto profil ketua takmir (max 2MB, format JPG/PNG)
  - ✅ Tampilkan nama dan jabatan
  - ✅ Tampilkan pesan sambutan (max 500 characters)
  - ✅ Takmir Inti dapat edit via dashboard
  - ✅ Otomatis save draft sebelum publish

**F-002: Galeri Foto Terbaru**
- **Priority:** P0 (Must Have)
- **Description:** Carousel/grid foto kegiatan masjid terbaru (6-8 foto)
- **User Roles:** Jamaah (view), Media (upload)
- **Acceptance Criteria:**
  - ✅ Tampilkan 6-8 foto terbaru dari galeri
  - ✅ Click foto untuk lihat full size (lightbox)
  - ✅ Auto-refresh dari database
  - ✅ Responsive di mobile (swipe carousel)

**F-003: Jadwal Sholat Hari Ini**
- **Priority:** P0 (Must Have)
- **Description:** Widget menampilkan jadwal 5 waktu sholat untuk hari ini
- **User Roles:** Jamaah (view), System (auto-update)
- **Acceptance Criteria:**
  - ✅ Fetch dari API aladhan.com (kota: Surabaya)
  - ✅ Tampilkan Subuh, Dzuhur, Ashar, Maghrib, Isya
  - ✅ Highlight waktu sholat berikutnya
  - ✅ Auto-update setiap hari pukul 00:01 WIB
  - ✅ Fallback jika API down (cache data kemarin)

**F-004: Pengumuman Masjid**
- **Priority:** P1 (Should Have)
- **Description:** Banner atau marquee untuk pengumuman penting
- **User Roles:** Jamaah (view), Takmir Inti (manage)
- **Acceptance Criteria:**
  - ✅ Tampilkan max 3 pengumuman aktif
  - ✅ Takmir Inti bisa set active/inactive
  - ✅ Support rich text (bold, link)
  - ✅ Auto-hide setelah tanggal expired

---

### 5.2 Module 2: Profil Masjid

**F-005: Sejarah Masjid Bukit Palma**
- **Priority:** P0 (Must Have)
- **Description:** Halaman static berisi sejarah, tahun berdiri, dan milestone masjid
- **User Roles:** Jamaah (view), Admin (edit)
- **Acceptance Criteria:**
  - ✅ Support rich text editor (headings, paragraphs, images)
  - ✅ Tampilkan foto-foto historis
  - ✅ Timeline tahun penting (optional visual timeline)

**F-006: Visi & Misi**
- **Priority:** P0 (Must Have)
- **Description:** Halaman menampilkan visi dan misi masjid
- **User Roles:** Jamaah (view), Takmir Inti (edit)
- **Acceptance Criteria:**
  - ✅ Section terpisah untuk Visi dan Misi
  - ✅ Support bullet points atau numbered list
  - ✅ Editable via WYSIWYG editor

**F-007: Struktur Organisasi Takmir**
- **Priority:** P0 (Must Have)
- **Description:** CRUD pengurus masjid (database-driven)
- **User Roles:** Jamaah (view), Admin (manage)
- **Acceptance Criteria:**
  - ✅ Table: `id, nama, jabatan, foto, kontak (optional), urutan`
  - ✅ Tampilkan dalam bagan organisasi (grid atau tree)
  - ✅ Admin bisa add/edit/delete/reorder pengurus
  - ✅ Upload foto pengurus (max 1MB, square crop)
  - ✅ Display: Ketua → Wakil → Sekretaris → Bendahara → Sie-sie

**F-008: Lokasi & Peta**
- **Priority:** P0 (Must Have)
- **Description:** Google Maps embed dan alamat lengkap masjid
- **User Roles:** Jamaah (view), Admin (set koordinat)
- **Acceptance Criteria:**
  - ✅ Google Maps iframe embed (interactive)
  - ✅ Tampilkan alamat lengkap
  - ✅ Button "Buka di Google Maps" (open in new tab)
  - ✅ Display koordinat untuk referensi

---

### 5.3 Module 3: Kegiatan & Program

**F-009: Kajian Rutin**
- **Priority:** P1 (Should Have)
- **Description:** List jadwal kajian rutin mingguan
- **User Roles:** Jamaah (view), Media (manage)
- **Acceptance Criteria:**
  - ✅ Table: `id, nama_kajian, hari, waktu, ustadz, lokasi, status`
  - ✅ Tampilkan dalam format calendar atau list
  - ✅ Filter by hari (Senin-Ahad)
  - ✅ Media bisa add/edit/archive

**F-010: Maulid Nabi & Hari Besar Islam**
- **Priority:** P1 (Should Have)
- **Description:** Event management untuk perayaan hari besar
- **User Roles:** Jamaah (view), Media (manage)
- **Acceptance Criteria:**
  - ✅ Table: `id, nama_event, tanggal, waktu, deskripsi, foto_banner`
  - ✅ Tampilkan upcoming events (next 3 months)
  - ✅ Countdown timer untuk event terdekat
  - ✅ Archive past events

**F-011: Program Sosial**
- **Priority:** P1 (Should Have)
- **Description:** List program sosial (santunan, baksos, dll.)
- **User Roles:** Jamaah (view), Media (manage)
- **Acceptance Criteria:**
  - ✅ Similar structure dengan F-010
  - ✅ Tampilkan gallery foto dokumentasi
  - ✅ Link ke laporan keuangan terkait (jika ada)

**F-012: Kegiatan Remaja Masjid**
- **Priority:** P2 (Nice to Have)
- **Description:** Dedicated section untuk kegiatan remaja
- **User Roles:** Jamaah (view), Media (manage)
- **Acceptance Criteria:**
  - ✅ Section terpisah dengan style lebih modern
  - ✅ Tampilkan jadwal latihan, event, achievement
  - ✅ Contact person untuk join

**F-013: Kalender Kegiatan (Unified)**
- **Priority:** P1 (Should Have)
- **Description:** Calendar view yang menampilkan semua kegiatan
- **User Roles:** Jamaah (view)
- **Acceptance Criteria:**
  - ✅ Monthly calendar view
  - ✅ Aggregate dari F-009, F-010, F-011, F-012
  - ✅ Color-coded by kategori
  - ✅ Click event untuk lihat detail
  - ✅ Download as iCal format (optional)

---

### 5.4 Module 4: Layanan Jamaah

**F-014: Jadwal Salat & Imsakiyah**
- **Priority:** P0 (Must Have)
- **Description:** Full month jadwal sholat + imsakiyah Ramadhan
- **User Roles:** Jamaah (view)
- **Acceptance Criteria:**
  - ✅ Tampilkan jadwal sholat 1 bulan penuh
  - ✅ Saat bulan Ramadhan, tampilkan kolom Imsak dan Berbuka
  - ✅ Export to PDF untuk print
  - ✅ Auto-generate dari API

**F-015: Layanan Nikah**
- **Priority:** P1 (Should Have)
- **Description:** Informasi dan redirect ke WhatsApp pengurus
- **User Roles:** Jamaah (view)
- **Acceptance Criteria:**
  - ✅ Halaman informasi syarat nikah di masjid
  - ✅ Button "Daftar Nikah" → redirect ke WA pengurus
  - ✅ Pre-filled message template
  - ✅ Display nomor WA pengurus (as fallback)

**F-016: Konsultasi Keagamaan**
- **Priority:** P2 (Nice to Have)
- **Description:** Informasi ustadz yang bisa dihubungi
- **User Roles:** Jamaah (view), Admin (manage)
- **Acceptance Criteria:**
  - ✅ List ustadz: nama, foto, keahlian, kontak
  - ✅ Button WhatsApp untuk tiap ustadz
  - ✅ Availability status (optional)

**F-017: Formulir Permohonan (Aula, dll.)**
- **Priority:** P1 (Should Have)
- **Description:** Informasi dan redirect ke WA pengurus
- **User Roles:** Jamaah (view)
- **Acceptance Criteria:**
  - ✅ Halaman informasi fasilitas yang bisa dipinjam
  - ✅ Button "Ajukan Permohonan" → redirect ke WA sekretaris
  - ✅ Pre-filled message template dengan format

---

### 5.5 Module 5: Keuangan & Donasi ⭐ (PRIORITAS TERTINGGI)

**F-018: Input Transaksi Manual (Bendahara)**
- **Priority:** P0 (Must Have)
- **Description:** Form input transaksi debit/kredit
- **User Roles:** Bendahara (create, edit), Takmir Inti (approve)
- **Acceptance Criteria:**
  - ✅ Form fields: tanggal, tipe (debit/kredit), kategori_ziswaf, kategori_detail, nominal, keterangan, bukti_foto (optional)
  - ✅ Dropdown kategori ZISWAF: Zakat, Infaq, Sedekah, Wakaf, Operasional
  - ✅ Dropdown kategori detail: Listrik, Honor Imam, Renovasi, dll. (customizable)
  - ✅ Validation: nominal harus > 0, tanggal tidak boleh future
  - ✅ Status: Draft → Submitted → Approved/Rejected
  - ✅ Bendahara bisa edit hanya saat status Draft
  - ✅ Auto-generate transaction ID (format: TRX-YYYYMMDD-XXX)

**F-019: Approval Workflow Laporan Keuangan**
- **Priority:** P0 (Must Have)
- **Description:** Takmir Inti approve transaksi sebelum publish ke publik
- **User Roles:** Bendahara (submit), Takmir Inti (approve/reject)
- **Acceptance Criteria:**
  - ✅ Bendahara submit batch transaksi (bulanan)
  - ✅ Takmir Inti lihat dashboard pending approval
  - ✅ Takmir Inti bisa approve/reject dengan alasan
  - ✅ Notif internal ke Bendahara jika approved/rejected
  - ✅ Hanya transaksi "Approved" yang visible ke jamaah
  - ✅ Audit trail: siapa approve kapan

**F-020: Dashboard Keuangan Real-time**
- **Priority:** P0 (Must Have)
- **Description:** Dashboard visual untuk jamaah dan admin
- **User Roles:** Jamaah (view public), Bendahara (view detail), Takmir Inti (view all)
- **Acceptance Criteria:**
  - ✅ **Public View (Jamaah):**
    - Total saldo per kategori ZISWAF (Pie Chart)
    - Transaksi bulan ini: Pemasukan vs Pengeluaran (Bar Chart)
    - Top 5 kategori pengeluaran
    - Total donasi terkumpul vs target (Progress Bar)
  - ✅ **Admin View (Bendahara/Takmir):**
    - Semua fitur public +
    - Filter by date range, kategori, status
    - Export ke Excel/PDF
    - Audit trail detail

**F-021: Pemisahan Dana ZISWAF**
- **Priority:** P0 (Must Have - Syariah Compliance)
- **Description:** Setiap kategori ZISWAF harus terpisah di database
- **User Roles:** Bendahara (manage), Takmir Inti (monitor)
- **Acceptance Criteria:**
  - ✅ Field `kategori_ziswaf` mandatory di setiap transaksi
  - ✅ Dashboard terpisah untuk tiap kategori:
    - **Zakat**: Tidak boleh dipakai untuk operasional
    - **Infaq**: Bisa untuk operasional umum
    - **Sedekah**: Bisa untuk operasional dan program sosial
    - **Wakaf**: Khusus untuk aset jangka panjang
    - **Operasional**: Dari sumber non-zakat
  - ✅ Alert jika dana Zakat digunakan untuk non-mustahiq
  - ✅ Laporan terpisah per kategori

**F-022: Laporan Keuangan Multi-periode**
- **Priority:** P0 (Must Have)
- **Description:** Generate laporan mingguan, bulanan, tahunan
- **User Roles:** Jamaah (view), Bendahara (generate), Takmir Inti (approve)
- **Acceptance Criteria:**
  - ✅ Auto-generate laporan bulanan setiap akhir bulan
  - ✅ Format: Ringkasan, Detail Transaksi, Saldo Akhir per Kategori
  - ✅ Tampilkan grafik tren (3 bulan terakhir)
  - ✅ Export to PDF (untuk print & pengumuman offline)
  - ✅ Jamaah bisa download laporan bulan-bulan sebelumnya

**F-023: Target Donasi & Progress Bar**
- **Priority:** P1 (Should Have)
- **Description:** Set target untuk kategori tertentu (misal: Wakaf Pembangunan)
- **User Roles:** Takmir Inti (set target), Bendahara (update manual), Jamaah (view)
- **Acceptance Criteria:**
  - ✅ Takmir Inti set target per kategori
  - ✅ Bendahara input donasi masuk manual (QRIS manual tracking)
  - ✅ Progress bar auto-update: Terkumpul / Target x 100%
  - ✅ Tampilkan di homepage untuk kategori dengan target aktif
  - ✅ Alert jika target tercapai

**F-024: Grafik Tren Donasi**
- **Priority:** P1 (Should Have)
- **Description:** Visualisasi tren donasi bulan ini vs bulan lalu
- **User Roles:** Jamaah (view), Admin (view detail)
- **Acceptance Criteria:**
  - ✅ Line chart: Total donasi per minggu/bulan (6 bulan terakhir)
  - ✅ Comparison: Bulan ini vs rata-rata 3 bulan sebelumnya
  - ✅ Breakdown by kategori ZISWAF (stacked bar chart)

**F-025: Donasi Online (QRIS Display)**
- **Priority:** P1 (Should Have)
- **Description:** Tampilkan QRIS masjid untuk donasi
- **User Roles:** Jamaah (view & scan), Admin (upload QRIS)
- **Acceptance Criteria:**
  - ✅ Upload image QRIS masjid (format PNG/JPG, max 2MB)
  - ✅ Display prominently di halaman Donasi
  - ✅ Instruksi: "Scan QRIS → Transfer → Screenshot → Kirim ke WA Bendahara"
  - ✅ Button "Kirim Bukti Transfer" → redirect ke WA dengan template
  - ✅ Dropdown pilihan kategori donasi (Zakat, Infaq, Wakaf, dll.)

**F-026: Audit Trail Keuangan**
- **Priority:** P0 (Must Have - Accountability)
- **Description:** Log semua perubahan transaksi keuangan
- **User Roles:** Takmir Inti (view), Admin (view)
- **Acceptance Criteria:**
  - ✅ Log: user_id, action (create/edit/delete/approve/reject), timestamp, old_value, new_value
  - ✅ Display dalam tabel: Tanggal, User, Aksi, Detail Transaksi
  - ✅ Filter by user, date range, action type
  - ✅ Tidak bisa dihapus (immutable log)

---

### 5.6 Module 6: Pembangunan Masjid

**F-027: Desain & Masterplan**
- **Priority:** P1 (Should Have)
- **Description:** Upload dan display masterplan pembangunan
- **User Roles:** Jamaah (view), Takmir Inti (upload)
- **Acceptance Criteria:**
  - ✅ Upload gambar masterplan (high-res, support zoom)
  - ✅ Deskripsi fase pembangunan
  - ✅ Timeline target completion

**F-028: Progress Pembangunan**
- **Priority:** P1 (Should Have)
- **Description:** Update progress % dan status per fase
- **User Roles:** Jamaah (view), Takmir Inti (update)
- **Acceptance Criteria:**
  - ✅ Table: `id, fase_nama, target_selesai, progress_persen, status`
  - ✅ Progress bar visual untuk tiap fase
  - ✅ Takmir Inti update progress via dashboard
  - ✅ Display: Fase 1 (100% ✅), Fase 2 (60% 🚧), Fase 3 (0% 📅)

**F-029: Galeri Foto Proyek**
- **Priority:** P1 (Should Have)
- **Description:** Dokumentasi foto "sebelum-sesudah" dan progress
- **User Roles:** Jamaah (view), Media (upload)
- **Acceptance Criteria:**
  - ✅ Upload multiple photos (batch upload)
  - ✅ Tag foto dengan fase pembangunan
  - ✅ Sortir by tanggal upload (newest first)
  - ✅ Lightbox view untuk full-size

**F-030: Laporan Teknis & Gantt Chart**
- **Priority:** P2 (Nice to Have)
- **Description:** Gantt chart timeline pembangunan
- **User Roles:** Jamaah (view), Takmir Inti (input data)
- **Acceptance Criteria:**
  - ✅ Input via form: Task name, Start date, End date, Status
  - ✅ Auto-generate Gantt Chart (horizontal bar chart)
  - ✅ Color-coded by status (Not Started, In Progress, Completed)

---

### 5.7 Module 7: Artikel & Dakwah

**F-031: Artikel Islami (CRUD)**
- **Priority:** P0 (Must Have)
- **Description:** Publish artikel dakwah, fiqih, sejarah, dll.
- **User Roles:** Jamaah (view), Media (create/edit/delete/publish)
- **Acceptance Criteria:**
  - ✅ Table: `id, judul, slug, konten, kategori_id, author_id, featured_image, status, published_at`
  - ✅ WYSIWYG editor (support bold, italic, headings, images, links)
  - ✅ Media bisa langsung publish (no approval workflow)
  - ✅ SEO-friendly: slug auto-generate dari judul
  - ✅ Featured image upload (16:9 ratio recommended)

**F-032: Kategori Artikel (CRUD by Media)**
- **Priority:** P1 (Should Have)
- **Description:** Media bisa buat dan manage kategori artikel
- **User Roles:** Media (create/edit/delete), Jamaah (filter by kategori)
- **Acceptance Criteria:**
  - ✅ Table: `id, nama_kategori, slug, deskripsi`
  - ✅ Media bisa add/edit/delete kategori via dashboard
  - ✅ Jamaah bisa filter artikel by kategori
  - ✅ Display jumlah artikel per kategori

**F-033: Video Ceramah (YouTube/Instagram Embed)**
- **Priority:** P1 (Should Have)
- **Description:** Embed video dari YouTube/Instagram
- **User Roles:** Jamaah (view & redirect), Media (manage)
- **Acceptance Criteria:**
  - ✅ Table: `id, judul, thumbnail_url, video_url, ustadz, durasi`
  - ✅ Media input: thumbnail image + video URL
  - ✅ Display: Grid layout dengan thumbnail
  - ✅ Click thumbnail → redirect ke YouTube/IG (open in new tab)

**F-034: Kutipan Hikmah (Daily Wisdom)**
- **Priority:** P2 (Nice to Have)
- **Description:** Random kutipan islami di homepage
- **User Roles:** Jamaah (view), Media (manage)
- **Acceptance Criteria:**
  - ✅ Table: `id, kutipan_text, sumber, status (active)`
  - ✅ Display random kutipan di homepage (refresh daily)
  - ✅ Media bisa add/edit/archive kutipan

---

### 5.8 Module 8: Kontak & Kritik Saran

**F-035: Formulir Kontak**
- **Priority:** P1 (Should Have)
- **Description:** Form untuk jamaah kirim pesan ke pengurus
- **User Roles:** Jamaah (submit), Admin (view inbox)
- **Acceptance Criteria:**
  - ✅ Form: nama, email, subject, pesan, captcha
  - ✅ Validation: email format, min 20 chars pesan
  - ✅ Submit → save to database
  - ✅ Admin lihat inbox di dashboard (mark as read/unread)

**F-036: Media Sosial Links**
- **Priority:** P0 (Must Have)
- **Description:** Display icon & link ke sosmed masjid
- **User Roles:** Jamaah (view), Admin (set URLs)
- **Acceptance Criteria:**
  - ✅ Config: Instagram, YouTube, WhatsApp Group, Email
  - ✅ Display di footer dan halaman Kontak
  - ✅ Icon styling consistent

**F-037: Nomor Takmir & Sekretariat**
- **Priority:** P0 (Must Have)
- **Description:** Display kontak pengurus
- **User Roles:** Jamaah (view), Admin (manage)
- **Acceptance Criteria:**
  - ✅ Display: Nama, Jabatan, Nomor WhatsApp, Email
  - ✅ Button "Chat WhatsApp" untuk tiap pengurus
  - ✅ Jam operasional sekretariat

---

### 5.9 Module 9: Belajar Islam

**F-038: Syahadat**
- **Priority:** P2 (Nice to Have)
- **Description:** Panduan dua kalimat syahadat
- **User Roles:** Jamaah (view)
- **Acceptance Criteria:**
  - ✅ Display teks Arab, Latin, dan Arti
  - ✅ Audio pronunciation (optional - embed from external)

**F-039: Pelatihan Sholat**
- **Priority:** P2 (Nice to Have)
- **Description:** Panduan step-by-step cara sholat
- **User Roles:** Jamaah (view)
- **Acceptance Criteria:**
  - ✅ Text + illustrasi setiap gerakan
  - ✅ Bacaan per gerakan (Arab, Latin, Arti)
  - ✅ Video tutorial (embed YouTube)

**F-040: Belajar Mengaji**
- **Priority:** P2 (Nice to Have)
- **Description:** Informasi kelas mengaji & pendaftaran
- **User Roles:** Jamaah (view & daftar)
- **Acceptance Criteria:**
  - ✅ Jadwal kelas: Anak, Dewasa, Iqra, Tahfidz
  - ✅ Syarat & biaya (jika ada)
  - ✅ Button "Daftar" → redirect ke WA ustadz/ustadzah

---

### 5.10 Module 10: Admin Dashboard

**F-041: Dashboard Overview**
- **Priority:** P0 (Must Have)
- **Description:** Landing page admin dengan ringkasan metrics
- **User Roles:** All admin roles (view sesuai permission)
- **Acceptance Criteria:**
  - ✅ Bendahara Dashboard: Total saldo, Pending approval, Transaksi bulan ini
  - ✅ Media Dashboard: Total artikel, Recent photos, Video count
  - ✅ Takmir Inti Dashboard: Pending approval, Activities, Progress pembangunan
  - ✅ Admin Dashboard: User count, System health

**F-042: Notifikasi Internal**
- **Priority:** P1 (Should Have)
- **Description:** In-app notification untuk admin
- **User Roles:** All admin roles
- **Acceptance Criteria:**
  - ✅ Bell icon dengan badge count (unread)
  - ✅ Dropdown list notifikasi
  - ✅ Mark as read
  - ✅ Link to related item

**F-043: User Management (Admin Only)**
- **Priority:** P0 (Must Have)
- **Description:** CRUD users dan assign roles
- **User Roles:** Administrator only
- **Acceptance Criteria:**
  - ✅ List all users dengan roles
  - ✅ Add new user (email, name, assign roles)
  - ✅ Multi-role support: 1 user bisa punya multiple roles (checkbox)
  - ✅ Delete user (soft delete)

**F-044: Audit Log Viewer**
- **Priority:** P1 (Should Have)
- **Description:** View all system activities
- **User Roles:** Takmir Inti, Administrator
- **Acceptance Criteria:**
  - ✅ Display: Timestamp, User, Action, Module, Detail
  - ✅ Filter: by user, date range, module
  - ✅ Export to CSV

---

## 6. Non-Functional Requirements

### 6.1 Performance

| Requirement | Target | Measurement |
|-------------|--------|-------------|
| **Page Load Time** | < 3s (desktop), < 5s (mobile 3G) | Google PageSpeed score > 80 |
| **API Response Time** | < 500ms for 95th percentile | Laravel Telescope |
| **Database Query** | < 100ms average | Query logging |
| **Concurrent Users** | Support 100+ simultaneous users | Load testing |
| **Image Optimization** | Auto-compress to < 500KB | ImageOptim |

### 6.2 Security

| Requirement | Implementation |
|-------------|----------------|
| **Authentication** | OAuth 2.0 (Google) via Laravel Socialite |
| **Authorization** | Role-based Access Control (RBAC) |
| **Data Encryption** | SSL/TLS (HTTPS enforced) |
| **SQL Injection Prevention** | Eloquent ORM prepared statements |
| **XSS Prevention** | Blade templating auto-escaping |
| **CSRF Protection** | Laravel CSRF tokens |
| **File Upload Validation** | Whitelist extensions, max size, MIME check |
| **Audit Trail** | Immutable logs for financial transactions |

### 6.3 Scalability

- Horizontal Scaling: Support multiple web servers (future)
- Database: MySQL dengan indexing optimal
- Caching: Redis/Memcached ready (Phase 2)
- CDN Ready: Static assets via CDN (Phase 2)

### 6.4 Usability

- **Responsive Design:** Mobile-first (Tailwind breakpoints)
- **Browser Support:** Chrome 90+, Firefox 88+, Safari 14+, Edge 90+
- **Accessibility:** WCAG 2.1 Level AA compliance
- **Language:** Bahasa Indonesia (primary), Arabic text support
- **Loading States:** Skeleton screens & spinners

### 6.5 Maintainability

- **Code Quality:** PSR-12 coding standard
- **Documentation:** Inline comments, README per module
- **Version Control:** Git (semantic versioning)
- **Testing:** Unit tests (PHPUnit) untuk critical functions
- **Error Handling:** Centralized exception handler
- **Logging:** Laravel Log (daily rotation)

### 6.6 Deployment (Hostinger Specific)

- **Environment:** Shared hosting (htdocs structure)
- **PHP Version:** 8.2+ (Laravel 12 requirement)
- **Database:** MySQL 8.0+
- **File Permissions:** 755 for directories, 644 for files
- **Cron Jobs:** Setup untuk daily updates
- **Backup:** Weekly automated backup

---

## 7. User Flows

### 7.1 Flow: Jamaah Lihat Laporan Keuangan

```
START (Homepage)
    ↓
[Click "Keuangan & Donasi"]
    ↓
[Keuangan Dashboard Page]
    ↓
[View: Pie Chart ZISWAF, Bar Chart Pemasukan/Pengeluaran]
    ↓
[Scroll down: List Laporan Bulanan]
    ↓
[Click "Download Laporan Januari 2026 (PDF)"]
    ↓
[PDF opens - bisa print/save]
    ↓
END (Trust increased ✅)
```

### 7.2 Flow: Bendahara Input & Submit Transaksi

```
[Bendahara Login via Google]
    ↓
[Dashboard: Click "Input Transaksi Baru"]
    ↓
[Form Input: tanggal, tipe, kategori, nominal, keterangan, foto]
    ↓
[Click "Simpan Draft"] → Status: DRAFT
    ↓
[Review & Edit if needed]
    ↓
[Click "Submit untuk Approval"] → Status: SUBMITTED
    ↓
[Notif ke Takmir Inti: "25 transaksi menunggu approval"]
    ↓
[Takmir Inti login → Dashboard Approval]
    ↓
[Review transaksi → Approve/Reject]
    ↓
[If Approved:] Status: APPROVED → Visible ke jamaah
[If Rejected:] Notif ke Bendahara untuk perbaiki
    ↓
END
```

### 7.3 Flow: Jamaah Donasi via QRIS

```
[Homepage: Click "Donasi Sekarang"]
    ↓
[Pilih Kategori: Wakaf Pembangunan]
    ↓
[View Progress Bar: "60jt / 100jt (60%)"]
    ↓
[See QRIS Image]
    ↓
[User: Scan QRIS → Transfer → Screenshot bukti]
    ↓
[Click "Kirim Bukti Transfer" → WA Bendahara]
    ↓
[Bendahara: Verify → Input to system]
    ↓
[Progress bar update: 60% → 65%]
    ↓
END
```

### 7.4 Flow: Media Upload Artikel

```
[Media Login]
    ↓
[Dashboard: "Buat Artikel Baru"]
    ↓
[Form: Judul, Kategori, Featured Image, Konten WYSIWYG]
    ↓
[Click "Publish"] → Article live immediately
    ↓
[Appears in "Artikel & Dakwah" for jamaah]
    ↓
END
```

### 7.5 Flow: Takmir Update Progress Pembangunan

```
[Takmir Inti Login]
    ↓
[Dashboard: "Pembangunan Masjid"]
    ↓
[View: Fase 1 (100%), Fase 2 (60%), Fase 3 (0%)]
    ↓
[Click "Edit Fase 2"]
    ↓
[Update Progress: 60% → 75%]
    ↓
[Click "Simpan & Publish"]
    ↓
[Homepage: Progress bar update]
    ↓
END
```

---

## 8. UI/UX Guidelines

### 8.1 Color Palette (Hijau Theme)

**Primary Colors:**
```css
--color-primary-50:  #ECFDF5;  /* Light green bg */
--color-primary-100: #D1FAE5;
--color-primary-500: #10B981;  /* Main green */
--color-primary-600: #059669;  /* Hover */
--color-primary-700: #047857;  /* Active */
--color-primary-900: #065F46;  /* Dark green */
```

**Secondary Colors:**
```css
--color-secondary-500: #F59E0B;  /* Gold accent */
--color-secondary-600: #D97706;  /* Hover gold */
```

**Neutral Colors:**
```css
--color-gray-50:  #F9FAFB;  /* Background */
--color-gray-100: #F3F4F6;  /* Cards */
--color-gray-600: #4B5563;  /* Secondary text */
--color-gray-900: #111827;  /* Primary text */
```

### 8.2 Typography

**Font Family:**
```css
font-family: 'Inter', 'Segoe UI', 'Roboto', system-ui, sans-serif;
```

**Font Sizes:**
```
text-xs:   12px (captions)
text-sm:   14px (secondary text)
text-base: 16px (body)
text-lg:   18px (subheadings)
text-2xl:  24px (page headings)
text-4xl:  36px (hero)
```

### 8.3 Component Patterns

**Button Primary:**
```html
<button class="bg-primary-500 hover:bg-primary-600 text-white 
               px-6 py-3 rounded-lg font-medium shadow-md">
  Donasi Sekarang
</button>
```

**Card Component:**
```html
<div class="bg-white rounded-xl shadow-md p-6 border border-gray-200">
  <h3 class="text-xl font-semibold mb-2">Card Title</h3>
  <p class="text-gray-600">Content...</p>
</div>
```

### 8.4 Layout Structure

**Desktop Navigation:**
```
┌──────────────────────────────────────────┐
│ [Logo] Beranda | Profil | Kegiatan |    │
│        Keuangan | Artikel | Kontak       │
│                              [Login]     │
└──────────────────────────────────────────┘
```

**Admin Sidebar:**
```
┌─────────────┐
│ 📊 Dashboard│
│ 💰 Keuangan │
│ 📝 Artikel  │
│ 📸 Galeri   │
│ ✅ Approval │
│ 👥 Users    │
└─────────────┘
```

### 8.5 Responsive Breakpoints

```
sm:  640px  /* Tablets */
md:  768px  /* Tablets landscape */
lg:  1024px /* Laptops */
xl:  1280px /* Desktops */
```

**Design Priority:** Desktop-first

---

## 9. Security & Permissions Matrix

### 9.1 Role-Based Access Control

| Module | Jamaah | Bendahara | Media | Takmir Inti | Admin |
|--------|--------|-----------|-------|-------------|-------|
| **Login** | ❌ | ✅ OAuth | ✅ OAuth | ✅ OAuth | ✅ OAuth |
| **Beranda** | ✅ View | ✅ View | ✅ View | ✅ Edit | ✅ Edit |
| **Profil** | ✅ View | ✅ View | ✅ View | ✅ Edit | ✅ Edit |
| **Keuangan View** | ✅ Public | ✅ Detail | ❌ | ✅ Detail | ✅ Detail |
| **Keuangan Input** | ❌ | ✅ CRUD | ❌ | ❌ | ✅ CRUD |
| **Keuangan Approve** | ❌ | ❌ | ❌ | ✅ | ✅ |
| **Artikel** | ✅ View | ✅ View | ✅ CRUD | ✅ CRUD | ✅ CRUD |
| **Galeri** | ✅ View | ✅ View | ✅ CRUD | ✅ CRUD | ✅ CRUD |
| **Kegiatan** | ✅ View | ✅ View | ✅ CRUD | ✅ CRUD | ✅ CRUD |
| **Pembangunan** | ✅ View | ✅ View | ✅ Upload | ✅ Update% | ✅ Update% |
| **Users** | ❌ | ❌ | ❌ | ❌ | ✅ CRUD |
| **Audit Log** | ❌ | ❌ | ❌ | ✅ View | ✅ View |

### 9.2 Multi-Role Support

- 1 user bisa memiliki multiple roles (many-to-many)
- Contoh: Pak Ahmad = `['takmir_inti', 'bendahara']`
- Permissions di-merge dari semua roles
- Dashboard adaptive menampilkan menu sesuai roles

---

## 10. Development Roadmap (3 Phases)

### Phase 1: Core MVP (Week 1-6) - March 2026

**Goal:** Launch functional website dengan transparansi keuangan

**Week 1-2: Foundation**
- ✅ Laravel 12 setup + Tailwind
- ✅ OAuth Google authentication
- ✅ Role & Permission system
- ✅ Admin dashboard layout
- ✅ Public layout

**Week 3-4: Keuangan (PRIORITY)**
- ✅ Database schema: transaksi, ZISWAF
- ✅ Bendahara: Input transaksi CRUD
- ✅ Approval workflow
- ✅ Dashboard keuangan public
- ✅ Laporan PDF generation
- ✅ Audit trail
- ✅ QRIS display

**Week 5-6: Profil & Beranda**
- ✅ Beranda: Sambutan, Galeri, Jadwal Sholat API
- ✅ Profil: Sejarah, Visi/Misi, Struktur Organisasi
- ✅ User management
- ✅ Internal notifications
- ✅ Data dummy seeding (3 months)

**Deliverables:**
- Functional admin dashboard
- Functional public website
- 3 months financial data
- Deployed to Hostinger

---

### Phase 2: Content & Engagement (Week 7-10) - April 2026

**Goal:** Add content management & interactive features

**Week 7-8: Artikel & Media**
- ✅ Artikel CRUD (WYSIWYG)
- ✅ Kategori artikel CRUD
- ✅ Video Ceramah (YouTube embed)
- ✅ Galeri Foto (batch upload)
- ✅ SEO optimization

**Week 9-10: Kegiatan & Layanan**
- ✅ Kegiatan CRUD
- ✅ Kalender Kegiatan (monthly view)
- ✅ Jadwal Salat full month
- ✅ Layanan pages (WA redirect)
- ✅ Kontak form
- ✅ Pengumuman management

**Deliverables:**
- 10+ artikel published
- 5+ video ceramah
- 15+ galeri photos
- Calendar dengan 10+ events

---

### Phase 3: Pembangunan & Polish (Week 11-14) - May 2026

**Goal:** Complete pembangunan tracking & polish UI/UX

**Week 11-12: Pembangunan Masjid**
- ✅ Desain & Masterplan upload
- ✅ Progress Pembangunan (% update)
- ✅ Galeri Foto Proyek
- ✅ Gantt Chart (input form → auto-generate)
- ✅ Link ke laporan keuangan

**Week 13: Belajar Islam & Features**
- ✅ Syahadat page
- ✅ Pelatihan Sholat
- ✅ Belajar Mengaji info
- ✅ Target Donasi & Progress Bar
- ✅ Grafik Tren Donasi
- ✅ UI/UX refinement

**Week 14: Testing & Launch**
- ✅ Cross-browser testing
- ✅ Mobile responsive testing
- ✅ Performance optimization
- ✅ Security audit
- ✅ UAT dengan admin users
- ✅ Training session
- ✅ Cron jobs setup

**Deliverables:**
- Complete pembangunan tracking
- Belajar Islam section
- All features tested
- Production-ready

---

## 11. Launch Strategy

### 11.1 Pre-Launch Checklist

**Technical:**
- [ ] SSL certificate active
- [ ] Database backup automated
- [ ] Google Analytics installed
- [ ] Sitemap.xml submitted
- [ ] .env production configured
- [ ] Cron jobs tested

**Content:**
- [ ] 3 months financial data
- [ ] 10+ artikel published
- [ ] 15+ galeri photos
- [ ] Struktur organisasi complete
- [ ] QRIS image uploaded

**Training:**
- [ ] Admin training conducted
- [ ] User manual created
- [ ] Test accounts ready

### 11.2 Launch Day

**Morning (09:00):**
- Final smoke test
- Database backup
- DNS/SSL check

**Noon (12:00):**
- Official Launch
- Announce to admin users

**Afternoon (15:00):**
- Social media announcement
- WhatsApp broadcast

**Evening (20:00):**
- Monitor analytics
- Respond to feedback

### 11.3 Communication Plan

**Internal:** WhatsApp Group admin
**External:** Instagram, WhatsApp broadcast, offline banner

**Messaging:**
- "🕌 Website Resmi Masjid Bukit Palma!"
- "✅ Laporan Keuangan Transparan"
- "✅ Donasi Online QRIS"
- "📱 https://masjidbukitpalma.or.id"

---

## 12. Success Criteria & KPIs

### Phase 1 (Month 1-2)

| Metric | Target |
|--------|--------|
| Unique Visitors | 200+/month |
| Financial Reports | 100% on-time |
| Admin Adoption | 80%+ |

### Phase 2 (Month 3-4)

| Metric | Target |
|--------|--------|
| Unique Visitors | 400+/month |
| QRIS Donations | 50+ transactions |
| Content Published | 90% within 48h |

### Phase 3 (Month 5-6)

| Metric | Target |
|--------|--------|
| Unique Visitors | 600+/month |
| Trust Score | > 4.5/5.0 |
| Donation Increase | +25% |

---

## 13. Open Questions & Risks

### 13.1 Open Questions

**Q1:** When will payment gateway budget be available?
**Q2:** Is native mobile app needed or PWA sufficient?
**Q3:** Need multi-language (EN/AR) support?

### 13.2 Risks

| Risk | Mitigation |
|------|------------|
| **Admin not tech-savvy** | Simple UI + hands-on training |
| **Low initial adoption** | Aggressive marketing |
| **Hosting performance** | Optimize + monitor |
| **Manual QRIS inefficient** | Accept for MVP, plan gateway Phase 4 |
| **Security breach** | HTTPS + regular updates + audit trail |

---

## 14. Appendix

### 14.1 Glossary

| Term | Definition |
|------|------------|
| **ZISWAF** | Zakat, Infaq, Sedekah, Wakaf |
| **Takmir** | Pengurus masjid |
| **Jamaah** | Congregation |
| **Mustahiq** | Penerima zakat yang sah |

### 14.2 References

- Laravel 12 Docs: https://laravel.com/docs/12.x
- Tailwind CSS: https://tailwindcss.com/docs
- Aladhan API: https://aladhan.com/prayer-times-api

---

**END OF PRD**

*For technical implementation, see technical-spec.md*