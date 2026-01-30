
        // Fungsi pencarian
        function searchTable() {
            const input = document.getElementById('searchInput');
            const filter = input.value.toLowerCase();
            const table = document.getElementById('mobilTable');
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
        }

        // Fungsi untuk menampilkan modal
        function showModal(mode, id = '') {
            const modal = document.getElementById('modalForm');
            const modalTitle = document.getElementById('modalTitle');
            const form = document.getElementById('mobilForm');
            
            if (mode === 'add') {
                modalTitle.textContent = 'Tambah Mobil Baru';
                form.reset();
                document.getElementById('idMobil').readOnly = false;
            } else if (mode === 'edit') {
                modalTitle.textContent = 'Edit Data Mobil';
                document.getElementById('idMobil').readOnly = true;
                loadDataForEdit(id);
            }
            
            modal.classList.add('active');
        }

        // Fungsi untuk menutup modal
        function closeModal() {
            const modal = document.getElementById('modalForm');
            modal.classList.remove('active');
        }

        // Fungsi untuk load data edit (simulasi)
        function loadDataForEdit(id) {
            const dummyData = {
                'M001': { idJenis: 'J01', merk: 'Toyota', model: 'Avanza', tahun: 2020, harga: 350000, status: 'tersedia' },
                'M002': { idJenis: 'J02', merk: 'Honda', model: 'Brio', tahun: 2021, harga: 300000, status: 'tersedia' },
                'M003': { idJenis: 'J01', merk: 'Mitsubishi', model: 'Xpander', tahun: 2022, harga: 450000, status: 'disewa' },
                'M004': { idJenis: 'J03', merk: 'Toyota', model: 'Fortuner', tahun: 2019, harga: 800000, status: 'tersedia' },
                'M005': { idJenis: 'J04', merk: 'Honda', model: 'Civic', tahun: 2018, harga: 500000, status: 'tersedia' }
            };
            
            if (dummyData[id]) {
                document.getElementById('idMobil').value = id;
                document.getElementById('idJenis').value = dummyData[id].idJenis;
                document.getElementById('merk').value = dummyData[id].merk;
                document.getElementById('model').value = dummyData[id].model;
                document.getElementById('tahun').value = dummyData[id].tahun;
                document.getElementById('hargaSewa').value = dummyData[id].harga;
                document.getElementById('status').value = dummyData[id].status;
            }
        }

        // Fungsi konfirmasi hapus
        function confirmDelete(id) {
            if (confirm('Apakah Anda yakin ingin menghapus data mobil ' + id + '?\n\nData yang dihapus tidak dapat dikembalikan!')) {
                alert('✅ Data mobil ' + id + ' berhasil dihapus!');
                // Tambahkan logika hapus data di sini
            }
        }

        // Format input harga sewa dengan titik pemisah ribuan
        document.getElementById('hargaSewa').addEventListener('blur', function(e) {
            const value = e.target.value;
            if (value) {
                const formatted = parseInt(value).toLocaleString('id-ID');
                console.log('Harga Sewa: Rp ' + formatted);
            }
        });

        // Submit form
        document.getElementById('mobilForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const idMobil = document.getElementById('idMobil').value;
            const isEdit = document.getElementById('idMobil').readOnly;
            
            if (isEdit) {
                alert('✅ Data mobil ' + idMobil + ' berhasil diperbarui!');
            } else {
                alert('✅ Mobil baru ' + idMobil + ' berhasil ditambahkan!');
            }
            
            closeModal();
        });

        // Close modal ketika klik di luar modal content
        window.onclick = function(event) {
            const modal = document.getElementById('modalForm');
            if (event.target == modal) {
                closeModal();
            }
        }

        // Close modal dengan tombol ESC
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeModal();
            }
        });
    