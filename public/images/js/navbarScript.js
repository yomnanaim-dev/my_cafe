document.addEventListener('DOMContentLoaded', function() {
    const navbar = document.getElementById('navbar');
    const navbarToggle = document.getElementById('navbarToggle');
    const navbarMenu = document.getElementById('navbarMenu');
    const navbarItems = document.querySelectorAll('.navbar-item');
    
    // متغيرات للتحكم
    let lastScrollPosition = 0;
    const SCROLL_THRESHOLD = 50; // عدد البكسلات قبل الإخفاء
    let isExpanded = true;

    // ===== دالة تتبع التمرير =====
    window.addEventListener('scroll', function() {
        const scrollPosition = window.scrollY;

        // إذا تجاوز التمرير عتبة معينة
        if (scrollPosition > SCROLL_THRESHOLD) {
            if (isExpanded) {
                navbar.classList.remove('navbar-expanded');
                navbar.classList.add('navbar-collapsed');
                isExpanded = false;
            }
        } else {
            if (!isExpanded) {
                navbar.classList.add('navbar-expanded');
                navbar.classList.remove('navbar-collapsed');
                isExpanded = true;
            }
        }

        lastScrollPosition = scrollPosition;
    });

    // ===== تبديل القائمة على الهاتف =====
    navbarToggle.addEventListener('click', function() {
        navbarMenu.classList.toggle('active');
        navbarToggle.classList.toggle('active');
    });

    // إغلاق القائمة عند النقر على رابط
    navbarItems.forEach(item => {
        item.addEventListener('click', function() {
            navbarMenu.classList.remove('active');
            navbarToggle.classList.remove('active');
        });
    });

    // إغلاق القائمة عند النقر خارجها
    document.addEventListener('click', function(event) {
        const isClickInsideNav = navbar.contains(event.target);
        if (!isClickInsideNav && navbarMenu.classList.contains('active')) {
            navbarMenu.classList.remove('active');
            navbarToggle.classList.remove('active');
        }
    });

    // تعيين الفئة الأولية
    if (window.scrollY > SCROLL_THRESHOLD) {
        navbar.classList.add('navbar-collapsed');
    } else {
        navbar.classList.add('navbar-expanded');
    }
});