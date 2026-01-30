
        function openAddModal() {
            document.getElementById('modalTitle').textContent = 'Tambah Pelanggan';
            document.getElementById('pelangganForm').reset();
            document.getElementById('id_pelanggan').readOnly = false;
            document.getElementById('formModal').classList.add('active');
        }

        function closeModal() {
            document.getElementById('formModal').classList.remove('active');
        }

        function closeDetailModal() {
            document.getElementById('detailModal').classList.remove('active');
        }

        function viewData(id) {
            // Simulasi load data
            if(id === 'P001') {
                document.getElementById('detail_id').textContent = 'P001';
                document.getElementById('detail_nama').textContent = 'Andi Saputra';
                document.getElementById('detail_hp').textContent = '081234567001';
                document.getElementById('detail_alamat').textContent = 'Bandung';
                document.getElementById('detail_email').textContent = 'andi.saputra@example.com';
            }
            document.getElementById('detailModal').classList.add('active');
        }

        function editData(id) {
            document.getElementById('modalTitle').textContent = 'Edit Pelanggan';
            document.getElementById('formModal').classList.add('active');
            
            // Simulasi load data
            if(id === 'P001') {
                document.getElementById('id_pelanggan').value = 'P001';
                document.getElementById('nama_pelanggan').value = 'Andi Saputra';
                document.getElementById('no_hp').value = '081234567001';
                document.getElementById('alamat').value = 'Bandung';
                document.getElementById('email').value = 'andi.saputra@example.com';
                document.getElementById('id_pelanggan').readOnly = true;
            }
        }

        function deleteData(id) {
            if(confirm('Apakah Anda yakin ingin menghapus data pelanggan ini?')) {
                alert('Data pelanggan dengan ID ' + id + ' berhasil dihapus!');
                // Di sini tambahkan kode untuk menghapus dari database
            }
        }

        function saveData(event) {
            event.preventDefault();
            
            const id = document.getElementById('id_pelanggan').value;
            const nama = document.getElementById('nama_pelanggan').value;
            const hp = document.getElementById('no_hp').value;
            const alamat = document.getElementById('alamat').value;
            const email = document.getElementById('email').value;
            
            alert('Data berhasil disimpan!\n\nID: ' + id + '\nNama: ' + nama + '\nNo. HP: ' + hp + '\nEmail: ' + email);
            closeModal();
            
            // Di sini tambahkan kode untuk menyimpan ke database
        }

        function searchTable() {
            const input = document.getElementById('searchInput');
            const filter = input.value.toLowerCase();
            const table = document.getElementById('dataTable');
            const tr = table.getElementsByTagName('tr');

            for (let i = 1; i < tr.length; i++) {
                let found = false;
                const td = tr[i].getElementsByTagName('td');
                
                for (let j = 0; j < td.length; j++) {
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

        // Close modal when clicking outside
        window.onclick = function(event) {
            const formModal = document.getElementById('formModal');
            const detailModal = document.getElementById('detailModal');
            if (event.target === formModal) {
                closeModal();
            }
            if (event.target === detailModal) {
                closeDetailModal();
            }
        }
    