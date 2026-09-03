// Verdant Cafe and Lounge - Menu Items Management Logic
var defaultProducts = [
  {
    id: 1,
    name: "Botanical Matcha Latte",
    category: "Beverage",
    price: 8.5,
    active: true,
    size: "Regular",
    image: "https://images.unsplash.com/photo-1536256263959-770b48d82b0a?w=400&h=300&fit=crop",
  },
  {
    id: 2,
    name: "Rosewater Velvet Cake",
    category: "Pastry",
    price: 12.0,
    active: true,
    size: "Slice",
    image: "https://images.unsplash.com/photo-1578985545062-69928b1d9587?w=400&h=300&fit=crop",
  },
  {
    id: 3,
    name: "Truffle Infused Croissant",
    category: "Savory",
    price: 9.5,
    active: false,
    size: "Regular",
    image: "https://images.unsplash.com/photo-1555507036-ab1f4038808a?w=400&h=300&fit=crop",
  },
  {
    id: 4,
    name: "Avocado Toast",
    category: "Breakfast",
    price: 12.5,
    active: true,
    size: "Full",
    image: "https://images.unsplash.com/photo-1541519227354-08fa5d50c44d?w=400&h=300&fit=crop",
  },
  {
    id: 5,
    name: "Cold Brew",
    category: "Beverage",
    price: 5.0,
    active: true,
    size: "Regular",
    image: "https://images.unsplash.com/photo-1461023058943-07fcbe16d735?w=400&h=300&fit=crop",
  },
  {
    id: 6,
    name: "Quinoa Bowl",
    category: "Lunch",
    price: 14.0,
    active: false,
    size: "Full",
    image: "https://images.unsplash.com/photo-1512621776951-a57141f2eefd?w=400&h=300&fit=crop",
  },
  {
    id: 7,
    name: "Smoked Salmon Tartine",
    category: "Breakfast",
    price: 24.0,
    active: true,
    size: "Full",
    image: "https://images.unsplash.com/photo-1541014741259-de529411b96a?w=400&h=300&fit=crop",
  },
  {
    id: 8,
    name: "Lavender Earl Grey",
    category: "Beverage",
    price: 7.0,
    active: true,
    size: "Regular",
    image: "https://images.unsplash.com/photo-1594631252845-29fc4cc8cde9?w=400&h=300&fit=crop",
  },
];

var products = (typeof window !== "undefined" && window.INITIAL_PRODUCTS && Array.isArray(window.INITIAL_PRODUCTS) && window.INITIAL_PRODUCTS.length > 0)
  ? window.INITIAL_PRODUCTS
  : defaultProducts;

var nextId = products.reduce(function(max, item) { return Math.max(max, item.id || 0); }, 0) + 1;
var fallbackImage = "https://images.unsplash.com/photo-1509042239860-f550ce710b93?w=400&h=300&fit=crop";

var tbody = document.getElementById("products-tbody");
var itemForm = document.getElementById("item-form");
var inputName = document.getElementById("input-name");
var inputPrice = document.getElementById("input-price");
var inputCategory = document.getElementById("input-category");
var btnCancel = document.getElementById("btn-cancel");
var uploadBox = document.getElementById("upload-box");
var uploadInput = document.getElementById("upload-input");
var uploadPreview = document.getElementById("upload-preview");
var uploadPlaceholder = document.getElementById("upload-placeholder");

var searchInput = document.querySelector(".search-box input");
var searchTerm = "";
var uploadedImage = "";

function getBadgeClass(category) {
  if (category === "Beverage") {
    return "badge-beverage";
  }
  if (category === "Pastry") {
    return "badge-pastry";
  }
  if (category === "Savory") {
    return "badge-savory";
  }
  if (category === "Breakfast") {
    return "badge-breakfast";
  }
  if (category === "Lunch") {
    return "badge-lunch";
  }
  return "badge-beverage";
}

function findProductById(id) {
  for (var i = 0; i < products.length; i++) {
    if (products[i].id === id) {
      return products[i];
    }
  }
  return null;
}

