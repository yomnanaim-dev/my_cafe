<?php require base_path("views/layouts/header.php"); ?>
<?php require base_path("views/layouts/navbar.php"); ?>

<main class="pt-24 min-h-screen">
  <!-- Hero Section -->
  <section class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-16">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
      <div>
        <span class="font-label-md text-label-md text-primary dark:text-primary-fixed uppercase tracking-widest block mb-4">
          A Sanctuary of Refined Hospitality
        </span>
        <h1 class="font-display-lg text-4xl md:text-5xl lg:text-display-lg text-deep-forest mb-6 leading-tight">
          Verdant Café &amp; Lounge
        </h1>
        <p class="font-body-lg text-on-surface-variant max-w-xl mb-8 leading-relaxed">
          Curated botanicals, ceremonial matchas, and hand-crafted delicacies. Designed for thoughtful moments and unhurried elegance.
        </p>
        <div class="flex flex-wrap gap-4">
          <a href="?page=products" class="bg-primary text-on-primary px-8 py-3.5 rounded font-label-md hover:bg-primary/90 transition-all duration-300 shadow-md">
            Explore Menu
          </a>
          <a href="?page=admin" class="border border-primary text-primary px-8 py-3.5 rounded font-label-md hover:bg-primary/5 transition-all duration-300">
            Admin Suite
          </a>
        </div>
      </div>
      
      <div class="relative">
        <div class="rounded-2xl overflow-hidden shadow-2xl border border-tertiary/20">
          <img src="a_wide_angle_luxury_hotel_caf_interior_shot._the_scene_features_deep_forest.png" 
               alt="Verdant Cafe Interior" 
               class="w-full h-[460px] object-cover"
               onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1554118811-1e0d58224f24?w=800&fit=crop';">
        </div>
      </div>
    </div>
  </section>

  <!-- Featured Menu Items Preview -->
  <section class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-12">
    <div class="flex justify-between items-end mb-8 border-b border-tertiary/20 pb-4">
      <div>
        <h2 class="font-headline-md text-2xl md:text-headline-md text-deep-forest">Curated Highlights</h2>
        <p class="font-body-md text-on-surface-variant mt-1">A sample of our seasonal offerings.</p>
      </div>
      <a href="?page=products" class="text-primary font-label-md hover:underline flex items-center gap-1">
        Full Menu &amp; Management <span class="material-symbols-outlined text-sm">arrow_forward</span>
      </a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
      <?php if (!empty($featuredProducts)): ?>
        <?php foreach ($featuredProducts as $item): ?>
          <div class="glass-card rounded-xl overflow-hidden transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">
            <div class="h-48 overflow-hidden bg-surface-container">
              <img src="<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>" class="w-full h-full object-cover">
            </div>
            <div class="p-5">
              <div class="flex justify-between items-start mb-2">
                <span class="text-xs font-semibold px-2.5 py-0.5 rounded-full bg-champagne-glint text-tertiary">
                  <?= htmlspecialchars($item['category']) ?>
                </span>
                <span class="font-headline-md text-deep-forest font-bold">
                  $<?= number_format($item['price'], 2) ?>
                </span>
              </div>
              <h3 class="font-headline-md text-lg text-deep-forest mb-1">
                <?= htmlspecialchars($item['name']) ?>
              </h3>
              <p class="text-xs text-on-surface-variant line-clamp-2">
                <?= htmlspecialchars($item['description'] ?? '') ?>
              </p>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </section>
</main>

<?php require base_path("public/js/script.php"); ?>
<?php require base_path("views/layouts/footer.php"); ?>