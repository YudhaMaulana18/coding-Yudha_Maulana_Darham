
        function openAddModal() {
            document.getElementById('modalTitle').textContent = 'Tambah Transaksi Pembayaran';
            document.getElementById('pembayaranForm').reset();
            document.getElementById('id_bayar').readOnly = false;
            document.getElementById('formModal').classList.add('active');
        }

        function closeModal() {
            document.getElementById('formModal').classList.remove('active');
        }

        function closeDetailModal() {
            document.getElementById('detailModal').classList.remove('active');
        }

        function viewData(id) {
            if(id === 'B001') {
                document.getElementById('detail_id_bayar').textContent = 'B001';
                document.getElementById('detail_id_transaksi').textContent = 'T001';
                document.getElementById('detail_metode').textContent = 'MP001 - Tunai';
                document.getElementById('detail_jumlah').textContent = 'Rp 780.000';
                document.getElementById('detail_tanggal').textContent = '2025-01-05';
                document.getElementById('detail_status').innerHTML = '<span class="badge badge-success">lunas</span>';
            }
            document.getElementById('detailModal').classList.add('active');
        }

        function editData(id) {
            document.getElementById('modalTitle').textContent = 'Edit Transaksi Pembayaran';
            document.getElementById('formModal').classList.add('active');
            
            if(id === 'B001') {
                document.getElementById('id_bayar').value = 'B001';
                document.getElementById('id_transaksi').value = 'T001';
                document.getElementById('id_metode').value = 'MP001';
                document.getElementById('jumlah').value = '780000';
                document.getElementById('tanggal').value = '2025-01-05';
                document.getElementById('status_pembayaran').value = 'lunas';
                document.getElementById('id_bayar').readOnly = true;
            }
        }

        function deleteData(id) {
            if(confirm('Apakah Anda yakin ingin menghapus transaksi pembayaran ini?')) {
                alert('Transaksi pembayaran dengan ID ' + id + ' berhasil dihapus!');
            }
        }

        function saveData(event) {
            event.preventDefault();
            
            const id = document.getElementById('id_bayar').value;
            const idTransaksi = document.getElementById('id_transaksi').value;
            const metode = document.getElementById('id_metode').value;
            const jumlah = document.getElementById('jumlah').value;
            const tanggal = document.getElementById('tanggal').value;
            const status = document.getElementById('status_pembayaran').value;
            
            alert('Data berhasil disimpan!\n\nID: ' + id + '\nID Transaksi: ' + idTransaksi + '\nMetode: ' + metode + '\nJumlah: Rp ' + jumlah + '\nStatus: ' + status);
            closeModal();
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

        function filterTable() {
            const filterMetode = document.getElementById('filterMetode').value.toLowerCase();
            const filterStatus = document.getElementById('filterStatus').value.toLowerCase();
            const table = document.getElementById('dataTable');
            const tr = table.getElementsByTagName('tr');

            for (let i = 1; i < tr.length; i++) {
                const td = tr[i].getElementsByTagName('td');
                const metode = td[2].textContent || td[2].innerText;
                const statusText = td[5].textContent || td[5].innerText;
                
                let showRow = true;
                
                if (filterMetode !== '' && metode.toLowerCase().indexOf(filterMetode) === -1) {
                    showRow = false;
                }
                
                if (filterStatus !== '' && statusText.toLowerCase().indexOf(filterStatus) === -1) {
                    showRow = false;
                }
                
                tr[i].style.display = showRow ? '' : 'none';
            }
        }

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
    