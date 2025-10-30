<?php
require_once __DIR__ . '/functions.php';
$pdo = getPDO();

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) {
    set_flash('error', 'ID tidak valid.');
    redirect('index.php');
}

try {
    $stmt = $pdo->prepare("SELECT * FROM contacts WHERE id = :id");
    $stmt->execute([':id' => $id]);
    $row = $stmt->fetch();
    if (!$row) {
        set_flash('error', 'Data tidak ditemukan.');
        redirect('index.php');
    }
} catch (PDOException $e) {
    error_log("View error: " . $e->getMessage());
    set_flash('error', 'Terjadi kesalahan saat mengambil data.');
    redirect('index.php');
}

require __DIR__ . '/header.php';
?>

<h2>Detail Kontak</h2>

<div class="detail-card">

    <div class="detail-row">
        <span class="detail-label">Nama</span>
        <div class="detail-value"><?= e($row['name']) ?></div>
    </div>

    <div class="detail-row">
        <span class="detail-label">Email</span>
        <div class="detail-value"><?= e($row['email']) ?></div>
    </div>

    <div class="detail-row">
        <span class="detail-label">Telepon</span>
        <div class="detail-value"><?= e((string)$row['phone']) ?></div>
    </div>

    <div class="detail-row">
        <span class="detail-label">Catatan</span>
        <div class="detail-value"><?= nl2br(e((string)$row['notes'])) ?></div>
    </div>

    <div class="detail-row">
        <span class="detail-label">Dibuat</span>
        <div class="detail-value"><?= e($row['created_at']) ?></div>
    </div>

    <div class="detail-row">
        <span class="detail-label">Terakhir diperbarui</span>
        <div class="detail-value"><?= e($row['updated_at'] ?? '-') ?></div>
    </div>

    <div class="button-group">
        <a href="edit.php?id=<?= e((string)$row['id']) ?>" class="button">
            <i class="fa-solid fa-pen-to-square"></i> Edit
        </a>

        <a href="delete.php?id=<?= e((string)$row['id']) ?>" onclick="return confirm('Hapus item ini?');"
            class="button danger">
            <i class="fa-solid fa-trash"></i> Hapus
        </a>

        <a href="index.php" class="button" style="background:#6b7280;">
            <i class="fa-solid fa-arrow-left"></i> Kembali
        </a>
    </div>
</div>