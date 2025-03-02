let biayaData = []; // Array untuk menyimpan data biaya hidup (sementara)
let editingIndex = -1; // Indeks item yang sedang diedit

function validateForm() {
    let kota = document.getElementById("kota").value;
    let provinsi = document.getElementById("provinsi").value;
    let biayaMakanan = document.getElementById("biayaMakanan").value;
    let biayaTransportasi = document.getElementById("biayaTransportasi").value;
    let biayaPendidikan = document.getElementById("biayaPendidikan").value;

    let kotaError = document.getElementById("kotaError");
    let provinsiError = document.getElementById("provinsiError");
    let biayaMakananError = document.getElementById("biayaMakananError");
    let biayaTransportasiError = document.getElementById("biayaTransportasiError");
    let biayaPendidikanError = document.getElementById("biayaPendidikanError");

    // Reset pesan error
    kotaError.textContent = "";
    provinsiError.textContent = "";
    biayaMakananError.textContent = "";
    biayaTransportasiError.textContent = "";
    biayaPendidikanError.textContent = "";

    let isValid = true;

    if (kota === "") {
        kotaError.textContent = "Kota harus diisi";
        isValid = false;
    }

    if (provinsi === "") {
        provinsiError.textContent = "Provinsi harus dipilih";
        isValid = false;
    }

    if (biayaMakanan === "") {
        biayaMakananError.textContent = "Biaya Makanan harus diisi";
        isValid = false;
    } else if (isNaN(biayaMakanan) || parseFloat(biayaMakanan) <= 0) {
        biayaMakananError.textContent = "Biaya Makanan harus berupa angka positif";
        isValid = false;
    }

    if (biayaTransportasi === "") {
        biayaTransportasiError.textContent = "Biaya Transportasi harus diisi";
        isValid = false;
    } else if (isNaN(biayaTransportasi) || parseFloat(biayaTransportasi) <= 0) {
        biayaTransportasiError.textContent = "Biaya Transportasi harus berupa angka positif";
        isValid = false;
    }

    if (biayaPendidikan === "") {
        biayaPendidikanError.textContent = "Biaya Pendidikan harus diisi";
        isValid = false;
    } else if (isNaN(biayaPendidikan) || parseFloat(biayaPendidikan) <= 0) {
        biayaPendidikanError.textContent = "Biaya Pendidikan harus berupa angka positif";
        isValid = false;
    }

    if (isValid) {
        saveBiaya(); // Simpan data jika valid
        return false; // Mencegah submit form
    }

    return false; // Mencegah submit jika tidak valid
}

function saveBiaya() {
    let kota = document.getElementById("kota").value;
    let provinsi = document.getElementById("provinsi").value;
    let biayaMakanan = parseFloat(document.getElementById("biayaMakanan").value);
    let biayaTransportasi = parseFloat(document.getElementById("biayaTransportasi").value);
    let biayaPendidikan = parseFloat(document.getElementById("biayaPendidikan").value);
    let biayaLain = parseFloat(document.getElementById("biayaLain").value) || 0; // Default 0 jika kosong

    let total = biayaMakanan + biayaTransportasi + biayaPendidikan + biayaLain;

    let biaya = {
        kota: kota,
        provinsi: provinsi,
        biayaMakanan: biayaMakanan,
        biayaTransportasi: biayaTransportasi,
        biayaPendidikan: biayaPendidikan,
        biayaLain: biayaLain,
        total: total
    };

    if (editingIndex === -1) {
        // Create
        biayaData.push(biaya);
    } else {
        // Update
        biayaData[editingIndex] = biaya;
        editingIndex = -1; // Reset editingIndex
    }

    updateTable();
    resetForm();
}

function updateTable() {
    let tableBody = document.getElementById("biayaTable").getElementsByTagName("tbody")[0];
    tableBody.innerHTML = ""; // Kosongkan tabel

    for (let i = 0; i < biayaData.length; i++) {
        let row = tableBody.insertRow(i);
        let kotaCell = row.insertCell(0);
        let provinsiCell = row.insertCell(1);
        let makananCell = row.insertCell(2);
        let transportasiCell = row.insertCell(3);
        let pendidikanCell = row.insertCell(4);
        let lainCell = row.insertCell(5);
        let totalCell = row.insertCell(6);
        let aksiCell = row.insertCell(7);

        kotaCell.textContent = biayaData[i].kota;
        provinsiCell.textContent = biayaData[i].provinsi;
        makananCell.textContent = biayaData[i].biayaMakanan;
        transportasiCell.textContent = biayaData[i].biayaTransportasi;
        pendidikanCell.textContent = biayaData[i].biayaPendidikan;
        lainCell.textContent = biayaData[i].biayaLain;
        totalCell.textContent = biayaData[i].total;

        aksiCell.innerHTML = `<button onclick="editBiaya(${i})">Edit</button> <button onclick="deleteBiaya(${i})">Delete</button>`;
    }
}

function editBiaya(index) {
    // Isi form dengan data yang akan diedit
    document.getElementById("kota").value = biayaData[index].kota;
    document.getElementById("provinsi").value = biayaData[index].provinsi;
    document.getElementById("biayaMakanan").value = biayaData[index].biayaMakanan;
    document.getElementById("biayaTransportasi").value = biayaData[index].biayaTransportasi;
    document.getElementById("biayaPendidikan").value = biayaData[index].biayaPendidikan;
    document.getElementById("biayaLain").value = biayaData[index].biayaLain;

    editingIndex = index; // Set editingIndex
}

function deleteBiaya(index) {
    biayaData.splice(index, 1);
    updateTable();
}

function resetForm() {
    document.getElementById("biayaForm").reset();
    let errors = document.getElementsByClassName("error");
    for (let i = 0; i < errors.length; i++) {
        errors[i].textContent = "";
    }
    editingIndex = -1; // Reset editingIndex
}

// Inisialisasi tabel saat halaman dimuat
updateTable();