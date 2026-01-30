// Toggle Submenu - dibuat global (menggunakan code original Anda)
window.toggleSubmenu = function(id) {
    const submenu = document.getElementById(id);
    const arrow = event.currentTarget.querySelector('.arrow');
    
    submenu.classList.toggle('active');
    arrow.classList.toggle('rotate');
};

// Animasi angka counter untuk statistik
function animateCounter(element, target, duration = 2000) {
    const start = 0;
    const increment = target / (duration / 16);
    let current = start;
    
    const timer = setInterval(() => {
        current += increment;
        if (current >= target) {
            element.textContent = target;
            clearInterval(timer);
        } else {
            element.textContent = Math.floor(current);
        }
    }, 16);
}

// Animasi untuk nilai rupiah
function animateRupiah(element, target, duration = 2000) {
    const targetValue = parseFloat(target.replace(/[^\d.]/g, ''));
    const start = 0;
    const increment = targetValue / (duration / 16);
    let current = start;
    
    const timer = setInterval(() => {
        current += increment;
        if (current >= targetValue) {
            element.textContent = `Rp ${targetValue}M`;
            clearInterval(timer);
        } else {
            element.textContent = `Rp ${current.toFixed(1)}M`;
        }
    }, 16);
}

// Update waktu real-time pada aktivitas
function updateActivityTime() {
    const activities = document.querySelectorAll('.activity-time');
    const times = ['5 menit yang lalu', '15 menit yang lalu', '1 jam yang lalu', '2 jam yang lalu'];
    
    activities.forEach((activity, index) => {
        if (times[index]) {
            activity.textContent = times[index];
        }
    });
}

// Animasi card saat hover
function initCardAnimations() {
    const cards = document.querySelectorAll('.stat-card, .card');
    
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px)';
            this.style.transition = 'all 0.3s ease';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
}

// Highlight baris tabel saat hover
function initTableInteractions() {
    const tableRows = document.querySelectorAll('tbody tr');
    
    tableRows.forEach(row => {
        row.addEventListener('mouseenter', function() {
            this.style.backgroundColor = '#f1f5f9';
            this.style.cursor = 'pointer';
            this.style.transition = 'all 0.2s ease';
        });
        
        row.addEventListener('mouseleave', function() {
            this.style.backgroundColor = '';
        });
        
        row.addEventListener('click', function() {
            const transactionId = this.querySelector('td').textContent;
            showTransactionDetail(transactionId);
        });
    });
}

// Tampilkan detail transaksi (simulasi)
function showTransactionDetail(transactionId) {
    const details = {
        '#TRX001': { pelanggan: 'Ahmad Fauzi', mobil: 'Toyota Avanza', durasi: '3 hari', total: 'Rp 1.200.000' },
        '#TRX002': { pelanggan: 'Budi Santoso', mobil: 'Honda Civic', durasi: '5 hari', total: 'Rp 2.500.000' },
        '#TRX003': { pelanggan: 'Siti Nurhaliza', mobil: 'Suzuki Ertiga', durasi: '2 hari', total: 'Rp 900.000' },
        '#TRX004': { pelanggan: 'Eko Prasetyo', mobil: 'Mitsubishi Xpander', durasi: '4 hari', total: 'Rp 1.800.000' },
        '#TRX005': { pelanggan: 'Dewi Lestari', mobil: 'Daihatsu Terios', durasi: '3 hari', total: 'Rp 1.350.000' }
    };
    
    if (details[transactionId]) {
        const detail = details[transactionId];
        alert(`📋 Detail Transaksi ${transactionId}\n\n` +
              `👤 Pelanggan: ${detail.pelanggan}\n` +
              `🚗 Mobil: ${detail.mobil}\n` +
              `📅 Durasi: ${detail.durasi}\n` +
              `💰 Total: ${detail.total}`);
    }
}

// Animasi loading untuk statistik
function showLoadingAnimation() {
    const statValues = document.querySelectorAll('.stat-value');
    
    statValues.forEach(stat => {
        stat.style.opacity = '0';
        stat.style.transform = 'translateY(20px)';
    });
    
    setTimeout(() => {
        statValues.forEach((stat, index) => {
            setTimeout(() => {
                stat.style.transition = 'all 0.5s ease';
                stat.style.opacity = '1';
                stat.style.transform = 'translateY(0)';
            }, index * 150);
        });
    }, 100);
}

