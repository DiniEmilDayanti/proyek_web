<?php
include 'Tugas_db.php';

// Menangani permintaan Ajax
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'add') {
        // Mendapatkan data dari form
        $nim = $_POST['nim'];
        $name = $_POST['name'];
        $major = $_POST['major'];
        $year = $_POST['year'];

        try {
            // Menambahkan data alumni menggunakan prepared statement untuk mencegah SQL injection
            $stmt = $conn->prepare("INSERT INTO alumni (nim, name, major, year) VALUES (?, ?, ?, ?)");
            $stmt->execute([$nim, $name, $major, $year]);

            // Mengirimkan response sukses
            echo json_encode(['status' => 'success', 'message' => 'Data berhasil ditambahkan!']);
        } catch (PDOException $e) {
            // Tangani error jika terjadi kesalahan dalam query
            echo json_encode(['status' => 'error', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    } elseif ($action === 'delete') {
        // Menghapus data alumni
        $id = $_POST['id'];

        try {
            $stmt = $conn->prepare("DELETE FROM alumni WHERE id = ?");
            $stmt->execute([$id]);

            // Mengirimkan response sukses
            echo json_encode(['status' => 'success', 'message' => 'Data berhasil dihapus!']);
        } catch (PDOException $e) {
            echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus data: ' . $e->getMessage()]);
        }
    } elseif ($action === 'fetch') {
        // Mengambil data alumni
        $stmt = $conn->query("SELECT * FROM alumni ORDER BY id DESC");
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Mengirimkan data dalam bentuk JSON
        echo json_encode($data);
    }
    exit;
}
?>
