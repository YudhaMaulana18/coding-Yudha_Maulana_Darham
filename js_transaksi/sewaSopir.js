
        // Data 50 transaksi sewa sopir dari database
const dataSewaSopir = [
    {id:'SS001',sopir:'S001',trx:'T001',hari:2,tarif:300000},
    {id:'SS002',sopir:'S002',trx:'T002',hari:5,tarif:750000},
    {id:'SS003',sopir:'S003',trx:'T003',hari:1,tarif:175000},
    {id:'SS004',sopir:'S004',trx:'T004',hari:8,tarif:1280000},
    {id:'SS005',sopir:'S005',trx:'T005',hari:2,tarif:280000},
    {id:'SS006',sopir:'S006',trx:'T006',hari:2,tarif:310000},
    {id:'SS007',sopir:'S007',trx:'T007',hari:2,tarif:290000},
    {id:'SS008',sopir:'S008',trx:'T008',hari:3,tarif:450000},
    {id:'SS009',sopir:'S009',trx:'T009',hari:3,tarif:444000},
    {id:'SS010',sopir:'S010',trx:'T010',hari:7,tarif:1120000},
    {id:'SS011',sopir:'S011',trx:'T011',hari:1,tarif:152000},
    {id:'SS012',sopir:'S012',trx:'T012',hari:3,tarif:447000},
    {id:'SS013',sopir:'S013',trx:'T013',hari:3,tarif:441000},
    {id:'SS014',sopir:'S014',trx:'T014',hari:1,tarif:151000},
    {id:'SS015',sopir:'S015',trx:'T015',hari:2,tarif:292000},
    {id:'SS016',sopir:'S001',trx:'T016',hari:2,tarif:300000},
    {id:'SS017',sopir:'S002',trx:'T017',hari:2,tarif:300000},
    {id:'SS018',sopir:'S003',trx:'T018',hari:4,tarif:700000},
    {id:'SS019',sopir:'S004',trx:'T019',hari:2,tarif:320000},
    {id:'SS020',sopir:'S005',trx:'T020',hari:2,tarif:280000},
    {id:'SS021',sopir:'S006',trx:'T021',hari:4,tarif:620000},
    {id:'SS022',sopir:'S007',trx:'T022',hari:5,tarif:725000},
    {id:'SS023',sopir:'S008',trx:'T023',hari:1,tarif:150000},
    {id:'SS024',sopir:'S009',trx:'T024',hari:4,tarif:592000},
    {id:'SS025',sopir:'S010',trx:'T025',hari:4,tarif:640000},
    {id:'SS026',sopir:'S011',trx:'T026',hari:1,tarif:152000},
    {id:'SS027',sopir:'S012',trx:'T027',hari:5,tarif:745000},
    {id:'SS028',sopir:'S013',trx:'T028',hari:5,tarif:735000},
    {id:'SS029',sopir:'S014',trx:'T029',hari:2,tarif:302000},
    {id:'SS030',sopir:'S015',trx:'T030',hari:3,tarif:438000},
    {id:'SS031',sopir:'S001',trx:'T031',hari:1,tarif:150000},
    {id:'SS032',sopir:'S002',trx:'T032',hari:4,tarif:600000},
    {id:'SS033',sopir:'S003',trx:'T033',hari:1,tarif:175000},
    {id:'SS034',sopir:'S004',trx:'T034',hari:4,tarif:640000},
    {id:'SS035',sopir:'S005',trx:'T035',hari:4,tarif:560000},
    {id:'SS036',sopir:'S006',trx:'T036',hari:1,tarif:155000},
    {id:'SS037',sopir:'S007',trx:'T037',hari:4,tarif:580000},
    {id:'SS038',sopir:'S008',trx:'T038',hari:1,tarif:150000},
    {id:'SS039',sopir:'S009',trx:'T039',hari:4,tarif:592000},
    {id:'SS040',sopir:'S010',trx:'T040',hari:3,tarif:480000},
    {id:'SS041',sopir:'S011',trx:'T041',hari:1,tarif:152000},
    {id:'SS042',sopir:'S012',trx:'T042',hari:4,tarif:596000},
    {id:'SS043',sopir:'S013',trx:'T043',hari:3,tarif:441000},
    {id:'SS044',sopir:'S014',trx:'T044',hari:1,tarif:151000},
    {id:'SS045',sopir:'S015',trx:'T045',hari:2,tarif:292000},
    {id:'SS046',sopir:'S001',trx:'T046',hari:4,tarif:600000},
    {id:'SS047',sopir:'S002',trx:'T047',hari:2,tarif:300000},
    {id:'SS048',sopir:'S003',trx:'T048',hari:3,tarif:525000},
    {id:'SS049',sopir:'S004',trx:'T049',hari:4,tarif:640000},
    {id:'SS050',sopir:'S005',trx:'T050',hari:4,tarif:560000}
];

