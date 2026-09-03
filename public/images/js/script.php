<script>
        // Scroll Reveal Logic
        function reveal() {
            var reveals = document.querySelectorAll(".reveal");
            for (var i = 0; i < reveals.length; i++) {
                var windowHeight = window.innerHeight;
                var elementTop = reveals[i].getBoundingClientRect().top;
                var elementVisible = 100;
                if (elementTop < windowHeight - elementVisible) {
                    reveals[i].classList.add("active");
                }
            }
        }
        window.addEventListener("scroll", reveal);
        reveal(); // Trigger on load

    


const orders = <?= json_encode($orders) ?>;

function showOrder(id){

    let order = orders.find(o => o.id == id);
    let box = document.getElementById("order-details");

    box.innerHTML = `
        <div class="details">

            <h2>Order #${order.id}</h2>

            <p><b>Status:</b> ${order.status}</p>
            <p><b>Room:</b> ${order.room || "N/A"}</p>
            <p><b>Notes:</b> ${order.notes || "No notes"}</p>

            <h3>Products</h3>

            ${order.items.map(item => `
                <div class="detail-item">
                    <span>${item.name} × ${item.qty}</span>
                    <b>${item.price * item.qty} EGP</b>
                </div>
            `).join("")}

            <div class="detail-total">
                <b>Total</b>
                <b>${order.total} EGP</b>
            </div>

        </div>
    `;
}

function changeQty(btn,change){

    let item = btn.closest(".cart-item");
    let qty = item.querySelector(".quantity span");

    qty.textContent = Math.max(1,+qty.textContent + change);

    item.querySelector(".item-total").textContent =
        +item.dataset.price * +qty.textContent + " EGP";

    updateCart();
}

function removeItem(btn){

    btn.closest(".cart-item").remove();
    updateCart();

}
function updateCart(){

    let count=0;
    let total=0;

    document.querySelectorAll(".cart-item").forEach(item=>{

        let qty=+item.querySelector(".quantity span").textContent;
        let price=+item.dataset.price;

        count+=qty;
        total+=qty*price;

    });

    document.getElementById("count").textContent=count;
    document.getElementById("total").textContent=total+" EGP";
}

function openCheckout(){

    document.querySelector(".orders-page").style.display="none";
    document.querySelector(".checkout-page").style.display="block";

    let box=document.getElementById("checkout-items");
    let total=0;

    box.innerHTML="";

    document.querySelectorAll(".cart-item").forEach(item=>{

        let name=item.querySelector("strong").textContent;
        let qty=+item.querySelector(".quantity span").textContent;
        let price=+item.dataset.price;
        let sum=qty*price;

        total+=sum;

        box.innerHTML+=`
            <div class="checkout-item">
                <span>${name} × ${qty}</span>
                <strong>${sum} EGP</strong>
            </div>
        `;
    });

    document.getElementById("checkout-total").textContent=total+" EGP";
}

function backToCart(){

    document.querySelector(".checkout-page").style.display="none";
    document.querySelector(".orders-page").style.display="block";
}




function placeOrder(){
    alert("Order placed successfully!");
}

</script>

