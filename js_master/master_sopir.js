// Fungsi pencarian - dibuat global
window.searchTable = function() {
    const input = document.getElementById('searchInput');
    const filter = input.value.toLowerCase();
    const table = document.getElementById('sopirTable');
    const tr = table.getElementsByTagName('tr');

    for (let i = 1; i < tr.length; i++) {
        const td = tr[i].getElementsByTagName('td');
        let found = false;
        
        for (let j = 0; j < td.length - 1; j++) {
            if (td[j]) {
                const txtValue = td[j].textContent || td[j].innerText;
                if (txtValue.toLowerCase().indexOf(filter) > -1) {
                    found = true;
                    break;
                }
            }
        }
        
        tr[i].style.display = found ? '' : 'none';
    }
};

// Fungsi untuk menampilkan modal - dibuat global
window.showModal = function(mode, id = '') {
    const modal = document.getElementById('modalForm');
    const modalTitle = document.getElementById('modalTitle');
    const form = document.getElementById('sopirForm');
    
    if (mode === 'add') {
        modalTitle.textContent = 'Tambah Sopir Baru';
        form.reset();
        document.getElementById('idSopir').readOnly = false;
    } else if (mode === 'edit') {
        modalTitle.textContent = 'Edit Data Sopir';
        document.getElementById('idSopir').readOnly = true;
        loadDataForEdit(id);
    }
    
    modal.classList.add('active');
};

// Fungsi untuk menutup modal - dibuat global
window.closeModal = function() {
    const modal = document.getElementById('modalForm');
    modal.classList.remove('active');
};

// Fungsi untuk load data edit (simulasi)
function loadDataForEdit(id) {
    const dummyData = {
        'S001': { nama: 'Rizky Kurniawan', noHp: '08134567001', sim: 'SIM A', tarif: 150000 },
        'S002': { nama: 'Hadi Pranoto', noHp: '08134567002', sim: 'SIM A', tarif: 150000 },
        'S003': { nama: 'Siti Nurhaliza', noHp: '08134567003', sim: 'SIM A', tarif: 175000 },
        'S004': { nama: 'Anton Wijaya', noHp: '08134567004', sim: 'SIM A', tarif: 160000 },
        'S005': { nama: 'Wulan Sari', noHp: '08134567005', sim: 'SIM A', tarif: 140000 },
        'S006': { nama: 'Dedi Prasetyo', noHp: '08134567006', sim: 'SIM A', tarif: 155000 },
        'S007': { nama: 'Maya Farida', noHp: '08134567007', sim: 'SIM A', tarif: 145000 },
        'S008': { nama: 'Rudy Santoso', noHp: '08134567008', sim: 'SIM A', tarif: 150000 },
        'S009': { nama: 'Tika Lestari', noHp: '08134567009', sim: 'SIM A', tarif: 148000 },
        'S010': { nama: 'Bambang Irawan', noHp: '08134567010', sim: 'SIM A', tarif: 160000 },
        'S011': { nama: 'Lulu Kurniati', noHp: '08134567011', sim: 'SIM A', tarif: 152000 },
        'S012': { nama: 'Yusuf Hidayat', noHp: '08134567012', sim: 'SIM A', tarif: 149000 },
        'S013': { nama: 'Rina Marlina', noHp: '08134567013', sim: 'SIM A', tarif: 147000 },
        'S014': { nama: 'Edi Susanto', noHp: '08134567014', sim: 'SIM A', tarif: 151000 },
        'S015': { nama: 'Vina Putri', noHp: '08134567015', sim: 'SIM A', tarif: 146000 }
    };
    
    if (dummyData[id]) {
        document.getElementById('idSopir').value = id;
        document.getElementById('namaSopir').value = dummyData[id].nama;
        document.getElementById('noHp').value = dummyData[id].noHp;
        document.getElementById('sim').value = dummyData[id].sim;
        document.getElementById('tarifHarian').value = dummyData[id].tarif;
    }
}

// Fungsi konfirmasi hapus - dibuat global
window.confirmDelete = function(id) {
    if (confirm('Apakah Anda yakin ingin menghapus data sopir ' + id + '?\n\nData yang dihapus tidak dapat dikembalikan!')) {
        alert('✅ Data sopir ' + id + ' berhasil dihapus!');
        // Tambahkan logika hapus data di sini
    }
};

// Tunggu DOM siap sebelum menjalankan event listener
document.addEventListener('DOMContentLoaded', function() {
    
    // Format input tarif harian dengan titik pemisah ribuan
    const tarifInput = document.getElementById('tarifHarian');
    if (tarifInput) {
        tarifInput.addEventListener('blur', function(e) {
            const value = e.target.value;
            if (value) {
                const formatted = parseInt(value).toLocaleString('id-ID');
                console.log('Tarif: Rp ' + formatted);
            }
        });
    }

    // Submit form
    const sopirForm = document.getElementById('sopirForm');
    if (sopirForm) {
        sopirForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const idSopir = document.getElementById('idSopir').value;
            const isEdit = document.getElementById('idSopir').readOnly;
            
            if (isEdit) {
                alert('✅ Data sopir ' + idSopir + ' berhasil diperbarui!');
            } else {
                alert('✅ Sopir baru ' + idSopir + ' berhasil ditambahkan!');
            }
            
            window.closeModal();
        });
    }

    // Close modal ketika klik di luar modal content
    window.onclick = function(event) {
        const modal = document.getElementById('modalForm');
        if (event.target == modal) {
            window.closeModal();
        }
    };

    // Close modal dengan tombol ESC
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            window.closeModal();
        }
    });
    
});