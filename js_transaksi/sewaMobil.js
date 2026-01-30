
        // Data 50 transaksi sewa mobil dari database
const dataSewa = [
    {id:'T001',pel:'P001',mob:'M001',lok:'L001',promo:'PR01',tglM:'2025-01-05',tglS:'2025-01-07',hari:2,biaya:780000,status:'selesai'},
    {id:'T002',pel:'P002',mob:'M002',lok:'L002',promo:'PR02',tglM:'2025-01-10',tglS:'2025-01-15',hari:5,biaya:2250000,status:'selesai'},
    {id:'T003',pel:'P003',mob:'M002',lok:'L003',promo:'PR03',tglM:'2025-01-08',tglS:'2025-01-09',hari:1,biaya:300000,status:'selesai'},
    {id:'T004',pel:'P004',mob:'M003',lok:'L004',promo:'PR04',tglM:'2025-01-12',tglS:'2025-01-20',hari:8,biaya:6400000,status:'selesai'},
    {id:'T005',pel:'P005',mob:'M004',lok:'L005',promo:'PR05',tglM:'2025-01-15',tglS:'2025-01-18',hari:3,biaya:1700000,status:'selesai'},
    {id:'T006',pel:'P006',mob:'M005',lok:'L006',promo:'PR06',tglM:'2025-02-05',tglS:'2025-02-07',hari:2,biaya:560000,status:'selesai'},
    {id:'T007',pel:'P007',mob:'M006',lok:'L007',promo:'PR07',tglM:'2025-02-10',tglS:'2025-02-12',hari:2,biaya:2400000,status:'selesai'},
    {id:'T008',pel:'P008',mob:'M008',lok:'L008',promo:'PR08',tglM:'2025-02-15',tglS:'2025-02-18',hari:3,biaya:3300000,status:'selesai'},
    {id:'T009',pel:'P009',mob:'M009',lok:'L009',promo:'PR09',tglM:'2025-03-01',tglS:'2025-03-04',hari:3,biaya:1200000,status:'selesai'},
    {id:'T010',pel:'P010',mob:'M010',lok:'L010',promo:'PR10',tglM:'2025-03-05',tglS:'2025-03-12',hari:7,biaya:4900000,status:'selesai'},
    {id:'T011',pel:'P011',mob:'M011',lok:'L011',promo:'PR11',tglM:'2025-03-10',tglS:'2025-03-11',hari:1,biaya:950000,status:'selesai'},
    {id:'T012',pel:'P012',mob:'M012',lok:'L012',promo:'PR12',tglM:'2025-03-15',tglS:'2025-03-18',hari:3,biaya:1800000,status:'selesai'},
    {id:'T013',pel:'P013',mob:'M013',lok:'L013',promo:'PR13',tglM:'2025-04-01',tglS:'2025-04-04',hari:3,biaya:4500000,status:'selesai'},
    {id:'T014',pel:'P014',mob:'M014',lok:'L014',promo:'PR14',tglM:'2025-04-05',tglS:'2025-04-06',hari:1,biaya:900000,status:'selesai'},
    {id:'T015',pel:'P015',mob:'M015',lok:'L015',promo:'PR15',tglM:'2025-04-10',tglS:'2025-04-12',hari:2,biaya:400000,status:'selesai'},
    {id:'T016',pel:'P001',mob:'M002',lok:'L001',promo:'',tglM:'2025-04-15',tglS:'2025-04-17',hari:2,biaya:600000,status:'selesai'},
    {id:'T017',pel:'P002',mob:'M004',lok:'L002',promo:'PR01',tglM:'2025-04-20',tglS:'2025-04-22',hari:2,biaya:1600000,status:'selesai'},
    {id:'T018',pel:'P003',mob:'M003',lok:'L003',promo:'PR02',tglM:'2025-04-25',tglS:'2025-04-29',hari:4,biaya:2000000,status:'selesai'},
    {id:'T019',pel:'P004',mob:'M005',lok:'L004',promo:'PR03',tglM:'2025-04-28',tglS:'2025-04-30',hari:2,biaya:1000000,status:'selesai'},
    {id:'T020',pel:'P005',mob:'M001',lok:'L005',promo:'PR04',tglM:'2025-05-05',tglS:'2025-05-07',hari:2,biaya:450000,status:'selesai'},
    {id:'T021',pel:'P006',mob:'M006',lok:'L006',promo:'PR05',tglM:'2025-05-10',tglS:'2025-05-14',hari:4,biaya:1120000,status:'selesai'},
    {id:'T022',pel:'P007',mob:'M007',lok:'L007',promo:'PR06',tglM:'2025-05-15',tglS:'2025-05-20',hari:5,biaya:6000000,status:'selesai'},
    {id:'T023',pel:'P008',mob:'M008',lok:'L008',promo:'PR07',tglM:'2025-05-21',tglS:'2025-05-22',hari:1,biaya:1100000,status:'selesai'},
    {id:'T024',pel:'P009',mob:'M009',lok:'L009',promo:'PR08',tglM:'2025-06-01',tglS:'2025-06-05',hari:4,biaya:1600000,status:'selesai'},
    {id:'T025',pel:'P010',mob:'M010',lok:'L010',promo:'PR09',tglM:'2025-06-06',tglS:'2025-06-10',hari:4,biaya:2800000,status:'selesai'},
    {id:'T026',pel:'P011',mob:'M011',lok:'L011',promo:'PR10',tglM:'2025-06-11',tglS:'2025-06-12',hari:1,biaya:950000,status:'selesai'},
    {id:'T027',pel:'P012',mob:'M012',lok:'L012',promo:'PR11',tglM:'2025-06-13',tglS:'2025-06-18',hari:5,biaya:3000000,status:'selesai'},
    {id:'T028',pel:'P013',mob:'M013',lok:'L013',promo:'PR12',tglM:'2025-06-20',tglS:'2025-06-25',hari:5,biaya:7500000,status:'selesai'},
    {id:'T029',pel:'P014',mob:'M014',lok:'L014',promo:'PR13',tglM:'2025-07-01',tglS:'2025-07-03',hari:2,biaya:1800000,status:'selesai'},
    {id:'T030',pel:'P015',mob:'M015',lok:'L015',promo:'PR14',tglM:'2025-07-05',tglS:'2025-07-08',hari:3,biaya:600000,status:'selesai'},
    {id:'T031',pel:'P001',mob:'M001',lok:'L001',promo:'PR15',tglM:'2025-07-10',tglS:'2025-07-11',hari:1,biaya:350000,status:'selesai'},
    {id:'T032',pel:'P002',mob:'M002',lok:'L002',promo:'',tglM:'2025-07-12',tglS:'2025-07-16',hari:4,biaya:1200000,status:'selesai'},
    {id:'T033',pel:'P003',mob:'M003',lok:'L003',promo:'PR01',tglM:'2025-07-17',tglS:'2025-07-18',hari:1,biaya:450000,status:'selesai'},
    {id:'T034',pel:'P004',mob:'M004',lok:'L004',promo:'PR02',tglM:'2025-07-21',tglS:'2025-07-25',hari:4,biaya:3200000,status:'selesai'},
    {id:'T035',pel:'P005',mob:'M005',lok:'L005',promo:'PR03',tglM:'2025-08-01',tglS:'2025-08-05',hari:4,biaya:2000000,status:'selesai'},
    {id:'T036',pel:'P006',mob:'M006',lok:'L006',promo:'PR04',tglM:'2025-08-06',tglS:'2025-08-07',hari:1,biaya:280000,status:'selesai'},
    {id:'T037',pel:'P007',mob:'M007',lok:'L007',promo:'PR05',tglM:'2025-08-08',tglS:'2025-08-12',hari:4,biaya:4800000,status:'selesai'},
    {id:'T038',pel:'P008',mob:'M008',lok:'L008',promo:'PR06',tglM:'2025-08-15',tglS:'2025-08-16',hari:1,biaya:1100000,status:'selesai'},
    {id:'T039',pel:'P009',mob:'M009',lok:'L009',promo:'PR07',tglM:'2025-08-18',tglS:'2025-08-22',hari:4,biaya:1600000,status:'selesai'},
    {id:'T040',pel:'P010',mob:'M010',lok:'L010',promo:'PR08',tglM:'2025-08-25',tglS:'2025-08-28',hari:3,biaya:2100000,status:'selesai'},
    {id:'T041',pel:'P011',mob:'M011',lok:'L011',promo:'PR09',tglM:'2025-09-01',tglS:'2025-09-02',hari:1,biaya:950000,status:'selesai'},
    {id:'T042',pel:'P012',mob:'M012',lok:'L012',promo:'PR10',tglM:'2025-09-03',tglS:'2025-09-07',hari:4,biaya:2400000,status:'selesai'},
    {id:'T043',pel:'P013',mob:'M013',lok:'L013',promo:'PR11',tglM:'2025-09-08',tglS:'2025-09-11',hari:3,biaya:4500000,status:'selesai'},
    {id:'T044',pel:'P014',mob:'M014',lok:'L014',promo:'PR12',tglM:'2025-09-12',tglS:'2025-09-13',hari:1,biaya:900000,status:'selesai'},
    {id:'T045',pel:'P015',mob:'M015',lok:'L015',promo:'PR13',tglM:'2025-09-14',tglS:'2025-09-16',hari:2,biaya:400000,status:'selesai'},
    {id:'T046',pel:'P001',mob:'M006',lok:'L001',promo:'',tglM:'2025-09-18',tglS:'2025-09-22',hari:4,biaya:3200000,status:'selesai'},
    {id:'T047',pel:'P002',mob:'M007',lok:'L002',promo:'PR14',tglM:'2025-09-23',tglS:'2025-09-25',hari:2,biaya:2400000,status:'selesai'},
    {id:'T048',pel:'P003',mob:'M005',lok:'L003',promo:'PR15',tglM:'2025-09-26',tglS:'2025-09-29',hari:3,biaya:1500000,status:'selesai'},
    {id:'T049',pel:'P004',mob:'M002',lok:'L004',promo:'',tglM:'2025-09-29',tglS:'2025-10-03',hari:4,biaya:1200000,status:'selesai'},
    {id:'T050',pel:'P005',mob:'M008',lok:'L005',promo:'PR01',tglM:'2025-10-05',tglS:'2025-10-09',hari:4,biaya:4400000,status:'selesai'}
];

