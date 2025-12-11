"use client";

import { createRoot } from "react-dom/client";
import SpotlightCard from "./components/SpotlightCard.jsx";

function Benefit({ title, desc, icon }) {
    return (
        <div className="flex flex-col">
            <div className="mb-3 inline-flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-500/10 text-indigo-400">
                {icon}
            </div>
            <h3 className="text-base font-semibold text-white">{title}</h3>
            <p className="mt-1 text-sm text-slate-300">{desc}</p>
        </div>
    );
}

function ShieldIcon() {
    return (
        <svg
            className="h-5 w-5"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            strokeWidth="2"
            strokeLinecap="round"
            strokeLinejoin="round"
            aria-hidden
        >
            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
        </svg>
    );
}
function CheckIcon() {
    return (
        <svg
            className="h-5 w-5"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            strokeWidth="2"
            strokeLinecap="round"
            strokeLinejoin="round"
            aria-hidden
        >
            <path d="M5 13l4 4L19 7" />
        </svg>
    );
}
function GridIcon() {
    return (
        <svg
            className="h-5 w-5"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            strokeWidth="2"
            strokeLinecap="round"
            strokeLinejoin="round"
            aria-hidden
        >
            <path d="M3 3h7v7H3zM14 3h7v7h-7zM14 14h7v7h-7zM3 14h7v7H3z" />
        </svg>
    );
}
function BoltIcon() {
    return (
        <svg
            className="h-5 w-5"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            strokeWidth="2"
            strokeLinecap="round"
            strokeLinejoin="round"
            aria-hidden
        >
            <path d="M22 12h-4l-3 9L9 3 6 12H2" />
        </svg>
    );
}

function BenefitsGrid() {
    const items = [
        {
            title: "All‑risk coverage",
            desc: "Drive with peace of mind with comprehensive insurance on every booking.",
            icon: <ShieldIcon />,
        },
        {
            title: "Transparent pricing",
            desc: "No surprises at checkout—what you see is what you pay.",
            icon: <CheckIcon />,
        },
        {
            title: "Flexible pickup",
            desc: "Choose airports, city hubs, or door‑to‑door delivery in select areas.",
            icon: <GridIcon />,
        },
        {
            title: "Top‑rated fleet",
            desc: "From efficient EVs to luxury SUVs, all impeccably maintained.",
            icon: <BoltIcon />,
        },
    ];

    return (
        <section
            id="benefits"
            className="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:py-16"
        >
            <div className="grid gap-8 md:grid-cols-4">
                {items.map((it, i) => (
                    <SpotlightCard
                        key={i}
                        className="bg-neutral-900/90 border-neutral-800"
                    >
                        <Benefit
                            title={it.title}
                            desc={it.desc}
                            icon={it.icon}
                        />
                    </SpotlightCard>
                ))}
            </div>
        </section>
    );
}

function mountBenefits() {
    const el = document.getElementById("react-benefits");
    if (!el) return;
    const root = createRoot(el);
    root.render(<BenefitsGrid />);
}

document.addEventListener("DOMContentLoaded", mountBenefits);
