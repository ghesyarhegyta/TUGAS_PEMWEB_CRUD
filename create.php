<?php
require_once __DIR__ . '/functions.php';
$pdo = getPDO();

$errors = [];
$name = '';
$email = '';
$phone = '';
$notes = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!validate_csrf_token($_POST['csrf'] ?? null)) {
        $errors[] = "Token keamanan tidak valid.";
    }

    $name = trim((string)($_POST['name'] ?? ''));
    $email = trim((string)($_POST['email'] ?? ''));
    $phone = trim((string)($_POST['phone'] ?? ''));
    $notes = trim((string)($_POST['notes'] ?? ''));

    if ($name === '') $errors[] = "Nama wajib diisi.";
    if ($email === '') $errors[] = "Email wajib diisi.";
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Format email tidak valid.";
    if (strlen($name) > 150) $errors[] = "Nama maksimal 150 karakter.";
    if (strlen($email) > 200) $errors[] = "Email maksimal 200 karakter.";
    if (strlen($phone) > 40) $errors[] = "Telepon maksimal 40 karakter.";

    if (empty($errors)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO contacts (name, email, phone, notes) VALUES (:name, :email, :phone, :notes)");
            $stmt->execute([
                ':name' => $name,
                ':email' => $email,
                ':phone' => $phone !== '' ? $phone : null,
                ':notes' => $notes !== '' ? $notes : null,
            ]);
            set_flash('success', 'Data berhasil ditambahkan.');
            redirect('index.php');
        } catch (PDOException $e) {
            error_log("Create error: " . $e->getMessage());
            $errors[] = "Gagal menyimpan data. Silakan coba lagi.";
        }
    }
}

require __DIR__ . '/header.php';
$csrf = generate_csrf_token();
?>

<h2>Tambah Kontak</h2>

<?php if (!empty($errors)): ?>
<div class="flash error">
    <ul>
        <?php foreach ($errors as $err): ?>
        <li><?= e($err) ?></li>
        <?php endforeach; ?>
    </ul>
</div>
<?php endif; ?>

<form method="post" action="create.php" novalidate>
    <input type="hidden" name="csrf" value="<?= e($csrf) ?>">
    <div class="form-group">
        <label>Nama *</label>
        <input type="text" name="name" class="input" value="<?= e($name) ?>" required>
    </div>
    <div class="form-group">
        <label>Email *</label>
        <input type="email" name="email" class="input" value="<?= e($email) ?>" required>
    </div>
    <div class="form-group">
        <label>Telepon</label>
        <input type="text" name="phone" class="input" value="<?= e($phone) ?>">
    </div>
    <div class="form-group">
        <label>Catatan</label>
        <textarea name="notes" rows="4" class="input"><?= e($notes) ?></textarea>
    </div>
    <button class="button" type="submit">Simpan</button>
    <a href="index.php" class="button" style="background:#6b7280;">Batal</a>
</form>