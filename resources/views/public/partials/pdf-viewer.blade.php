{{--
    Partial Preview Dokumen bersama (PDF + Gambar).
    Pakai: bungkus halaman dengan <main x-data="pdfViewerData()"> lalu @include partial ini di dalamnya.
    Picu modal dari tombol: @click="openDoc('{{ $url }}')".
    PDF dirender pdf.js (navigasi per halaman). JPG/PNG dirender langsung sebagai <img>.
--}}
<div x-cloak x-show="isOpen" class="fixed inset-0 z-[100] flex items-center justify-center bg-black/80 backdrop-blur-sm p-4">
    <div @click.outside="closeDoc()" class="relative flex w-full max-w-4xl flex-col rounded-2xl bg-surface shadow-2xl h-[90vh]">
        <!-- Header Modal -->
        <div class="flex items-center justify-between border-b border-outline_variant/30 px-6 py-4">
            <h3 class="font-headline text-lg font-bold text-primary">Preview Dokumen</h3>
            <div class="flex items-center gap-4">
                <!-- Navigasi halaman hanya untuk PDF -->
                <div x-show="mode === 'pdf' && pageCount > 0" class="flex items-center gap-2 text-sm text-on_surface_variant">
                    <button @click="prevPage()" :disabled="pageNum <= 1" class="rounded-full p-2 hover:bg-surface_container disabled:opacity-50 transition">
                        <span class="material-symbols-outlined">chevron_left</span>
                    </button>
                    <span class="font-bold">Hal <span x-text="pageNum"></span> / <span x-text="pageCount"></span></span>
                    <button @click="nextPage()" :disabled="pageNum >= pageCount" class="rounded-full p-2 hover:bg-surface_container disabled:opacity-50 transition">
                        <span class="material-symbols-outlined">chevron_right</span>
                    </button>
                </div>
                <button @click="closeDoc()" class="rounded-full p-2 text-on_surface_variant hover:bg-error_container hover:text-error transition">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
        </div>

        <!-- Body Modal -->
        <div class="relative flex-1 overflow-auto bg-surface_container_low p-6 flex justify-center items-start">
            <div x-show="loading" class="absolute inset-0 flex items-center justify-center bg-surface_container_low/80 z-10 backdrop-blur-sm">
                <span class="material-symbols-outlined animate-spin text-5xl text-primary">progress_activity</span>
            </div>
            <!-- Render PDF -->
            <canvas x-show="mode === 'pdf'" id="pdf-canvas" class="max-w-full shadow-lg bg-white border border-outline_variant/20" @contextmenu.prevent=""></canvas>
            <!-- Render Gambar (template x-if agar <img> hanya ada di DOM saat mode image; mencegah error event dari src kosong) -->
            <template x-if="mode === 'image'">
                <img :src="imageUrl" x-on:load="loading = false" x-on:error="loading = false; alert('Gagal memuat dokumen.'); closeDoc()" alt="Preview Dokumen" class="max-w-full max-h-full object-contain shadow-lg" @contextmenu.prevent="" />
            </template>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
<script>
    pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';

    document.addEventListener('alpine:init', () => {
        Alpine.data('pdfViewerData', () => {
            // pdfDoc disimpan di luar state reaktif Alpine.
            // Alpine membungkus state dalam Proxy; PDFDocumentProxy pdf.js memakai private field (#),
            // sehingga akses lewat Proxy memicu "object is not the right class".
            let pdfDoc = null;

            return {
                isOpen: false,
                loading: false,
                mode: 'pdf', // 'pdf' | 'image'
                imageUrl: '',
                pageNum: 1,
                pageCount: 0,

                init() {
                    this.$watch('isOpen', value => {
                        if (!value) {
                            pdfDoc = null;
                            this.pageNum = 1;
                            this.pageCount = 0;
                            this.imageUrl = '';

                            const canvasEl = document.getElementById('pdf-canvas');
                            if (canvasEl) {
                                const ctx = canvasEl.getContext('2d');
                                ctx.clearRect(0, 0, canvasEl.width, canvasEl.height);
                            }
                            document.body.style.overflow = 'auto';
                        } else {
                            document.body.style.overflow = 'hidden';
                        }
                    });
                },

                openDoc(url) {
                    // Deteksi tipe dari ekstensi (buang query string & fragment)
                    const clean = (url || '').split('?')[0].split('#')[0].toLowerCase();
                    const isImage = /\.(jpe?g|png|gif|webp|bmp)$/.test(clean);

                    this.isOpen = true;
                    this.loading = true;

                    if (isImage) {
                        this.mode = 'image';
                        this.pageNum = 1;
                        this.pageCount = 0;
                        this.imageUrl = url;
                        // loading dimatikan oleh handler load/error pada elemen img
                        return;
                    }

                    this.mode = 'pdf';
                    this.imageUrl = '';
                    pdfjsLib.getDocument(url).promise.then(doc => {
                        pdfDoc = doc;
                        this.pageCount = pdfDoc.numPages;
                        this.pageNum = 1;
                        this.renderPage(this.pageNum);
                    }).catch(err => {
                        console.error('Error loading PDF: ', err);
                        alert('Gagal memuat dokumen.');
                        this.loading = false;
                    });
                },

                renderPage(num) {
                    this.loading = true;
                    pdfDoc.getPage(num).then(page => {
                        const viewport = page.getViewport({ scale: 1.5 });

                        // Ambil elemen DOM asli secara langsung, bukan via proxy Alpine
                        const canvasEl = document.getElementById('pdf-canvas');
                        const ctx = canvasEl.getContext('2d');

                        canvasEl.height = viewport.height;
                        canvasEl.width = viewport.width;

                        const renderContext = {
                            canvasContext: ctx,
                            viewport: viewport
                        };

                        page.render(renderContext).promise.then(() => {
                            this.loading = false;
                        }).catch(err => {
                            console.error('Error rendering page:', err);
                            this.loading = false;
                        });
                    });
                },

                prevPage() {
                    if (this.pageNum <= 1) return;
                    this.pageNum--;
                    this.renderPage(this.pageNum);
                },

                nextPage() {
                    if (this.pageNum >= this.pageCount) return;
                    this.pageNum++;
                    this.renderPage(this.pageNum);
                },

                closeDoc() {
                    this.isOpen = false;
                }
            };
        });
    });
</script>
