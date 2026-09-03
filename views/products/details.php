<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($pageTitle ?? 'Item Details - Verdant Cafe and Lounge') ?></title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:ital,wght@0,600;0,700;1,600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="public/css/style.css">
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <div class="app">
    <div class="sidebar">
      <div class="sidebar-top">
        <div class="brand">
          <h1 class="brand-name">Verdant Cafe</h1>
          <p class="brand-sub">Management Suite</p>
        </div>
        <nav class="nav">
          <a href="?page=products" class="nav-item active">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Back to Menu</span>
          </a>
        </nav>
      </div>
    </div>

    <div class="main">
      <div class="topbar">
        <h2 class="topbar-title">Verdant Cafe and Lounge Admin</h2>
      </div>

      <div class="content">
        <div class="page-heading">
          <h3><?= htmlspecialchars($product['name']) ?></h3>
          <p>Curated menu item details.</p>
        </div>

        <div class="panels" style="grid-template-columns: 1fr;">
          <div class="panel">
            <div class="modal-body" style="grid-template-columns: 1fr 300px;">
              <div class="modal-preview">
                <div class="preview-image-wrap">
                  <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
                  <span class="preview-badge"><?= htmlspecialchars($product['category']) ?></span>
                  <div class="preview-overlay">
                    <div class="preview-title-row">
                      <h4><?= htmlspecialchars($product['name']) ?></h4>
                    </div>
                  </div>
                </div>
                <div class="preview-meta">
                  <div class="meta-item">
                    <span class="meta-label">Price</span>
                    <span class="meta-value">$<?= number_format($product['price'], 2) ?></span>
                  </div>
                  <div class="meta-item">
                    <span class="meta-label">Status</span>
                    <span class="meta-value"><?= !empty($product['active']) ? 'Active' : 'Out of Stock' ?></span>
                  </div>
                  <div class="meta-item">
                    <span class="meta-label">Size</span>
                    <span class="meta-value"><?= htmlspecialchars($product['size']) ?></span>
                  </div>
                </div>
              </div>

              <div class="modal-details">
                <div class="details-header">Item Information</div>
                <div class="details-body">
                  <p style="font-size: 13px; color: #8b8578; line-height: 1.6;"><?= htmlspecialchars($product['description'] ?? '') ?></p>
                </div>
                <div class="details-actions">
                  <a href="?page=products" class="btn-submit" style="text-align:center; text-decoration:none;">Back to Menu Items</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>

