<!-- resources\views\admin\sections\about-section\index.blade.php -->
@extends('admin.layouts.master')

@section('content')
<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">About Us</h3>
                <div class="card-actions">
                    <a href="{{ route('admin.course-levels.index') }}" class="btn btn-primary">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-chevron-left"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 6l-6 6l6 6" /></svg>
                        Back
                    </a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.about-section.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <x-image-preview id="preview1" src="{{ asset($about->image) }}"/>
                                <label class="form-label">Image</label>
                                <input type="file" class="form-control fileInput" name="image" data-preview="preview1">
                                <input type="hidden" name="old_image" value="{{ $about->image }}">
                                <x-input-error for="image" class="mt-2"/>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Rounded Text</label>
                                <input type="text" class="form-control" name="rounded_text" value="{{ old('rounded_text', $about->rounded_text) }}">
                                <x-input-error for="rounded_text" class="mt-2"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Learner Count</label>
                                <input type="text" class="form-control" name="learner_count" value="{{ old('learner_count', $about->learner_count) }}">
                                <x-input-error for="learner_count" class="mt-2"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Learner Count Text</label>
                                <input type="text" class="form-control" name="learner_count_text" value="{{ old('learner_count_text', $about->learner_count_text) }}">
                                <x-input-error for="learner_count_text" class="mt-2"/>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <x-image-preview id="preview2" src="{{ asset($about->learner_image) }}"/>
                                <label class="form-label">Learner Image</label>
                                <input type="file" class="form-control fileInput" name="learner_image" data-preview="preview2">
                                <input type="hidden" name="old_learner_image" value="{{ $about->learner_image }}">
                                <x-input-error for="learner_image" class="mt-2"/>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">About Title</label>
                                <input type="text" class="form-control" name="about_title" value="{{ old('about_title', $about->title) }}">
                                <x-input-error for="about_title" class="mt-2"/>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">About Description</label>
                                <textarea name="about_description">{!! $about->description !!}</textarea>
                                <x-input-error for="about_description" class="mt-2"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Button Text</label>
                                <input type="text" class="form-control" name="button_text" value="{{ old('button_text', $about->button_text) }}">
                                <x-input-error for="button_text" class="mt-2"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Button Url</label>
                                <input type="text" class="form-control" name="button_url" value="{{ old('button_url', $about->button_url) }}">
                                <x-input-error for="button_url" class="mt-2"/>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <x-image-preview id="preview3" src="{{ asset($about->video_image) }}"/>
                                <label class="form-label">Video Image</label>
                                <input type="file" class="form-control fileInput" name="video_image" data-preview="preview3">
                                <input type="hidden" name="old_video_image" value="{{ $about->video_image }}">
                                <x-input-error for="video_image" class="mt-2"/>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Video Url</label>
                                <input type="text" class="form-control" name="video_url" value="{{ old('video_url', $about->video_url) }}">
                                <x-input-error for="video_url" class="mt-2"/>
                            </div>
                        </div>
                        <div class="my-3 ms-2">
                            <button class="btn btn-primary" type="submit">
                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-device-floppy"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /><path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M14 4l0 4l-6 0l0 -4" /></svg>
                                Update
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>

// --- PNG analýza průhlednosti a bílé barvy ---
async function analyzePngFile(file)
{
    return new Promise((resolve) =>
    {
        const img = new Image();

        img.onload = () => {
            const canvas = document.createElement("canvas");
            canvas.width = img.width;
            canvas.height = img.height;

            const ctx = canvas.getContext("2d");
            ctx.drawImage(img, 0, 0);

            const data = ctx.getImageData(0, 0, img.width, img.height).data;

            let isWhitened = false;
            let whiteCounter = 0;

            for (let i = 0; i < data.length; i += 4)
            {
                const r = data[i];
                const g = data[i + 1];
                const b = data[i + 2];
                if (r == 255 && g == 255 && b == 255) whiteCounter++;
            }

            if ((whiteCounter*3 / data.length) >= 0.15 ) isWhitened = true;

            resolve({needsBg: isWhitened,});
        };
        img.src = URL.createObjectURL(file);
    });
}

