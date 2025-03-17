try {
    new simpleDatatables.DataTable("#datatable_1", {
        searchable: !0,
        fixedHeight: !1,
    });
} catch (e) {}
try {
    const b = new simpleDatatables.DataTable("#datatable_2");
    document.querySelector("button.csv").addEventListener("click", () => {
        b.exportCSV({
            type: "csv",
            download: !0,
            lineDelimiter: "\n\n",
            columnDelimiter: ";",
        });
    }),
        document.querySelector("button.sql").addEventListener("click", () => {
            b.export({ type: "sql", download: !0, tableName: "export_table" });
        }),
        document.querySelector("button.txt").addEventListener("click", () => {
            b.export({ type: "txt", download: !0 });
        }),
        document.querySelector("button.json").addEventListener("click", () => {
            b.export({ type: "json", download: !0, escapeHTML: !0, space: 3 });
        });
} catch (e) {}
try {
    document.addEventListener("DOMContentLoaded", function () {
        var c = document.querySelector("[name='select-all']"),
            n = document.querySelectorAll("[name='check']"),
            // Masalah terjadi di baris berikut
            e =
                (c?.addEventListener("change", function () {
                    var t = c.checked;
                    n.forEach(function (e) {
                        e.checked = t;
                    });
                }),
                n.forEach(function (e) {
                    e.addEventListener("click", function () {
                        var e = n.length,
                            t = document.querySelectorAll(
                                "[name='check']:checked"
                            ).length;
                        t <= 0
                            ? ((c.checked = !1), (c.indeterminate = !1))
                            : e === t
                            ? ((c.checked = !0), (c.indeterminate = !1))
                            : ((c.checked = !0), (c.indeterminate = !0));
                    });
                }),
                document.querySelectorAll("table > thead > tr > th"));

        // Error pada baris ini - 'th' belum didefinisikan dengan benar
        // th.querySelector("button:first-child"));

        // Perbaikan: Periksa apakah ada elemen th dan gunakan elemen pertama
        if (e && e.length > 0) {
            const firstTh = e[0];
            const firstButton = firstTh.querySelector("button:first-child");
            if (firstButton) {
                firstButton.classList.remove("datatable-sorter");
            }
        }
    });

    // Bagian ini juga bisa menyebabkan error jika elemen tidak ditemukan
    const checkboxButton = document.querySelector(
        ".checkbox-all thead tr th:first-child button"
    );
    if (checkboxButton) {
        checkboxButton.classList.remove("datatable-sorter");
    }
} catch (e) {
    console.error("Error in datatable initialization:", e);
}