function renderProducts() {
  if (!tbody) return;
  tbody.innerHTML = "";

  var filtered = [];
  for (var k = 0; k < products.length; k++) {
    var nameLower = products[k].name.toLowerCase();
    var categoryLower = (products[k].category || "").toLowerCase();
    if (searchTerm === "" || nameLower.indexOf(searchTerm) !== -1 || categoryLower.indexOf(searchTerm) !== -1) {
      filtered.push(products[k]);
    }
  }

  for (var i = 0; i < filtered.length; i++) {
    var product = filtered[i];

    var tr = document.createElement("tr");

    var tdImage = document.createElement("td");
    var img = document.createElement("img");
    img.className = "product-thumb";
    img.src = product.image && product.image !== "" ? product.image : fallbackImage;
    img.alt = product.name;
    img.onerror = function () {
      this.onerror = null;
      this.src = fallbackImage;
    };
    tdImage.appendChild(img);

    var tdName = document.createElement("td");
    tdName.textContent = product.name;

    var tdCategory = document.createElement("td");
    var badge = document.createElement("span");
    badge.className = "badge " + getBadgeClass(product.category);
    badge.textContent = product.category;
    tdCategory.appendChild(badge);

    var tdPrice = document.createElement("td");
    tdPrice.textContent = "$" + Number(product.price).toFixed(2);

    var tdActions = document.createElement("td");
    var actionsWrap = document.createElement("div");
    actionsWrap.className = "actions-cell";

    var toggleLabel = document.createElement("label");
    toggleLabel.className = "toggle";
    var toggleInput = document.createElement("input");
    toggleInput.type = "checkbox";
    toggleInput.checked = product.active;
    toggleInput.setAttribute("data-id", product.id);
    toggleInput.addEventListener("change", onToggleChange);
    var toggleSpan = document.createElement("span");
    toggleSpan.className = "toggle-slider";
    toggleLabel.appendChild(toggleInput);
    toggleLabel.appendChild(toggleSpan);

    var editBtn = document.createElement("button");
    editBtn.className = "action-icon";
    editBtn.setAttribute("title", "Edit Item");
    editBtn.innerHTML = '<i class="fa-solid fa-pen"></i>';
    editBtn.setAttribute("data-id", product.id);
    editBtn.addEventListener("click", onEditClick);

    var deleteBtn = document.createElement("button");
    deleteBtn.className = "action-icon delete";
    deleteBtn.setAttribute("title", "Delete Item");
    deleteBtn.innerHTML = '<i class="fa-solid fa-trash"></i>';
    deleteBtn.setAttribute("data-id", product.id);
    deleteBtn.addEventListener("click", onDeleteClick);

    actionsWrap.appendChild(toggleLabel);
    actionsWrap.appendChild(editBtn);
    actionsWrap.appendChild(deleteBtn);
    tdActions.appendChild(actionsWrap);

    tr.appendChild(tdImage);
    tr.appendChild(tdName);
    tr.appendChild(tdCategory);
    tr.appendChild(tdPrice);
    tr.appendChild(tdActions);

    tbody.appendChild(tr);
  }
}

function onToggleChange(e) {
  var id = Number(e.target.getAttribute("data-id"));
  var product = findProductById(id);
  if (product !== null) {
    product.active = e.target.checked;
  }
}

function onDeleteClick(e) {
  var id = Number(e.currentTarget.getAttribute("data-id"));
  var confirmDelete = confirm("Are you sure you want to delete this item?");
  if (!confirmDelete) {
    return;
  }
  var newProducts = [];
  for (var i = 0; i < products.length; i++) {
    if (products[i].id !== id) {
      newProducts.push(products[i]);
    }
  }
  products = newProducts;
  renderProducts();
}

function resetAddForm() {
  if (itemForm) itemForm.reset();
  if (uploadPreview) uploadPreview.style.display = "none";
  if (uploadPlaceholder) uploadPlaceholder.style.display = "block";
  uploadedImage = "";
}

if (uploadBox && uploadInput) {
  uploadBox.addEventListener("click", function () {
    uploadInput.click();
  });

  uploadInput.addEventListener("change", function () {
    var file = uploadInput.files[0];
    if (!file) {
      return;
    }
    var reader = new FileReader();
    reader.onload = function (event) {
      uploadedImage = event.target.result;
      if (uploadPreview) {
        uploadPreview.src = uploadedImage;
        uploadPreview.style.display = "block";
      }
      if (uploadPlaceholder) uploadPlaceholder.style.display = "none";
    };
    reader.readAsDataURL(file);
  });
}

if (btnCancel) {
  btnCancel.addEventListener("click", function () {
    resetAddForm();
  });
}

if (itemForm) {
  itemForm.addEventListener("submit", function (e) {
    e.preventDefault();

    var name = inputName.value.trim();
    var price = parseFloat(inputPrice.value);
    var category = inputCategory.value;

    if (name === "" || category === "" || isNaN(price)) {
      alert("Please fill in all fields.");
      return;
    }

    var newProduct = {
      id: nextId,
      name: name,
      category: category,
      price: price,
      active: true,
      size: "Regular",
      image: uploadedImage !== "" ? uploadedImage : fallbackImage,
    };
    nextId = nextId + 1;
    products.push(newProduct);

    renderProducts();
    resetAddForm();
  });
}

if (searchInput) {
  searchInput.addEventListener("input", function () {
    searchTerm = searchInput.value.trim().toLowerCase();
    renderProducts();
  });
}

var tableView = document.getElementById("table-view");
var editView = document.getElementById("edit-view");
var modalCloseBtn = document.getElementById("modal-close-btn");
var modalImage = document.getElementById("modal-image");
var modalCategoryBadge = document.getElementById("modal-category-badge");
var modalNameDisplay = document.getElementById("modal-name-display");
var modalPriceDisplay = document.getElementById("modal-price-display");
var modalStatusDisplay = document.getElementById("modal-status-display");
var modalSizeDisplay = document.getElementById("modal-size-display");