// Load data ke tabel
function loadData() {
    const tbody = document.getElementById('tableBody');
    tbody.innerHTML = '';
    dataSewa.forEach(d => {
        const badgeClass = d.status === 'selesai' ? 'badge-success' : d.status === 'aktif' ? 'badge-warning' : 'badge-danger';
        const row = `<tr>
            <td>${d.id}</td>
            <td>${d.pel}</td>
            <td>${d.mob}</td>
            <td>${d.tglM}</td>
            <td>${d.tglS}</td>
            <td>${d.hari}</td>
            <td>Rp ${d.biaya.toLocaleString('id-ID')}</td>
            <td><span class="badge ${badgeClass}">${d.status}</span></td>
            <td style="text-align: center;">
                <div class="action-buttons">
                    <button class="btn btn-info" onclick="viewData('${d.id}')">👁️</button>
                    <button class="btn btn-warning" onclick="editData('${d.id}')">✏️</button>
                    <button class="btn btn-danger" onclick="deleteData('${d.id}')">🗑️</button>
                </div>
            </td>
        </tr>`;
        tbody.innerHTML += row;
    });
}

window.onload = loadData;

function openAddModal() {
    document.getElementById('modalTitle').textContent = 'Tambah Transaksi Sewa Mobil';
    document.getElementById('sewaForm').reset();
    document.getElementById('id_transaksi').readOnly = false;
    document.getElementById('formModal').classList.add('active');
}

