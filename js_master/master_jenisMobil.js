        function openAddModal() {
            document.getElementById('modalTitle').textContent = 'Tambah Jenis Mobil';
            document.getElementById('jenisForm').reset();
            document.getElementById('id_jenis').readOnly = false;
            document.getElementById('formModal').classList.add('active');
        }

        function closeModal() {
            document.getElementById('formModal').classList.remove('active');
        }

        function editData(id) {
            document.getElementById('modalTitle').textContent = 'Edit Jenis Mobil';
            document.getElementById('formModal').classList.add('active');
            
            // Simulasi load data
            if(id === 'J01') {
                document.getElementById('id_jenis').value = 'J01';
                document.getElementById('nama_jenis').value = 'MPV';
                document.getElementById('deskripsi').value = 'Multi Purpose Vehicle - cocok keluarga';
                document.getElementById('id_jenis').readOnly = true;
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
            
            const id = document.getElementById('id_jenis').value;
            const nama = document.getElementById('nama_jenis').value;
            const deskripsi = document.getElementById('deskripsi').value;
            
            alert('Data berhasil disimpan!\n\nID: ' + id + '\nNama: ' + nama + '\nDeskripsi: ' + deskripsi);
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