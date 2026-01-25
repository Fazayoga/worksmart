document.addEventListener("DOMContentLoaded", function () {
    const filters = document.querySelectorAll(".pegawai-filter");
    const rows = document.querySelectorAll("tbody tr");

    function applyFilter(status, withAnimation = true) {
        // Active card
        filters.forEach((f) => f.classList.remove("active"));
        document
            .querySelector(`.pegawai-filter[data-status="${status}"]`)
            .classList.add("active");

        rows.forEach((row) => {
            if (withAnimation) {
                row.classList.add("fade-out");
            }

            setTimeout(
                () => {
                    if (row.dataset.status === status) {
                        row.style.display = "";
                        row.classList.remove("fade-out");
                        row.classList.add("fade-in");
                    } else {
                        row.style.display = "none";
                    }
                },
                withAnimation ? 200 : 0,
            );

            setTimeout(() => {
                row.classList.remove("fade-in");
            }, 400);
        });
    }

    // 🔹 Klik filter
    filters.forEach((filter) => {
        filter.addEventListener("click", function () {
            applyFilter(this.dataset.status);
        });
    });

    // 🔹 DEFAULT SAAT HALAMAN DIBUKA
    applyFilter("aktif", false);

    /*
            ======================================
            NANTI JIKA PAKAI AJAX (DIKOMEN)
            ======================================

            function loadPegawai(status) {
                fetch(`/pegawai?status=${status}`)
                    .then(res => res.text())
                    .then(html => {
                        document.querySelector('tbody').innerHTML = html;
                    });
            }
            */
});
