<?php
// index.php

// تعريف الثوابت في الأعلى
define('BASE_URL', 'http://localhost/project/');
define('ASSETS_URL', BASE_URL . 'assets/');

?>
<!DOCTYPE html>

<html class="scroll-smooth" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Verdant Café &amp; Lounge | Home</title>
<link rel="stylesheet" href="<?php echo ASSETS_URL; ?>css/styles.css">

<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com" rel="preconnect"/>
<link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500&amp;family=Playfair+Display:wght@400;600&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "surface-variant": "#e8e2d6",
                        "primary-container": "#3d532b",
                        "on-primary-container": "#acc693",
                        "error-container": "#ffdad6",
                        "surface-container-high": "#eee7dc",
                        "surface-container": "#f4ede1",
                        "surface-bright": "#fff9ef",
                        "inverse-on-surface": "#f7f0e4",
                        "outline-variant": "#c4c8bb",
                        "primary-fixed": "#d0ebb6",
                        "on-error-container": "#93000a",
                        "deep-forest": "#3D532B",
                        "tertiary-fixed-dim": "#d3c5ad",
                        "inverse-surface": "#333028",
                        "outline": "#74796d",
                        "on-tertiary-container": "#cabca4",
                        "primary": "#273c16",
                        "error": "#ba1a1a",
                        "tertiary": "#3e3524",
                        "on-secondary-fixed": "#241a00",
                        "on-primary": "#ffffff",
                        "on-tertiary-fixed": "#221b0b",
                        "secondary": "#735c00",
                        "surface-dim": "#e0d9ce",
                        "on-error": "#ffffff",
                        "on-secondary-container": "#745c00",
                        "background": "#fff9ef",
                        "surface-tint": "#4e653b",
                        "surface": "#fff9ef",
                        "tertiary-container": "#554b39",
                        "on-tertiary": "#ffffff",
                        "on-surface": "#1e1b14",
                        "on-surface-variant": "#44483e",
                        "secondary-fixed": "#ffe088",
                        "surface-container-lowest": "#ffffff",
                        "on-primary-fixed": "#0d2001",
                        "cream-surface": "#FFF8EC",
                        "on-background": "#1e1b14",
                        "on-primary-fixed-variant": "#374d26",
                        "surface-container-highest": "#e8e2d6",
                        "secondary-fixed-dim": "#e9c349",
                        "champagne-glint": "#F7E7CE",
                        "inverse-primary": "#b4cf9c",
                        "surface-container-low": "#faf3e7",
                        "on-secondary": "#ffffff",
                        "secondary-container": "#fed65b",
                        "primary-fixed-dim": "#b4cf9c",
                        "on-tertiary-fixed-variant": "#4f4533",
                        "tertiary-fixed": "#f0e0c8",
                        "on-secondary-fixed-variant": "#574500",
                        "royal-gold": "#D4AF37"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.125rem",
                        "lg": "0.25rem",
                        "xl": "0.5rem",
                        "full": "0.75rem"
                    },
                    "spacing": {
                        "gutter": "32px",
                        "section-gap": "128px",
                        "element-gap": "24px",
                        "margin-desktop": "80px",
                        "margin-mobile": "24px"
                    },
                    "fontFamily": {
                        "body-md": ["Montserrat"],
                        "headline-lg": ["Playfair Display"],
                        "label-md": ["Montserrat"],
                        "body-lg": ["Montserrat"],
                        "subheading-caps": ["Playfair Display"],
                        "headline-lg-mobile": ["Playfair Display"],
                        "display-lg": ["Playfair Display"]
                    },
                    "fontSize": {
                        "body-md": ["16px", { "lineHeight": "28px", "fontWeight": "300" }],
                        "headline-lg": ["40px", { "lineHeight": "48px", "letterSpacing": "0.02em", "fontWeight": "400" }],
                        "label-md": ["12px", { "lineHeight": "16px", "letterSpacing": "0.15em", "fontWeight": "500" }],
                        "body-lg": ["18px", { "lineHeight": "32px", "fontWeight": "300" }],
                        "subheading-caps": ["15px", { "lineHeight": "24px", "letterSpacing": "0.1em", "fontWeight": "400" }],
                        "headline-lg-mobile": ["32px", { "lineHeight": "40px", "fontWeight": "400" }],
                        "display-lg": ["64px", { "lineHeight": "72px", "letterSpacing": "-0.01em", "fontWeight": "400" }]
                    }
                }
            }
        }
    </script>
<style>
        .divider-diamond::before, .divider-diamond::after {
            content: '';
            display: inline-block;
            width: 40px;
            height: 1px;
            background-color: rgba(212, 175, 55, 0.3);
            vertical-align: middle;
            margin: 0 16px;
        }
    </style>
    <link rel="stylesheet" href="<?php echo ASSETS_URL; ?>css/styles.css">
</head>