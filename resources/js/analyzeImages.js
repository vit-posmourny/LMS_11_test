// --- PNG analýza průhlednosti a bílé barvy ---
async function analyzeImages(file)
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

        const result = await analyzeImages(file); // Analýza File objektu

        if (result.needsBg) {
            preview.classList.add("needs-bg");
        } else {
            preview.classList.remove("needs-bg");
        }
    }
    else if (preview.src) {
        // Logika pro DOMContentLoaded (náhled již obsahuje obrázek z DB)
        // Kód je v tuto chvíli složitější, protože analyzeImages vyžaduje 'File' objekt.
        // Pro zjednodušení: Na DOMContentLoaded budeme pracovat s URL.
        const imgUrl = preview.src;

        // Zde potřebujeme funkci, která analyzuje URL (protože analyzeImages bere File)
        // Toto by vyžadovalo přepsání analyzeImages, aby brala URL/Blob/File

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
                    // Vytvoříme File objekt (nutný pro analyzeImages)
                    const tempFile = new File([blob], "temp_preview.png", { type: blob.type });

                    // Analyzujeme File objekt
                    const result = await analyzeImages(tempFile);

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
