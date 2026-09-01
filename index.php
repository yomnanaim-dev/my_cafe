<?php require("views/layouts/header.php"); ?>
<?php require("views/layouts/navbar.php"); ?>
<!DOCTYPE html>

<html class="light" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Verdant Café &amp; Lounge - Menu</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500&amp;family=Playfair+Display:wght@400;600;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "surface-container-highest": "#e8e2d6",
                        "cream-surface": "#FFF8EC",
                        "on-primary-fixed-variant": "#374d26",
                        "surface-dim": "#e0d9ce",
                        "primary-fixed": "#d0ebb6",
                        "outline-variant": "#c4c8bb",
                        "on-surface-variant": "#44483e",
                        "secondary-fixed-dim": "#e9c349",
                        "champagne-glint": "#F7E7CE",
                        "surface": "#fff9ef",
                        "royal-gold": "#D4AF37",
                        "inverse-on-surface": "#f7f0e4",
                        "background": "#fff9ef",
                        "surface-bright": "#fff9ef",
                        "on-secondary-fixed-variant": "#574500",
                        "primary": "#273c16",
                        "surface-container-low": "#faf3e7",
                        "surface-container-lowest": "#ffffff",
                        "surface-container-high": "#eee7dc",
                        "tertiary-fixed-dim": "#d3c5ad",
                        "on-tertiary-container": "#cabca4",
                        "primary-fixed-dim": "#b4cf9c",
                        "outline": "#74796d",
                        "on-background": "#1e1b14",
                        "on-primary-container": "#acc693",
                        "surface-container": "#f4ede1",
                        "error": "#ba1a1a",
                        "on-secondary-container": "#745c00",
                        "on-surface": "#1e1b14",
                        "on-error-container": "#93000a",
                        "tertiary-container": "#554b39",
                        "on-tertiary-fixed-variant": "#4f4533",
                        "on-tertiary": "#ffffff",
                        "deep-forest": "#3D532B",
                        "error-container": "#ffdad6",
                        "on-primary": "#ffffff",
                        "secondary": "#735c00",
                        "surface-variant": "#e8e2d6",
                        "inverse-primary": "#b4cf9c",
                        "surface-tint": "#4e653b",
                        "on-secondary-fixed": "#241a00",
                        "inverse-surface": "#333028",
                        "on-secondary": "#ffffff",
                        "tertiary": "#3e3524",
                        "tertiary-fixed": "#f0e0c8",
                        "on-primary-fixed": "#0d2001",
                        "on-tertiary-fixed": "#221b0b",
                        "on-error": "#ffffff",
                        "secondary-fixed": "#ffe088",
                        "primary-container": "#3d532b",
                        "secondary-container": "#fed65b"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.125rem",
                        "lg": "0.25rem",
                        "xl": "0.5rem",
                        "full": "0.75rem"
                    },
                    "spacing": {
                        "gutter": "32px",
                        "margin-desktop": "80px",
                        "element-gap": "24px",
                        "section-gap": "128px",
                        "margin-mobile": "24px"
                    },
                    "fontFamily": {
                        "subheading-caps": ["Playfair Display"],
                        "headline-lg-mobile": ["Playfair Display"],
                        "label-md": ["Montserrat"],
                        "display-lg": ["Playfair Display"],
                        "headline-lg": ["Playfair Display"],
                        "body-md": ["Montserrat"],
                        "body-lg": ["Montserrat"]
                    },
                    "fontSize": {
                        "subheading-caps": ["16px", { "lineHeight": "24px", "letterSpacing": "0.2em", "fontWeight": "600" }],
                        "headline-lg-mobile": ["32px", { "lineHeight": "40px", "fontWeight": "400" }],
                        "label-md": ["12px", { "lineHeight": "16px", "letterSpacing": "0.15em", "fontWeight": "500" }],
                        "display-lg": ["64px", { "lineHeight": "72px", "letterSpacing": "-0.01em", "fontWeight": "400" }],
                        "headline-lg": ["40px", { "lineHeight": "48px", "letterSpacing": "0.02em", "fontWeight": "400" }],
                        "body-md": ["16px", { "lineHeight": "28px", "fontWeight": "300" }],
                        "body-lg": ["18px", { "lineHeight": "32px", "fontWeight": "300" }]
                    }
                }
            }
        }
    </script>
