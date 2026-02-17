
import { tsParticles } from "@tsparticles/engine";
import { loadSlim } from "@tsparticles/slim";

export async function loadParticles(id) {
    await loadSlim(tsParticles);

    await tsParticles.load({
        id: id,
        options: {
            background: {
                color: {
                    value: "transparent",
                },
            },
            fpsLimit: 120,
            interactivity: {
                events: {
                    onClick: {
                        enable: true,
                        mode: "push",
                    },
                    onHover: {
                        enable: true,
                        mode: "grab",
                        parallax: {
                            enable: true,
                            force: 60,
                            smooth: 10
                        }
                    },
                    resize: true,
                },
                modes: {
                    push: {
                        quantity: 4,
                    },
                    grab: {
                        distance: 140,
                        links: {
                            opacity: 0.5,
                        },
                    },
                },
            },
            particles: {
                color: {
                    value: "#10b981", // Emerald 500
                },
                links: {
                    color: "#10b981", // Emerald 500
                    distance: 150,
                    enable: true,
                    opacity: 0.1, // Slightly more visible opacity
                    width: 1.5, // Thicker lines
                },
                move: {
                    direction: "none",
                    enable: true,
                    outModes: {
                        default: "bounce",
                    },
                    random: false,
                    speed: 0.8, // Slightly faster to match the weight
                    straight: false,
                },
                number: {
                    density: {
                        enable: true,
                        area: 800,
                    },
                    value: 60, // Back to original density (less crowded if dots are bigger)
                },
                opacity: {
                    value: 0.5, // clearer dots
                },
                shape: {
                    type: "circle",
                },
                size: {
                    value: { min: 2, max: 4 }, // Larger dots
                },
            },
            detectRetina: true,
        },
    });
}