// Load data ke tabel
function loadData() {
    const tbody = document.getElementById('tableBody');
    tbody.innerHTML = '';
    dataSewaSopir.forEach(d => {
        const row = `<tr>
            <td>${d.id}</td>
            <td>${d.sopir}</td>
            <td>${d.trx}</td>
            <td>${d.hari} hari</td>
            <td>Rp ${d.tarif.toLocaleString('id-ID')}</td>
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
    document.getElementById('modalTitle').textContent = 'Tambah Transaksi Sewa Sopir';
    document.getElementById('sewaSopirForm').reset();
    document.getElementById('id_sewa_sopir').readOnly = false;
    document.getElementById('formModal').classList.add('active');
}

function closeModal() {
    document.getElementById('formModal').classList.remove('active');
}

function closeDetailModal() {
    document.getElementById('detailModal').classList.remove('active');
}

function viewData(id) {
    const data = dataSewaSopir.find(d => d.id === id);
    if(data) {
        document.getElementById('detail_id').textContent = data.id;
        document.getElementById('detail_sopir').textContent = data.sopir;
        document.getElementById('detail_transaksi').textContent = data.trx;
        document.getElementById('detail_hari').textContent = data.hari + ' hari';
        document.getElementById('detail_tarif').textContent = 'Rp ' + data.tarif.toLocaleString('id-ID');
    }
    document.getElementById('detailModal').classList.add('active');
}

function editData(id) {
    const data = dataSewaSopir.find(d => d.id === id);
    if(data) {
        document.getElementById('modalTitle').textContent = 'Edit Transaksi Sewa Sopir';
        document.getElementById('id_sewa_sopir').value = data.id;
        document.getElementById('id_sopir').value = data.sopir;
        document.getElementById('id_transaksi').value = data.trx;
        document.getElementById('jumlah_hari').value = data.hari;
        document.getElementById('total_tarif').value = data.tarif;
        document.getElementById('id_sewa_sopir').readOnly = true;
        document.getElementById('formModal').classList.add('active');
    }
}

function deleteData(id) {
    if(confirm('Apakah Anda yakin ingin menghapus transaksi sewa sopir ini?')) {
        alert('Transaksi sewa sopir dengan ID ' + id + ' berhasil dihapus!');
    }
}

function updateTarif() {
    const sopirSelect = document.getElementById('id_sopir');
    const jumlahHari = document.getElementById('jumlah_hari').value;
    const selectedOption = sopirSelect.options[sopirSelect.selectedIndex];
    
    if(selectedOption && jumlahHari) {
        const tarifPerHari = selectedOption.getAttribute('data-tarif');
        const totalTarif = tarifPerHari * jumlahHari;
        document.getElementById('total_tarif').value = totalTarif;
    }
}

function saveData(event) {
    event.preventDefault();
    const id = document.getElementById('id_sewa_sopir').value;
    const sopir = document.getElementById('id_sopir').value;
    const transaksi = document.getElementById('id_transaksi').value;
    const hari = document.getElementById('jumlah_hari').value;
    const tarif = document.getElementById('total_tarif').value;
    
    alert('Data berhasil disimpan!\n\nID: ' + id + '\nSopir: ' + sopir + '\nTransaksi: ' + transaksi + '\nJumlah Hari: ' + hari + '\nTotal Tarif: Rp ' + tarif);
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
    const filter = document.getElementById('filterHari').value;
    const table = document.getElementById('dataTable');
    const tr = table.getElementsByTagName('tr');
    
    for (let i = 1; i < tr.length; i++) {
        const td = tr[i].getElementsByTagName('td');
        const hariText = td[3].textContent || td[3].innerText;
        const hariValue = parseInt(hariText);
        
        let show = false;
        
        if (filter === '') {
            show = true;
        } else if (filter === '4' && hariValue >= 4) {
            show = true;
        } else if (hariValue === parseInt(filter)) {
            show = true;
        }
        
        tr[i].style.display = show ? '' : 'none';
    }
}

window.onclick = function(event) {
    const formModal = document.getElementById('formModal');
    const detailModal = document.getElementById('detailModal');
    if (event.target === formModal) closeModal();
    if (event.target === detailModal) closeDetailModal();
}
    