function closeModal() {
    document.getElementById('formModal').classList.remove('active');
}

function closeDetailModal() {
    document.getElementById('detailModal').classList.remove('active');
}

function viewData(id) {
    const data = dataSewa.find(d => d.id === id);
    if(data) {
        document.getElementById('detail_id').textContent = data.id;
        document.getElementById('detail_pelanggan').textContent = data.pel;
        document.getElementById('detail_mobil').textContent = data.mob;
        document.getElementById('detail_lokasi').textContent = data.lok;
        document.getElementById('detail_promo').textContent = data.promo || '-';
        document.getElementById('detail_tgl_mulai').textContent = data.tglM;
        document.getElementById('detail_tgl_selesai').textContent = data.tglS;
        document.getElementById('detail_hari').textContent = data.hari + ' hari';
        document.getElementById('detail_biaya').textContent = 'Rp ' + data.biaya.toLocaleString('id-ID');
        const badgeClass = data.status === 'selesai' ? 'badge-success' : data.status === 'aktif' ? 'badge-warning' : 'badge-danger';
        document.getElementById('detail_status').innerHTML = `<span class="badge ${badgeClass}">${data.status}</span>`;
    }
    document.getElementById('detailModal').classList.add('active');
}

function editData(id) {
    const data = dataSewa.find(d => d.id === id);
    if(data) {
        document.getElementById('modalTitle').textContent = 'Edit Transaksi Sewa Mobil';
        document.getElementById('id_transaksi').value = data.id;
        document.getElementById('id_pelanggan').value = data.pel;
        document.getElementById('id_mobil').value = data.mob;
        document.getElementById('id_lokasi').value = data.lok;
        document.getElementById('id_promo').value = data.promo;
        document.getElementById('tgl_mulai').value = data.tglM;
        document.getElementById('tgl_selesai').value = data.tglS;
        document.getElementById('jumlah_hari').value = data.hari;
        document.getElementById('total_biaya').value = data.biaya;
        document.getElementById('status').value = data.status;
        document.getElementById('id_transaksi').readOnly = true;
        document.getElementById('formModal').classList.add('active');
    }
}

