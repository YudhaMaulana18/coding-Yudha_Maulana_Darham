
        // Fungsi pencarian
        function searchTable() {
            const input = document.getElementById('searchInput');
            const filter = input.value.toLowerCase();
            const table = document.getElementById('promoTable');
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
            const form = document.getElementById('promoForm');
            
            if (mode === 'add') {
                modalTitle.textContent = 'Tambah Promo Baru';
                form.reset();
                document.getElementById('idPromo').readOnly = false;
            } else if (mode === 'edit') {
                modalTitle.textContent = 'Edit Promo';
                document.getElementById('idPromo').readOnly = true;
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
                'PR01': { nama: 'Promo Tahun Baru', diskon: 10, syarat: 'Minimal 2 hari sewa' },
                'PR02': { nama: 'Promo Long Weekend', diskon: 15, syarat: 'Periode liburan tertentu' },
                'PR03': { nama: 'Promo Pelajar', diskon: 20, syarat: 'Tunjukkan kartu pelajar' },
                'PR04': { nama: 'Promo Bulanan', diskon: 25, syarat: 'Sewa 30 hari' },
                'PR05': { nama: 'Promo Weekend', diskon: 5, syarat: 'Sewa Sabtu-Minggu' }
            };
            
            if (dummyData[id]) {
                document.getElementById('idPromo').value = id;
                document.getElementById('namaPromo').value = dummyData[id].nama;
                document.getElementById('diskonPersen').value = dummyData[id].diskon;
                document.getElementById('syarat').value = dummyData[id].syarat;
            }
        }

        // Fungsi konfirmasi hapus
        function confirmDelete(id) {
            if (confirm('Apakah Anda yakin ingin menghapus promo ' + id + '?\n\nData yang dihapus tidak dapat dikembalikan!')) {
                alert('✅ Data promo ' + id + ' berhasil dihapus!');
                // Tambahkan logika hapus data di sini
            }
        }

        // Submit form
        document.getElementById('promoForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const idPromo = document.getElementById('idPromo').value;
            const isEdit = document.getElementById('idPromo').readOnly;
            
            if (isEdit) {
                alert('✅ Data promo ' + idPromo + ' berhasil diperbarui!');
            } else {
                alert('✅ Promo baru ' + idPromo + ' berhasil ditambahkan!');
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
    