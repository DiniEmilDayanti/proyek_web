<h3>DAFTAR ALUMNI</h3>
<hr>

<!-- Form Pencarian -->
<form method="GET" class="mb-3">
    <input type="hidden" name="menu" value="alumni">
    <div class="form-row">
        <div class="col-md-8">
            <input type="text" name="search" class="form-control" placeholder="Cari Alumni berdasarkan Nama, Tahun Lulus, atau Jurusan" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
        </div>
        <div class="col-md-4">
            <button type="submit" class="btn btn-primary">Cari</button>
        </div>
    </div>
</form>

<a href="?menu=calumni" class="btn btn-primary mb-3">Tambah</a>

<?php
include 'Latihan_09_config.php';

// Mengambil nilai pencarian dari URL
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Menyusun query untuk mencari alumni
$sql = "SELECT * FROM alumni WHERE nama LIKE '%$search%' OR tahun_lulus LIKE '%$search%' OR jurusan LIKE '%$search%'";
$result = $conn->query($sql);

if($result->num_rows > 0){
    echo "<table class='table table-bordered'>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Tahun Lulus</th>
                <th>Jurusan</th>
                <th>Foto</th>
                <th>Aksi</th>
            </tr>";
    
    while($row = $result->fetch_assoc()){
        echo "<tr>
                <td>".$row["id"]."</td>
                <td>".$row["nama"]."</td>
                <td>".$row["tahun_lulus"]."</td>
                <td>".$row["jurusan"]."</td>
                <td><img src='".$row["foto"]."' width='50'></td>
                <td>
                    <a class='btn btn-warning' href='Latihan_09_index.php?menu=ualumni&id=".$row["id"]."'>Edit</a> |
                    <a class='btn btn-danger' href='Latihan_09_dalumni.php?id=".$row["id"]."'>Hapus</a>
                </td>
              </tr>";
    }
    echo "</table>";
}else{
    echo "Tidak ada data";
}

$conn->close();
?>
