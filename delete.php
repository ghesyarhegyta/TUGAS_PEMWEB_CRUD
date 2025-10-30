<?php
require_once __DIR__ . '/functions.php';
$pdo = getPDO();

$id = isset($_REQUEST['id']) ? (int)$_REQUEST['id'] : 0;
if ($id <= 0) {
    set_flash('error', 'ID tidak valid.');
    redirect('index.php');
}

try {
    $stmt = $pdo->prepare("SELECT name FROM contacts WHERE id = :id");
    $stmt->execute([':id' => $id]);
    $row = $stmt->fetch();
    if (!$row) {
        set_flash('error', 'Data tidak ditemukan.');
        redirect('index.php');
    }
    $name = $row['name'];
} catch (PDOException $e) {
    error_log("Fetch delete data error: " . $e->getMessage());
    set_flash('error', 'Gagal mengambil data.');
    redirect('index.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!validate_csrf_token($_POST['csrf'] ?? null)) {
        set_flash('error', 'Token keamanan tidak valid.');
        redirect('index.php');
    }
    try {
        $stmt = $pdo->prepare("DELETE FROM contacts WHERE id = :id");
        $stmt->execute([':id' => $id]);
        set_flash('success', 'Data berhasil dihapus.');
        redirect('index.php');
    } catch (PDOException $e) {
        error_log("Delete error: " . $e->getMessage());
        set_flash('error', 'Gagal menghapus data.');
        redirect('index.php');
    }
}

require __DIR__ . '/header.php';
$csrf = generate_csrf_token();
?>

<h2>Hapus Kontak</h2>
<p>Apakah Anda yakin ingin menghapus data dengan nama <strong><?= e((string)$name) ?></strong>?</p>

<form method="post" action="delete.php?id=<?= e((string)$id) ?>">
    <input type="hidden" name="csrf" value="<?= e($csrf) ?>">
    <button type="submit" class="button danger">Ya, Hapus</button>
    <a href="index.php" class="button" style="background:#6b7280;">Batal</a>
</form>