 <?php require("layouts/header.php"); ?>
    <?php require("layouts/navbar.php"); ?>
   
<!-- Mobile Menu Toggle (Decorative for this scope) -->
<button class="md:hidden text-royal-gold">
<span class="material-symbols-outlined" data-icon="menu">menu</span>
</button>
</div>
</header>
<main>
<!-- Hero Section -->
<section class="relative w-full h-[90vh] flex flex-col justify-center items-center text-center overflow-hidden">
<!-- Background Image -->
<div class="absolute inset-0 w-full h-full">
<img alt="Hero background" class="object-cover w-full h-full opacity-90 scale-105 transform origin-center animate-[pulse_20s_ease-in-out_infinite]" src="\public\images\hero background.jpg"/>
<div class="absolute inset-0 bg-gradient-to-b from-transparent to-surface-inverse/80"></div>
</div>
<!-- Content -->
<div class="relative z-10 px-margin-mobile md:px-margin-desktop max-w-[1000px] mx-auto flex flex-col items-center">
<h1 class="font-display-lg text-display-lg text-champagne-glint drop-shadow-lg mb-6 max-w-4xl leading-tight">
                    A Sanctuary of Refined Hospitality
                </h1>
<div class="w-1/4 h-px bg-royal-gold/60 mb-10"></div>
<a class="px-10 py-5 bg-deep-forest/90 text-champagne-glint border border-royal-gold rounded-2xl font-subheading-caps text-subheading-caps uppercase tracking-[0.2em] hover:bg-deep-forest transition-colors duration-500 backdrop-blur-sm" href="#reservations">
                    Begin Your Experience
                </a>
</section>
<!-- The Legacy of Elegance (About) -->
<section class="py-section-gap px-margin-mobile md:px-margin-desktop max-w-[1440px] mx-auto bg-cream-surface">
<div class="grid grid-cols-1 md:grid-cols-12 gap-gutter items-center">
<!-- Text Content -->
<div class="md:col-span-5 md:col-start-2 flex flex-col items-start space-y-8 order-2 md:order-1">
<h2 class="font-headline-lg text-headline-lg text-deep-forest">
                        The Legacy of Elegance
                    </h2>
<div class="w-12 h-px bg-royal-gold"></div>
<p class="font-body-lg text-body-lg text-on-surface-variant">
                        Step into a world where time slows down. Verdant Café &amp; Lounge offers an unparalleled 7-star experience, marrying classical architectural grace with botanical serenity. Every detail, from the velvet banquettes to the hand-poured artisan coffees, is curated for the discerning few.
                    </p>
<p class="font-body-md text-body-md text-on-surface-variant/80">
                        Our commitment is to absolute perfection—a quiet luxury whispered through expansive space, impeccable service, and culinary mastery.
                    </p>
<a class="mt-4 font-subheading-caps text-subheading-caps text-royal-gold uppercase tracking-[0.2em] border-b border-royal-gold/30 hover:border-royal-gold pb-1 transition-all" href="#">
                        Discover Our Story
                    </a>
</div>
<!-- Image Gallery -->
<div class="md:col-span-5 order-1 md:order-2 relative">
<div class="p-12 border border-royal-gold/20 bg-champagne-glint/20 relative z-0">
<img class="object-cover w-full aspect-[4/5] shadow-2xl relative z-10" data-alt="A close-up of a meticulously crafted artisan coffee on a pristine marble table. Soft, natural morning light filters through large classical windows, highlighting the delicate foam art and the opulent gold-rimmed saucer. The background softly blurs into an elegant, deep forest green luxury lounge setting." src="https://lh3.googleusercontent.com/aida-public/AB6AXuAEQzV0iZvbsFHhE_5eeZTy4Et055Jr5risESYPdHePHLcrm3BAXMmfNdyaTcqasKiFqYp_XFyugqQI6mxgveqToFirm3t43Y3Yv_8BAN7XxXVKQV1FoaB9Y1FwIPnicOANKF2SqY4MPsZ9WUBFLQVT0RxS2n5Hi7TzUapLC-tkyCjgiQcWjGETvFWe6c41YiPNUSpxz_ZtdSB5FGNCH_knZYpb4EpAkpV9uRP_N05Flf8NRLcSU_eSmg"/>
</div>
</div>
</div>
</section>
<!-- Featured Selection (Menu) -->
<section class="py-section-gap px-margin-mobile md:px-margin-desktop max-w-[1440px] mx-auto bg-background">
<div class="text-center mb-16">
<h2 class="font-headline-lg text-headline-lg text-deep-forest mb-4">Featured Selection</h2>
<div class="font-subheading-caps text-subheading-caps text-royal-gold uppercase tracking-[0.2em] divider-diamond">
<span class="material-symbols-outlined text-[16px] text-royal-gold align-middle" data-icon="local_cafe">local_cafe</span>
</div>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 gap-x-gutter gap-y-16 max-w-4xl mx-auto">
<!-- Item 1 -->
<div class="flex flex-col space-y-4">
<div class="flex justify-between items-baseline border-b border-royal-gold/30 pb-2">
<h3 class="font-subheading-caps text-subheading-caps text-deep-forest uppercase tracking-wider">The Signature Roast</h3>
<span class="font-body-md text-body-md text-royal-gold">$24</span>
</div>
<p class="font-body-md text-body-md text-on-surface-variant/70 font-light">
                        Single-origin Ethiopian beans, slow-roasted over mahogany wood, served in a gold-leaf demitasse with a side of Madagascar vanilla cream.
                    </p>
</div>
<!-- Item 2 -->
<div class="flex flex-col space-y-4">
<div class="flex justify-between items-baseline border-b border-royal-gold/30 pb-2">
<h3 class="font-subheading-caps text-subheading-caps text-deep-forest uppercase tracking-wider">Truffle Brioche</h3>
<span class="font-body-md text-body-md text-royal-gold">$32</span>
</div>
<p class="font-body-md text-body-md text-on-surface-variant/70 font-light">
                        Warm, hand-laminated brioche infused with white Alba truffle butter, accompanied by wild mountain honey.
                    </p>
</div>
<!-- Item 3 -->
<div class="flex flex-col space-y-4">
<div class="flex justify-between items-baseline border-b border-royal-gold/30 pb-2">
<h3 class="font-subheading-caps text-subheading-caps text-deep-forest uppercase tracking-wider">Osetra Caviar Tart</h3>
<span class="font-body-md text-body-md text-royal-gold">$85</span>
</div>
<p class="font-body-md text-body-md text-on-surface-variant/70 font-light">
                        Delicate charcoal tart shell filled with crème fraîche and topped with pristine Imperial Osetra caviar.
                    </p>
</div>
<!-- Item 4 -->
<div class="flex flex-col space-y-4">
<div class="flex justify-between items-baseline border-b border-royal-gold/30 pb-2">
<h3 class="font-subheading-caps text-subheading-caps text-deep-forest uppercase tracking-wider">Golden Matcha</h3>
<span class="font-body-md text-body-md text-royal-gold">$28</span>
</div>
<p class="font-body-md text-body-md text-on-surface-variant/70 font-light">
                        Ceremonial grade Uji matcha, whisked table-side, finished with a dusting of edible 24k gold.
                    </p>
</div>
</div>
<div class="text-center mt-16">
<a class="inline-block px-10 py-4 bg-transparent text-deep-forest border border-royal-gold rounded-2xl font-label-md text-label-md uppercase tracking-[0.15em] hover:bg-champagne-glint/30 transition-all duration-300" href="#">
                    View Full Menu
                </a>
</div>
</section>
</main>


<?php require("layouts/footer.php"); ?>