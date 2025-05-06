document.addEventListener('DOMContentLoaded', function () {
    console.log('JavaScript loaded!');

    const searchButton = document.querySelector('.search-box button');
    if (searchButton) {
        searchButton.addEventListener('click', function () {
            alert('Searching for hotels...');
        });
    }

    const promoCards = document.querySelectorAll('.promo-card');
    promoCards.forEach(card => {
        card.addEventListener('mouseenter', () => {
            card.style.transform = 'translateY(-10px)';
        });
        card.addEventListener('mouseleave', () => {
            card.style.transform = 'translateY(0)';
        });
    });
    flatpickr("#datepicker", {
        dateFormat: "d/m/Y",
    });
    const modal = document.getElementById('authModal');
    if (modal) {
        modal.addEventListener('click', function (event) {
            if (event.target === modal) {
                const modalInstance = bootstrap.Modal.getInstance(modal);
                modalInstance.hide();
            }
        });
    }
});
document.addEventListener('DOMContentLoaded', function () {
    flatpickr("#checkin", {
        dateFormat: "D, d M",
        defaultDate: "today",
    });
    flatpickr("#checkout", {
        dateFormat: "D, d M",
        defaultDate: new Date().fp_incr(1),
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const profileSection = document.getElementById('profileSection');
    const bookingHistorySection = document.getElementById('bookingHistorySection');
    const profileMenuItem = document.getElementById('profileMenuItem');
    const historyMenuItem = document.getElementById('historyMenuItem');

    profileMenuItem.addEventListener('click', function () {
        profileSection.style.display = 'block';
        bookingHistorySection.style.display = 'none';
        profileMenuItem.classList.add('active');
        historyMenuItem.classList.remove('active');
    });

    historyMenuItem.addEventListener('click', function () {
        profileSection.style.display = 'none';
        bookingHistorySection.style.display = 'block';
        profileMenuItem.classList.remove('active');
        historyMenuItem.classList.add('active');
    });
});
