document.addEventListener("DOMContentLoaded", function () {
    const gajiCtx = document.getElementById("gajiChart");
    if (!gajiCtx) return;

    new Chart(gajiCtx, {
        type: "line",
        data: {
            labels: [
                "Jan",
                "Feb",
                "Mar",
                "Apr",
                "Mei",
                "Jun",
                "Jul",
                "Agu",
                "Sep",
                "Okt",
                "Nov",
                "Des",
            ],
            datasets: [
                {
                    label: "Gaji Pokok",
                    data: [10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10],
                    borderColor: "#696cff",
                    backgroundColor: "rgba(105,108,255,0.15)",
                    tension: 0.4,
                    fill: true,
                },
                {
                    label: "Potongan",
                    data: [2, 1, 1, 2, 1, 1, 2, 1, 1, 2, 1, 1],
                    borderColor: "#ff4d49",
                    backgroundColor: "rgba(255,77,73,0.15)",
                    tension: 0.4,
                    fill: true,
                },
                {
                    label: "Tunjangan & Bonus",
                    data: [3, 2, 4, 3, 2, 4, 3, 2, 4, 3, 2, 4],
                    borderColor: "#28c76f",
                    backgroundColor: "rgba(40,199,111,0.15)",
                    tension: 0.4,
                    fill: true,
                },
                {
                    label: "Total Gaji",
                    data: [11, 11, 13, 11, 11, 13, 11, 11, 13, 11, 11, 13],
                    borderColor: "#ff9f43",
                    borderWidth: 3,
                    tension: 0.4,
                    fill: false,
                },
            ],
        },
    });
});
document.addEventListener("DOMContentLoaded", function () {
    const ijinCutiCtx = document.getElementById("ijin-cutiChart");
    if (!ijinCutiCtx) return;

    new Chart(ijinCutiCtx, {
        type: "line",
        data: {
            labels: [
                "Jan",
                "Feb",
                "Mar",
                "Apr",
                "Mei",
                "Jun",
                "Jul",
                "Agu",
                "Sep",
                "Okt",
                "Nov",
                "Des",
            ],
            datasets: [
                {
                    label: "Ijin",
                    data: [2, 1, 3, 2, 1, 2, 3, 2, 1, 2, 3, 2],
                    borderColor: "#696cff",
                    tension: 0.4,
                    backgroundColor: "rgba(105,108,255,0.15)",
                    fill: true,
                },
                {
                    label: "Cuti",
                    data: [1, 2, 1, 2, 3, 1, 2, 3, 1, 2, 1, 2],
                    borderColor: "#ff4d49",
                    tension: 0.4,
                    backgroundColor: "rgba(255,77,73,0.15)",
                    fill: true,
                },
                {
                    label: "Disetujui",
                    data: [3, 3, 4, 4, 4, 3, 5, 5, 4, 4, 5, 4],
                    borderColor: "#28c76f",
                    tension: 0.4,
                    backgroundColor: "rgba(40,199,111,0.15)",
                    fill: true,
                },
                {
                    label: "Ditolak",
                    data: [1, 0, 1, 0, 1, 0, 1, 0, 1, 0, 1, 0],
                    borderColor: "#ff9f43",
                    tension: 0.4,
                    borderWidth: 3,
                    fill: false,
                },
            ],
        },
    });
});
document.addEventListener("DOMContentLoaded", function () {
    const ctx = document.getElementById("reimbursementChart");

    if (!ctx) return;

    new Chart(ctx, {
        type: "line",
        data: {
            labels: [
                "Jan",
                "Feb",
                "Mar",
                "Apr",
                "Mei",
                "Jun",
                "Jul",
                "Agu",
                "Sep",
                "Okt",
                "Nov",
                "Des",
            ],
            datasets: [
                {
                    label: "Total Reimbursement",
                    data: [5, 4, 6, 7, 5, 6, 8, 7, 6, 5, 6, 7],
                    borderColor: "#696cff",
                    backgroundColor: "rgba(105,108,255,0.15)",
                    tension: 0.4,
                    fill: true,
                    pointRadius: 4,
                },
                {
                    label: "Disetujui",
                    data: [4, 3, 5, 6, 4, 5, 7, 6, 5, 4, 5, 6],
                    borderColor: "#28c76f",
                    backgroundColor: "rgba(40,199,111,0.15)",
                    tension: 0.4,
                    fill: true,
                    pointRadius: 4,
                },
                {
                    label: "Ditolak",
                    data: [1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1],
                    borderColor: "#ff4d49",
                    backgroundColor: "rgba(255,77,73,0.15)",
                    borderWidth: 3,
                    tension: 0.4,
                    fill: false,
                    pointRadius: 4,
                },
            ],
        },
        options: {
            responsive: true,
            interaction: {
                mode: "index",
                intersect: false,
            },
            plugins: {
                legend: {
                    position: "top",
                },
                tooltip: {
                    callbacks: {
                        label: function (context) {
                            return `${context.dataset.label}: ${context.parsed.y}`;
                        },
                    },
                },
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1,
                    },
                },
            },
        },
    });
});
