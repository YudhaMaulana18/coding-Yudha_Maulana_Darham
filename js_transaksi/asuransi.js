
        // Data 50 transaksi asuransi dari database
const dataAsuransi = [
    {id:'TA001',trx:'T001',asr:'A001',biaya:100000},
    {id:'TA002',trx:'T002',asr:'A002',biaya:375000},
    {id:'TA003',trx:'T003',asr:'A001',biaya:50000},
    {id:'TA004',trx:'T004',asr:'A001',biaya:200000},
    {id:'TA005',trx:'T005',asr:'A004',biaya:680000},
    {id:'TA006',trx:'T006',asr:'A007',biaya:80000},
    {id:'TA007',trx:'T007',asr:'A006',biaya:180000},
    {id:'TA008',trx:'T008',asr:'A008',biaya:195000},
    {id:'TA009',trx:'T009',asr:'A003',biaya:120000},
    {id:'TA010',trx:'T010',asr:'A010',biaya:350000},
    {id:'TA011',trx:'T011',asr:'A011',biaya:68000},
    {id:'TA012',trx:'T012',asr:'A012',biaya:144000},
    {id:'TA013',trx:'T013',asr:'A014',biaya:204000},
    {id:'TA014',trx:'T014',asr:'A015',biaya:62000},
    {id:'TA015',trx:'T015',asr:'A009',biaya:80000},
    {id:'TA016',trx:'T016',asr:'A001',biaya:100000},
    {id:'TA017',trx:'T017',asr:'A002',biaya:150000},
    {id:'TA018',trx:'T018',asr:'A003',biaya:240000},
    {id:'TA019',trx:'T019',asr:'A004',biaya:170000},
    {id:'TA020',trx:'T020',asr:'A005',biaya:22500},
    {id:'TA021',trx:'T021',asr:'A006',biaya:360000},
    {id:'TA022',trx:'T022',asr:'A006',biaya:450000},
    {id:'TA023',trx:'T023',asr:'A007',biaya:65000},
    {id:'TA024',trx:'T024',asr:'A008',biaya:220000},
    {id:'TA025',trx:'T025',asr:'A009',biaya:100000},
    {id:'TA026',trx:'T026',asr:'A010',biaya:140000},
    {id:'TA027',trx:'T027',asr:'A011',biaya:360000},
    {id:'TA028',trx:'T028',asr:'A012',biaya:300000},
    {id:'TA029',trx:'T029',asr:'A013',biaya:95000},
    {id:'TA030',trx:'T030',asr:'A014',biaya:81600},
    {id:'TA031',trx:'T031',asr:'A015',biaya:70000},
    {id:'TA032',trx:'T032',asr:'A001',biaya:100000},
    {id:'TA033',trx:'T033',asr:'A002',biaya:135000},
    {id:'TA034',trx:'T034',asr:'A003',biaya:320000},
    {id:'TA035',trx:'T035',asr:'A004',biaya:200000},
    {id:'TA036',trx:'T036',asr:'A005',biaya:28000},
    {id:'TA037',trx:'T037',asr:'A006',biaya:360000},
    {id:'TA038',trx:'T038',asr:'A007',biaya:55000},
    {id:'TA039',trx:'T039',asr:'A008',biaya:250000},
    {id:'TA040',trx:'T040',asr:'A009',biaya:325000},
    {id:'TA041',trx:'T041',asr:'A010',biaya:68000},
    {id:'TA042',trx:'T042',asr:'A011',biaya:288000},
    {id:'TA043',trx:'T043',asr:'A012',biaya:315000},
    {id:'TA044',trx:'T044',asr:'A013',biaya:61200},
    {id:'TA045',trx:'T045',asr:'A014',biaya:136000},
    {id:'TA046',trx:'T046',asr:'A015',biaya:272000},
    {id:'TA047',trx:'T047',asr:'A001',biaya:100000},
    {id:'TA048',trx:'T048',asr:'A002',biaya:28000},
    {id:'TA049',trx:'T049',asr:'A003',biaya:240000},
    {id:'TA050',trx:'T050',asr:'A004',biaya:352000}
];

