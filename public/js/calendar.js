document.addEventListener("DOMContentLoaded", function () {
    let calendarEl = document.getElementById("calendar");

    let calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: "dayGridMonth",
        height: "auto",
        headerToolbar: {
            left: "prev,next today",
            center: "title",
            right: "dayGridMonth,timeGridWeek,timeGridDay,listWeek",
        },
        selectable: true,
        editable: true,
        navLinks: true,

        events: [
            {
                title: "Meeting Tim",
                start: "2026-01-10",
                classNames: [
                    "bg-primary",
                    "text-primary",
                    "fw-semibold",
                    "border",
                    "border-primary",
                    "px-2",
                    "py-1",
                    "rounded-2",
                ],
            },
            {
                title: "Deadline Project",
                start: "2026-01-12",
                classNames: [
                    "bg-danger",
                    "text-primary",
                    "fw-semibold",
                    "border",
                    "border-danger",
                    "px-2",
                    "py-1",
                    "rounded-2",
                ],
            },
            {
                title: "Review",
                start: "2026-01-15",
                end: "2026-01-16",
                classNames: [
                    "bg-success",
                    "text-primary",
                    "fw-semibold",
                    "border",
                    "border-success",
                    "px-2",
                    "py-1",
                    "rounded-2",
                ],
            },
        ],

        dateClick: function (info) {
            document.getElementById("eventStartDate").value = info.dateStr;
            let offcanvas = new bootstrap.Offcanvas(
                document.getElementById("addEventSidebar"),
            );
            offcanvas.show();
        },
    });

    calendar.render();
});
document.addEventListener("DOMContentLoaded", function () {
    const startPicker = flatpickr("#eventStartDate", {
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        time_24hr: true,
    });

    const endPicker = flatpickr("#eventEndDate", {
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        time_24hr: true,
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
        },
    });
});
