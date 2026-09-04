<div class="checkout-page">

    <div class="checkout-header">

        <button
            type="button"
            onclick="backToCart()"
        >
            ← Back
        </button>

        <h1>Checkout</h1>

    </div>


    <div class="checkout-content">

        <div class="checkout-form">

            <h2>Order Details</h2>

            <form
                method="POST"
                action="/my_cafe/index.php?route=place-order"
            >

                <label for="room-number">
                    Room Number
                </label>

                <input
                    id="room-number"
                    name="room_id"
                    type="number"
                    placeholder="Enter room number"
                    min="1"
                    required
                >


                <label for="order-notes">
                    Notes
                </label>

                <textarea
                    id="order-notes"
                    name="note"
                    placeholder="Any special notes?"
                ></textarea>


                <input
                    type="hidden"
                    name="total"
                    id="order-total-input"
                    value="0"
                >


                <button
                    type="submit"
                    class="place-order"
                >
                    Place Order
                </button>

            </form>

        </div>


        <div class="checkout-summary">

            <h2>Your Order</h2>

            <div id="checkout-items">
            </div>


            <div class="checkout-total">

                <span>
                    Total
                </span>

                <strong id="checkout-total">
                    0 EGP
                </strong>

            </div>

        </div>

    </div>

</div>


<style>

.checkout-page {
    display: block;
    width: min(1000px, 92%);
    margin: auto;
    padding: 60px 0;
}

.checkout-header {
    display: flex;
    align-items: center;
    gap: 20px;
    margin-bottom: 30px;
}

.checkout-header h1 {
    margin: 0;
    color: #546B41;
}

.checkout-header button {
    border: 0;
    background: none;
    color: #546B41;
    font-size: 16px;
    cursor: pointer;
}

.checkout-content {
    display: grid;
    grid-template-columns: 1.4fr 1fr;
    gap: 25px;
}

.checkout-form,
.checkout-summary {
    background: white;
    padding: 25px;
    border: 1px solid #DCCCAC;
    border-radius: 12px;
}

.checkout-form h2,
.checkout-summary h2 {
    margin-top: 0;
    color: #546B41;
}

.checkout-form label {
    display: block;
    margin: 15px 0 6px;
    color: #555;
}

.checkout-form input,
.checkout-form textarea {
    width: 100%;
    box-sizing: border-box;
    padding: 12px;
    border: 1px solid #DCCCAC;
    border-radius: 7px;
    font-size: 14px;
}

.checkout-form textarea {
    height: 100px;
    resize: vertical;
}

.place-order {
    width: 100%;
    margin-top: 20px;
    padding: 13px;
    border: 0;
    border-radius: 7px;
    background: #546B41;
    color: white;
    cursor: pointer;
    font-size: 15px;
}

.checkout-item {
    display: flex;
    justify-content: space-between;
    gap: 10px;
    padding: 14px 0;
    border-bottom: 1px solid #eee;
}

.checkout-total {
    display: flex;
    justify-content: space-between;
    margin-top: 20px;
    padding-top: 18px;
    border-top: 1px solid #DCCCAC;
    color: #546B41;
}

@media (max-width: 700px) {

    .checkout-page {
        padding: 35px 0;
    }

    .checkout-content {
        grid-template-columns: 1fr;
    }

    .checkout-form,
    .checkout-summary {
        padding: 18px;
    }
}

</style>

<script src="/cafeteria/public/js/script.js"></script>
<!-- views/orders/checks.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Admin - Order Checks</title>
    <link rel="stylesheet" href="/public/css/orders.css">
</head>
<body>
    <div class="container">
        <h1>📊 Order Checks</h1>
        
        <form method="GET" action="/admin/checks" class="filters">
            <div class="filter-group">
                <label>From Date:</label>
                <input type="date" name="from_date" value="<?= htmlspecialchars($fromDate) ?>">
            </div>
            
            <div class="filter-group">
                <label>To Date:</label>
                <input type="date" name="to_date" value="<?= htmlspecialchars($toDate) ?>">
            </div>
            
            <div class="filter-group">
                <label>User:</label>
                <select name="user_id">
                    <option value="all" <?= $userId === 'all' ? 'selected' : '' ?>>All Users</option>
                    <?php foreach ($users as $user): ?>
                        <option value="<?= $user['id'] ?>" <?= $userId == $user['id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($user['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <button type="submit">Apply Filters</button>
        </form>
        
        <table class="checks-table">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Orders Count</th>
                    <th>Total Amount</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($reportData)): ?>
                    <tr><td colspan="4">No orders found</td></tr>
                <?php else: ?>
                    <?php foreach ($reportData as $userId => $data): ?>
                        <tr>
                            <td>
                                <a href="/admin/order-details/user/<?= $userId ?>?from=<?= $fromDate ?>&to=<?= $toDate ?>" class="user-link">
                                    <?= htmlspecialchars($data['user_name']) ?>
                                </a>
                            </td>
                            <td><?= $data['order_count'] ?></td>
                            <td><?= number_format($data['total_amount'], 2) ?> EGP</td>
                            <td>
                                <a href="/admin/order-details/user/<?= $userId ?>?from=<?= $fromDate ?>&to=<?= $toDate ?>" class="details-link">
                                    View Orders
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    
    <script src="/public/js/orders.js"></script>
</body>
</html>
