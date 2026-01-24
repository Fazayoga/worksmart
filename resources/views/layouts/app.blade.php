<!doctype html>
<html lang="en" class="layout-menu-fixed layout-compact" data-assets-path="{{ asset('assets/') }}"
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>@yield('title') | WorkSmart</title>
    <meta name="description" content="" />
    <link rel="icon" type="image/x-icon" href="{{ asset('/assets/img/favicon/logo.ico') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/iconify-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}" />
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('assets/js/config.js') }}"></script>
    @stack('styles')
</head>

<body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            @include('partials.sidebar')
            <div class="layout-page">
                @include('partials.navbar')
                <div class="content-wrapper">
                    <div class="container-fluid flex-grow-1 container-p-y">
                        @yield('content')
                    </div>
                    @include('partials.footer')
                    <div class="content-backdrop fade"></div>
                </div>
            </div>
        </div>
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>

    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API = Tawk_API || {},
            Tawk_LoadStart = new Date();
        (function() {
            var s1 = document.createElement("script"),
                s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/696a647c5884721983ad421a/1jf3ph1o0';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    </script>
    <!--End of Tawk.to Script-->
    <script>
        /*
                                                document.addEventListener('DOMContentLoaded', function () {
                                                    document.querySelectorAll('.pegawai-filter').forEach(card => {
                                                        card.addEventListener('click', function () {
                                                            const status = this.dataset.status;

                                                            fetch(`/pegawai?status=${status}`)
                                                                .then(response => response.json())
                                                                .then(data => {
                                                                    renderPegawai(data);
                                                                });
                                                        });
                                                    });
                                                });

                                                function renderPegawai(data) {
                                                    const tbody = document.querySelector('tbody');
                                                    tbody.innerHTML = '';

                                                    if (data.length === 0) {
                                                        tbody.innerHTML = `
            <tr>
                <td colspan="6" class="text-center text-muted">
                    Tidak ada data
                </td>
            </tr>
        `;
                                                        return;
                                                    }

                                                    data.forEach(row => {
                                                        tbody.innerHTML += `
            <tr>
                <td>
                    <div class="d-flex align-items-center gap-2">
                        <img src="${row.avatar ?? '/assets/img/avatars/default.png'}"
                             class="rounded-circle" width="32">
                        <span>${row.nama}</span>
                    </div>
                </td>
                <td>${row.email}</td>
                <td>${row.jabatan}</td>
                <td>
                    <span class="badge bg-label-${row.status === 'aktif' ? 'success' : 'secondary'}">
                        ${row.status}
                    </span>
                </td>
                <td>${row.created_at}</td>
                <td class="text-center">
                    <button class="btn btn-sm btn-warning">
                        <i class="bx bx-edit"></i>
                    </button>
                    <button class="btn btn-sm btn-danger">
                        <i class="bx bx-trash"></i>
                    </button>
                </td>
            </tr>
        `;
                                                    });
                                                }
                                                */
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const filters = document.querySelectorAll('.pegawai-filter');
            const rows = document.querySelectorAll('tbody tr');

            function applyFilter(status, withAnimation = true) {
                // Active card
                filters.forEach(f => f.classList.remove('active'));
                document
                    .querySelector(`.pegawai-filter[data-status="${status}"]`)
                    .classList.add('active');

                rows.forEach(row => {
                    if (withAnimation) {
                        row.classList.add('fade-out');
                    }

                    setTimeout(() => {
                        if (row.dataset.status === status) {
                            row.style.display = '';
                            row.classList.remove('fade-out');
                            row.classList.add('fade-in');
                        } else {
                            row.style.display = 'none';
                        }
                    }, withAnimation ? 200 : 0);

                    setTimeout(() => {
                        row.classList.remove('fade-in');
                    }, 400);
                });
            }

            // 🔹 Klik filter
            filters.forEach(filter => {
                filter.addEventListener('click', function() {
                    applyFilter(this.dataset.status);
                });
            });

            // 🔹 DEFAULT SAAT HALAMAN DIBUKA
            applyFilter('aktif', false);

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
    </script>

    <script>
        document.getElementById('sortTanggal').addEventListener('click', function() {
            const icon = this.querySelector('i');
            const currentSort = this.getAttribute('data-sort');

            if (currentSort === 'desc') {
                // Terbaru → Terlama
                this.setAttribute('data-sort', 'asc');
                this.setAttribute('title', 'Pendaftar Terlama');
                icon.classList.replace('bx-sort-down', 'bx-sort-up');
            } else {
                // Terlama → Terbaru
                this.setAttribute('data-sort', 'desc');
                this.setAttribute('title', 'Pendaftar Terbaru');
                icon.classList.replace('bx-sort-up', 'bx-sort-down');
            }

            // 🔥 Panggil reload data (AJAX / submit form)
            // loadPegawai({ sort: this.dataset.sort });
        });
    </script>

    {{-- Side bar ditutup mode dekstop --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const toggle = document.getElementById("desktopMenuToggle");
            const icon = toggle.querySelector("i");

            toggle.addEventListener("click", function() {
                document.body.classList.toggle("layout-menu-collapsed");

                icon.classList.toggle("bx-chevron-left");
                icon.classList.toggle("bx-chevron-right");
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let calendarEl = document.getElementById('calendar');

            let calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                height: 'auto',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                },
                selectable: true,
                editable: true,
                navLinks: true,

                events: [{
                        title: 'Meeting Tim',
                        start: '2026-01-10',
                        classNames: [
                            'bg-primary',
                            'text-primary',
                            'fw-semibold',
                            'border',
                            'border-primary',
                            'px-2',
                            'py-1',
                            'rounded-2'
                        ]
                    },
                    {
                        title: 'Deadline Project',
                        start: '2026-01-12',
                        classNames: [
                            'bg-danger',
                            'text-primary',
                            'fw-semibold',
                            'border',
                            'border-danger',
                            'px-2',
                            'py-1',
                            'rounded-2'
                        ]
                    },
                    {
                        title: 'Review',
                        start: '2026-01-15',
                        end: '2026-01-16',
                        classNames: [
                            'bg-success',
                            'text-primary',
                            'fw-semibold',
                            'border',
                            'border-success',
                            'px-2',
                            'py-1',
                            'rounded-2'
                        ]
                    }
                ],

                dateClick: function(info) {
                    document.getElementById('eventStartDate').value = info.dateStr;
                    let offcanvas = new bootstrap.Offcanvas(
                        document.getElementById('addEventSidebar')
                    );
                    offcanvas.show();
                }
            });

            calendar.render();
        });
        document.addEventListener('DOMContentLoaded', function() {

            const startPicker = flatpickr("#eventStartDate", {
                enableTime: true,
                dateFormat: "Y-m-d H:i",
                time_24hr: true
            });

            const endPicker = flatpickr("#eventEndDate", {
                enableTime: true,
                dateFormat: "Y-m-d H:i",
                time_24hr: true
            });

            flatpickr("#miniCalendar", {
                inline: true,
                mode: "range",
                dateFormat: "Y-m-d",
                onChange(selectedDates) {
                    if (selectedDates.length === 2) {
                        startPicker.setDate(selectedDates[0], true);
                        endPicker.setDate(selectedDates[1], true);
                    }
                }
            });

        });
    </script>

</body>

</html>