function deleteData(id) {
    if(confirm('Apakah Anda yakin ingin menghapus transaksi sewa mobil ini?')) {
        alert('Transaksi sewa mobil dengan ID ' + id + ' berhasil dihapus!');
    }
}

function hitungHari() {
    const tglMulai = new Date(document.getElementById('tgl_mulai').value);
    const tglSelesai = new Date(document.getElementById('tgl_selesai').value);
    if(tglMulai && tglSelesai && tglSelesai >= tglMulai) {
        const diff = Math.ceil((tglSelesai - tglMulai) / (1000 * 60 * 60 * 24));
        document.getElementById('jumlah_hari').value = diff;
    }
}

function saveData(event) {
    event.preventDefault();
    const id = document.getElementById('id_transaksi').value;
    alert('Data berhasil disimpan! ID: ' + id);
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
    const filter = document.getElementById('filterStatus').value.toLowerCase();
    const table = document.getElementById('dataTable');
    const tr = table.getElementsByTagName('tr');
    for (let i = 1; i < tr.length; i++) {
        const td = tr[i].getElementsByTagName('td');
        const status = td[7].textContent || td[7].innerText;
        if (filter === '' || status.toLowerCase().indexOf(filter) > -1) {
            tr[i].style.display = '';
        } else {
            tr[i].style.display = 'none';
        }
    }
}

window.onclick = function(event) {
    const formModal = document.getElementById('formModal');
    const detailModal = document.getElementById('detailModal');
    if (event.target === formModal) closeModal();
    if (event.target === detailModal) closeDetailModal();
}
    