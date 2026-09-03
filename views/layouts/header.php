<!DOCTYPE html>

<html class="scroll-smooth" dir="ltr" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Verdant Café &amp; Lounge</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600&amp;family=Playfair+Display:wght@600;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "surface-container-lowest": "#ffffff",
                        "deep-forest": "#3d532b",
                        "on-tertiary": "#ffffff",
                        "secondary": "#526438",
                        "on-error": "#ffffff",
                        "on-secondary-container": "#586a3e",
                        "on-surface-variant": "#44483f",
                        "on-error-container": "#93000a",
                        "primary-container": "#546b41",
                        "on-secondary-fixed-variant": "#3b4c23",
                        "on-secondary-fixed": "#111f00",
                        "inverse-on-surface": "#f7f0e4",
                        "on-primary-fixed-variant": "#374d26",
                        "on-tertiary-container": "#f1e0bf",
                        "outline-variant": "#c4c8bb",
                        "on-primary-container": "#d0ebb6",
                        "on-surface": "#1e1b14",
                        "on-primary": "#ffffff",
                        "on-primary-fixed": "#0d2001",
                        "champagne-glint": "#f1e1c0",
                        "error": "#ba1a1a",
                        "on-background": "#1e1b14",
                        "primary-fixed": "#d0ebb7",
                        "surface": "#fff9ef",
                        "primary-fixed-dim": "#b5cf9c",
                        "surface-container-low": "#faf3e7",
                        "surface-container-highest": "#e8e2d6",
                        "surface-container": "#f4ede1",
                        "tertiary-fixed-dim": "#d5c5a5",
                        "soft-sage": "#b5cf9c",
                        "surface-variant": "#e8e2d6",
                        "secondary-fixed-dim": "#b9ce98",
                        "secondary-fixed": "#d5eab2",
                        "on-secondary": "#ffffff",
                        "surface-tint": "#4e653c",
                        "inverse-surface": "#333028",
                        "surface-dim": "#e0d9ce",
                        "secondary-container": "#d5eab2",
                        "surface-container-high": "#eee7dc",
                        "outline": "#74796e",
                        "tertiary": "#564b33",
                        "on-tertiary-fixed-variant": "#50462d",
                        "on-tertiary-fixed": "#231b06",
                        "error-container": "#ffdad6",
                        "inverse-primary": "#b5cf9c",
                        "tertiary-container": "#6f6349",
                        "primary": "#3d532b",
                        "tertiary-fixed": "#f1e1c0",
                        "surface-bright": "#fff9ef",
                        "background": "#fff9ef"
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    spacing: {
                        "container-max": "1280px",
                        "gutter": "24px",
                        "base": "8px",
                        "margin-desktop": "64px",
                        "section-gap": "96px",
                        "margin-mobile": "16px"
                    },
                    fontFamily: {
                        "body-md": ["Montserrat"],
                        "label-sm": ["Montserrat"],
                        "body-lg": ["Montserrat"],
                        "headline-lg": ["Playfair Display"],
                        "headline-md": ["Playfair Display"],
                        "display-lg": ["Playfair Display"],
                        "label-md": ["Montserrat"],
                        "headline-lg-mobile": ["Playfair Display"]
                    },
                    fontSize: {
                        "body-md": ["16px", { lineHeight: "24px", fontWeight: "400" }],
                        "label-sm": ["12px", { lineHeight: "14px", letterSpacing: "0.03em", fontWeight: "500" }],
                        "body-lg": ["18px", { lineHeight: "28px", fontWeight: "400" }],
                        "headline-lg": ["40px", { lineHeight: "48px", fontWeight: "600" }],
                        "headline-md": ["28px", { lineHeight: "36px", fontWeight: "600" }],
                        "display-lg": ["56px", { lineHeight: "62px", letterSpacing: "-0.02em", fontWeight: "700" }],
                        "label-md": ["14px", { lineHeight: "16px", letterSpacing: "0.05em", fontWeight: "600" }],
                        "headline-lg-mobile": ["32px", { lineHeight: "38px", fontWeight: "600" }]
                    }
                }
            }
        }
    </script>
<style>
        .reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s ease-out;
        }
        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }
        .glass-card {
            background: rgba(255, 249, 239, 0.6);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(220, 204, 172, 0.4);
            box-shadow: 0 4px 30px rgba(84, 107, 65, 0.05);
        }
        .ghost-border {
            border: 1px solid rgba(220, 204, 172, 0.4);
        }
    </style>
</head>
<body class="bg-surface text-on-surface font-body-md antialiased overflow-x-hidden">