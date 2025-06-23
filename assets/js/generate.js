// File: assets/js/generate.js (Untuk Tombol Download Melayang)

document.addEventListener('DOMContentLoaded', function() {
    const downloadButton = document.getElementById('downloadPDF');
    if (downloadButton) {
        downloadButton.addEventListener('click', () => {
            const element = document.getElementById('cv');
            const filename = downloadButton.dataset.filename || 'CV_Profesional.pdf';
            const opt = { margin: 0, filename: filename, image: { type: 'jpeg', quality: 0.98 }, html2canvas:  { scale: 2, useCORS: true }, jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' } };
            downloadButton.style.display = 'none';
            html2pdf().set(opt).from(element).save().finally(() => {
                downloadButton.style.display = 'flex';
            });
        });
    }
});