var nama = document.forms['form']['nama'];
var nim = document.forms['form']['nim'];
var password = document.forms['form']['password'];

var nilai_nama = document.getElementById('user_nama');
var nilai_nim = document.getElementById('user_nim');

var nama_error = document.getElementById('nama_error');
var nim_error = document.getElementById('nim_error');
var password_error = document.getElementById('password_error');

nama.addEventListener('textInput', nama_verify);
nim.addEventListener('textInput', nim_verify);
password.addEventListener('textInput', password_verify);


function validated() {
    if (nama.value.length < 1 && nim.value.length < 1 && password.value.length < 1) {
        nama_error.style.display = "block";
        nim_error.style.display = "block";
        password_error.style.display = "block";
        nama.focus()
        nim.focus()
        password.focus()
        return false;
    }
    if (nama.value.length < 1) {
        nama_error.style.display = "block";
        nama.focus()
        return false;
    }
    if (nim.value.length < 12 || nim.value.length > 12) {
        nim_error.style.display = "block";
        nim.focus()
        return false;
    }
    if (password.value.length < 6 || password.value.length > 6) {
        password_error.style.display = "block";
        password.focus()
        return false;
    }
}

function nama_verify() {
    if (nama.value.length > 1) {
        nama_error.style.display = "none";
        return true;
    }
}

function nim_verify() {
    if (nim.value.length = 12) {
        nim_error.style.display = "none";
        return true;
    }
}

function password_verify() {
    if (password.value.length = 6) {
        password_error.style.display = "none";
        return true;
    }
}


function tampilkan() {
    window.alert("Nama " + nilai_nama.value + " Dengan NIM " + nilai_nim.value + " Selamat Anda Lulus Matakuliah DPW Dengan Nilai A");

}