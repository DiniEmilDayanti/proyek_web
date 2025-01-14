<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tracer Alumni</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<div class="container my-5">
    <h1 class="text-center">Tracer Alumni</h1>

    <!-- Form Tambah Alumni -->
    <div class="card mb-4">
        <div class="card-body">
            <h4>Tambah Data Alumni</h4>
            <form id="alumniForm">
                <div class="form-group">
                    <label for="nim">NIM</label>
                    <input type="text" class="form-control" id="nim" name="nim" required>
                </div>
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="major">Jurusan</label>
                    <input type="text" class="form-control" id="major" name="major" required>
                </div>
                <div class="form-group">
                    <label for="year">Angkatan</label>
                    <input type="number" class="form-control" id="year" name="year" required>
                </div>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </form>
        </div>
    </div>

    <!-- Tabel Alumni -->
    <div class="card">
        <div class="card-body">
            <h4>Daftar Alumni</h4>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Jurusan</th>
                        <th>Angkatan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="alumniList">
                    <!-- Data alumni akan dimuat lewat Ajax -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Script untuk Ajax -->
<script>
$(document).ready(function () {
    // Fungsi untuk memuat data alumni
    function loadAlumni() {
        $.post('functions.php', { action: 'fetch' }, function (data) {
            const alumni = JSON.parse(data);
            let html = '';
            alumni.forEach((alumnus) => {
                html += `
                    <tr>
                        <td>${alumnus.nim}</td>
                        <td>${alumnus.name}</td>
                        <td>${alumnus.major}</td>
                        <td>${alumnus.year}</td>
                        <td>
                            <button class="btn btn-danger btn-sm deleteBtn" data-id="${alumnus.id}">Hapus</button>
                        </td>
                    </tr>`;
            });
            $('#alumniList').html(html);
        });
    }

    // Fungsi untuk menambah alumni
    $('#alumniForm').on('submit', function (e) {
        e.preventDefault();
        const formData = $(this).serialize() + '&action=add';  // Menambahkan action=add ke form data
        $.post('functions.php', formData, function (response) {
            const res = JSON.parse(response);
            alert(res.message);
            $('#alumniForm')[0].reset();  // Reset form setelah berhasil
            loadAlumni();  // Muat ulang data alumni
        });
    });

    // Fungsi untuk menghapus data alumni
    $(document).on('click', '.deleteBtn', function () {
        const id = $(this).data('id');
        $.post('functions.php', { action: 'delete', id: id }, function (response) {
            const res = JSON.parse(response);
            alert(res.message);
            loadAlumni();  // Muat ulang data alumni setelah penghapusan
        });
    });

    // Memuat data alumni saat halaman pertama kali diakses
    loadAlumni();
});
</script>

</body>
</html>
