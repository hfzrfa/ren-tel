"use client";

import React from "react";
import { createRoot } from "react-dom/client";
import TiltedCard from "./components/ui/TiltedCard";

function mountHeroTiltedCard() {
    const el = document.getElementById("react-hero-tilted-card");
    if (!el) return;

    const imageSrc = (el as HTMLElement).dataset.imageSrc || "/images/pict1.jpg";
    const caption = (el as HTMLElement).dataset.caption || "Premium rental car";

    const root = createRoot(el);
    root.render(
        <TiltedCard
            imageSrc={imageSrc}
            altText={caption}
            captionText={caption}
            containerHeight="320px"
            containerWidth="100%"
            imageHeight="320px"
            imageWidth="100%"
            scaleOnHover={1.05}
            rotateAmplitude={14}
            showMobileWarning={false}
            showTooltip={true}
        />
    );
}

document.addEventListener("DOMContentLoaded", mountHeroTiltedCard);
