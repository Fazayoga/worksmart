document.addEventListener("DOMContentLoaded", function () {
    const btn = document.getElementById("sortTanggal");
    if (!btn) return;

    btn.addEventListener("click", function () {
        const icon = this.querySelector("i");
        const currentSort = this.dataset.sort;

        if (currentSort === "desc") {
            this.dataset.sort = "asc";
            icon.classList.replace("bx-sort-down", "bx-sort-up");
        } else {
            this.dataset.sort = "desc";
            icon.classList.replace("bx-sort-up", "bx-sort-down");
        }
    });
});
