<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($pageTitle ?? 'Verdant Cafe and Lounge Admin') ?></title>
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
          <a href="?page=orders" class="nav-item" data-page="orders">
            <i class="fa-solid fa-receipt"></i>
            <span>Orders</span>
          </a>
          <a href="?page=staff" class="nav-item" data-page="staff">
            <i class="fa-solid fa-users"></i>
            <span>Staff Management</span>
          </a>
          <a href="?page=products" class="nav-item active" data-page="menu">
            <i class="fa-solid fa-utensils"></i>
            <span>Menu Items</span>
          </a>
          <a href="?page=reports" class="nav-item" data-page="reports">
            <i class="fa-solid fa-chart-column"></i>
            <span>Financial Reports</span>
          </a>
          <a href="index.php" class="nav-item" title="Visit Public Café Website">
            <i class="fa-solid fa-arrow-up-right-from-square"></i>
            <span>Public Site</span>
          </a>
        </nav>
      </div>

      <div class="sidebar-bottom">
        <button class="btn-reservation" onclick="alert('New Reservation dialog');">
          <i class="fa-solid fa-plus"></i>
          New Reservation
        </button>
        <a href="?page=settings" class="nav-item">
          <i class="fa-solid fa-gear"></i>
          <span>Settings</span>
        </a>
        <a href="?page=logout" class="nav-item">
          <i class="fa-solid fa-arrow-right-from-bracket"></i>
          <span>Log Out</span>
        </a>
      </div>
    </div>

    <div class="main">

      <div class="topbar">
        <h2 class="topbar-title">Verdant Cafe and Lounge Admin</h2>
        <div class="topbar-actions">
          <div class="search-box">
            <input type="text" placeholder="Search...">
            <i class="fa-solid fa-magnifying-glass"></i>
          </div>
          <button class="icon-btn" title="Notifications">
            <i class="fa-regular fa-bell"></i>
          </button>
          <button class="icon-btn" title="Help & Support">
            <i class="fa-regular fa-circle-question"></i>
          </button>
          <div class="avatar">
            <img src="https://i.pravatar.cc/40" alt="user">
          </div>
        </div>
      </div>

      <div class="content">

        <div class="page-heading">
          <h3>Menu Items Management</h3>
          <p>Curate and refine the culinary offerings for Verdant Cafe and Lounge.</p>
        </div>

        <div class="panels">

          <div class="panel panel-products">

            <div id="table-view">
              <div class="panel-header">
                <h4>All Products</h4>
                <button class="btn-filter" id="btn-filter" onclick="document.querySelector('.search-box input').focus();">
                  <i class="fa-solid fa-filter"></i>
                  Filter
                </button>
              </div>

              <table class="products-table">
                <thead>
                  <tr>
                    <th>Image</th>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody id="products-tbody">
                  <?php if (!empty($products)): ?>
                    <?php foreach ($products as $prod): ?>
                      <tr>
                        <td>
                          <img class="product-thumb" 
                               src="<?= htmlspecialchars($prod['image'] ?: 'https://images.unsplash.com/photo-1509042239860-f550ce710b93?w=400&h=300&fit=crop') ?>" 
                               alt="<?= htmlspecialchars($prod['name']) ?>"
                               onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1509042239860-f550ce710b93?w=400&h=300&fit=crop';">
                        </td>
                        <td><?= htmlspecialchars($prod['name']) ?></td>
                        <td>
                          <?php 
                            $badgeClass = 'badge-beverage';
                            if ($prod['category'] === 'Pastry') $badgeClass = 'badge-pastry';
                            elseif ($prod['category'] === 'Savory') $badgeClass = 'badge-savory';
                            elseif ($prod['category'] === 'Breakfast') $badgeClass = 'badge-breakfast';
                            elseif ($prod['category'] === 'Lunch') $badgeClass = 'badge-lunch';
                          ?>
                          <span class="badge <?= $badgeClass ?>"><?= htmlspecialchars($prod['category']) ?></span>
                        </td>
                        <td>$<?= number_format($prod['price'], 2) ?></td>
                        <td>
                          <div class="actions-cell">
                            <label class="toggle">
                              <input type="checkbox" data-id="<?= $prod['id'] ?>" <?= !empty($prod['active']) ? 'checked' : '' ?>>
                              <span class="toggle-slider"></span>
                            </label>
                            <button class="action-icon" data-id="<?= $prod['id'] ?>" title="Edit">
                              <i class="fa-solid fa-pen"></i>
                            </button>
                            <button class="action-icon delete" data-id="<?= $prod['id'] ?>" title="Delete">
                              <i class="fa-solid fa-trash"></i>
                            </button>
                          </div>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>

            <div id="edit-view" style="display:none;">

              <button class="modal-close" id="modal-close-btn" title="Close">
                <i class="fa-solid fa-xmark"></i>
              </button>

              <div class="modal-heading">
                <h3>Editorial Menu Curation</h3>
                <p>Manage your culinary offerings. Ensure imagery meets the high-fidelity standards of the Verdant visual identity.</p>
              </div>

              <div class="modal-body">

                <div class="modal-preview">

                  <div class="preview-image-wrap">
                    <img id="modal-image" src="" alt="Product Preview">
                    <span class="preview-badge" id="modal-category-badge"></span>

                    <div class="preview-overlay">
                      <div class="preview-title-row">
                        <h4 id="modal-name-display"></h4>
                        <button class="pencil-btn" data-field="name" title="Edit name">
                          <i class="fa-solid fa-pen"></i>
                        </button>
                      </div>
                    </div>
                  </div>

                  <div class="preview-meta">
                    <div class="meta-item">
                      <span class="meta-label">Price</span>
                      <span class="meta-value" id="modal-price-display"></span>
                      <button class="pencil-btn" data-field="price" title="Edit price">
                        <i class="fa-solid fa-pen"></i>
                      </button>
                    </div>
                    <div class="meta-item">
                      <span class="meta-label">Status</span>
                      <span class="meta-value" id="modal-status-display"></span>
                      <button class="pencil-btn" data-field="status" title="Toggle status">
                        <i class="fa-solid fa-pen"></i>
                      </button>
                    </div>
                    <div class="meta-item">
                      <span class="meta-label">Size</span>
                      <span class="meta-value" id="modal-size-display"></span>
                      <button class="pencil-btn" data-field="size" title="Edit size">
                        <i class="fa-solid fa-pen"></i>
                      </button>
                    </div>
                  </div>

                </div>

                <div class="modal-details">
                  <div class="details-header">Edit Item Details</div>

                  <div class="details-body">

                    <img id="details-thumb" class="details-thumb" src="" alt="Thumbnail">

                    <div class="details-field">
                      <label>Product Name</label>
                      <div class="details-value-row">
                        <span id="details-name-display"></span>
                        <button class="pencil-btn" data-field="name" title="Edit name">
                          <i class="fa-solid fa-pen"></i>
                        </button>
                      </div>
                    </div>

                    <div class="details-field">
                      <label>Category</label>
                      <div class="details-value-row">
                        <span id="details-category-display"></span>
                        <button class="pencil-btn" data-field="category" title="Edit category">
                          <i class="fa-solid fa-pen"></i>
                        </button>
                      </div>
                    </div>

                    <div class="details-field">
                      <label>Price</label>
                      <div class="details-value-row">
                        <span id="details-price-display"></span>
                        <button class="pencil-btn" data-field="price" title="Edit price">
                          <i class="fa-solid fa-pen"></i>
                        </button>
                      </div>
                    </div>

                    <div class="details-field">
                      <label>Size</label>
                      <div class="details-value-row">
                        <span id="details-size-display"></span>
                        <button class="pencil-btn" data-field="size" title="Edit size">
                          <i class="fa-solid fa-pen"></i>
                        </button>
                      </div>
                    </div>

                  </div>

                  <div class="details-actions">
                    <button class="btn-cancel" id="btn-discard">Discard</button>
                    <button class="btn-submit" id="btn-done">Done</button>
                  </div>
                </div>

              </div>

            </div>

          </div>

          <div class="panel panel-form">
            <h4>Add New Item</h4>

            <form id="item-form">

              <label class="field-label">Product Image</label>
              <div class="upload-box" id="upload-box">
                <img id="upload-preview" style="display:none;" alt="Uploaded Preview">
                <div id="upload-placeholder">
                  <i class="fa-regular fa-image"></i>
                  <p>Click to upload image</p>
                  <span>PNG, JPG up to 5MB</span>
                </div>
              </div>
              <input type="file" id="upload-input" accept="image/*" style="display:none;">

              <label class="field-label">Product Name</label>
              <input type="text" id="input-name" class="text-input" placeholder="eg. Lavender Earl Grey" required>

              <div class="field-row">
                <div class="field-col">
                  <label class="field-label">Price ($)</label>
                  <input type="number" id="input-price" class="text-input" placeholder="0.00" step="0.01" min="0" required>
                </div>
                <div class="field-col">
                  <label class="field-label">Category</label>
                  <select id="input-category" class="text-input" required>
                    <option value="">Select...</option>
                    <option value="Beverage">Beverage</option>
                    <option value="Pastry">Pastry</option>
                    <option value="Savory">Savory</option>
                    <option value="Breakfast">Breakfast</option>
                    <option value="Lunch">Lunch</option>
                  </select>
                </div>
              </div>

              <div class="form-actions">
                <button type="button" id="btn-cancel" class="btn-cancel">Cancel</button>
                <button type="submit" id="btn-submit" class="btn-submit">Add Item</button>
              </div>

            </form>
          </div>

        </div>

      </div>

    </div>

  </div>

  <script>
    window.INITIAL_PRODUCTS = <?= !empty($initialProductsJson) ? $initialProductsJson : '[]' ?>;
  </script>
  <script src="public/js/script.js"></script>
</body>

</html>

