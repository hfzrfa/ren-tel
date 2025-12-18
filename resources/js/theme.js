const STORAGE_KEY = "rentel-theme";
const mediaQuery = window.matchMedia("(prefers-color-scheme: dark)");

const readStoredTheme = () => {
    try {
        const stored = localStorage.getItem(STORAGE_KEY);
        if (stored === "dark" || stored === "light") {
            return stored;
        }
    } catch (_err) {
        /* ignore storage errors */
    }
    return null;
};

const resolveTheme = () => {
    const stored = readStoredTheme();
    if (stored) return stored;
    if (document.documentElement.dataset.theme === "dark") return "dark";
    return mediaQuery.matches ? "dark" : "light";
};

const updateThemeColorMeta = (theme) => {
    const meta = document.querySelector('meta[name="theme-color"]');
    if (!meta) return;
    const content = theme === "dark" ? "#0B1220" : "#F4F4F4";
    meta.setAttribute("content", content);
};

export const applyTheme = (theme, { persist = true } = {}) => {
    const mode = theme === "dark" ? "dark" : "light";
    const root = document.documentElement;
    root.classList.toggle("dark", mode === "dark");
    root.dataset.theme = mode;
    root.style.colorScheme = mode;
    if (persist) {
        try {
            localStorage.setItem(STORAGE_KEY, mode);
        } catch (_err) {
            /* ignore storage errors */
        }
    }
    updateThemeColorMeta(mode);

    document.querySelectorAll("[data-theme-toggle]").forEach((button) => {
        button.setAttribute("aria-pressed", mode === "dark" ? "true" : "false");
        const sun = button.querySelector('[data-theme-icon="light"]');
        const moon = button.querySelector('[data-theme-icon="dark"]');
        if (sun) sun.classList.toggle("hidden", mode !== "light");
        if (moon) moon.classList.toggle("hidden", mode !== "dark");
        const label = button.querySelector("[data-theme-label]");
        if (label) {
            label.textContent =
                mode === "dark" ? "Switch to light mode" : "Switch to dark mode";
        }
    });
};

const toggleTheme = () => {
    const next = document.documentElement.dataset.theme === "dark" ? "light" : "dark";
    applyTheme(next);
};

// Apply as early as possible
const initial = resolveTheme();
applyTheme(initial, { persist: Boolean(readStoredTheme()) });

const bindToggles = () => {
    document.addEventListener(
        "click",
        (event) => {
            const button = event.target.closest("[data-theme-toggle]");
            if (!button) return;
            toggleTheme();
        },
        { passive: true }
    );
};

if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", bindToggles, { once: true });
} else {
    bindToggles();
}

mediaQuery.addEventListener("change", (event) => {
    if (readStoredTheme()) return;
    applyTheme(event.matches ? "dark" : "light", { persist: false });
});
