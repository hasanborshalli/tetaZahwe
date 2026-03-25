/* ================================================================
   TETA ZAHWE — Admin Panel JavaScript
   ================================================================ */

document.addEventListener("DOMContentLoaded", () => {
    /* ── 1. Mobile sidebar toggle ────────────────────────────── */
    const toggle = document.getElementById("sidebarToggle");
    const sidebar = document.querySelector(".sidebar");
    const overlay = document.getElementById("sidebarOverlay");

    function openSidebar() {
        sidebar?.classList.add("open");
        overlay?.classList.add("active");
        document.body.style.overflow = "hidden";
    }
    function closeSidebar() {
        sidebar?.classList.remove("open");
        overlay?.classList.remove("active");
        document.body.style.overflow = "";
    }

    toggle?.addEventListener("click", () => {
        sidebar?.classList.contains("open") ? closeSidebar() : openSidebar();
    });
    overlay?.addEventListener("click", closeSidebar);

    // Close sidebar when a nav link is clicked on mobile
    sidebar?.querySelectorAll(".sidebar-link").forEach((link) => {
        link.addEventListener("click", () => {
            if (window.innerWidth <= 1024) closeSidebar();
        });
    });

    /* ── 2. Flash message auto-dismiss ──────────────────────── */
    document.querySelectorAll(".admin-flash").forEach((el) => {
        setTimeout(() => {
            el.style.transition = "opacity 0.4s ease";
            el.style.opacity = "0";
            setTimeout(() => el.remove(), 400);
        }, 5000);
    });

    /* ── 3. Delete form confirmation ─────────────────────────── */
    document.querySelectorAll(".delete-form").forEach((form) => {
        form.addEventListener("submit", (e) => {
            if (!confirm("Are you sure you want to delete this?")) {
                e.preventDefault();
            }
        });
    });

    /* ── 4. Bulk dish form — loading state ───────────────────── */
    document.querySelectorAll(".bulk-dish-form").forEach((form) => {
        form.addEventListener("submit", function (e) {
            const inputs = this.querySelectorAll("input[name*='[name_ar]']");
            const hasValue = Array.from(inputs).some(
                (i) => i.value.trim() !== "",
            );

            if (!hasValue) {
                e.preventDefault();
                alert("Please enter at least one dish name before saving.");
                return;
            }

            const btn = this.querySelector(".admin-btn-primary");
            if (btn) {
                btn.textContent = "Saving...";
                btn.disabled = true;
            }
        });
    });
});
