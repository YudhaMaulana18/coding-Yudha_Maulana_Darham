
        function openAddModal() {
            document.getElementById('modalTitle').textContent = 'Tambah Lokasi Pengambilan';
            document.getElementById('lokasiForm').reset();
            document.getElementById('id_lokasi').readOnly = false;
            document.getElementById('formModal').classList.add('active');
        }

        function closeModal() {
            document.getElementById('formModal').classList.remove('active');
        }

        function editData(id) {
            document.getElementById('modalTitle').textContent = 'Edit Lokasi Pengambilan';
            document.getElementById('formModal').classList.add('active');
            
            // Simulasi load data
            if(id === 'L001') {
                document.getElementById('id_lokasi').value = 'L001';
                document.getElementById('nama_lokasi').value = 'Bandung - Stasiun';
                document.getElementById('alamat').value = 'Jl. Stasiun No.1';
                document.getElementById('kota').value = 'Bandung';
                document.getElementById('id_lokasi').readOnly = true;
            }
        }

        function deleteData(id) {
            if(confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                alert('Data dengan ID ' + id + ' berhasil dihapus!');
                // Di sini tambahkan kode untuk menghapus dari database
            }
        }

        function saveData(event) {
            event.preventDefault();
            
            const id = document.getElementById('id_lokasi').value;
            const nama = document.getElementById('nama_lokasi').value;
            const alamat = document.getElementById('alamat').value;
            const kota = document.getElementById('kota').value;
            
            alert('Data berhasil disimpan!\n\nID: ' + id + '\nNama: ' + nama + '\nAlamat: ' + alamat + '\nKota: ' + kota);
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
            const modal = document.getElementById('formModal');
            if (event.target === modal) {
                closeModal();
            }
        }
    