// --- Spustí analýzu a aplikuje třídu ---
async function applyBgAnalysis(input)
{
    const previewId = input.dataset.preview;
    const preview = document.getElementById(previewId);

    if (!preview) {
        console.error("Preview element nenalezen:", previewId);
        return;
    }

    // Pro načtení souboru z disku (událost 'change')
    const file = input.files?.[0];

    // Pro DOMContentLoaded: potřebujeme analyzovat obrázek, který je již v 'src' náhledu (preview)
    // To je složitější, protože DOMContentLoaded potřebuje URL.
    // Pokud chcete analyzovat PŘEDNAČTENÝ obrázek, potřebujete jeho Blob/File objekt.

    if (file) {
        // Logika pro změnu souboru (přes File objekt)
        const objectUrl = URL.createObjectURL(file);
        preview.src = objectUrl;

        const result = await analyzePngFile(file); // Analýza File objektu

        if (result.needsBg) {
            preview.classList.add("needs-bg");
        } else {
            preview.classList.remove("needs-bg");
        }
    }
    else if (preview.src) {
        // Logika pro DOMContentLoaded (náhled již obsahuje obrázek z DB)
        // Kód je v tuto chvíli složitější, protože analyzePngFile vyžaduje 'File' objekt.
        // Pro zjednodušení: Na DOMContentLoaded budeme pracovat s URL.
        const imgUrl = preview.src;

        // Zde potřebujeme funkci, která analyzuje URL (protože analyzePngFile bere File)
        // Toto by vyžadovalo přepsání analyzePngFile, aby brala URL/Blob/File

        // **Zjednodušené řešení pro existující náhled (DOM Ready):**
        // Pokud je v preview.src obrázek, musíme ho stáhnout (fetch) a převést na Blob/File.
        const allowedExtensions = ['.png', '.webp', '.jpg', '.jpeg', '.gif'];

        // Převedeme URL na malá písmena pro spolehlivé porovnání
        const imgUrlLower = imgUrl.toLowerCase();

        // Zkontrolujeme, zda alespoň JEDNA přípona odpovídá konci URL
        const isImage = allowedExtensions.some(extension =>
            imgUrlLower.endsWith(extension)
        );

        if (isImage) {
            // Pokud je v preview.src platná URL (a je to PNG), provedeme Fetch.
             // Použijeme fetch API k získání Blob a vytvoření File objektu.
            fetch(imgUrl)
                .then(res => res.blob()) // Získáme obrázek jako Blob
                .then(async blob => {
                    // Vytvoříme File objekt (nutný pro analyzePngFile)
                    const tempFile = new File([blob], "temp_preview.png", { type: blob.type });

                    // Analyzujeme File objekt
                    const result = await analyzePngFile(tempFile);

                    if (result.needsBg) {
                        preview.classList.add("needs-bg");
                    } else {
                        preview.classList.remove("needs-bg");
                    }
                })
            .catch(err => console.error("Chyba při stahování obrázku pro analýzu:", err));
        }
        else {
            console.warn("URL nekončí podporovanou příponou obrázku:", imgUrl);
        }
    }
}

// --- Spuštění při načtení DOM ---
document.addEventListener("DOMContentLoaded", function()
{
    // 2. Projdeme všechny 'fileInput' a spustíme analýzu
    document.querySelectorAll(".fileInput").forEach(input => {
        // V tomto případě voláme applyBgAnalysis pro existující náhledy
        applyBgAnalysis(input);
    });
});


// --- Obsluha všech <input type="file" class="fileInput"> ---
document.querySelectorAll(".fileInput").forEach(input =>
{
    // 1. Nastavíme obsluhu události 'change' (když uživatel nahraje nový soubor)
    input.addEventListener("change", (e) => {
        applyBgAnalysis(input);
    });
});


</script>
@endpush
