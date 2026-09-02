document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.product-card').forEach(card => {
        card.querySelectorAll('.qty-btn').forEach((btn, index) => {
            const isPlus = index === 1; // 0 for minus, 1 for plus
            btn.onclick = () => {
                let qEl = card.querySelector('.qty-val');
                qEl.textContent = Math.max(0, +qEl.textContent + (isPlus ? 1 : -1));
                
                let total = 0, items = '', inputs = '';
                document.querySelectorAll('.product-card').forEach(c => {
                    let q = +c.querySelector('.qty-val').textContent;
                    if (q > 0) {
                        total += q * parseFloat(c.dataset.price);
                        items += `<div class="order-item"><span>${q}x ${c.dataset.name}</span><span>$${(q * parseFloat(c.dataset.price)).toFixed(2)}</span></div>`;
                        inputs += `<input type="hidden" name="products[${c.dataset.id}]" value="${q}">`;
                    }
                });
                
                document.getElementById('orderItemsList').innerHTML = items || '<span style="color: #7A8071; font-size: 13px;">No items selected yet.</span>';
                document.getElementById('hiddenInputs').innerHTML = inputs;
                document.getElementById('subtotalPrice').textContent = `$${total.toFixed(2)}`;
                document.getElementById('totalPrice').textContent = `$${total.toFixed(2)}`;
            };
        });
    });
});