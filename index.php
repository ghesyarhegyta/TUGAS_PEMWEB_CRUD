<?php
require_once __DIR__ . '/functions.php';
$pdo = getPDO();

$perPage = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;

$search = trim((string)($_GET['kw'] ?? ''));
$hasSearch = ($search !== '');

$where = "";
if ($hasSearch) {
    $where = "WHERE (LOWER(name) LIKE ? OR LOWER(email) LIKE ?)";
    $like = "%" . strtolower($search) . "%";
}

try {
    $countSql = "SELECT COUNT(*) FROM contacts $where";
    $countStmt = $pdo->prepare($countSql);

    if ($hasSearch) {
        $countStmt->execute([$like, $like]);
    } else {
        $countStmt->execute();
    }

    $total = (int)$countStmt->fetchColumn();
} catch (PDOException $e) {
    error_log("Count error: " . $e->getMessage());
    $total = 0;
}

$totalPages = max(1, ceil($total / $perPage));
if ($page > $totalPages) $page = $totalPages;
$offset = ($page - 1) * $perPage;

try {
    $sql = "SELECT id, name, email, phone, created_at
            FROM contacts
            $where
            ORDER BY created_at DESC
            LIMIT ? OFFSET ?";

    $dataStmt = $pdo->prepare($sql);

    if ($hasSearch) {
        $dataStmt->execute([$like, $like, (int)$perPage, (int)$offset]);
    } else {
        $dataStmt->execute([(int)$perPage, (int)$offset]);
    }

    $rows = $dataStmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("Fetch list error: " . $e->getMessage());
    $rows = [];
}

require __DIR__ . '/header.php';
?>

<style>
    .card {
        background: rgba(255, 255, 255, 0.15);
        border: 1px solid rgba(255, 255, 255, 0.25);
        padding: 16px;
        border-radius: 10px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        backdrop-filter: blur(6px);
        margin-top: 20px;
    }

    .icon-btn {
        text-decoration: none !important;
        border: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        padding: 6px;
        cursor: pointer;
    }

    .icon-btn:hover {
        opacity: 0.7;
    }
</style>

<div class="container">
    <div style="display:flex; justify-content:space-between; align-items:center;">
        <h2 style="margin:0;">Daftar Kontak</h2>
        <a href="create.php" class="button" style="background:#059669;">+ Tambah Kontak</a>
    </div>

    <form method="get" action="index.php" style="margin-top:16px; display:flex; gap:10px;">
        <input type="text" name="kw" placeholder="Cari nama atau email..." value="<?= e($search) ?>" class="input"
            style="flex:1;" />
        <button class="button" type="submit" style="padding:8px 18px;">Cari</button>
        <?php if ($search !== ''): ?>
            <a href="index.php" class="button" style="background:#6b7280;">Reset</a>
        <?php endif; ?>
    </form>

    <div class="card">
        <table class="table" style="margin-top:10px;">
            <thead style="background:#f1f5f9;">
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Telepon</th>
                    <th>Dibuat</th>
                    <th style="text-align:center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!$rows): ?>
                    <tr>
                        <td colspan="6" style="text-align:center; color:#666;">Tidak ada data.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($rows as $r): ?>
                        <tr>
                            <td><?= e($r['name']) ?></td>
                            <td><?= e($r['email']) ?></td>
                            <td><?= e((string)$r['phone']) ?></td>
                            <td><?= e($r['created_at']) ?></td>
                            <td style="text-align:center;">
                                <a href="view.php?id=<?= e((string)$r['id']) ?>" class="icon-btn" title="Detail">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                <a href="delete.php?id=<?= e((string)$r['id']) ?>" class="icon-btn" title="Hapus"
                                    onclick="return confirm('Hapus item ini?');" style="margin-left:8px; color:#d00;">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="pagination" style="margin-top:16px; text-align:center;">
        <?php if ($page > 1): ?>
            <a href="?<?= http_build_query(['kw' => $search, 'page' => $page - 1]) ?>" class="button"
                style="background:#ddd; color:#333;">&laquo; Prev</a>
        <?php endif; ?>

        <span style="margin:0 10px;">
            Halaman <?= $page ?> / <?= $totalPages ?> (<?= $total ?> data)
        </span>

        <?php if ($page < $totalPages): ?>
            <a href="?<?= http_build_query(['kw' => $search, 'page' => $page + 1]) ?>" class="button"
                style="background:#ddd; color:#333;">Next &raquo;</a>
        <?php endif; ?>
    </div>
</div>