<?php
// session_start();
require 'conn.php';


// ---------------------------------------------------------------------------------------//
// -----------------------------------------AUTH------------------------------------------//

// REGISTER
if ($_POST["register"]) {

    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = sha1($_POST["password"]);

    $sql_insert = mysqli_query($conn, "INSERT INTO user (username, email, password) VALUES('$username', '$email', '$password ')");
    echo "<script> alert('Tunggu Lagi diverif'); window.location.href='../sign-in.php'</script>";
}

// SIGN IN
// if ($_POST["login"]) {
//     session_start();

//     $username = $_POST["email"];
//     $email = $_POST["email"];
//     $password =  sha1($_POST["password"]);
//     $signin = mysqli_query($conn, "SELECT * FROM user WHERE (email='$email' OR username='$username') AND (password='$password')");

//     $data = @mysqli_fetch_array($signin);

//     if ($data['level'] == "admin") {
//         setcookie('username', $data["username"], time() + (86400 * 30), "/");
//         setcookie('password', $password, time() + (86400 * 30), "/");
//         setcookie('level', $data["level"], time() + (86400 * 30), "/");
//         setcookie('id_user', $data["id_user"], time() + (86400 * 30), "/");
//         setcookie('email', $data["email"], time() + (86400 * 30), "/");
//         $_SESSION['hak_akses'] = "admin";
//         header("Location: ../index.php");
//     } else if ($data['level'] == "operator") {
//         setcookie('username', $data["username"], time() + (86400 * 30), "/");
//         setcookie('password', $password, time() + (86400 * 30), "/");
//         setcookie('level', $data["level"], time() + (86400 * 30), "/");
//         setcookie('id_user', $data["id_user"], time() + (86400 * 30), "/");
//         setcookie('email', $data["email"], time() + (86400 * 30), "/");
//         $_SESSION['hak_akses'] = "operator";
//         header("Location: ../index.php");
//     } else {
//         $_SESSION["status"] = "error";
//         header("Location: ../sign-in.php");
//     }
// }

// REGISTER
// if ($_POST["register"]) {

//     $username = $_POST["username"];
//     $email = $_POST["email"];
//     $password = sha1($_POST["password"]);

//     $sql_insert = mysqli_query($conn, "INSERT INTO user (username, email, password) VALUES('$username', '$email', '$password ')");
//     echo "<script> alert('Tunggu Lagi diverif'); window.location.href='../sign-in.php'</script>";

// }

// // SIGN OUT
// if ($_POST["logout"]) {
//     session_destroy();
//     unset($_SESSION["hak_akses"]);
//     setcookie("username", "", time() - 3600);
//     setcookie("password", "", time() - 3600);
//     header("Location: ../sign-in.php");
// }





// ---------------------------------------------------------------------------------------//
// -----------------------------------------ADMIN-----------------------------------------//

// -------------------------USERS-------------------------//