// Load data ke tabel
function loadData() {
    const tbody = document.getElementById('tableBody');
    tbody.innerHTML = '';
    dataAsuransi.forEach(d => {
        const row = `<tr>
            <td>${d.id}</td>
            <td>${d.trx}</td>
            <td>${d.asr}</td>
            <td>Rp ${d.biaya.toLocaleString('id-ID')}</td>
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
    document.getElementById('modalTitle').textContent = 'Tambah Transaksi Asuransi';
    document.getElementById('transaksiForm').reset();
    document.getElementById('id_trans_asuransi').readOnly = false;
    document.getElementById('formModal').classList.add('active');
}

function closeModal() {
    document.getElementById('formModal').classList.remove('active');
}

function closeDetailModal() {
    document.getElementById('detailModal').classList.remove('active');
}

function viewData(id) {
    const data = dataAsuransi.find(d => d.id === id);
    if(data) {
        document.getElementById('detail_id_trans').textContent = data.id;
        document.getElementById('detail_id_transaksi').textContent = data.trx;
        document.getElementById('detail_id_asuransi').textContent = data.asr;
        document.getElementById('detail_biaya').textContent = 'Rp ' + data.biaya.toLocaleString('id-ID');
    }
    document.getElementById('detailModal').classList.add('active');
}

function editData(id) {
    const data = dataAsuransi.find(d => d.id === id);
    if(data) {
        document.getElementById('modalTitle').textContent = 'Edit Transaksi Asuransi';
        document.getElementById('id_trans_asuransi').value = data.id;
        document.getElementById('id_transaksi').value = data.trx;
        document.getElementById('id_asuransi').value = data.asr;
        document.getElementById('total_biaya_asuransi').value = data.biaya;
        document.getElementById('id_trans_asuransi').readOnly = true;
        document.getElementById('formModal').classList.add('active');
    }
}

function deleteData(id) {
    if(confirm('Apakah Anda yakin ingin menghapus transaksi asuransi ini?')) {
        alert('Transaksi asuransi dengan ID ' + id + ' berhasil dihapus!');
    }
}

function updateBiaya() {
    const asuransiSelect = document.getElementById('id_asuransi');
    const jumlahHari = document.getElementById('jumlah_hari').value;
    const selectedOption = asuransiSelect.options[asuransiSelect.selectedIndex];
    
    if(selectedOption && jumlahHari) {
        const biayaPerHari = selectedOption.getAttribute('data-biaya');
        const totalBiaya = biayaPerHari * jumlahHari;
        document.getElementById('total_biaya_asuransi').value = totalBiaya;
    }
}

function saveData(event) {
    event.preventDefault();
    
    const id = document.getElementById('id_trans_asuransi').value;
    const idTransaksi = document.getElementById('id_transaksi').value;
    const idAsuransi = document.getElementById('id_asuransi').value;
    const totalBiaya = document.getElementById('total_biaya_asuransi').value;
    
    alert('Data berhasil disimpan!\n\nID: ' + id + '\nID Transaksi: ' + idTransaksi + '\nID Asuransi: ' + idAsuransi + '\nTotal Biaya: Rp ' + totalBiaya);
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
    const filterAsuransi = document.getElementById('filterAsuransi').value.toLowerCase();
    const table = document.getElementById('dataTable');
    const tr = table.getElementsByTagName('tr');

    for (let i = 1; i < tr.length; i++) {
        const td = tr[i].getElementsByTagName('td');
        const idAsuransi = td[2].textContent || td[2].innerText;
        
        if (filterAsuransi === '' || idAsuransi.toLowerCase().indexOf(filterAsuransi) > -1) {
            tr[i].style.display = '';
        } else {
            tr[i].style.display = 'none';
        }
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
    