<style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background-color: #D4AF37;
            border-radius: 10px;
        }
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</head>
<body class="bg-surface text-on-surface font-body-md antialiased min-h-screen flex flex-col md:flex-row overflow-x-hidden">
<!-- Mobile Top Header (Hidden on Desktop) -->
<header class="md:hidden flex justify-between items-center px-margin-mobile h-24 border-b border-royal-gold/30 bg-surface z-50 sticky top-0 w-full">
<h1 class="font-headline-lg-mobile text-headline-lg-mobile text-primary tracking-widest uppercase">Verdant</h1>
<button class="text-primary p-2 focus:outline-none">
<span class="material-symbols-outlined" style="font-size: 28px;">shopping_bag</span>
</button>
</header>
<!-- Side Navigation (Desktop) -->
<nav class="hidden md:flex flex-col fixed left-0 top-0 h-screen w-80 bg-cream-surface border-r border-royal-gold/20 py-margin-desktop z-40 transition-transform duration-200">
<div class="px-gutter mb-16 text-center">
<div class="w-16 h-16 mx-auto mb-6 rounded-full border border-royal-gold flex items-center justify-center bg-champagne-glint/20">
<span class="material-symbols-outlined text-royal-gold text-3xl">local_florist</span>
</div>
<h1 class="font-subheading-caps text-subheading-caps text-royal-gold mb-2 uppercase tracking-widest">Verdant Menu</h1>
<p class="font-label-md text-label-md text-on-surface-variant uppercase tracking-widest">Exquisite Selection</p>
</div>
<div class="flex-grow px-8 flex flex-col gap-4 overflow-y-auto custom-scrollbar">
<a class="flex items-center gap-4 px-6 py-4 text-on-primary-fixed-variant bg-primary-fixed/30 rounded-full font-label-md text-label-md uppercase tracking-widest transition-colors" href="#">
<span class="material-symbols-outlined text-xl">coffee</span>
<span>Coffee</span>
</a>
<a class="flex items-center gap-4 px-6 py-4 text-on-surface-variant hover:text-primary hover:bg-champagne-glint/50 rounded-full font-label-md text-label-md uppercase tracking-widest transition-colors" href="#">
<span class="material-symbols-outlined text-xl">redeem</span>
<span>Tea</span>
</a>
<a class="flex items-center gap-4 px-6 py-4 text-on-surface-variant hover:text-primary hover:bg-champagne-glint/50 rounded-full font-label-md text-label-md uppercase tracking-widest transition-colors" href="#">
<span class="material-symbols-outlined text-xl">bakery_dining</span>
<span>Pastries</span>
</a>
<a class="flex items-center gap-4 px-6 py-4 text-on-surface-variant hover:text-primary hover:bg-champagne-glint/50 rounded-full font-label-md text-label-md uppercase tracking-widest transition-colors" href="#">
<span class="material-symbols-outlined text-xl">set_meal</span>
<span>Light Bites</span>
</a>
<a class="flex items-center gap-4 px-6 py-4 text-on-surface-variant hover:text-primary hover:bg-champagne-glint/50 rounded-full font-label-md text-label-md uppercase tracking-widest transition-colors" href="#">
<span class="material-symbols-outlined text-xl">liquor</span>
<span>Spirits</span>
</a>
</div>
<div class="px-gutter mt-auto pt-8">
<button class="w-full py-4 border border-royal-gold text-royal-gold font-label-md text-label-md uppercase tracking-widest hover:bg-royal-gold hover:text-surface transition-colors flex justify-center items-center gap-2">
<span class="material-symbols-outlined text-sm">shopping_bag</span>
                View Cart (3)
            </button>
