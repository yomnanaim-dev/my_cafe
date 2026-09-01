<?php require "views/layouts/header.php"; ?>
<link rel="stylesheet" href="public/css/manual_order.css">
<?php require "views/layouts/navbar.php"; ?>

<main class="manual-order-page">
    <div class="order-wrapper">
        <div class="page-header">
            <h2 class="page-title">Manual Order Creation</h2>
        </div>

        <form class="main-grid" action="/manual-order" method="POST">
           
            <div class="card">
                <label class="form-label">Available Menu Products</label>
                <div class="products-grid">
                    
                    <!-- Product 1 -->
                    <div class="product-card" data-id="1" data-price="3.50" data-name="Espresso">
                        <img src="https://images.unsplash.com/photo-1510591509098-f4fdc6d0ff04?w=300" alt="Espresso" class="product-img">
                        <div class="product-details">
                            <h4 class="product-title">Espresso</h4>
                            <div class="product-price">$3.50</div>
                            <div class="qty-control">
                                <button type="button" class="qty-btn">-</button>
                                <span class="qty-val">0</span>
                                <button type="button" class="qty-btn">+</button>
                            </div>
                        </div>
                    </div>

                
                    <div class="product-card" data-id="3" data-price="5.00" data-name="Iced Latte">
                        <img src="https://images.unsplash.com/photo-1517701604599-bb29b565090c?w=300" alt="Iced Latte" class="product-img">
                        <div class="product-details">
                            <h4 class="product-title">Iced Latte</h4>
                            <div class="product-price">$5.00</div>
                            <div class="qty-control">
                                <button type="button" class="qty-btn">-</button>
                                <span class="qty-val">0</span>
                                <button type="button" class="qty-btn">+</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

          
            <div class="card sticky-card">
                <h3 class="summary-title">Order Details</h3>

                <div style="margin-bottom: 1rem;">
                    <label class="form-label" for="user">Select Customer</label>
                    <select class="custom-select" id="user" name="user_id" required>
                        <option value="">-- Choose User --</option>
                        <option value="1">John Doe</option>
                        <option value="2">Jane Smith</option>
                    </select>
                </div>

                <div style="margin-bottom: 1rem;">
                    <label class="form-label" for="room">Room Number</label>
                    <select class="custom-select" id="room" name="room_id" required>
                        <option value="">-- Select Room --</option>
                        <option value="101">Room 101</option>
                        <option value="102">Room 102</option>
                    </select>
                </div>

                <div style="margin-bottom: 1rem;">
                    <label class="form-label" for="notes">Special Notes</label>
                    <textarea class="custom-textarea" id="notes" name="notes" rows="2" placeholder="e.g. Extra sugar, no ice..."></textarea>
                </div>

                <label class="form-label">Order Items</label>
                <div class="order-items-list" id="orderItemsList">
                    <span style="color: #7A8071; font-size: 0.8125rem;">No items selected yet.</span>
                </div>

                <div id="hiddenInputs"></div>

                <div class="summary-row">
                    <span>Subtotal</span>
                    <span id="subtotalPrice">$0.00</span>
                </div>

                <div class="total-row">
                    <span>Total Amount</span>
                    <span id="totalPrice">$0.00</span>
                </div>

                <button type="submit" class="btn-confirm">
                    ✓ Place Manual Order
                </button>
            </div>
        </form>
    </div>
</main>

<script src="public/js/manual_order.js"></script>
<?php require "views/layouts/footer.php"; ?>