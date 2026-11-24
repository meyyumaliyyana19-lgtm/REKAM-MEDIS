</main>

<footer class="bg-white border-top py-4 mt-auto">
    <div class="container text-center text-md-between d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
        <div class="text-muted" style="font-size: 0.85rem;">
            <strong>RSUD MEDIKA UTAMA TUBAN</strong> &copy; 2026 — Sistem Informasi Manajemen Rekam Medis (SIMRS)
        </div>
        <div class="text-muted" style="font-size: 0.83rem;">
            <span class="badge bg-light text-dark border me-2"><i class="fa-solid fa-graduation-cap me-1"></i> SMK Negeri 3 Tuban</span>
            <span>Status SIMRS: <strong class="text-success"><i class="fa-solid fa-circle-check me-1"></i> Online & Terhubung</strong></span>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function updateLiveClock() {
    const now = new Date();
    
    // Waktu HH:MM:SS WIB
    const hours   = String(now.getHours()).padStart(2, '0');
    const minutes = String(now.getMinutes()).padStart(2, '0');
    const seconds = String(now.getSeconds()).padStart(2, '0');
    const timeStr = `${hours}:${minutes}:${seconds} WIB`;
    
    const timeElem = document.getElementById('liveClockTime');
    if (timeElem) timeElem.textContent = timeStr;
    
    const dashboardClockElem = document.getElementById('dashboardClock');
    if (dashboardClockElem) dashboardClockElem.textContent = timeStr;

    // Tanggal (Hari, DD MMMM YYYY)
    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    const dateStr = now.toLocaleDateString('id-ID', options);
    
    const dateElem = document.getElementById('liveClockDate');
    if (dateElem) dateElem.textContent = dateStr;

    const dashboardDateElem = document.getElementById('dashboardDate');
    if (dashboardDateElem) dashboardDateElem.textContent = dateStr;
}

document.addEventListener('DOMContentLoaded', function () {
    updateLiveClock();
    setInterval(updateLiveClock, 1000);

    const searchInput = document.getElementById('tableSearch');
    if (searchInput) {
        searchInput.addEventListener('keyup', function () {
            const filter = this.value.toLowerCase();
            const tableRows = document.querySelectorAll('tbody tr');
            tableRows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(filter) ? '' : 'none';
            });
        });
    }
});
</script>

</body>
</html>