</div>
</nav>
<!-- Mobile Bottom Navigation -->
<nav class="md:hidden fixed bottom-0 left-0 w-full bg-surface border-t border-royal-gold/30 flex justify-around items-center h-20 z-50 px-4 shadow-[0_-4px_24px_rgba(39,60,22,0.05)]">
<a class="flex flex-col items-center gap-1 text-primary p-2" href="#">
<span class="material-symbols-outlined text-2xl" style="font-variation-settings: 'FILL' 1;">coffee</span>
<span class="font-label-md text-[10px] uppercase tracking-wider">Coffee</span>
</a>
<a class="flex flex-col items-center gap-1 text-on-surface-variant p-2 hover:text-primary transition-colors" href="#">
<span class="material-symbols-outlined text-2xl">redeem</span>
<span class="font-label-md text-[10px] uppercase tracking-wider">Tea</span>
</a>
<a class="flex flex-col items-center gap-1 text-on-surface-variant p-2 hover:text-primary transition-colors" href="#">
<span class="material-symbols-outlined text-2xl">bakery_dining</span>
<span class="font-label-md text-[10px] uppercase tracking-wider">Pastries</span>
</a>
<a class="flex flex-col items-center gap-1 text-on-surface-variant p-2 hover:text-primary transition-colors" href="#">
<span class="material-symbols-outlined text-2xl">set_meal</span>
<span class="font-label-md text-[10px] uppercase tracking-wider">Bites</span>
</a>
</nav>
<!-- Main Content Area -->
<main class="flex-grow md:ml-80 flex flex-col xl:flex-row min-h-screen pb-24 md:pb-0">
<!-- Canvas: Menu Grid -->
<div class="flex-grow px-margin-mobile md:px-margin-desktop py-12 md:py-margin-desktop w-full xl:w-2/3 max-w-[1000px] mx-auto xl:mx-0">
<div class="mb-16 text-center md:text-left">
<h2 class="font-display-lg text-display-lg text-primary mb-4">Coffee &amp; Espresso</h2>
<div class="flex items-center justify-center md:justify-start gap-4">
<div class="h-px bg-royal-gold/30 w-12"></div>
<span class="material-symbols-outlined text-royal-gold text-sm">diamond</span>
<div class="h-px bg-royal-gold/30 flex-grow max-w-[200px]"></div>
</div>
<p class="font-body-lg text-body-lg text-on-surface-variant mt-6 max-w-2xl">Expertly sourced beans, roasted to highlight their intrinsic character. Served with meticulous precision.</p>
</div>
<!-- Bento Grid layout for menu items -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-element-gap">
<!-- Menu Item Card 1 (Hero/Featured) -->
<div class="md:col-span-2 flex flex-col md:flex-row gap-8 items-center bg-cream-surface border border-champagne-glint p-6 rounded-sm hover:shadow-[0_8px_32px_rgba(61,83,43,0.03)] transition-all duration-300">
<div class="w-full md:w-1/2 aspect-[4/3] md:aspect-square lg:aspect-[4/3] relative overflow-hidden p-2">
<div class="absolute inset-2 border border-royal-gold/20 z-10 pointer-events-none"></div>
<img alt="Signature Verdant Espresso" class="w-full h-full object-cover grayscale-[20%] hover:grayscale-0 transition-all duration-700" src="https://lh3.googleusercontent.com/aida/AEtjO1WDlhKRmyi994ZgsYU8MdJvAe8ExwcRWsZcr9iy4N6a19DIyLrLeSzpxCtBguSJfNsEjQNj-gWsWB022JYaPWrPg_l1QZepqseuWvgCq9y7NoN2ZonPwmIECEfdXnjViaSxZA-WuLV_2lKvDH7pYHPw73ZdJj9fmZ_RDw-rdQ7XQ5iWJdTp4HZZ8fIUMSOKPFlQE6j6x9I703iNi2fHTuwsKP18ut1DTtC6BBRlRPd0SHRNCf1aPoXAjq8"/>
</div>
<div class="w-full md:w-1/2 flex flex-col justify-center">
<div class="flex justify-between items-start mb-2">
<h3 class="font-headline-lg text-2xl text-primary">Signature Verdant Espresso</h3>
<span class="font-label-md text-label-md text-royal-gold tracking-widest uppercase">$8</span>
</div>
<div class="h-px w-full bg-royal-gold/20 mb-4"></div>
<p class="font-body-md text-body-md text-on-surface-variant mb-8 line-clamp-3">A double ristretto shot featuring our reserve estate blend. Notes of dark chocolate, wild berries, and a whisper of smoke. Served with a sparkling palate cleanser.</p>
<button class="self-start px-8 py-3 bg-deep-forest text-champagne-glint border border-royal-gold font-label-md text-label-md uppercase tracking-widest hover:bg-opacity-90 transition-opacity">
                            Add to Order
                        </button>
