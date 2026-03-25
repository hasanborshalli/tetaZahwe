/* ================================================================
   TETA ZAHWE CATERING — Main JavaScript (Clean)
   ================================================================ */

document.addEventListener("DOMContentLoaded", () => {
    /* ── 1. Navbar scroll shadow ─────────────────────────────── */
    const navbar = document.getElementById("navbar");
    if (navbar) {
        window.addEventListener(
            "scroll",
            () => {
                navbar.classList.toggle("scrolled", window.scrollY > 40);
            },
            { passive: true },
        );
    }

    /* ── 2. Hamburger / mobile menu ──────────────────────────── */
    const hamburger = document.getElementById("navHamburger");
    const mobileMenu = document.getElementById("navMobile");

    if (hamburger && mobileMenu) {
        // Toggle on hamburger click
        hamburger.addEventListener("click", (e) => {
            e.stopPropagation();
            const isOpen = mobileMenu.classList.toggle("open");
            hamburger.classList.toggle("is-open", isOpen);
            hamburger.setAttribute("aria-expanded", String(isOpen));
        });

        // Close when a mobile link is clicked
        mobileMenu.querySelectorAll("a").forEach((link) => {
            link.addEventListener("click", () => {
                mobileMenu.classList.remove("open");
                hamburger.classList.remove("is-open");
                hamburger.setAttribute("aria-expanded", "false");
            });
        });

        // Close when clicking anywhere outside the navbar
        document.addEventListener("click", (e) => {
            if (navbar && !navbar.contains(e.target)) {
                mobileMenu.classList.remove("open");
                hamburger.classList.remove("is-open");
                hamburger.setAttribute("aria-expanded", "false");
            }
        });
    }

    /* ── 3. Smooth scroll for anchor links ───────────────────── */
    document.querySelectorAll('a[href*="#"]').forEach((link) => {
        link.addEventListener("click", (e) => {
            const href = link.getAttribute("href") || "";
            const hash = href.includes("#") ? "#" + href.split("#")[1] : null;
            if (!hash || hash === "#") return;
            const target = document.querySelector(hash);
            if (target) {
                e.preventDefault();
                window.scrollTo({
                    top:
                        target.getBoundingClientRect().top +
                        window.scrollY -
                        90,
                    behavior: "smooth",
                });
            }
        });
    });

    /* ── 4. Active nav ───────────────────────────────────────── */
    const navLinks = document.querySelectorAll(".nav-links a");
    const mobileLinks = document.querySelectorAll(".nav-mobile a");
    const path = window.location.pathname;

    function setActiveLink(links) {
        links.forEach((link) => {
            const href = link.getAttribute("href") || "";
            let active = false;

            if (!href.includes("#")) {
                // Extract just the pathname from the href (handles full URLs and relative paths)
                let linkPath = href;
                try {
                    linkPath = new URL(href, window.location.origin).pathname;
                } catch (e) {}

                if (linkPath === "/" || linkPath === "") {
                    active = path === "/";
                } else {
                    active =
                        path === linkPath || path.startsWith(linkPath + "/");
                }
            }

            link.classList.toggle("active", active);
        });
    }

    // Set page-based active immediately
    setActiveLink(navLinks);
    setActiveLink(mobileLinks);

    // Scroll spy — only run on homepage (path === "/")
    if (path === "/") {
        function updateScrollSpy() {
            let currentId = "";
            document.querySelectorAll("section[id]").forEach((sec) => {
                if (window.scrollY >= sec.offsetTop - 160) currentId = sec.id;
            });

            navLinks.forEach((link) => {
                const href = link.getAttribute("href") || "";
                if (!href.includes("#")) return; // skip page links
                const anchorId = href.split("#")[1];
                link.classList.toggle(
                    "active",
                    anchorId === currentId && currentId !== "",
                );
            });
        }
        window.addEventListener("scroll", updateScrollSpy, { passive: true });
        updateScrollSpy();
    }

    /* ── 5. Hero stagger entrance ────────────────────────────── */
    document.querySelectorAll(".hero-animate").forEach((el, i) => {
        el.style.transitionDelay = `${i * 0.15}s`;
        requestAnimationFrame(() =>
            requestAnimationFrame(() => {
                el.style.opacity = "1";
                el.style.transform = "translateY(0)";
            }),
        );
    });

    /* ── 6. Ticker duplicate for seamless loop ───────────────── */
    const ticker = document.querySelector(".ticker-track");
    if (ticker) ticker.innerHTML += ticker.innerHTML;

    /* ── 7. Flash message auto-dismiss ───────────────────────── */
    const flash = document.getElementById("flashMsg");
    if (flash) {
        setTimeout(() => {
            flash.style.transition = "opacity 0.4s ease, transform 0.4s ease";
            flash.style.opacity = "0";
            flash.style.transform = "translateX(20px)";
            setTimeout(() => flash.remove(), 400);
        }, 4500);
    }

    /* ── 8. Today's card — JS date double-check ─────────────── */
    // Primary logic is in PHP/Blade via .is-today class.
    // This also checks via data-date attribute as a fallback.
    const todayStr = new Date().toISOString().slice(0, 10);
    document.querySelectorAll(".day-card[data-date]").forEach((card) => {
        const isToday = card.dataset.date === todayStr;
        if (isToday && !card.classList.contains("is-today")) {
            card.classList.add("is-today");
        }
        if (!isToday && card.classList.contains("is-today")) {
            card.classList.remove("is-today");
        }
    });

    /* ── 9. Contact form submit loading state ────────────────── */
    const contactForm = document.getElementById("contactForm");
    if (contactForm) {
        contactForm.addEventListener("submit", () => {
            const btn = contactForm.querySelector(".form-submit");
            if (btn) {
                btn.textContent = "Sending...";
                btn.disabled = true;
                btn.style.opacity = "0.7";
            }
        });
    }

    /* ── 10. Scroll reveal ───────────────────────────────────── */
    const revealEls = document.querySelectorAll("[data-reveal]");
    if (revealEls.length) {
        const style = document.createElement("style");
        style.textContent = `
            [data-reveal]{opacity:0;transform:translateY(28px);transition:opacity .7s ease,transform .7s ease}
            [data-reveal="left"]{transform:translateX(-28px)}
            [data-reveal="right"]{transform:translateX(28px)}
            [data-reveal="scale"]{transform:scale(.96)}
            [data-reveal].visible{opacity:1!important;transform:none!important}
            [data-stagger-item]{opacity:0;transform:translateY(20px);transition:opacity .6s ease,transform .6s ease}
            [data-stagger-item].visible{opacity:1;transform:none}
        `;
        document.head.appendChild(style);

        new IntersectionObserver(
            (entries, obs) => {
                entries.forEach((e) => {
                    if (e.isIntersecting) {
                        const delay = parseInt(
                            e.target.dataset.delay || "0",
                            10,
                        );
                        setTimeout(
                            () => e.target.classList.add("visible"),
                            delay,
                        );
                        obs.unobserve(e.target);
                    }
                });
            },
            { threshold: 0.12 },
        ).observe
            ? (function () {
                  const obs = new IntersectionObserver(
                      (entries, o) => {
                          entries.forEach((e) => {
                              if (e.isIntersecting) {
                                  const d = parseInt(
                                      e.target.dataset.delay || "0",
                                      10,
                                  );
                                  setTimeout(
                                      () => e.target.classList.add("visible"),
                                      d,
                                  );
                                  o.unobserve(e.target);
                              }
                          });
                      },
                      { threshold: 0.12 },
                  );
                  revealEls.forEach((el) => obs.observe(el));
              })()
            : null;
    }

    /* ── 11. Stagger groups ───────────────────────────────────── */
    document.querySelectorAll("[data-stagger]").forEach((group) => {
        new IntersectionObserver(
            (entries, obs) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        entry.target
                            .querySelectorAll("[data-stagger-item]")
                            .forEach((child, i) => {
                                setTimeout(
                                    () => child.classList.add("visible"),
                                    i * 120,
                                );
                            });
                        obs.unobserve(entry.target);
                    }
                });
            },
            { threshold: 0.1 },
        ).observe(group);
    });
});
