@extends('public.layout')

@section('title', 'Susunan Prajuru - Desa Adat Tamanbali')

@section('content')
    <main>
        <section class="relative overflow-hidden bg-primary px-6 py-24 text-white">
            <div class="absolute inset-0 hero-overlay opacity-90"></div>
            <div class="relative mx-auto max-w-7xl">
                <p class="mb-4 text-xs font-bold uppercase tracking-[0.3em] text-secondary_fixed_dim">Struktur Organisasi</p>
                <h1 class="max-w-3xl font-headline text-5xl font-extrabold tracking-tight md:text-6xl">Susunan Prajuru Desa Adat</h1>
                <p class="mt-6 max-w-2xl text-lg leading-8 text-primary_fixed_dim">Tim prajuru menjaga irama administrasi,
                    keuangan, dan pelayanan desa adat agar berjalan tertib dan dapat dipertanggungjawabkan.</p>
            </div>
        </section>

        <section class="bg-surface px-6 py-20">
            <div class="mx-auto max-w-7xl">
                <div class="mb-8">
                    <p class="mb-3 text-xs font-bold uppercase tracking-[0.28em] text-secondary">Prajuru Inti</p>
                    <h2 class="font-headline text-3xl font-extrabold text-primary">Penggerak utama tata kelola desa</h2>
                </div>

                @if($coreTeam->isEmpty())
                    <p class="text-on_surface_variant italic">Data prajuru belum tersedia.</p>
                @else
                    <div class="grid gap-6 lg:grid-cols-3">
                        @foreach ($coreTeam as $member)
                            <article class="rounded-[28px] bg-white p-8 shadow-sky flex flex-col items-center text-center">
                                {{-- Foto profil --}}
                                <div class="mb-5 h-24 w-24 overflow-hidden rounded-full ring-4 ring-primary/10">
                                    <img
                                        src="{{ $member->foto ? Storage::disk('public')->url($member->foto) : 'https://ui-avatars.com/api/?name=' . urlencode($member->nama_lengkap) . '&background=00236f&color=fff&size=128' }}"
                                        alt="Foto {{ $member->nama_lengkap }}"
                                        class="h-full w-full object-cover"
                                    />
                                </div>
                                <div class="mb-3 text-xs font-bold uppercase tracking-[0.28em] text-secondary">{{ $member->jabatan }}</div>
                                <h3 class="font-headline text-2xl font-extrabold text-primary">{{ $member->nama_lengkap }}</h3>
                                @if($member->deskripsi)
                                    <p class="mt-4 leading-7 text-on_surface_variant text-sm">{{ $member->deskripsi }}</p>
                                @endif
                            </article>
                        @endforeach
                    </div>
                @endif
            </div>
        </section>

        <section class="bg-surface_container_low px-6 py-20">
            <div class="mx-auto max-w-7xl">
                <div class="mb-8">
                    <p class="mb-3 text-xs font-bold uppercase tracking-[0.28em] text-secondary">Kelian Banjar</p>
                    <h2 class="font-headline text-3xl font-extrabold text-primary">Perwakilan banjar yang terhubung</h2>
                </div>
                <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                    @foreach ($banjarLeaders as $leader)
                        <article class="glass-card rounded-[28px] p-7 shadow-sky">
                            <div class="mb-3 flex h-12 w-12 items-center justify-center rounded-full bg-primary_container text-white">
                                <span class="material-symbols-outlined">groups</span>
                            </div>
                            <h3 class="font-headline text-xl font-extrabold text-primary">{{ $leader->kelian_banjar }}</h3>
                            <p class="mt-2 text-on_surface_variant">{{ $leader->nama_banjar }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        @if(!$balaAngkep->isEmpty())
        <section class="bg-surface px-6 py-20">
            <div class="mx-auto max-w-7xl">
                <div class="mb-8">
                    <p class="mb-3 text-xs font-bold uppercase tracking-[0.28em] text-secondary">Kelian Bala Angkep</p>
                    <h2 class="font-headline text-3xl font-extrabold text-primary">Penanggung jawab koordinasi bala</h2>
                </div>
                <div class="grid gap-6 lg:grid-cols-3">
                    @foreach ($balaAngkep as $member)
                        <article class="rounded-[28px] bg-white p-8 shadow-sky flex flex-col items-center text-center">
                            <div class="mb-5 h-24 w-24 overflow-hidden rounded-full ring-4 ring-primary/10">
                                <img
                                    src="{{ $member->foto_url }}"
                                    alt="Foto {{ $member->nama_lengkap }}"
                                    class="h-full w-full object-cover"
                                />
                            </div>
                            <div class="mb-3 text-xs font-bold uppercase tracking-[0.28em] text-secondary">{{ $member->jabatan }}</div>
                            <h3 class="font-headline text-2xl font-extrabold text-primary">{{ $member->nama_lengkap }}</h3>
                            @if($member->deskripsi)
                                <p class="mt-4 leading-7 text-on_surface_variant text-sm">{{ $member->deskripsi }}</p>
                            @endif
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
        @endif

        @if(!$sabhaDesa->isEmpty())
        <section class="bg-surface_container_low px-6 py-20">
            <div class="mx-auto max-w-7xl">
                <div class="mb-8">
                    <p class="mb-3 text-xs font-bold uppercase tracking-[0.28em] text-secondary">Sabha Desa</p>
                    <h2 class="font-headline text-3xl font-extrabold text-primary">Lembaga legislatif dan musyawarah adat</h2>
                </div>
                <div class="grid gap-6 lg:grid-cols-4 md:grid-cols-2">
                    @foreach ($sabhaDesa as $member)
                        <article class="rounded-[28px] bg-white p-6 shadow-sky flex flex-col items-center text-center">
                            <div class="mb-4 h-20 w-20 overflow-hidden rounded-full ring-4 ring-primary/10">
                                <img
                                    src="{{ $member->foto_url }}"
                                    alt="Foto {{ $member->nama_lengkap }}"
                                    class="h-full w-full object-cover"
                                />
                            </div>
                            <div class="mb-2 text-[10px] font-bold uppercase tracking-[0.2em] text-secondary">{{ $member->jabatan }}</div>
                            <h3 class="font-headline text-lg font-extrabold text-primary">{{ $member->nama_lengkap }}</h3>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
        @endif

        @if(!$kertaDesa->isEmpty())
        <section class="bg-surface px-6 py-20">
            <div class="mx-auto max-w-7xl">
                <div class="mb-8">
                    <p class="mb-3 text-xs font-bold uppercase tracking-[0.28em] text-secondary">Kerta Desa</p>
                    <h2 class="font-headline text-3xl font-extrabold text-primary">Lembaga pertimbangan dan peradilan adat</h2>
                </div>
                <div class="grid gap-6 lg:grid-cols-4 md:grid-cols-2">
                    @foreach ($kertaDesa as $member)
                        <article class="rounded-[28px] bg-white p-6 shadow-sky flex flex-col items-center text-center">
                            <div class="mb-4 h-20 w-20 overflow-hidden rounded-full ring-4 ring-primary/10">
                                <img
                                    src="{{ $member->foto_url }}"
                                    alt="Foto {{ $member->nama_lengkap }}"
                                    class="h-full w-full object-cover"
                                />
                            </div>
                            <div class="mb-2 text-[10px] font-bold uppercase tracking-[0.2em] text-secondary">{{ $member->jabatan }}</div>
                            <h3 class="font-headline text-lg font-extrabold text-primary">{{ $member->nama_lengkap }}</h3>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
        @endif
    </main>
@endsection
