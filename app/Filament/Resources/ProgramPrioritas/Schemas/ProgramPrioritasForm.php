<?php

namespace App\Filament\Resources\ProgramPrioritas\Schemas;

use App\Models\ProgramPrioritas;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ProgramPrioritasForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama_program')
                    ->required()
                    ->maxLength(255)
                    ->label('Nama Program Strategis')
                    ->placeholder('contoh: Pemugaran & Penataan Candi Bentar Pura Kahyangan Tiga')
                    ->columnSpanFull(),

                Select::make('bidang')
                    ->options(ProgramPrioritas::bidangOptions())
                    ->default(ProgramPrioritas::BIDANG_PARAHYANGAN)
                    ->required()
                    ->label('Bidang Tri Hita Karana'),

                TextInput::make('tahun_anggaran')
                    ->required()
                    ->numeric()
                    ->default((int) date('Y'))
                    ->label('Tahun Anggaran'),

                Select::make('status')
                    ->options(ProgramPrioritas::statusOptions())
                    ->default(ProgramPrioritas::STATUS_DIRENCANAKAN)
                    ->required()
                    ->label('Status Pelaksanaan'),

                TextInput::make('persentase_progress')
                    ->required()
                    ->numeric()
                    ->minValue(0)
                    ->maxValue(100)
                    ->default(0)
                    ->suffix('%')
                    ->label('Progress Capaian (%)')
                    ->helperText('Isi 0-100. Nilai 100% menandakan program telah rampung.'),

                TextInput::make('estimasi_anggaran')
                    ->required()
                    ->numeric()
                    ->prefix('Rp')
                    ->default(0)
                    ->label('Estimasi Biaya / Alokasi Anggaran'),

                TextInput::make('realisasi_anggaran')
                    ->required()
                    ->numeric()
                    ->prefix('Rp')
                    ->default(0)
                    ->label('Realisasi Anggaran Terpakai'),

                TextInput::make('target_output')
                    ->maxLength(255)
                    ->label('Target Output / Sasaran')
                    ->placeholder('contoh: Tuntas pemugaran fisik & upacara pemlaspasan'),

                TextInput::make('penanggung_jawab')
                    ->maxLength(255)
                    ->label('Penanggung Jawab / Tim Adat')
                    ->placeholder('contoh: Manggala Adat & Panitia Banjar Kawan'),

                DatePicker::make('tanggal_mulai')
                    ->label('Tanggal Dimulai')
                    ->native(false),

                DatePicker::make('target_selesai')
                    ->label('Target Selesai')
                    ->native(false),

                FileUpload::make('foto')
                    ->image()
                    ->disk('public')
                    ->directory('program-prioritas')
                    ->visibility('public')
                    ->maxSize(3072)
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                    ->imagePreviewHeight('180')
                    ->fetchFileInformation(false)
                    ->label('Foto Dokumentasi / Desain Program')
                    ->helperText('Format JPG/PNG/WebP, maksimal 3 MB.')
                    ->columnSpanFull(),

                Textarea::make('deskripsi')
                    ->rows(3)
                    ->maxLength(1000)
                    ->label('Deskripsi & Latar Belakang Program')
                    ->placeholder('Uraian singkat mengenai latar belakang, tahapan pelaksanaan, dan manfaat bagi krama desa...')
                    ->columnSpanFull(),

                TextInput::make('urutan')
                    ->numeric()
                    ->default(0)
                    ->minValue(0)
                    ->label('Urutan Tampil')
                    ->helperText('Angka lebih kecil akan tampil lebih awal.'),

                Toggle::make('is_tampil_beranda')
                    ->label('Tampilkan di Highlight Beranda')
                    ->default(true)
                    ->helperText('Aktifkan agar muncul di showcase halaman utama.'),

                Toggle::make('is_aktif')
                    ->label('Status Aktif / Publikasikan')
                    ->default(true)
                    ->helperText('Nonaktifkan jika masih berupa draf internal prajuru.'),
            ]);
    }
}
