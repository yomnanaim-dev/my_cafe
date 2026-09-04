<?php

require_once __DIR__ . "/../../models/Order.php";

$statusMap = [
    'pending'   => 'Processing',
    'confirmed' => 'Out for Delivery',
    'completed' => 'Done',
    'cancelled' => 'Cancelled'
];

?>

<div class="orders-page">

    <div class="page-title">
        <h1>My Orders</h1>
        <p>View your orders and track their status</p>
    </div>


    <!-- Date Filter -->

    <form class="date-filter" method="GET">

        <div>
            <label>From</label>

            <input
                type="date"
                name="from"
                value="<?= htmlspecialchars($_GET['from'] ?? '') ?>"
            >
        </div>

        <div>
            <label>To</label>

            <input
                type="date"
                name="to"
                value="<?= htmlspecialchars($_GET['to'] ?? '') ?>"
            >
        </div>

        <button type="submit">
            Filter
        </button>

    </form>


    <!-- Orders -->

    <div class="orders-list">

        <?php if (empty($orders)): ?>

            <div class="empty">
                No orders found.
            </div>

        <?php else: ?>

            <?php foreach ($orders as $order): ?>

                <?php
                $status = $order['order_status'];

                $statusText =
                    $statusMap[$status] ?? $status;

                $orderId = (int)$order['order_id'];
                ?>

                <div class="order-card">

                    <!-- Order Header -->

                    <div class="order-info">

                        <div>
                            <strong>
                                Order #<?= $orderId ?>
                            </strong>

                            <small>
                                <?= date(
                                    'Y-m-d H:i',
                                    strtotime($order['order_created_at'])
                                ) ?>
                            </small>
                        </div>

                        <strong class="total">
                            <?= htmlspecialchars($order['order_total']) ?>
                            EGP
                        </strong>

                    </div>


                    <!-- Status -->

                    <div class="order-status">

                        <span class="status <?= htmlspecialchars($status) ?>">
                            <?= htmlspecialchars($statusText) ?>
                        </span>

                    </div>


                    <!-- Expand Button -->

                    <button
                        type="button"
                        class="details-btn"
                        onclick="toggleOrder(<?= $orderId ?>)"
                    >
                        <span id="btn-text-<?= $orderId ?>">
                            View Details
                        </span>

                        <span id="arrow-<?= $orderId ?>">
                            ▼
                        </span>
                    </button>


                    <!-- Order Details -->

                    <div
                        class="order-details"
                        id="details-<?= $orderId ?>"
                    >

                        <?php if (!empty($order['items'])): ?>

                            <?php foreach ($order['items'] as $item): ?>

                                <div class="item">

                                    <span>
                                        <?= htmlspecialchars(
                                            $item['product_name']
                                        ) ?>
                                    </span>

                                    <span>
                                        × <?= (int)$item['item_QTY'] ?>
                                    </span>

                                    <strong>
                                        <?= htmlspecialchars(
                                            $item['price_at_order']
                                        ) ?>
                                        EGP
                                    </strong>

                                </div>

                            <?php endforeach; ?>

                        <?php else: ?>

                            <div class="item">
                                No items found.
                            </div>

                        <?php endif; ?>


                        <!-- Room + Note -->

                        <div class="extra-info">

                            <span>
                                Room:
                                <?= htmlspecialchars(
                                    $order['room_number'] ?? 'N/A'
                                ) ?>
                            </span>

                            <span>
                                Note:
                                <?= htmlspecialchars(
                                    $order['order_note'] ?? 'None'
                                ) ?>
                            </span>

                        </div>


                        <!-- Cancel -->

                        <?php if (Order::canCancel($status)): ?>

                            <form
                                method="POST"
                                action="/my_cafe/cancel-my-order"
                            >

                                <input
                                    type="hidden"
                                    name="order_id"
                                    value="<?= $orderId ?>"
                                >

                                <button
                                    type="submit"
                                    class="cancel-btn"
                                >
                                    Cancel Order
                                </button>

                            </form>

                        <?php endif; ?>

                    </div>

                </div>

            <?php endforeach; ?>

        <?php endif; ?>

    </div>

</div>
<style>

.orders-page {
    width: min(1000px, 92%);
    margin: auto;
    padding: 50px 0;
}

.page-title {
    margin-bottom: 25px;
}

.page-title h1 {
    margin: 0;
    color: #546B41;
}

.page-title p {
    color: #777;
}


/* Date Filter */

.date-filter {
    display: flex;
    align-items: end;
    gap: 15px;
    margin-bottom: 30px;
    padding: 20px;
    background: white;
    border: 1px solid #DCCCAC;
    border-radius: 12px;
}

.date-filter div {
    flex: 1;
}

.date-filter label {
    display: block;
    margin-bottom: 7px;
    color: #555;
}

.date-filter input {
    width: 100%;
    box-sizing: border-box;
    padding: 10px;
    border: 1px solid #DCCCAC;
    border-radius: 7px;
}

.date-filter button {
    padding: 11px 25px;
    border: 0;
    border-radius: 7px;
    background: #546B41;
    color: white;
    cursor: pointer;
}


/* Orders */

.orders-list {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.order-card {
    background: white;
    border: 1px solid #DCCCAC;
    border-radius: 12px;
    padding: 22px;
}


/* Order Info */

.order-info {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.order-info strong {
    color: #333;
}

.order-info small {
    display: block;
    margin-top: 5px;
    color: #888;
}

.order-info .total {
    color: #546B41;
}


/* Status */

.order-status {
    margin-top: 15px;
}

.status {
    display: inline-block;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 13px;
}

.status.pending {
    background: #fff3cd;
    color: #856404;
}

.status.confirmed {
    background: #dbeafe;
    color: #1e40af;
}

.status.completed {
    background: #d1fae5;
    color: #065f46;
}

.status.cancelled {
    background: #fee2e2;
    color: #991b1b;
}


/* Details Button */

.details-btn {
    margin-top: 18px;
    padding: 9px 15px;
    border: 1px solid #DCCCAC;
    border-radius: 7px;
    background: white;
    color: #546B41;
    cursor: pointer;
    font-size: 14px;
}

.details-btn:hover {
    background: #f7f5ef;
}


/* Order Details */

.order-details {
    display: none;
    margin-top: 18px;
    padding-top: 15px;
    border-top: 1px solid #eee;
}

.order-details.show {
    display: block;
}


/* Items */

.item {
    display: grid;
    grid-template-columns: 1fr auto auto;
    gap: 20px;
    padding: 10px 0;
    border-bottom: 1px solid #f1f1f1;
}


/* Room + Note */

.extra-info {
    display: flex;
    justify-content: space-between;
    gap: 20px;
    margin-top: 15px;
    color: #666;
}


/* Cancel */

.cancel-btn {
    margin-top: 18px;
    padding: 9px 18px;
    border: 0;
    border-radius: 7px;
    background: #b84a4a;
    color: white;
    cursor: pointer;
}

.cancel-btn:hover {
    opacity: 0.9;
}


/* Empty */

.empty {
    padding: 40px;
    text-align: center;
    background: white;
    border: 1px solid #DCCCAC;
    border-radius: 12px;
    color: #777;
}


/* Mobile */

@media (max-width: 700px) {

    .date-filter {
        flex-direction: column;
        align-items: stretch;
    }

    .item {
        grid-template-columns: 1fr;
        gap: 5px;
    }

    .extra-info {
        flex-direction: column;
    }

    .order-info {
        gap: 15px;
    }

}

</style>
<script src="/my_cafe/public/js/script.js"></script>