// Animasi untuk aktivitas terkini
function animateActivities() {
    const activities = document.querySelectorAll('.activity-item');
    
    activities.forEach((activity, index) => {
        activity.style.opacity = '0';
        activity.style.transform = 'translateX(-20px)';
        
        setTimeout(() => {
            activity.style.transition = 'all 0.4s ease';
            activity.style.opacity = '1';
            activity.style.transform = 'translateX(0)';
        }, index * 150);
    });
}

// Rotate icon pada stat cards
function rotateStatIcons() {
    const icons = document.querySelectorAll('.stat-icon');
    
    icons.forEach(icon => {
        icon.addEventListener('mouseenter', function() {
            this.style.transform = 'rotate(360deg) scale(1.1)';
            this.style.transition = 'all 0.6s ease';
        });
        
        icon.addEventListener('mouseleave', function() {
            this.style.transform = 'rotate(0deg) scale(1)';
        });
    });
}

// Update status badge dengan animasi
function animateStatusBadges() {
    const badges = document.querySelectorAll('.status');
    
    badges.forEach(badge => {
        badge.style.animation = 'pulse 2s infinite';
    });
}

// Tambahkan efek ripple pada menu item
function addRippleEffect() {
    const menuItems = document.querySelectorAll('.menu-item');
    
    menuItems.forEach(item => {
        item.addEventListener('click', function(e) {
            const ripple = document.createElement('span');
            ripple.classList.add('ripple-effect');
            
            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = e.clientX - rect.left - size / 2;
            const y = e.clientY - rect.top - size / 2;
            
            ripple.style.width = ripple.style.height = size + 'px';
            ripple.style.left = x + 'px';
            ripple.style.top = y + 'px';
            
            this.appendChild(ripple);
            
            setTimeout(() => ripple.remove(), 600);
        });
    });
}

// Fungsi ini dihapus karena data "Sedang Disewa" seharusnya 
// berdasarkan transaksi aktual, bukan random update

// Tambahkan notifikasi toast
function showToast(message, type = 'info') {
    const toast = document.createElement('div');
    toast.className = `toast toast-${type}`;
    toast.textContent = message;
    toast.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 15px 25px;
        background: ${type === 'success' ? '#10b981' : type === 'error' ? '#ef4444' : '#3b82f6'};
        color: white;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        z-index: 10000;
        animation: slideIn 0.3s ease;
    `;
    
    document.body.appendChild(toast);
    
    setTimeout(() => {
        toast.style.animation = 'slideOut 0.3s ease';
        setTimeout(() => toast.remove(), 300);
    }, 3000);
}

// Welcome message saat load
function showWelcomeMessage() {
    const hour = new Date().getHours();
    let greeting = 'Selamat pagi';
    
    if (hour >= 12 && hour < 15) greeting = 'Selamat siang';
    else if (hour >= 15 && hour < 18) greeting = 'Selamat sore';
    else if (hour >= 18) greeting = 'Selamat malam';
    
    setTimeout(() => {
        showToast(`${greeting}, Yudha Maulana Darham! 👋`, 'success');
    }, 500);
}

// Inisialisasi semua fungsi saat DOM ready
document.addEventListener('DOMContentLoaded', function() {
    // Tampilkan loading animation
    showLoadingAnimation();
    
    // Jalankan animasi counter untuk statistik
    setTimeout(() => {
        const statValues = document.querySelectorAll('.stat-value');
        animateCounter(statValues[0], 15);
        animateCounter(statValues[1], 1);
        animateCounter(statValues[2], 156);
        animateRupiah(statValues[3], '45.5');
    }, 600);
    
    // Inisialisasi interaksi
    initCardAnimations();
    initTableInteractions();
    animateActivities();
    rotateStatIcons();
    animateStatusBadges();
    addRippleEffect();
    
    // Update waktu aktivitas
    updateActivityTime();
    setInterval(updateActivityTime, 60000); // Update setiap menit
    
    // Tampilkan welcome message
    showWelcomeMessage();
    
    // Tambahkan CSS untuk animasi
    const style = document.createElement('style');
    style.textContent = `
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }
        
        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
        
        @keyframes slideOut {
            from {
                transform: translateX(0);
                opacity: 1;
            }
            to {
                transform: translateX(100%);
                opacity: 0;
            }
        }
        
        .ripple-effect {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.5);
            transform: scale(0);
            animation: ripple-animation 0.6s ease-out;
            pointer-events: none;
        }
        
        @keyframes ripple-animation {
            to {
                transform: scale(2);
                opacity: 0;
            }
        }
        
        .menu-item {
            position: relative;
            overflow: hidden;
        }
    `;
    document.head.appendChild(style);
});