var detailsThumb = document.getElementById("details-thumb");
var detailsNameDisplay = document.getElementById("details-name-display");
var detailsCategoryDisplay = document.getElementById("details-category-display");
var detailsPriceDisplay = document.getElementById("details-price-display");
var detailsSizeDisplay = document.getElementById("details-size-display");

var btnDiscard = document.getElementById("btn-discard");
var btnDone = document.getElementById("btn-done");

var editingProductId = null;
var draft = null;

function fillModal() {
  if (!draft) return;
  var imgSrc = draft.image && draft.image !== "" ? draft.image : fallbackImage;
  
  if (modalImage) {
    modalImage.src = imgSrc;
    modalImage.onerror = function () {
      this.onerror = null;
      this.src = fallbackImage;
    };
  }
  
  if (modalCategoryBadge) modalCategoryBadge.textContent = draft.category;
  if (modalNameDisplay) modalNameDisplay.textContent = draft.name;
  if (modalPriceDisplay) modalPriceDisplay.textContent = "$" + Number(draft.price).toFixed(2);
  if (modalStatusDisplay) modalStatusDisplay.textContent = draft.active ? "Active" : "Out of Stock";
  if (modalSizeDisplay) modalSizeDisplay.textContent = draft.size;

  if (detailsThumb) {
    detailsThumb.src = imgSrc;
    detailsThumb.onerror = function () {
      this.onerror = null;
      this.src = fallbackImage;
    };
  }
  if (detailsNameDisplay) detailsNameDisplay.textContent = draft.name;
  if (detailsCategoryDisplay) detailsCategoryDisplay.textContent = draft.category;
  if (detailsPriceDisplay) detailsPriceDisplay.textContent = "$" + Number(draft.price).toFixed(2);
  if (detailsSizeDisplay) detailsSizeDisplay.textContent = draft.size;
}

function onEditClick(e) {
  var id = Number(e.currentTarget.getAttribute("data-id"));
  var product = findProductById(id);
  if (product === null) {
    return;
  }

  editingProductId = id;
  draft = {
    name: product.name,
    category: product.category,
    price: product.price,
    active: product.active,
    size: product.size || "Regular",
    image: product.image,
  };

  fillModal();
  if (tableView) tableView.style.display = "none";
  if (editView) editView.style.display = "block";
}

function closeModal() {
  if (editView) editView.style.display = "none";
  if (tableView) tableView.style.display = "block";
  editingProductId = null;
  draft = null;
}

if (modalCloseBtn) modalCloseBtn.addEventListener("click", closeModal);
if (btnDiscard) btnDiscard.addEventListener("click", closeModal);

if (btnDone) {
  btnDone.addEventListener("click", function () {
    var product = findProductById(editingProductId);
    if (product !== null && draft !== null) {
      product.name = draft.name;
      product.category = draft.category;
      product.price = draft.price;
      product.active = draft.active;
      product.size = draft.size;
      product.image = draft.image;
    }
    renderProducts();
    closeModal();
  });
}

function startFieldEdit(field, button) {
  if (!draft) return;

  if (field === "status") {
    draft.active = !draft.active;
    fillModal();
    return;
  }

  var currentValue = draft[field];

  var input = document.createElement("input");
  input.type = field === "price" ? "number" : "text";
  if (field === "price") {
    input.step = "0.01";
  }
  input.value = currentValue;
  input.className = "inline-edit-input";

  var row = button.parentElement;
  var existingInput = row.querySelector("input, select");
  if (existingInput) {
    return;
  }

  var displaySpans = row.querySelectorAll("span");
  for (var i = 0; i < displaySpans.length; i++) {
    displaySpans[i].style.display = "none";
  }

  if (field === "category") {
    var select = document.createElement("select");
    var options = ["Beverage", "Pastry", "Savory", "Breakfast", "Lunch"];
    for (var j = 0; j < options.length; j++) {
      var opt = document.createElement("option");
      opt.value = options[j];
      opt.textContent = options[j];
      if (options[j] === currentValue) {
        opt.selected = true;
      }
      select.appendChild(opt);
    }
    row.insertBefore(select, button);
    select.focus();
    select.addEventListener("change", function () {
      draft.category = select.value;
      fillModal();
    });
    return;
  }

  row.insertBefore(input, button);
  input.focus();

  function commit() {
    var newValue = input.value;
    if (field === "price") {
      var parsed = parseFloat(newValue);
      draft.price = isNaN(parsed) ? draft.price : parsed;
    } else if (field === "name") {
      draft.name = newValue.trim() !== "" ? newValue : draft.name;
    } else if (field === "size") {
      draft.size = newValue.trim() !== "" ? newValue : draft.size;
    }
    fillModal();
  }

  input.addEventListener("blur", commit);
  input.addEventListener("keydown", function (ev) {
    if (ev.key === "Enter") {
      input.blur();
    }
  });
}

var pencilButtons = document.querySelectorAll(".pencil-btn");
for (var p = 0; p < pencilButtons.length; p++) {
  pencilButtons[p].addEventListener("click", function () {
    var field = this.getAttribute("data-field");
    startFieldEdit(field, this);
  });
}

// Initial render
renderProducts();