// CREATE USERS
if (isset($_POST["create_user"])) {
    $full_name = $_POST["full_name"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $role = $_POST["role"];
    $password = sha1($_POST["password"]);

    $create_user = mysqli_query($conn, "INSERT INTO tbl_users (full_name, username, email, role, password) VALUES ('$full_name','$username','$email', '$role', '$password')");

    if (!$create_user) {
        die("Query gagal dijalankan: " . mysqli_errno($conn) .
            " - " . mysqli_error($conn));
    } else {
        echo "<script>alert('Berhasil Menambahkan User');window.location='../admin/user.php';</script>";
    }
    header("Location: ../admin/user.php");
}

// UPDATE USERS
if (isset($_POST["update_user"])) {
    $id_user = $_POST["id_user"];
    $full_name = $_POST["full_name"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $role = $_POST["role"];
    $password = sha1($_POST["password"]);

    $update_user = mysqli_query($conn, "UPDATE tbl_users SET full_name='$full_name', username='$username', email='$email', role='$role', password='$password' WHERE id_user='$id_user'");

    if (!$update_user) {
        die("Query gagal dijalankan: " . mysqli_errno($conn) .
            " - " . mysqli_error($conn));
    } else {
        echo "<script>alert('Berhasil Menambahkan User');window.location='../admin/user.php';</script>";
    }

    header("Location: ../admin/user.php");
}

// DELETE USERS
if ($_POST['delete_user']) {
    $id_user = $_POST['id_user'];

    $delete_user = mysqli_query($conn, "DELETE FROM tbl_users WHERE id_user='$id_user'");
    if (!$delete_user) {
        die("Query gagal dijalankan: " . mysqli_errno($conn) .
            " - " . mysqli_error($conn));
    } else {
        echo "<script>alert('Berhasil Menambahkan User');window.location='../admin/user.php';</script>";
    }

    header("Location: ../admin/user.php");
}




// ---------------------------------------------------------------------------------------//
// ----------------------------------Pasien & Pengunjung----------------------------------//
// -------------------------DOKTER-------------------------//

// CREATE DOKTER
if (isset($_POST["create_dokter"])) {
    $fullname = $_POST["fullname"];
    $username = $_POST["username"];
    $nip = $_POST["nip"];
    $mobile_number = $_POST["mobile_number"];
    $id_spesialis = $_POST["id_spesialis"];
    $email = $_POST["email"];
    $jenis_kelamin = $_POST["jenis_kelamin"];
    $join_date = $_POST["join_date"];
    $alamat = $_POST["alamat"];
    $pendidikan = $_POST["pendidikan"];
    $deskripsi = $_POST["deskripsi"];
    $profile_picture = $_FILES["profile_picture"]['name'];
    $user_picture = $_FILES["profile_picture"]['name'];

    if ($profile_picture != "" && $user_picture != "") {
        $allow_extension = ['jpg', 'png', 'jpeg'];
        $x = explode('.', $profile_picture);
        $extension = strtolower(end($x));
        $file_tmp = $_FILES['profile_picture']['tmp_name'];
        $file_name = "dokter_" . $username . "." . $extension;

        if (
            in_array($extension, $allow_extension) === true
        ) {
            move_uploaded_file($file_tmp, "../assets/images/upload/dokter/" . $file_name);

            $create_dokter = mysqli_query($conn, "INSERT INTO tbl_dokter (nip_dokter, full_name, username, mobile_number, alamat, jenis_kelamin, id_spesialis, email, joining_date, pendidikan, deskripsi, profile_picture) VALUES ('$nip','$fullname','$username','$mobile_number','$alamat','$jenis_kelamin','$id_spesialis','$email','$join_date','$pendidikan', '$deskripsi', '$file_name')");
            $create_user_dokter = mysqli_query($conn, "INSERT INTO tbl_users (full_name, username, email, nip_dokter, role, mobile_number, user_picture) VALUES ('$fullname','$username','$email','$nip',2,'$mobile_number','$file_name')");

            if (!$create_dokter && !$create_user_dokter) {
                die("Query gagal dijalankan: " . mysqli_errno($conn) .
                    " - " . mysqli_error($conn));
            } else {
                echo "<script>alert('Berhasil Menambahkan Dokter');window.location='../admin/admin-dokter.php';</script>";
            }
        } else {
            echo "<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');";
        }
    } else {
        $create_dokter = mysqli_query($conn, "INSERT INTO tbl_dokter (nip_dokter, full_name, username, mobile_number, alamat, jenis_kelamin, id_spesialis, email, joining_date, pendidikan, deskripsi, profile_picture) VALUES ('$nip','$fullname','$username','$mobile_number','$alamat','$jenis_kelamin','$id_spesialis','$email','$join_date','$pendidikan', '$deskripsi', null)");
        $create_user_dokter = mysqli_query($conn, "INSERT INTO tbl_users (full_name, username, email, nip_dokter, role, mobile_number, user_picture) VALUES ('$fullname','$username','$email','$nip',2,'$mobile_number',null)");
        if (!$create_dokter && !$create_user_dokter) {
            die("Query gagal dijalankan: " . mysqli_errno($conn) .
                " - " . mysqli_error($conn));
        } else {
            echo "<script>alert('Berhasil Menambahkan Dokter');";
        }
    }
    header("Location: ../admin/admin-dokter.php");
}

// UPDATE DOKTER
if (isset($_POST["update_dokter"])) {
    $id_dokter = $_POST['id_dokter'];
    $nip_dokter = $_POST['nip_dokter'];
    $fullname = $_POST["fullname"];
    $username = $_POST["username"];
    $mobile_number = $_POST["mobile_number"];
    $id_spesialis = $_POST["id_spesialis"];
    $email = $_POST["email"];
    $jenis_kelamin = $_POST["jenis_kelamin"];
    $join_date = $_POST["join_date"];
    $alamat = $_POST["alamat"];
    $pendidikan = $_POST["pendidikan"];
    $deskripsi = $_POST["deskripsi"];
    $profile_picture = $_FILES["profile_picture"]['name'];

    if ($profile_picture != "") {
        $allow_extension = ['jpg', 'png', 'jpeg'];
        $x = explode('.', $profile_picture);
        $extension = strtolower(end($x));
        $file_tmp = $_FILES['profile_picture']['tmp_name'];
        $file_name = "dokter_" . $username . "." . $extension;

        if (
            in_array($extension, $allow_extension) === true
        ) {
            move_uploaded_file($file_tmp, "../assets/images/upload/dokter/" . $file_name);
            $update_dokter = mysqli_query($conn, "UPDATE tbl_dokter SET nip_dokter='$nip', full_name='$fullname', username='$username', mobile_number='$mobile_number', alamat='$alamat', jenis_kelamin='$jenis_kelamin', id_spesialis='$id_spesialis', email='$email', joining_date='$join_date', pendidikan='$pendidikan', deskripsi='$deskripsi', profile_picture='$file_name' WHERE id_dokter='$id_dokter'");
            $update_dokter_user = mysqli_query($conn, "UPDATE tbl_users SET full_name='$fullname', username='$username', email='$email', mobile_number='$mobile_number', user_picture='$file_name' WHERE nip_dokter='$nip_dokter'");

            if (!$update_dokter && !$update_dokter_user) {
                die("Query gagal dijalankan: " . mysqli_errno($conn) .
                    " - " . mysqli_error($conn));
            } else {
                echo "<script>alert('Berhasil Mengupdate Dokter');window.location='../admin/admin-dokter.php';</script>";
            }
        } else {
            echo "<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');";
        }
    } else {
        $update_dokter = mysqli_query($conn, "UPDATE tbl_dokter SET full_name='$fullname', username='$username', mobile_number='$mobile_number', alamat='$alamat', jenis_kelamin='$jenis_kelamin', id_spesialis='$id_spesialis', email='$email', joining_date='$join_date', pendidikan='$pendidikan', deskripsi='$deskripsi' WHERE id_dokter='$id_dokter'");
        $update_dokter_user = mysqli_query($conn, "UPDATE tbl_users SET full_name='$fullname', username='$username', email='$email', mobile_number='$mobile_number' WHERE nip_dokter='$nip_dokter'");
        if (!$update_dokter && !$update_dokter_user) {
            die("Query gagal dijalankan: " . mysqli_errno($conn) .
                " - " . mysqli_error($conn));
        } else {
            echo "<script>alert('Berhasil Mengupdate Dokter');";
        }
    }

    header("Location: ../admin/admin-dokter.php");
}

// DELETE DOKTER
if ($_POST['delete_dokter']) {
    $id_dokter = $_POST['id_dokter'];
    $nip_dokter = $_POST['nip_dokter'];

    $delete_dokter = mysqli_query($conn, "DELETE FROM tbl_dokter WHERE id_dokter='$id_dokter'");
    $delete_dokter_user = mysqli_query($conn, "DELETE FROM tbl_users WHERE nip_dokter='$nip_dokter'");
    if (!$delete_dokter && !$delete_dokter_user) {
        die("Query gagal dijalankan: " . mysqli_errno($conn) .
            " - " . mysqli_error($conn));
    } else {
        echo "<script>alert('Berhasil Menghapus Dokter');";
    }

    header("Location: ../admin/admin-dokter.php");
}



// -------------------------PERAWAT-------------------------//

// CREATE PERAWAT
if (isset($_POST["create_perawat"])) {
    $fullname = $_POST["fullname"];
    $username = $_POST["username"];
    $nip = $_POST["nip"];
    $mobile_number = $_POST["mobile_number"];
    $id_spesialis = $_POST["id_spesialis"];
    $email = $_POST["email"];
    $jenis_kelamin = $_POST["jenis_kelamin"];
    $join_date = $_POST["join_date"];
    $alamat = $_POST["alamat"];
    $pendidikan = $_POST["pendidikan"];
    $deskripsi = $_POST["deskripsi"];
    $profile_picture = $_FILES["profile_picture"]['name'];

    if ($profile_picture != "") {
        $allow_extension = ['jpg', 'png', 'jpeg'];
        $x = explode('.', $profile_picture);
        $extension = strtolower(end($x));
        $file_tmp = $_FILES['profile_picture']['tmp_name'];
        $file_name = "perawat_" . $username . "." . $extension;

        if (
            in_array($extension, $allow_extension) === true
        ) {
            move_uploaded_file($file_tmp, "../assets/images/upload/perawat/" . $file_name);

            $create_perawat = mysqli_query($conn, "INSERT INTO tbl_perawat (nip_perawat, full_name, username, mobile_number, alamat, jenis_kelamin, id_spesialis, email, joining_date, pendidikan, deskripsi, profile_picture) VALUES ('$nip','$fullname','$username','$mobile_number','$alamat','$jenis_kelamin','$id_spesialis','$email','$join_date','$pendidikan','$deskripsi', '$file_name')");
            $create_user_perawat = mysqli_query($conn, "INSERT INTO tbl_users (full_name, username, email, nip_perawat, role, mobile_number, user_picture) VALUES ('$fullname','$username','$email','$nip',3,'$mobile_number','$file_name')");
            if (!$create_perawat && !$create_user_perawat) {
                die("Query gagal dijalankan: " . mysqli_errno($conn) .
                    " - " . mysqli_error($conn));
            } else {
                echo "<script>alert('Berhasil Menambahkan Perawat');window.location='../admin/admin-perawat.php';</script>";
            }
        } else {
            echo "<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');";
        }
    } else {
        $create_perawat = mysqli_query($conn, "INSERT INTO tbl_perawat (nip_perawat, full_name, username, mobile_number, alamat, jenis_kelamin, id_spesialis, email, joining_date, pendidikan, deskripsi, profile_picture) VALUES ('$nip','$fullname','$username','$mobile_number','$alamat','$jenis_kelamin','$id_spesialis','$email','$join_date','$pendidikan','$deskripsi', null)");
        $create_user_perawat = mysqli_query($conn, "INSERT INTO tbl_users (full_name, username, email, nip_perawat, role, mobile_number, user_picture) VALUES ('$fullname','$username','$email','$nip',2,'$mobile_number', null)");
        if (!$create_perawat && !$create_user_perawat) {
            die("Query gagal dijalankan: " . mysqli_errno($conn) .
                " - " . mysqli_error($conn));
        } else {
            echo "<script>alert('Berhasil Menambahkan Perawat');";
        }
    }
    header("Location: ../admin/admin-perawat.php");
}

// UPDATE PERAWAT
if (isset($_POST["update_perawat"])) {
    $id_perawat = $_POST['id_perawat'];
    $nip_perawat = $_POST['nip_perawat'];
    $fullname = $_POST["fullname"];
    $username = $_POST["username"];
    $nip = $_POST["nip"];
    $mobile_number = $_POST["mobile_number"];
    $id_spesialis = $_POST["id_spesialis"];
    $email = $_POST["email"];
    $jenis_kelamin = $_POST["jenis_kelamin"];
    $join_date = $_POST["join_date"];
    $alamat = $_POST["alamat"];
    $pendidikan = $_POST["pendidikan"];
    $deskripsi = $_POST["deskripsi"];
    $profile_picture = $_FILES["profile_picture"]['name'];

    if ($profile_picture != "") {
        $allow_extension = ['jpg', 'png', 'jpeg'];
        $x = explode('.', $profile_picture);
        $extension = strtolower(end($x));
        $file_tmp = $_FILES['profile_picture']['tmp_name'];
        $file_name = "perawat_" . $username . "." . $extension;

        if (
            in_array($extension, $allow_extension) === true
        ) {
            move_uploaded_file($file_tmp, "../assets/images/upload/perawat/" . $file_name);
            $update_perawat = mysqli_query($conn, "UPDATE tbl_perawat SET nip_perawat='$nip', full_name='$fullname', username='$username', mobile_number='$mobile_number', alamat='$alamat', jenis_kelamin='$jenis_kelamin', id_spesialis='$id_spesialis', email='$email', joining_date='$join_date', pendidikan='$pendidikan', deskripsi='$deskripsi', profile_picture='$file_name' WHERE id_perawat='$id_perawat'");
            $update_perawat_user = mysqli_query($conn, "UPDATE tbl_users SET full_name='$fullname', username='$username', email='$email', mobile_number='$mobile_number', user_picture='$file_name' WHERE nip_perawat='$nip_perawat'");
            if (!$update_perawat && !$update_perawat_user) {
                die("Query gagal dijalankan: " . mysqli_errno($conn) .
                    " - " . mysqli_error($conn));
            } else {
                echo "<script>alert('Berhasil Mengupdate Perawat');window.location='../admin/admin-perawat.php';</script>";
            }
        } else {
            echo "<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');";
        }
    } else {
        $update_perawat = mysqli_query($conn, "UPDATE tbl_perawat SET nip_perawat='$nip', full_name='$fullname', username='$username', mobile_number='$mobile_number', alamat='$alamat', jenis_kelamin='$jenis_kelamin', id_spesialis='$id_spesialis', email='$email', joining_date='$join_date', pendidikan='$pendidikan', deskripsi='$deskripsi' WHERE id_perawat='$id_perawat'");
        $update_perawat_user = mysqli_query($conn, "UPDATE tbl_users SET full_name='$fullname', username='$username', email='$email', mobile_number='$mobile_number' WHERE nip_perawat='$nip_perawat'");
        if (!$update_perawat && !$update_perawat_user) {
            die("Query gagal dijalankan: " . mysqli_errno($conn) .
                " - " . mysqli_error($conn));
        } else {
            echo "<script>alert('Berhasil Mengupdate Perawat');";
        }
    }

    header("Location: ../admin/admin-perawat.php");
}

// DELETE PERAWAT
if ($_POST['delete_perawat']) {
    $id_perawat = $_POST['id_perawat'];
    $nip_perawat = $_POST['nip_perawat'];

    $delete_perawat = mysqli_query($conn, "DELETE FROM tbl_perawat WHERE id_perawat='$id_perawat'");
    $delete_perawat_user = mysqli_query($conn, "DELETE FROM tbl_users WHERE nip_perawat='$nip_perawat'");
    if (!$delete_perawat && !$delete_perawat_user) {
        die("Query gagal dijalankan: " . mysqli_errno($conn) .
            " - " . mysqli_error($conn));
    } else {
        echo "<script>alert('Berhasil Menghapus Perawat');";
    }

    header("Location: ../admin/admin-perawat.php");
}



// -------------------------POLIKLINIK-------------------------//

// CREATE POLIKLINIK
if (isset($_POST["create_poliklinik"])) {
    $nama_poliklinik = $_POST["nama_poliklinik"];
    $admission = $_POST["admission"];
    $program_unggulan = $_POST["program_unggulan"];
    $deskripsi = $_POST["deskripsi"];
    $link = $_POST["link"];
    $poliklinik_picture = $_FILES["poliklinik_picture"]['name'];

    if ($poliklinik_picture != "") {
        $allow_extension = ['jpg', 'png', 'jpeg'];
        $x = explode('.', $poliklinik_picture);
        $extension = strtolower(end($x));
        $angka_acak = rand(1, 999);
        $file_tmp = $_FILES['poliklinik_picture']['tmp_name'];
        $file_name = "Poliklinik_" . $angka_acak . "." . $extension;

        if (
            in_array($extension, $allow_extension) === true
        ) {
            move_uploaded_file($file_tmp, "../assets/images/upload/poliklinik/" . $file_name);

            $create_poliklinik = mysqli_query($conn, "INSERT INTO tbl_poliklinik (nama_poliklinik, admission, program_unggulan, link, deskripsi, poliklinik_picture) VALUES ('$nama_poliklinik','$admission','$program_unggulan','$link','$deskripsi', '$file_name')");

            if (!$create_poliklinik) {
                die("Query gagal dijalankan: " . mysqli_errno($conn) .
                    " - " . mysqli_error($conn));
            } else {
                echo "<script>alert('Berhasil Menambahkan Poliklinik');window.location='../admin/admin-poliklinik.php';</script>";
            }
        } else {
            echo "<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');";
        }
    } else {
        $create_poliklinik = mysqli_query($conn, "INSERT INTO tbl_poliklinik (nama_poliklinik, admission, program_unggulan, link, deskripsi, poliklinik_picture) VALUES ('$nama_poliklinik','$admission','$program_unggulan','$link','$deskripsi', null)");
        if (!$create_poliklinik) {
            die("Query gagal dijalankan: " . mysqli_errno($conn) .
                " - " . mysqli_error($conn));
        } else {
            echo "<script>alert('Berhasil Menambahkan Poliklinik');";
        }
    }
    header("Location: ../admin/admin-poliklinik.php");
}

// UPDATE POLIKLINIK
if (isset($_POST["update_poliklinik"])) {
    $id_poliklinik = $_POST['id_poliklinik'];
    $nama_poliklinik = $_POST["nama_poliklinik"];
    $admission = $_POST["admission"];
    $program_unggulan = $_POST["program_unggulan"];
    $deskripsi = $_POST["deskripsi"];
    $link = $_POST["link"];
    $poliklinik_picture = $_FILES["poliklinik_picture"]['name'];

    if ($poliklinik_picture != "") {
        $allow_extension = ['jpg', 'png', 'jpeg'];
        $x = explode('.', $poliklinik_picture);
        $extension = strtolower(end($x));
        $angka_acak = rand(1, 999);
        $file_tmp = $_FILES['poliklinik_picture']['tmp_name'];
        $file_name = "Poliklinik_" . $angka_acak . "." . $extension;

        if (
            in_array($extension, $allow_extension) === true
        ) {
            move_uploaded_file($file_tmp, "../assets/images/upload/poliklinik/" . $file_name);
            $update_poliklinik = mysqli_query($conn, "UPDATE tbl_poliklinik SET nama_poliklinik='$nama_poliklinik', admission='$admission', program_unggulan='$program_unggulan', deskripsi='$deskripsi', link='$link', poliklinik_picture='$file_name' WHERE id_poliklinik='$id_poliklinik'");

            if (!$update_poliklinik) {
                die("Query gagal dijalankan: " . mysqli_errno($conn) .
                    " - " . mysqli_error($conn));
            } else {
                echo "<script>alert('Berhasil Mengupdate Poliklinik');window.location='../admin/admin-poliklinik.php';</script>";
            }
        } else {
            echo "<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');";
        }
    } else {
        $update_poliklinik = mysqli_query($conn, "UPDATE tbl_poliklinik SET nama_poliklinik='$nama_poliklinik', admission='$admission', program_unggulan='$program_unggulan', deskripsi='$deskripsi', link='$link' WHERE id_poliklinik='$id_poliklinik'");
        if (!$update_poliklinik) {
            die("Query gagal dijalankan: " . mysqli_errno($conn) .
                " - " . mysqli_error($conn));
        } else {
            echo "<script>alert('Berhasil Mengupdate Poliklinik');";
        }
    }

    header("Location: ../admin/admin-poliklinik.php");
}

// DELETE POLIKLINIK
if ($_POST['delete_poliklinik']) {
    $id_poliklinik = $_POST['id_poliklinik'];

    $delete_poliklinik = mysqli_query($conn, "DELETE FROM tbl_poliklinik WHERE id_poliklinik='$id_poliklinik'");
    if (!$delete_poliklinik) {
        die("Query gagal dijalankan: " . mysqli_errno($conn) .
            " - " . mysqli_error($conn));
    } else {
        echo "<script>alert('Berhasil Menghapus Poli Klinik');";
    }

    header("Location: ../admin/admin-poliklinik.php");
}



// -------------------------RAWAT INAP-------------------------//

// CREATE RAWATINAP
if (isset($_POST["create_kamar"])) {
    $nama_kamar = $_POST["nama_kamar"];
    $fasilitas_kamar = $_POST["fasilitas_kamar"];
    $total_kamar = $_POST["total_kamar"];
    $admission = $_POST["admission"];
    $link = $_POST["link"];
    $kamar_picture = $_FILES["kamar_picture"]['name'];

    if ($kamar_picture != "") {
        $allow_extension = ['jpg', 'png', 'jpeg'];
        $x = explode('.', $kamar_picture);
        $extension = strtolower(end($x));
        $title_gambar = explode(' ', $nama_kamar);
        $gambar = (strtolower(end($title_gambar)));
        $file_tmp = $_FILES['kamar_picture']['tmp_name'];
        $file_name = "Kamar_" . $gambar . "." . $extension;

        if (
            in_array($extension, $allow_extension) === true
        ) {
            move_uploaded_file($file_tmp, "../assets/images/upload/rawatinap/" . $file_name);

            $create_kamar = mysqli_query($conn, "INSERT INTO tbl_rawatinap (nama_kamar, fasilitas_kamar, total_kamar, admission, link, kamar_picture) VALUES ('$nama_kamar','$fasilitas_kamar','$total_kamar','$admission','$link', '$file_name')");

            if (!$create_kamar) {
                die("Query gagal dijalankan: " . mysqli_errno($conn) .
                    " - " . mysqli_error($conn));
            } else {
                echo "<script>alert('Berhasil Menambahkan Kamar');window.location='../admin/admin-rawatinap.php';</script>";
            }
        } else {
            echo "<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');";
        }
    } else {
        $create_kamar = mysqli_query($conn, "INSERT INTO tbl_rawatinap (nama_kamar, fasilitas_kamar, total_kamar, admission, link, kamar_picture) VALUES ('$nama_kamar','$fasilitas_kamar','$total_kamar','$admission','$link', null)");
        if (!$create_kamar) {
            die("Query gagal dijalankan: " . mysqli_errno($conn) .
                " - " . mysqli_error($conn));
        } else {
            echo "<script>alert('Berhasil Menambahkan Kamar');";
        }
    }
    header("Location: ../admin/admin-rawatinap.php");
}

// UPDATE RAWATINAP
if (isset($_POST["update_kamar"])) {
    $id_rawatinap = $_POST['id_rawatinap'];
    $nama_kamar = $_POST["nama_kamar"];
    $fasilitas_kamar = $_POST["fasilitas_kamar"];
    $total_kamar = $_POST["total_kamar"];
    $admission = $_POST["admission"];
    $link = $_POST["link"];
    $kamar_picture = $_FILES["kamar_picture"]['name'];

    if ($kamar_picture != "") {
        $allow_extension = ['jpg', 'png', 'jpeg'];
        $x = explode('.', $kamar_picture);
        $extension = strtolower(end($x));
        $title_gambar = explode(' ', $nama_kamar);
        $gambar = (strtolower(end($title_gambar)));
        $file_tmp = $_FILES['kamar_picture']['tmp_name'];
        $file_name = "Kamar_" . $gambar . "." . $extension;

        if (
            in_array($extension, $allow_extension) === true
        ) {
            move_uploaded_file($file_tmp, "../assets/images/upload/rawatinap/" . $file_name);
            $update_kamar = mysqli_query($conn, "UPDATE tbl_rawatinap SET nama_kamar='$nama_kamar', fasilitas_kamar='$fasilitas_kamar', total_kamar='$total_kamar', admission='$admission', link='$link', kamar_picture='$file_name' WHERE id_rawatinap='$id_rawatinap'");

            if (!$update_kamar) {
                die("Query gagal dijalankan: " . mysqli_errno($conn) .
                    " - " . mysqli_error($conn));
            } else {
                echo "<script>alert('Berhasil Mengupdate Kamar');window.location='../admin/admin-rawatinap.php';</script>";
            }
        } else {
            echo "<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');";
        }
    } else {
        $update_kamar = mysqli_query($conn, "UPDATE tbl_rawatinap SET nama_kamar='$nama_kamar', fasilitas_kamar='$fasilitas_kamar', total_kamar='$total_kamar', admission='$admission', link='$link' WHERE id_rawatinap='$id_rawatinap'");
        if (!$update_kamar) {
            die("Query gagal dijalankan: " . mysqli_errno($conn) .
                " - " . mysqli_error($conn));
        } else {
            echo "<script>alert('Berhasil Mengupdate Kamar');";
        }
    }

    header("Location: ../admin/admin-rawatinap.php");
}

// DELETE RAWATINAP
if ($_POST['delete_kamar']) {
    $id_rawatinap = $_POST['id_rawatinap'];

    $delete_kamar = mysqli_query($conn, "DELETE FROM tbl_rawatinap WHERE id_rawatinap='$id_rawatinap'");
    if (!$delete_kamar) {
        die("Query gagal dijalankan: " . mysqli_errno($conn) .
            " - " . mysqli_error($conn));
    } else {
        echo "<script>alert('Berhasil Menghapus Kamar');";
    }

    header("Location: ../admin/admin-rawatinap.php");
}



// ---------------------------------------------------------------------------------------//
// -----------------------------------------Layanan---------------------------------------//

// -------------------------FARMASI-------------------------//

// CREATE FARMASI
if (isset($_POST["create_obat"])) {
    $nama_obat = $_POST["nama_obat"];
    $id_kategori_obat = $_POST["id_kategori_obat"];
    $jenis = $_POST["jenis"];
    $harga = $_POST["harga"];
    $deskripsi = $_POST["deskripsi"];
    $admission = $_POST["admission"];
    $link = $_POST["link"];
    $obat_picture = $_FILES["obat_picture"]['name'];

    if ($obat_picture != "") {
        $allow_extension = ['jpg', 'png', 'jpeg'];
        $x = explode('.', $obat_picture);
        $extension = strtolower(end($x));
        $title_gambar = explode(' ', $nama_obat);
        $gambar = (strtolower(end($title_gambar)));
        $file_tmp = $_FILES['obat_picture']['tmp_name'];
        $file_name = "Obat_" . $gambar . "." . $extension;

        if (
            in_array($extension, $allow_extension) === true
        ) {
            move_uploaded_file($file_tmp, "../assets/images/upload/farmasi/" . $file_name);

            $create_obat = mysqli_query($conn, "INSERT INTO tbl_farmasi (nama_obat, id_kategori_obat, jenis, harga, deskripsi, admission, link, obat_picture) VALUES ('$nama_obat','$id_kategori_obat','$jenis','$harga','$deskripsi','$admission','$link', '$file_name')");

            if (!$create_obat) {
                die("Query gagal dijalankan: " . mysqli_errno($conn) .
                    " - " . mysqli_error($conn));
            } else {
                echo "<script>alert('Berhasil Menambahkan Obat');window.location='../admin/admin-farmasi.php';</script>";
            }
        } else {
            echo "<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');";
        }
    } else {
        $create_obat = mysqli_query($conn, "INSERT INTO tbl_farmasi (nama_obat, id_kategori_obat, jenis, harga, deskripsi, admission, link, obat_picture) VALUES ('$nama_obat','$id_kategori_obat','$jenis','$harga','$deskripsi','$admission','$link', null)");
        if (!$create_obat) {
            die("Query gagal dijalankan: " . mysqli_errno($conn) .
                " - " . mysqli_error($conn));
        } else {
            echo "<script>alert('Berhasil Menambahkan Obat');";
        }
    }
    header("Location: ../admin/admin-farmasi.php");
}

// UPDATE FARMASI
if (isset($_POST["update_obat"])) {
    $id_farmasi = $_POST['id_farmasi'];
    $nama_obat = $_POST["nama_obat"];
    $id_kategori_obat = $_POST["id_kategori_obat"];
    $jenis = $_POST["jenis"];
    $harga = $_POST["harga"];
    $deskripsi = $_POST["deskripsi"];
    $admission = $_POST["admission"];
    $link = $_POST["link"];
    $obat_picture = $_FILES["obat_picture"]['name'];

    if ($obat_picture != "") {
        $allow_extension = ['jpg', 'png', 'jpeg'];
        $x = explode('.', $obat_picture);
        $extension = strtolower(end($x));
        $title_gambar = explode(' ', $nama_obat);
        $gambar = (strtolower(end($title_gambar)));
        $file_tmp = $_FILES['obat_picture']['tmp_name'];
        $file_name = "Obat_" . $gambar . "." . $extension;

        if (
            in_array($extension, $allow_extension) === true
        ) {
            move_uploaded_file($file_tmp, "../assets/images/upload/farmasi/" . $file_name);
            $update_obat = mysqli_query($conn, "UPDATE tbl_farmasi SET nama_obat='$nama_obat', id_kategori_obat='$id_kategori_obat', jenis='$jenis', harga='$harga', deskripsi='$deskripsi', admission='$admission', link='$link', obat_picture='$file_name' WHERE id_farmasi='$id_farmasi'");

            if (!$update_obat) {
                die("Query gagal dijalankan: " . mysqli_errno($conn) .
                    " - " . mysqli_error($conn));
            } else {
                echo "<script>alert('Berhasil Mengupdate Obat');window.location='../admin/admin-farmasi.php';</script>";
            }
        } else {
            echo "<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');";
        }
    } else {
        $update_obat = mysqli_query($conn, "UPDATE tbl_farmasi SET nama_obat='$nama_obat', id_kategori_obat='$id_kategori_obat', jenis='$jenis', harga='$harga', deskripsi='$deskripsi', admission='$admission', link='$link' WHERE id_farmasi='$id_farmasi'");
        if (!$update_obat) {
            die("Query gagal dijalankan: " . mysqli_errno($conn) .
                " - " . mysqli_error($conn));
        } else {
            echo "<script>alert('Berhasil Mengupdate Obat');";
        }
    }

    header("Location: ../admin/admin-farmasi.php");
}

// DELETE FARMASI
if ($_POST['delete_obat']) {
    $id_farmasi = $_POST['id_farmasi'];

    $delete_obat = mysqli_query($conn, "DELETE FROM tbl_farmasi WHERE id_farmasi='$id_farmasi'");
    if (!$delete_obat) {
        die("Query gagal dijalankan: " . mysqli_errno($conn) .
            " - " . mysqli_error($conn));
    } else {
        echo "<script>alert('Berhasil Menghapus Obat');";
    }

    header("Location: ../admin/admin-farmasi.php");
}



// ---------------------------------------------------------------------------------------//
// ---------------------------------Berita & Artikel Populer------------------------------//

// -------------------------ARTIKEL POPULER-------------------------//

// CREATE ARTIKEL
if (isset($_POST["create_artikel"])) {
    $judul_artikel = $_POST["judul_artikel"];
    $penulis = $_POST["penulis"];
    $date = $_POST["date"];
    $admission = $_POST["admission"];
    $content_short = $_POST["content_short"];
    $content = $_POST["content"];
    $artikel_picture = $_FILES["artikel_picture"]['name'];

    if ($artikel_picture != "") {
        $allow_extension = ['jpg', 'png', 'jpeg'];
        $x = explode('.', $artikel_picture);
        $extension = strtolower(end($x));
        $angka_acak = rand(1, 999);
        $file_tmp = $_FILES['artikel_picture']['tmp_name'];
        $file_name = "Artikel_" . $angka_acak . "." . $extension;

        if (
            in_array($extension, $allow_extension) === true
        ) {
            move_uploaded_file($file_tmp, "../assets/images/upload/artikel/" . $file_name);

            $create_artikel = mysqli_query($conn, "INSERT INTO tbl_artikel (judul_artikel, penulis, date, admission, content_short, content, artikel_picture) VALUES ('$judul_artikel','$penulis','$date','$admission','$content_short','$content', '$file_name')");

            if (!$create_artikel) {
                die("Query gagal dijalankan: " . mysqli_errno($conn) .
                    " - " . mysqli_error($conn));
            } else {
                echo "<script>alert('Berhasil Menambahkan Artikel');window.location='../admin/admin-artikel-populer.php';</script>";
            }
        } else {
            echo "<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');";
        }
    } else {
        $create_artikel = mysqli_query($conn, "INSERT INTO tbl_artikel (judul_artikel, penulis, date, admission, content_short, content, artikel_picture) VALUES ('$judul_artikel','$penulis','$date','$admission','$content_short','$content', null)");
        if (!$create_artikel) {
            die("Query gagal dijalankan: " . mysqli_errno($conn) .
                " - " . mysqli_error($conn));
        } else {
            echo "<script>alert('Berhasil Menambahkan Artikel');";
        }
    }
    header("Location: ../admin/admin-artikel-populer.php");
}

// UPDATE ARTIKEL
if (isset($_POST["update_artikel"])) {
    $id_artikel = $_POST['id_artikel'];
    $judul_artikel = $_POST["judul_artikel"];
    $penulis = $_POST["penulis"];
    $date = $_POST["date"];
    $admission = $_POST["admission"];
    $content_short = $_POST["content_short"];
    $content = $_POST["content"];
    $artikel_picture = $_FILES["artikel_picture"]['name'];

    if ($artikel_picture != "") {
        $allow_extension = ['jpg', 'png', 'jpeg'];
        $x = explode('.', $artikel_picture);
        $extension = strtolower(end($x));
        $angka_acak = rand(1, 999);
        $file_tmp = $_FILES['artikel_picture']['tmp_name'];
        $file_name = "Artikel_" . $angka_acak . "." . $extension;

        if (
            in_array($extension, $allow_extension) === true
        ) {
            move_uploaded_file($file_tmp, "../assets/images/upload/artikel/" . $file_name);

            $update_artikel = mysqli_query($conn, "UPDATE tbl_artikel SET judul_artikel='$judul_artikel', penulis='$penulis', date='$date', admission='$admission', content_short='$content_short', content='$content', artikel_picture='$file_name' WHERE id_artikel='$id_artikel'");

            if (!$update_artikel) {
                die("Query gagal dijalankan: " . mysqli_errno($conn) .
                    " - " . mysqli_error($conn));
            } else {
                echo "<script>alert('Berhasil Mengupdate Artikel');window.location='../admin/admin-artikel-populer.php';</script>";
            }
        } else {
            echo "<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');";
        }
    } else {
        $update_artikel = mysqli_query($conn, "UPDATE tbl_artikel SET judul_artikel='$judul_artikel', penulis='$penulis', date='$date', admission='$admission', content_short='$content_short', content='$content' WHERE id_artikel='$id_artikel'");
        if (!$update_artikel) {
            die("Query gagal dijalankan: " . mysqli_errno($conn) .
                " - " . mysqli_error($conn));
        } else {
            echo "<script>alert('Berhasil Mengupdate Artikel');";
        }
    }

    header("Location: ../admin/admin-artikel-populer.php");
}

// DELETE ARTIKEL
if ($_POST['delete_artikel']) {
    $id_artikel = $_POST['id_artikel'];

    $delete_artikel = mysqli_query($conn, "DELETE FROM tbl_artikel WHERE id_artikel='$id_artikel'");
    if (!$delete_artikel) {
        die("Query gagal dijalankan: " . mysqli_errno($conn) .
            " - " . mysqli_error($conn));
    } else {
        echo "<script>alert('Berhasil Menghapus Artikel');";
    }

    header("Location: ../admin/admin-artikel-populer.php");
}



// -------------------------EDUKASI VISUAL-------------------------//

// CREATE EDUKASI VISUAL
if (isset($_POST["create_edukasi"])) {
    $judul_edukasivisual = $_POST["judul_edukasivisual"];
    $id_kategori_edukasi = $_POST["id_kategori_edukasi"];
    $date = $_POST["date"];
    $link = $_POST["link"];
    $admission = $_POST["admission"];
    $deskripsi = $_POST["deskripsi"];
    $edukasivisual_picture = $_FILES["edukasivisual_picture"]['name'];

    if ($edukasivisual_picture != "") {
        $allow_extension = ['jpg', 'png', 'jpeg'];
        $x = explode('.', $edukasivisual_picture);
        $extension = strtolower(end($x));
        $angka_acak = rand(1, 999);
        $file_tmp = $_FILES['edukasivisual_picture']['tmp_name'];
        $file_name = "Edukasi_" . $angka_acak . "." . $extension;

        if (
            in_array($extension, $allow_extension) === true
        ) {
            move_uploaded_file($file_tmp, "../assets/images/upload/edukasivisual/" . $file_name);

            $create_edukasi = mysqli_query($conn, "INSERT INTO tbl_edukasivisual (judul_edukasivisual, id_kategori_edukasi, date, link, admission, deskripsi, edukasivisual_picture) VALUES ('$judul_edukasivisual','$id_kategori_edukasi','$date','$link','$admission','$deskripsi', '$file_name')");

            if (!$create_edukasi) {
                die("Query gagal dijalankan: " . mysqli_errno($conn) .
                    " - " . mysqli_error($conn));
            } else {
                echo "<script>alert('Berhasil Menambahkan Edukasi Visual');window.location='../admin/admin-edukasi-visual.php';</script>";
            }
        } else {
            echo "<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');";
        }
    } else {
        $create_edukasi = mysqli_query($conn, "INSERT INTO tbl_edukasivisual (judul_edukasivisual, id_kategori_edukasi, date, link, admission, deskripsi, edukasivisual_picture) VALUES ('$judul_edukasivisual','$id_kategori_edukasi','$date','$link','$admission','$deskripsi',null)");
        if (!$create_edukasi) {
            die("Query gagal dijalankan: " . mysqli_errno($conn) .
                " - " . mysqli_error($conn));
        } else {
            echo "<script>alert('Berhasil Menambahkan Edukasi Visual');";
        }
    }
    header("Location: ../admin/admin-edukasi-visual.php");
}

// UPDATE EDUKASI VISUAL
if (isset($_POST["update_edukasi"])) {
    $id_edukasivisual = $_POST['id_edukasivisual'];
    $judul_edukasivisual = $_POST["judul_edukasivisual"];
    $id_kategori_edukasi = $_POST["id_kategori_edukasi"];
    $date = $_POST["date"];
    $link = $_POST["link"];
    $admission = $_POST["admission"];
    $deskripsi = $_POST["deskripsi"];
    $edukasivisual_picture = $_FILES["edukasivisual_picture"]['name'];

    if ($edukasivisual_picture != "") {
        $allow_extension = ['jpg', 'png', 'jpeg'];
        $x = explode('.', $edukasivisual_picture);
        $extension = strtolower(end($x));
        $angka_acak = rand(1, 999);
        $file_tmp = $_FILES['edukasivisual_picture']['tmp_name'];
        $file_name = "Edukasi_" . $angka_acak . "." . $extension;

        if (
            in_array($extension, $allow_extension) === true
        ) {
            move_uploaded_file($file_tmp, "../assets/images/upload/edukasivisual/" . $file_name);

            $update_edukasi = mysqli_query($conn, "UPDATE tbl_edukasivisual SET judul_edukasivisual='$judul_edukasivisual', id_kategori_edukasi='$id_kategori_edukasi', date='$date', link='$link', admission='$admission', deskripsi='$deskripsi', edukasivisual_picture='$file_name' WHERE id_edukasivisual='$id_edukasivisual'");

            if (!$update_artikel) {
                die("Query gagal dijalankan: " . mysqli_errno($conn) .
                    " - " . mysqli_error($conn));
            } else {
                echo "<script>alert('Berhasil Mengupdate Edukasi Visual');window.location='../admin/admin-edukasi-visual.php';</script>";
            }
        } else {
            echo "<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');";
        }
    } else {
        $update_edukasi = mysqli_query($conn, "UPDATE tbl_edukasivisual SET judul_edukasivisual='$judul_edukasivisual', id_kategori_edukasi='$id_kategori_edukasi', date='$date', link='$link', admission='$admission', deskripsi='$deskripsi' WHERE id_edukasivisual='$id_edukasivisual'");
        if (!$update_edukasi) {
            die("Query gagal dijalankan: " . mysqli_errno($conn) .
                " - " . mysqli_error($conn));
        } else {
            echo "<script>alert('Berhasil Mengupdate Edukasi Visual');";
        }
    }

    header("Location: ../admin/admin-edukasi-visual.php");
}

// DELETE EDUKASI VISUAL
if ($_POST['delete_edukasi']) {
    $id_edukasivisual = $_POST['id_edukasivisual'];

    $delete_edukasi = mysqli_query($conn, "DELETE FROM tbl_edukasivisual WHERE id_edukasivisual='$id_edukasivisual'");
    if (!$delete_edukasi) {
        die("Query gagal dijalankan: " . mysqli_errno($conn) .
            " - " . mysqli_error($conn));
    } else {
        echo "<script>alert('Berhasil Menghapus Edukasi Visual');";
    }

    header("Location: ../admin/admin-edukasi-visual.php");
}



// -------------------------BULETIN-------------------------//

// CREATE BULETIN
if (isset($_POST["create_buletin"])) {
    $judul_buletin = $_POST["judul_buletin"];
    $date = $_POST["date"];
    $link = $_POST["link"];
    $admission = $_POST["admission"];
    $deskripsi = $_POST["deskripsi"];
    $buletin_picture = $_FILES["buletin_picture"]['name'];

    if ($buletin_picture != "") {
        $allow_extension = ['jpg', 'png', 'jpeg'];
        $x = explode('.', $buletin_picture);
        $extension = strtolower(end($x));
        $angka_acak = rand(1, 999);
        $file_tmp = $_FILES['buletin_picture']['tmp_name'];
        $file_name = "Buletin_" . $angka_acak . "." . $extension;

        if (
            in_array($extension, $allow_extension) === true
        ) {
            move_uploaded_file($file_tmp, "../assets/images/upload/buletin/" . $file_name);

            $create_buletin = mysqli_query($conn, "INSERT INTO tbl_buletin (judul_buletin, date, link, admission, deskripsi, buletin_picture) VALUES ('$judul_buletin','$date','$link','$admission','$deskripsi', '$file_name')");

            if (!$create_buletin) {
                die("Query gagal dijalankan: " . mysqli_errno($conn) .
                    " - " . mysqli_error($conn));
            } else {
                echo "<script>alert('Berhasil Menambahkan Buletin');window.location='../admin/admin-buletin.php';</script>";
            }
        } else {
            echo "<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');";
        }
    } else {
        $create_buletin = mysqli_query($conn, "INSERT INTO tbl_buletin (judul_buletin, date, link, admission, deskripsi, buletin_picture) VALUES ('$judul_buletin','$date','$link','$admission','$deskripsi', null)");
        if (!$create_buletin) {
            die("Query gagal dijalankan: " . mysqli_errno($conn) .
                " - " . mysqli_error($conn));
        } else {
            echo "<script>alert('Berhasil Menambahkan Buletin');";
        }
    }
    header("Location: ../admin/admin-buletin.php");
}

// UPDATE BULETIN
if (isset($_POST["update_buletin"])) {
    $id_buletin = $_POST["id_buletin"];
    $judul_buletin = $_POST["judul_buletin"];
    $date = $_POST["date"];
    $link = $_POST["link"];
    $admission = $_POST["admission"];
    $deskripsi = $_POST["deskripsi"];
    $buletin_picture = $_FILES["buletin_picture"]['name'];

    if ($buletin_picture != "") {
        $allow_extension = ['jpg', 'png', 'jpeg'];
        $x = explode('.', $buletin_picture);
        $extension = strtolower(end($x));
        $angka_acak = rand(1, 999);
        $file_tmp = $_FILES['buletin_picture']['tmp_name'];
        $file_name = "Buletin_" . $angka_acak . "." . $extension;

        if (
            in_array($extension, $allow_extension) === true
        ) {
            move_uploaded_file($file_tmp, "../assets/images/upload/buletin/" . $file_name);

            $update_buletin = mysqli_query($conn, "UPDATE tbl_buletin SET judul_buletin='$judul_buletin', date='$date', link='$link', admission='$admission', deskripsi='$deskripsi', buletin_picture='$file_name' WHERE id_buletin='$id_buletin'");

            if (!$update_buletin) {
                die("Query gagal dijalankan: " . mysqli_errno($conn) .
                    " - " . mysqli_error($conn));
            } else {
                echo "<script>alert('Berhasil Mengupdate Buletin');window.location='../admin/admin-buletin.php';</script>";
            }
        } else {
            echo "<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');";
        }
    } else {
        $update_buletin = mysqli_query($conn, "UPDATE tbl_buletin SET judul_buletin='$judul_buletin', date='$date', link='$link', admission='$admission', deskripsi='$deskripsi' WHERE id_buletin='$id_buletin'");
        if (!$update_buletin) {
            die("Query gagal dijalankan: " . mysqli_errno($conn) .
                " - " . mysqli_error($conn));
        } else {
            echo "<script>alert('Berhasil Mengupdate Buletin');";
        }
    }

    header("Location: ../admin/admin-buletin.php");
}

// DELETE BULETIN
if ($_POST['delete_buletin']) {
    $id_buletin = $_POST['id_buletin'];

    $delete_buletin = mysqli_query($conn, "DELETE FROM tbl_buletin WHERE id_buletin='$id_buletin'");
    if (!$delete_buletin) {
        die("Query gagal dijalankan: " . mysqli_errno($conn) .
            " - " . mysqli_error($conn));
    } else {
        echo "<script>alert('Berhasil Menghapus Buletin');";
    }

    header("Location: ../admin/admin-buletin.php");
}



// -------------------------VIDEO-------------------------//

// CREATE VIDEO
if (isset($_POST["create_video"])) {
    $judul_video = $_POST["judul_video"];
    $date = $_POST["date"];
    $link = $_POST["link"];
    $admission = $_POST["admission"];
    $deskripsi = $_POST["deskripsi"];
    $video_picture = $_FILES["video_picture"]['name'];

    if ($video_picture != "") {
        $allow_extension = ['jpg', 'png', 'jpeg'];
        $x = explode('.', $video_picture);
        $extension = strtolower(end($x));
        $angka_acak = rand(1, 999);
        $file_tmp = $_FILES['video_picture']['tmp_name'];
        $file_name = "Video_" . $angka_acak . "." . $extension;

        if (
            in_array($extension, $allow_extension) === true
        ) {
            move_uploaded_file($file_tmp, "../assets/images/upload/video/" . $file_name);

            $create_video = mysqli_query($conn, "INSERT INTO tbl_video (judul_video, date, link, admission, deskripsi, video_picture) VALUES ('$judul_video','$date','$link','$admission','$deskripsi', '$file_name')");

            if (!$create_video) {
                die("Query gagal dijalankan: " . mysqli_errno($conn) .
                    " - " . mysqli_error($conn));
            } else {
                echo "<script>alert('Berhasil Menambahkan Video');window.location='../admin/admin-video.php';</script>";
            }
        } else {
            echo "<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');";
        }
    } else {
        $create_video = mysqli_query($conn, "INSERT INTO tbl_video (judul_video, date, link, admission, deskripsi, video_picture) VALUES ('$judul_video','$date','$link','$admission','$deskripsi', null)");
        if (!$create_video) {
            die("Query gagal dijalankan: " . mysqli_errno($conn) .
                " - " . mysqli_error($conn));
        } else {
            echo "<script>alert('Berhasil Menambahkan Video');";
        }
    }
    header("Location: ../admin/admin-video.php");
}

// UPDATE VIDEO
if (isset($_POST["update_video"])) {
    $id_video = $_POST['id_video'];
    $judul_video = $_POST["judul_video"];
    $date = $_POST["date"];
    $link = $_POST["link"];
    $admission = $_POST["admission"];
    $deskripsi = $_POST["deskripsi"];
    $video_picture = $_FILES["video_picture"]['name'];

    if ($video_picture != "") {
        $allow_extension = ['jpg', 'png', 'jpeg'];
        $x = explode('.', $video_picture);
        $extension = strtolower(end($x));
        $angka_acak = rand(1, 999);
        $file_tmp = $_FILES['video_picture']['tmp_name'];
        $file_name = "Video_" . $angka_acak . "." . $extension;

        if (
            in_array($extension, $allow_extension) === true
        ) {
            move_uploaded_file($file_tmp, "../assets/images/upload/video/" . $file_name);

            $update_video = mysqli_query($conn, "UPDATE tbl_video SET judul_video='$judul_video', date='$date', link='$link', admission='$admission', deskripsi='$deskripsi', video_picture='$file_name' WHERE id_video='$id_video'");

            if (!$update_video) {
                die("Query gagal dijalankan: " . mysqli_errno($conn) .
                    " - " . mysqli_error($conn));
            } else {
                echo "<script>alert('Berhasil Mengupdate Video');window.location='../admin/admin-video.php';</script>";
            }
        } else {
            echo "<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');";
        }
    } else {
        $update_video = mysqli_query($conn, "UPDATE tbl_video SET judul_video='$judul_video', date='$date', link='$link', admission='$admission', deskripsi='$deskripsi' WHERE id_video='$id_video'");
        if (!$update_video) {
            die("Query gagal dijalankan: " . mysqli_errno($conn) .
                " - " . mysqli_error($conn));
        } else {
            echo "<script>alert('Berhasil Mengupdate Video');";
        }
    }

    header("Location: ../admin/admin-video.php");
}

// DELETE VIDEO
if ($_POST['delete_video']) {
    $id_video = $_POST['id_video'];

    $delete_video = mysqli_query($conn, "DELETE FROM tbl_video WHERE id_video='$id_video'");
    if (!$delete_video) {
        die("Query gagal dijalankan: " . mysqli_errno($conn) .
            " - " . mysqli_error($conn));
    } else {
        echo "<script>alert('Berhasil Menghapus Video');";
    }

    header("Location: ../admin/admin-video.php");
}



// -------------------------PROMOSI-------------------------//

// CREATE PROMOSI
if (isset($_POST["create_promosi"])) {
    $judul_promosi = $_POST["judul_promosi"];
    $date = $_POST["date"];
    $location = $_POST["location"];
    $admission = $_POST["admission"];
    $deskripsi = $_POST["deskripsi"];
    $promosi_picture = $_FILES["promosi_picture"]['name'];

    if ($promosi_picture != "") {
        $allow_extension = ['jpg', 'png', 'jpeg'];
        $x = explode('.', $promosi_picture);
        $extension = strtolower(end($x));
        $angka_acak = rand(1, 999);
        $file_tmp = $_FILES['promosi_picture']['tmp_name'];
        $file_name = "Promosi_" . $angka_acak . "." . $extension;

        if (
            in_array($extension, $allow_extension) === true
        ) {
            move_uploaded_file($file_tmp, "../assets/images/upload/promosi/" . $file_name);

            $create_promosi = mysqli_query($conn, "INSERT INTO tbl_promosi (judul_promosi, date, location, admission, deskripsi, promosi_picture) VALUES ('$judul_promosi','$date','$location','$admission','$deskripsi', '$file_name')");

            if (!$create_promosi) {
                die("Query gagal dijalankan: " . mysqli_errno($conn) .
                    " - " . mysqli_error($conn));
            } else {
                echo "<script>alert('Berhasil Menambahkan Promosi');window.location='../admin/admin-promosi.php';</script>";
            }
        } else {
            echo "<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');";
        }
    } else {
        $create_promosi = mysqli_query($conn, "INSERT INTO tbl_promosi (judul_promosi, date, location, admission, deskripsi, promosi_picture) VALUES ('$judul_promosi','$date','$location','$admission','$deskripsi', null)");
        if (!$create_promosi) {
            die("Query gagal dijalankan: " . mysqli_errno($conn) .
                " - " . mysqli_error($conn));
        } else {
            echo "<script>alert('Berhasil Menambahkan Promosi');";
        }
    }
    header("Location: ../admin/admin-promosi.php");
}

// UPDATE PROMOSI
if (isset($_POST["update_promosi"])) {
    $id_promosi = $_POST['id_promosi'];
    $judul_promosi = $_POST["judul_promosi"];
    $date = $_POST["date"];
    $location = $_POST["location"];
    $admission = $_POST["admission"];
    $deskripsi = $_POST["deskripsi"];
    $promosi_picture = $_FILES["promosi_picture"]['name'];

    if ($promosi_picture != "") {
        $allow_extension = ['jpg', 'png', 'jpeg'];
        $x = explode('.', $promosi_picture);
        $extension = strtolower(end($x));
        $angka_acak = rand(1, 999);
        $file_tmp = $_FILES['promosi_picture']['tmp_name'];
        $file_name = "Promosi_" . $angka_acak . "." . $extension;

        if (
            in_array($extension, $allow_extension) === true
        ) {
            move_uploaded_file($file_tmp, "../assets/images/upload/promosi/" . $file_name);

            $update_promosi = mysqli_query($conn, "UPDATE tbl_promosi SET judul_promosi='$judul_promosi', date='$date', location='$location', admission='$admission', deskripsi='$deskripsi', promosi_picture='$file_name' WHERE id_promosi='$id_promosi'");

            if (!$update_promosi) {
                die("Query gagal dijalankan: " . mysqli_errno($conn) .
                    " - " . mysqli_error($conn));
            } else {
                echo "<script>alert('Berhasil Mengupdate Promosi');window.location='../admin/admin-promosi.php';</script>";
            }
        } else {
            echo "<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');";
        }
    } else {
        $update_promosi = mysqli_query($conn, "UPDATE tbl_promosi SET judul_promosi='$judul_promosi', date='$date', location='$location', admission='$admission', deskripsi='$deskripsi' WHERE id_promosi='$id_promosi'");
        if (!$update_promosi) {
            die("Query gagal dijalankan: " . mysqli_errno($conn) .
                " - " . mysqli_error($conn));
        } else {
            echo "<script>alert('Berhasil Mengupdate Promosi');";
        }
    }

    header("Location: ../admin/admin-promosi.php");
}

// DELETE PROMOSI
if ($_POST['delete_promosi']) {
    $id_promosi = $_POST['id_promosi'];

    $delete_promosi = mysqli_query($conn, "DELETE FROM tbl_promosi WHERE id_promosi='$id_promosi'");
    if (!$delete_promosi) {
        die("Query gagal dijalankan: " . mysqli_errno($conn) .
            " - " . mysqli_error($conn));
    } else {
        echo "<script>alert('Berhasil Menghapus Promosi');";
    }

    header("Location: ../admin/admin-promosi.php");
}



// -------------------------JUMBOTRON-------------------------//

// CREATE JUMBOTRON
if (isset($_POST["create_jumbotron"])) {
    $judul_jumbotron = $_POST["judul_jumbotron"];
    $date = $_POST["date"];
    $location = $_POST["location"];
    $admission = $_POST["admission"];
    $deskripsi_short = $_POST["deskripsi_short"];
    $deskripsi = $_POST["deskripsi"];
    $jumbotron_picture = $_FILES["jumbotron_picture"]['name'];

    if ($jumbotron_picture != "") {
        $allow_extension = ['jpg', 'png', 'jpeg'];
        $x = explode('.', $jumbotron_picture);
        $extension = strtolower(end($x));
        $angka_acak = rand(1, 999);
        $file_tmp = $_FILES['jumbotron_picture']['tmp_name'];
        $file_name = "Jumbotron_" . $angka_acak . "." . $extension;

        if (
            in_array($extension, $allow_extension) === true
        ) {
            move_uploaded_file($file_tmp, "../assets/images/upload/jumbotron/" . $file_name);

            $create_jumbotron = mysqli_query($conn, "INSERT INTO tbl_jumbotron (judul_jumbotron, date, location, admission, deskripsi_short, deskripsi, jumbotron_picture) VALUES ('$judul_jumbotron','$date','$location','$admission','$deskripsi_short','$deskripsi', '$file_name')");

            if (!$create_jumbotron) {
                die("Query gagal dijalankan: " . mysqli_errno($conn) .
                    " - " . mysqli_error($conn));
            } else {
                echo "<script>alert('Berhasil Menambahkan Jumbotron');window.location='../admin/admin-jumbotron.php';</script>";
            }
        } else {
            echo "<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');";
        }
    } else {
        $create_jumbotron = mysqli_query($conn, "INSERT INTO tbl_jumbotron (judul_jumbotron, date, location, admission, deskripsi_short, deskripsi, jumbotron_picture) VALUES ('$judul_jumbotron','$date','$location','$admission','$deskripsi_short','$deskripsi', null)");
        if (!$create_jumbotron) {
            die("Query gagal dijalankan: " . mysqli_errno($conn) .
                " - " . mysqli_error($conn));
        } else {
            echo "<script>alert('Berhasil Menambahkan Jumbotron');";
        }
    }
    header("Location: ../admin/admin-jumbotron.php");
}

// UPDATE JUMBOTRON
if (isset($_POST["update_jumbotron"])) {
    $id_jumbotron = $_POST['id_jumbotron'];
    $judul_jumbotron = $_POST["judul_jumbotron"];
    $date = $_POST["date"];
    $location = $_POST["location"];
    $admission = $_POST["admission"];
    $deskripsi_short = $_POST["deskripsi_short"];
    $deskripsi = $_POST["deskripsi"];
    $jumbotron_picture = $_FILES["jumbotron_picture"]['name'];

    if ($jumbotron_picture != "") {
        $allow_extension = ['jpg', 'png', 'jpeg'];
        $x = explode('.', $jumbotron_picture);
        $extension = strtolower(end($x));
        $angka_acak = rand(1, 999);
        $file_tmp = $_FILES['jumbotron_picture']['tmp_name'];
        $file_name = "Jumbotron_" . $angka_acak . "." . $extension;

        if (
            in_array($extension, $allow_extension) === true
        ) {
            move_uploaded_file($file_tmp, "../assets/images/upload/jumbotron/" . $file_name);

            $update_jumbotron = mysqli_query($conn, "UPDATE tbl_jumbotron SET judul_jumbotron='$judul_jumbotron', date='$date', location='$location', admission='$admission', deskripsi_short='$deskripsi_short', deskripsi='$deskripsi', jumbotron_picture='$file_name' WHERE id_jumbotron='$id_jumbotron'");

            if (!$update_jumbotron) {
                die("Query gagal dijalankan: " . mysqli_errno($conn) .
                    " - " . mysqli_error($conn));
            } else {
                echo "<script>alert('Berhasil Mengupdate Jumbotron');window.location='../admin/admin-jumbotron.php';</script>";
            }
        } else {
            echo "<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');";
        }
    } else {
        $update_jumbotron = mysqli_query($conn, "UPDATE tbl_jumbotron SET judul_jumbotron='$judul_jumbotron', date='$date', location='$location', admission='$admission', deskripsi_short='$deskripsi_short', deskripsi='$deskripsi' WHERE id_jumbotron='$id_jumbotron'");
        if (!$update_jumbotron) {
            die("Query gagal dijalankan: " . mysqli_errno($conn) .
                " - " . mysqli_error($conn));
        } else {
            echo "<script>alert('Berhasil Mengupdate Jumbotron');";
        }
    }

    header("Location: ../admin/admin-jumbotron.php");
}

// DELETE JUMBOTRON
if ($_POST['delete_jumbotron']) {
    $id_jumbotron = $_POST['id_jumbotron'];

    $delete_jumbotron = mysqli_query($conn, "DELETE FROM tbl_jumbotron WHERE id_jumbotron='$id_jumbotron'");
    if (!$delete_jumbotron) {
        die("Query gagal dijalankan: " . mysqli_errno($conn) .
            " - " . mysqli_error($conn));
    } else {
        echo "<script>alert('Berhasil Menghapus Jumbotron');";
    }

    header("Location: ../admin/admin-jumbotron.php");
}



// -------------------------FASILITAS & PELAYANAN-------------------------//

// CREATE FASILITAS & PELAYANAN
if (isset($_POST["create_fp"])) {
    $nama_fp = $_POST["nama_fp"];
    $admission = $_POST["admission"];
    $deskripsi_short = $_POST["deskripsi_short"];
    $fp_picture = $_FILES["fp_picture"]['name'];

    if ($fp_picture != "") {
        $allow_extension = ['jpg', 'png', 'jpeg'];
        $x = explode('.', $fp_picture);
        $extension = strtolower(end($x));
        $angka_acak = rand(1, 999);
        $file_tmp = $_FILES['fp_picture']['tmp_name'];
        $file_name = "Jumbotron_" . $angka_acak . "." . $extension;

        if (
            in_array($extension, $allow_extension) === true
        ) {
            move_uploaded_file($file_tmp, "../assets/images/upload/fp/" . $file_name);

            $create_fp = mysqli_query($conn, "INSERT INTO tbl_fp (nama_fp, admission, deskripsi_short, fp_picture) VALUES ('$nama_fp','$admission','$deskripsi_short','$file_name')");

            if (!$create_fp) {
                die("Query gagal dijalankan: " . mysqli_errno($conn) .
                    " - " . mysqli_error($conn));
            } else {
                echo "<script>alert('Berhasil Menambahkan Fasilitas & Pelayaan');window.location='../admin/admin-fp.php';</script>";
            }
        } else {
            echo "<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');";
        }
    } else {
        $create_fp = mysqli_query($conn, "INSERT INTO tbl_fp (nama_fp, admission, deskripsi_short, fp_picture) VALUES ('$nama_fp','$admission','$deskripsi_short',null)");

        if (!$create_fp) {
            die("Query gagal dijalankan: " . mysqli_errno($conn) .
                " - " . mysqli_error($conn));
        } else {
            echo "<script>alert('Berhasil Menambahkan Fasilitas & Pelayaan');";
        }
    }
    header("Location: ../admin/admin-fp.php");
}

// UPDATE FASILITAS & PELAYANAN
if (isset($_POST["update_fp"])) {
    $id_fp = $_POST['id_fp'];
    $nama_fp = $_POST["nama_fp"];
    $admission = $_POST["admission"];
    $deskripsi_short = $_POST["deskripsi_short"];
    $fp_picture = $_FILES["fp_picture"]['name'];

    if ($fp_picture != "") {
        $allow_extension = ['jpg', 'png', 'jpeg'];
        $x = explode('.', $fp_picture);
        $extension = strtolower(end($x));
        $angka_acak = rand(1, 999);
        $file_tmp = $_FILES['fp_picture']['tmp_name'];
        $file_name = "Jumbotron_" . $angka_acak . "." . $extension;

        if (
            in_array($extension, $allow_extension) === true
        ) {
            move_uploaded_file($file_tmp, "../assets/images/upload/fp/" . $file_name);

            $update_fp = mysqli_query($conn, "UPDATE tbl_fp SET nama_fp='$nama_fp', admission='$admission', deskripsi_short='$deskripsi_short', fp_picture='$file_name' WHERE id_fp='$id_fp'");

            if (!$update_fp) {
                die("Query gagal dijalankan: " . mysqli_errno($conn) .
                    " - " . mysqli_error($conn));
            } else {
                echo "<script>alert('Berhasil Mengupdate Fasilitas & Pelayanan');window.location='../admin/admin-fp.php';</script>";
            }
        } else {
            echo "<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');";
        }
    } else {
        $update_fp = mysqli_query($conn, "UPDATE tbl_fp SET nama_fp='$nama_fp', admission='$admission', deskripsi_short='$deskripsi_short' WHERE id_fp='$id_fp'");

        if (!$update_fp) {
            die("Query gagal dijalankan: " . mysqli_errno($conn) .
                " - " . mysqli_error($conn));
        } else {
            echo "<script>alert('Berhasil Mengupdate Fasilitas & Pelayanan');";
        }
    }

    header("Location: ../admin/admin-fp.php");
}

// DELETE FASILITAS & PELAYANAN
if ($_POST['delete_fp']) {
    $id_fp = $_POST['id_fp'];

    $delete_fp = mysqli_query($conn, "DELETE FROM tbl_fp WHERE id_fp='$id_fp'");
    if (!$delete_fp) {
        die("Query gagal dijalankan: " . mysqli_errno($conn) .
            " - " . mysqli_error($conn));
    } else {
        echo "<script>alert('Berhasil Menghapus Faslitas & Pelayanan');";
    }

    header("Location: ../admin/admin-fp.php");
}



// -------------------------ASURANSI KESEHATAN-------------------------//

// CREATE ASURANSI KESEHATAN
if (isset($_POST["create_asuransi"])) {
    $nama_asuransi = $_POST["nama_asuransi"];
    $admission = $_POST["admission"];
    $link = $_POST["link"];
    $asuransi_picture = $_FILES["asuransi_picture"]['name'];

    if ($asuransi_picture != "") {
        $allow_extension = ['jpg', 'png', 'jpeg'];
        $x = explode('.', $asuransi_picture);
        $extension = strtolower(end($x));
        $angka_acak = rand(1, 999);
        $file_tmp = $_FILES['asuransi_picture']['tmp_name'];
        $file_name = "Asuransi_" . $angka_acak . "." . $extension;

        if (
            in_array($extension, $allow_extension) === true
        ) {
            move_uploaded_file($file_tmp, "../assets/images/upload/asuransi/" . $file_name);

            $create_asuransi = mysqli_query($conn, "INSERT INTO tbl_asuransi (nama_asuransi, admission, link, asuransi_picture) VALUES ('$nama_asuransi','$admission','$link','$file_name')");

            if (!$create_asuransi) {
                die("Query gagal dijalankan: " . mysqli_errno($conn) .
                    " - " . mysqli_error($conn));
            } else {
                echo "<script>alert('Berhasil Menambahkan Asuransi Kesehatan');window.location='../admin/admin-asuransi.php';</script>";
            }
        } else {
            echo "<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');";
        }
    } else {
        $create_asuransi = mysqli_query($conn, "INSERT INTO tbl_asuransi (nama_asuransi, admission, link, asuransi_picture) VALUES ('$nama_asuransi','$admission','$link',null)");

        if (!$create_asuransi) {
            die("Query gagal dijalankan: " . mysqli_errno($conn) .
                " - " . mysqli_error($conn));
        } else {
            echo "<script>alert('Berhasil Menambahkan Asuransi Kesehatan');";
        }
    }
    header("Location: ../admin/admin-asuransi.php");
}

// UPDATE ASURANSI KESEHATAN
if (isset($_POST["update_asuransi"])) {
    $id_asuransi = $_POST['id_asuransi'];
    $nama_asuransi = $_POST["nama_asuransi"];
    $admission = $_POST["admission"];
    $link = $_POST["link"];
    $asuransi_picture = $_FILES["asuransi_picture"]['name'];

    if ($asuransi_picture != "") {
        $allow_extension = ['jpg', 'png', 'jpeg'];
        $x = explode('.', $asuransi_picture);
        $extension = strtolower(end($x));
        $angka_acak = rand(1, 999);
        $file_tmp = $_FILES['asuransi_picture']['tmp_name'];
        $file_name = "Asuransi_" . $angka_acak . "." . $extension;

        if (
            in_array($extension, $allow_extension) === true
        ) {
            move_uploaded_file($file_tmp, "../assets/images/upload/asuransi/" . $file_name);

            $update_asuransi = mysqli_query($conn, "UPDATE tbl_asuransi SET nama_asuransi='$nama_asuransi', admission='$admission', link='$link', asuransi_picture='$file_name' WHERE id_asuransi='$id_asuransi'");

            if (!$update_asuransi) {
                die("Query gagal dijalankan: " . mysqli_errno($conn) .
                    " - " . mysqli_error($conn));
            } else {
                echo "<script>alert('Berhasil Mengupdate Asuransi Kesehatan');window.location='../admin/admin-asuransi.php';</script>";
            }
        } else {
            echo "<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');";
        }
    } else {
        $update_asuransi = mysqli_query($conn, "UPDATE tbl_asuransi SET nama_asuransi='$nama_asuransi', admission='$admission', link='$link' WHERE id_asuransi='$id_asuransi'");

        if (!$update_asuransi) {
            die("Query gagal dijalankan: " . mysqli_errno($conn) .
                " - " . mysqli_error($conn));
        } else {
            echo "<script>alert('Berhasil Mengupdate Asuransi Kesehatan');";
        }
    }

    header("Location: ../admin/admin-asuransi.php");
}

// DELETE ASURANSI KESEHATAN
if ($_POST['delete_asuransi']) {
    $id_asuransi = $_POST['id_asuransi'];

    $delete_asuransi = mysqli_query($conn, "DELETE FROM tbl_asuransi WHERE id_asuransi='$id_asuransi'");
    if (!$delete_asuransi) {
        die("Query gagal dijalankan: " . mysqli_errno($conn) .
            " - " . mysqli_error($conn));
    } else {
        echo "<script>alert('Berhasil Menghapus Faslitas & Pelayanan');";
    }

    header("Location: ../admin/admin-asuransi.php");
}

// ---------------------------------------------------------------------------------------//
// ---------------------------------------END ADMIN---------------------------------------//