</div>
</div>
<!-- Menu Item Card 2 -->
<div class="flex flex-col bg-surface border border-champagne-glint/50 p-4 hover:bg-cream-surface transition-colors duration-300 group">
<div class="aspect-square w-full relative overflow-hidden mb-6 p-1">
<img alt="Botanical Latte" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out" src="https://lh3.googleusercontent.com/aida/AEtjO1Xslbp5QNC-6QmHYS8lnhI80TiCZnWY4e0sJtY0kge0I9NRUMGvQUzaiGnkMMU3tiitCOSxKySkYi8ObTlTPjiy5gCWMy5EzZQBYH860PPqzR4sNSeh9tg513sVjAvByir8IadhsAnsuGIhKDPT_5CrsKPYZf7MEH99ZPWWxg2oGq-flui6LvHVGex89j7SiRv11klDL8WeCMzMC6sk7OQQyGwoKr08k6idGUUmS5W3UEEyHdjvuA9cmoBp"/>
</div>
<div class="flex justify-between items-baseline mb-2">
<h3 class="font-subheading-caps text-subheading-caps text-primary truncate pr-4">Botanical Latte</h3>
<span class="font-label-md text-label-md text-royal-gold uppercase">$12</span>
</div>
<p class="font-body-md text-sm text-on-surface-variant mb-6 flex-grow line-clamp-2">Espresso infused with house-made lavender and rosemary syrup, lightly textured milk.</p>
<button class="w-full py-2 border border-royal-gold/50 text-primary font-label-md text-[10px] uppercase tracking-widest hover:border-royal-gold transition-colors">Add</button>
</div>
<!-- Menu Item Card 3 -->
<div class="flex flex-col bg-surface border border-champagne-glint/50 p-4 hover:bg-cream-surface transition-colors duration-300 group">
<div class="aspect-square w-full relative overflow-hidden mb-6 p-1">
<img alt="Pour Over Selection" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out" src="https://lh3.googleusercontent.com/aida/AEtjO1Uk6Sy5q8NAfH5u58_SjWKrEmNgtDJrgF6Uo8iAafPCr4B91Bg74YvXWBxUAObvPT17NRE7Yl4o5dMNP--5AF2eWC8UqucbfW1dDdbC8BmxFTY0xLUzVF_gSo3wuPk4s8TuYaxK5AZuMNvlaShUizGsMowSwFFhEhDpFh8rW2_sOi1A7Sxw-SnwGdveNSWXDbAonSJdYLu1hleQPzkl3KaM5-G45KYY0U69OCbgZBR0mB98-NGLSwg69GkM"/>
</div>
<div class="flex justify-between items-baseline mb-2">
<h3 class="font-subheading-caps text-subheading-caps text-primary truncate pr-4">Single Origin Pour Over</h3>
<span class="font-label-md text-label-md text-royal-gold uppercase">$14</span>
</div>
<p class="font-body-md text-sm text-on-surface-variant mb-6 flex-grow line-clamp-2">Rotating selection of rare lots. Brewed at the table with precise temperature control.</p>
<button class="w-full py-2 border border-royal-gold/50 text-primary font-label-md text-[10px] uppercase tracking-widest hover:border-royal-gold transition-colors">Add</button>
</div>
<!-- Menu Item Card 4 -->
<div class="flex flex-col bg-surface border border-champagne-glint/50 p-4 hover:bg-cream-surface transition-colors duration-300 group">
<div class="aspect-square w-full relative overflow-hidden mb-6 p-1">
<img alt="Iced Gold Brew" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out" src="https://lh3.googleusercontent.com/aida/AEtjO1VeMUq8PMUFLuOrbteSUT6_4zXgLdWwhcUrKDvFIcd_8OPZ0Rbt0Q7MGTZ1NiyCUrs_J5-2ZQX-BJTociiYXDvvqdVeBVySbBYfq_51m2kL6TBrm8XgVT1_BEw8z12GtFKk34KaLDHBh2ljWDlsqM2yKYazYqlMOnhVRI_c0ypVtgOwaPnVlw6PM6J6m415vlowXxFi3yZd_k3EzFxnAfUptZiinSgI8rIfo0nn2y2vdz660rnuxbVw_xyc"/>
</div>
<div class="flex justify-between items-baseline mb-2">
<h3 class="font-subheading-caps text-subheading-caps text-primary truncate pr-4">Iced Gold Brew</h3>
<span class="font-label-md text-label-md text-royal-gold uppercase">$10</span>
</div>
<p class="font-body-md text-sm text-on-surface-variant mb-6 flex-grow line-clamp-2">24-hour slow drip cold brew, served over hand-cut clear ice.</p>
<button class="w-full py-2 border border-royal-gold/50 text-primary font-label-md text-[10px] uppercase tracking-widest hover:border-royal-gold transition-colors">Add</button>
</div>
<!-- Menu Item Card 5 -->
<div class="flex flex-col bg-surface border border-champagne-glint/50 p-4 hover:bg-cream-surface transition-colors duration-300 group">
<div class="aspect-square w-full relative overflow-hidden mb-6 p-1">
<img alt="Macchiato" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out" src="https://lh3.googleusercontent.com/aida/AEtjO1XYV8MiKJNp5BxXx68MLvSNUIXnNYK7l5CvMmIVazJVv-xzKs9Um9__nh92TOb_-qCkDhWSVu4VjuzQfkiGvbP9uBTiN5QY9WM657609ncxNIIZ8arTW9IqNSG0KjRp9rtylC-4f3W96dXtTI0-mZ6Cfc25eEWWlGAHeNtjuVJgqIyDlbxsqWjokQp-klD7GXZtVWTJZvY3a6E9wzR0SfcHxF8l0WVc9iBACpsltYv80VaWS7n4rQjIBdT1"/>
</div>
<div class="flex justify-between items-baseline mb-2">
<h3 class="font-subheading-caps text-subheading-caps text-primary truncate pr-4">Classic Macchiato</h3>
<span class="font-label-md text-label-md text-royal-gold uppercase">$9</span>
</div>
<p class="font-body-md text-sm text-on-surface-variant mb-6 flex-grow line-clamp-2">Espresso marked with a delicate dollop of micro-foam. Traditional style.</p>
<button class="w-full py-2 border border-royal-gold/50 text-primary font-label-md text-[10px] uppercase tracking-widest hover:border-royal-gold transition-colors">Add</button>
</div>
</div>
<!-- Section Divider -->
<div class="w-full flex items-center justify-center py-24">
<div class="h-px bg-royal-gold/20 w-full max-w-[200px]"></div>
<span class="material-symbols-outlined text-royal-gold mx-4 opacity-50 text-sm">star</span>
<div class="h-px bg-royal-gold/20 w-full max-w-[200px]"></div>
</div>
</div>
<!-- Sidebar: Order Summary / Cart (Desktop right side) -->
<aside class="hidden xl:flex w-[400px] border-l border-royal-gold/20 bg-cream-surface flex-col fixed right-0 top-0 h-screen z-30 shadow-[-10px_0_30px_rgba(39,60,22,0.02)]">
<div class="p-10 flex-grow flex flex-col">
<!-- Order Header -->
<div class="text-center mb-10 pb-8 border-b border-royal-gold/30">
<h2 class="font-subheading-caps text-subheading-caps text-primary uppercase tracking-widest mb-2">Your Selection</h2>
<p class="font-label-md text-[10px] text-on-surface-variant uppercase tracking-[0.2em]">Table 14 • The Conservatory</p>
</div>
<!-- Order Items List -->
<div class="flex-grow overflow-y-auto custom-scrollbar pr-4 space-y-6">
<!-- Item 1 -->
<div class="flex justify-between items-start group">
<div class="flex flex-col">
<span class="font-subheading-caps text-sm text-primary mb-1">Signature Verdant Espresso</span>
<span class="font-label-md text-[10px] text-on-surface-variant uppercase">Qty: 2</span>
</div>
<div class="flex flex-col items-end gap-2">
<span class="font-label-md text-xs text-royal-gold">$16.00</span>
<button class="text-on-surface-variant hover:text-error opacity-0 group-hover:opacity-100 transition-opacity">
<span class="material-symbols-outlined text-sm">close</span>
</button>
</div>
</div>
<div class="w-full border-t border-dashed border-royal-gold/30"></div>
<!-- Item 2 -->
<div class="flex justify-between items-start group">
<div class="flex flex-col">
<span class="font-subheading-caps text-sm text-primary mb-1">Botanical Latte</span>
<span class="font-label-md text-[10px] text-on-surface-variant uppercase">Qty: 1</span>
<span class="font-body-md text-[11px] text-outline italic mt-1">+ Oat Milk</span>
</div>
<div class="flex flex-col items-end gap-2">
<span class="font-label-md text-xs text-royal-gold">$13.50</span>
<button class="text-on-surface-variant hover:text-error opacity-0 group-hover:opacity-100 transition-opacity">
<span class="material-symbols-outlined text-sm">close</span>
</button>
</div>
</div>
</div>
<!-- Order Totals & Checkout -->
<div class="pt-8 mt-auto">
<div class="flex justify-between items-center mb-3">
<span class="font-body-md text-sm text-on-surface-variant">Subtotal</span>
<span class="font-body-md text-sm text-primary">$29.50</span>
</div>
<div class="flex justify-between items-center mb-6 pb-6 border-b border-royal-gold/30">
<span class="font-body-md text-sm text-on-surface-variant">Service</span>
<span class="font-body-md text-sm text-primary">$5.90</span>
</div>
<div class="flex justify-between items-baseline mb-8">
<span class="font-subheading-caps text-subheading-caps text-primary">Total</span>
<span class="font-headline-lg text-2xl text-royal-gold">$35.40</span>
</div>
<button class="w-full py-5 bg-deep-forest text-champagne-glint border border-royal-gold font-label-md text-label-md uppercase tracking-widest hover:bg-opacity-90 transition-all flex justify-center items-center gap-3 group">
                        Place Royal Order
                        <span class="material-symbols-outlined text-sm group-hover:translate-x-1 transition-transform">arrow_forward</span>
</button>
<p class="text-center font-label-md text-[9px] text-on-surface-variant uppercase tracking-widest mt-4">Orders are prepared immediately</p>
</div>
</div>
<!-- Aesthetic Corner Accents for the sidebar -->
<div class="absolute top-4 left-4 w-4 h-4 border-t border-l border-royal-gold/40"></div>
<div class="absolute top-4 right-4 w-4 h-4 border-t border-r border-royal-gold/40"></div>
<div class="absolute bottom-4 left-4 w-4 h-4 border-b border-l border-royal-gold/40"></div>
<div class="absolute bottom-4 right-4 w-4 h-4 border-b border-r border-royal-gold/40"></div>
</aside>
</main>
</body></html>




<!-- 
<?php require("public/js/script.php"); ?> -->
<?php require("views/layouts/footer.php"); ?>
