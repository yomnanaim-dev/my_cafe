<?php
require_once __DIR__ . "/../../models/Order.php";


$orders = [
    [
        "id"=>101,
        "date"=>"2026-08-20",
        "total"=>250,
        "status"=>"Processing",
        "room"=>"204",
        "notes"=>"Less sugar",
        "items"=>[
            ["name"=>"Cappuccino","qty"=>2,"price"=>80],
            ["name"=>"Cake","qty"=>1,"price"=>90]
        ]
    ],
    [
        "id"=>102,
        "date"=>"2026-08-25",
        "total"=>340,
        "status"=>"Out for Delivery",
        "room"=>"310",
        "notes"=>"",
        "items"=>[
            ["name"=>"Club Sandwich","qty"=>2,"price"=>170]
        ]
    ],
    [
        "id"=>103,
        "date"=>"2026-08-27",
        "total"=>180,
        "status"=>"Done",
        "room"=>"205",
        "notes"=>"No sugar",
        "items"=>[
            ["name"=>"Coffee","qty"=>2,"price"=>50],
            ["name"=>"Juice","qty"=>1,"price"=>80]
        ]
    ]
];

$cart = [
    ["name"=>"Cappuccino","price"=>80,"qty"=>2],
    ["name"=>"Club Sandwich","price"=>150,"qty"=>1],
    ["name"=>"Fresh Juice","price"=>70,"qty"=>1]
];

$count = 0;
$total = 0;

foreach($cart as $item){
    $count += $item["qty"];
    $total += $item["price"] * $item["qty"];
}
?>

<div class="orders-page">

    <div class="page-title">
        <h1>My Orders</h1>
        <p>View your orders and track their status</p>
    </div>

    <form class="date-filter">
        <div>
            <label>From</label>
            <input type="date" name="from">
        </div>

        <div>
            <label>To</label>
            <input type="date" name="to">
        </div>

        <button>Filter</button>
    </form>

    <div class="orders-list">

        <?php foreach($orders as $order): ?>

            <div class="order"
                 onclick="showOrder(<?= $order['id'] ?>)">

                <div>
                    <strong>Order #<?= $order["id"] ?></strong>
                    <small><?= $order["date"] ?></small>
                </div>

                <strong><?= $order["total"] ?> EGP</strong>

                <span><?= $order["status"] ?></span>

                <?php if(Order::canCancel($order["status"])): ?>
                    <button onclick="event.stopPropagation()">
                        Cancel
                    </button>
                <?php endif; ?>

            </div>

        <?php endforeach; ?>

    </div>

    <div id="order-details"></div>

    <div class="cart-section">

        <div class="section-title">
            <h2>Your Cart</h2>
            <span><?= $count ?> items</span>
        </div>

        <div class="cart-list">

            <?php foreach($cart as $item): ?>

                <div class="cart-item"
                     data-price="<?= $item["price"] ?>">

                    <div>
                        <strong><?= $item["name"] ?></strong>
                        <small><?= $item["price"] ?> EGP each</small>
                    </div>

                    <div class="quantity">
                        <button onclick="changeQty(this,-1)">−</button>
                        <span><?= $item["qty"] ?></span>
                        <button onclick="changeQty(this,1)">+</button>
                    </div>

                    <strong class="item-total">
                        <?= $item["price"]*$item["qty"] ?> EGP
                    </strong>

                    <button class="remove"
                            onclick="removeItem(this)">
                        ×
                    </button>

                </div>

            <?php endforeach; ?>

        </div>

        <div class="cart-bottom">

            <div>
                <small>Items</small>
                <strong id="count"><?= $count ?></strong>
            </div>

            <div>
                <small>Total</small>
                <strong id="total"><?= $total ?> EGP</strong>
            </div>

            <button class="checkout-btn"
                    onclick="openCheckout()">
                Checkout
            </button>

        </div>

    </div>

</div>

<?php require "checkout.php"; ?>


<style>

.orders-page{
    max-width:1000px;
    margin:auto;
    padding:110px 25px 70px;
    color:#546B41;
}

.page-title{
    text-align:center;
    margin-bottom:35px;
}

.page-title h1{
    font-size:36px;
    margin-bottom:8px;
}

.page-title p{
    color:#777;
}

.date-filter{
    display:flex;
    justify-content:center;
    align-items:end;
    gap:12px;
    margin-bottom:25px;
}

.date-filter label{
    display:block;
    font-size:13px;
    margin-bottom:5px;
}

.date-filter input{
    padding:10px;
    border:1px solid #DCCCAC;
    border-radius:7px;
}

.date-filter button,
.checkout-btn{
    padding:11px 22px;
    border:0;
    border-radius:7px;
    background:#546B41;
    color:white;
    cursor:pointer;
}

.orders-list,
.cart-list{
    background:white;
    border:1px solid #DCCCAC;
    border-radius:12px;
    overflow:hidden;
}

.order{
    display:grid;
    grid-template-columns:1.5fr 1fr 1.2fr auto;
    align-items:center;
    gap:15px;
    padding:18px 22px;
    border-bottom:1px solid #eee;
    cursor:pointer;
}

.order:last-child{
    border-bottom:0;
}

.order small,
.cart-item small{
    display:block;
    color:#999;
    margin-top:4px;
}

.status{
    background:#DCCCAC;
    color:#546B41;
    padding:6px 12px;
    border-radius:20px;
    font-size:13px;
    width:max-content;
}

.order button{
    border:0;
    background:#FFF8EC;
    color:#546B41;
    padding:7px 12px;
    border-radius:6px;
    cursor:pointer;
}

.cart-section{
    margin-top:45px;
}

.section-title{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:15px;
}

.section-title h2{
    margin:0;
}

.section-title span{
    color:#888;
    font-size:14px;
}

.cart-item{
    display:grid;
    grid-template-columns:1fr auto auto auto;
    align-items:center;
    gap:25px;
    padding:18px 22px;
    border-bottom:1px solid #eee;
}

.quantity{
    display:flex;
    align-items:center;
    gap:10px;
}

.quantity button{
    width:28px;
    height:28px;
    border:1px solid #DCCCAC;
    background:#FFF8EC;
    color:#546B41;
    border-radius:6px;
    cursor:pointer;
}

.remove{
    border:0;
    background:none;
    color:#999;
    font-size:20px;
    cursor:pointer;
}

.cart-bottom{
    display:flex;
    justify-content:flex-end;
    align-items:center;
    gap:35px;
    margin-top:18px;
    padding:20px;
    background:#FFF8EC;
    border-radius:10px;
}

.cart-bottom small{
    display:block;
    color:#888;
}

#order-details{
    margin-top:25px;
}

.details{
    background:white;
    border:1px solid #DCCCAC;
    border-radius:12px;
    padding:25px;
}

.details h2{
    margin-top:0;
}

.detail-item,
.detail-total{
    display:flex;
    justify-content:space-between;
    padding:12px 0;
    border-bottom:1px solid #eee;
}

.detail-total{
    border-top:2px solid #DCCCAC;
    border-bottom:0;
    margin-top:10px;
    padding-top:18px;
}

@media(max-width:700px){

    .date-filter{
        flex-wrap:wrap;
    }

    .order{
        grid-template-columns:1fr 1fr;
    }

    .cart-item{
        grid-template-columns:1fr auto;
    }

    .cart-bottom{
        flex-wrap:wrap;
        justify-content:center;
    }
}

</style>
<script src="/cafeteria/public/js/script.js"></script>