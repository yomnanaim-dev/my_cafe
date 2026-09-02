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

        // public/js/orders.js

document.addEventListener('DOMContentLoaded', function() {
    // تحديث حالة الطلب
    const updateButtons = document.querySelectorAll('.update-status-btn');
    updateButtons.forEach(button => {
        button.addEventListener('click', function() {
            const orderId = this.dataset.orderId;
            const select = document.querySelector(`.status-select[data-order-id="${orderId}"]`);
            const status = select.value;
            
            if (!confirm(`Are you sure you want to change order #${orderId} status to "${status}"?`)) {
                return;
            }
            
            updateOrderStatus(orderId, status);
        });
    });
    
    // دالة تحديث الحالة عبر AJAX
    function updateOrderStatus(orderId, status) {
        const formData = new FormData();
        formData.append('order_id', orderId);
        formData.append('status', status);
        
        fetch('/admin/update-status', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Status updated successfully!');
                location.reload(); // إعادة تحميل الصفحة لتحديث الواجهة
            } else {
                alert('Error: ' + (data.message || 'Update failed'));
            }
        })
        .catch(error => {
            alert('Network error: ' + error.message);
        });
    }
    
    // دالة عرض طلبات المستخدم (لصفحة الـ Checks)
    window.viewUserOrders = function(userId, fromDate, toDate) {
        window.location.href = `/admin/order-details/user/${userId}?from=${fromDate}&to=${toDate}`;
    };
});

// دالة لتأكيد تغيير الحالة (استخدام اختياري)
function confirmStatusChange(orderId, newStatus) {
    return confirm(`Are you sure you want to change order #${orderId} to "${newStatus}"?`);
}
    </script>
    