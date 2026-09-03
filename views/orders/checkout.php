<div class="checkout-page">

    <div class="checkout-header">
        <button onclick="backToCart()">← Back</button>
        <h1>Checkout</h1>
    </div>

    <div class="checkout-content">

        <div class="checkout-form">

            <h2>Order Details</h2>

            <label>Room Number</label>
            <input type="text" placeholder="Enter room number">

            <label>Notes</label>
            <textarea placeholder="Any special notes?"></textarea>

            <button class="place-order"
                    onclick="placeOrder()">
                Place Order
            </button>

        </div>

        <div class="checkout-summary">

            <h2>Your Order</h2>

            <div id="checkout-items"></div>

            <div class="checkout-total">
                <span>Total</span>
                <strong id="checkout-total">0 EGP</strong>
            </div>

        </div>

    </div>

</div>

<style>

.checkout-page{
    display:none;
    max-width:1000px;
    margin:auto;
    padding:110px 25px 70px;
}

.checkout-header{
    display:flex;
    align-items:center;
    gap:20px;
    margin-bottom:30px;
}

.checkout-header h1{
    color:#546B41;
}

.checkout-header button{
    border:0;
    background:none;
    color:#546B41;
    cursor:pointer;
}

.checkout-content{
    display:grid;
    grid-template-columns:1.4fr 1fr;
    gap:25px;
}

.checkout-form,
.checkout-summary{
    background:white;
    padding:25px;
    border:1px solid #DCCCAC;
    border-radius:12px;
}

.checkout-form h2,
.checkout-summary h2{
    color:#546B41;
    margin-top:0;
}

.checkout-form label{
    display:block;
    margin:15px 0 6px;
    color:#555;
}

.checkout-form input,
.checkout-form textarea{
    width:100%;
    box-sizing:border-box;
    padding:12px;
    border:1px solid #DCCCAC;
    border-radius:7px;
}

.checkout-form textarea{
    height:100px;
    resize:none;
}

.place-order{
    width:100%;
    margin-top:20px;
    padding:13px;
    border:0;
    border-radius:7px;
    background:#546B41;
    color:white;
    cursor:pointer;
}

.checkout-item{
    display:flex;
    justify-content:space-between;
    padding:14px 0;
    border-bottom:1px solid #eee;
}

.checkout-total{
    display:flex;
    justify-content:space-between;
    margin-top:20px;
    padding-top:18px;
    border-top:1px solid #DCCCAC;
    color:#546B41;
}

@media(max-width:700px){
    .checkout-content{
        grid-template-columns:1fr;
    }
}

</style>

<script src="/cafeteria/public/js/script.js"></script>