<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'MCP System') ?></title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="/assets/css/custom.css?v=<?= time() ?>">
</head>

<body class="bg-light">

<nav class="navbar navbar-light bg-white border-bottom d-lg-none fixed-top px-3">
    <button class="btn btn-outline-primary" id="toggleSidebar">
        ☰
    </button>
    <span class="fw-bold ms-2">MCP System</span>
</nav>

<!-- Layout Wrapper -->
<div class="d-flex">

    <!-- SIDEBAR -->
    <nav id="sidebar" class="sidebar bg-white border-end shadow-sm">
        <div class="p-3">
            <h4 class="fw-bold text-primary d-none d-lg-block">MCP</h4>
            <hr class="d-none d-lg-block">

            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link <?= ($active ?? '') == 'dashboard' ? 'active-link' : '' ?>" href="/">
                        🏠 Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($active ?? '') == 'inform' ? 'active-link' : '' ?>" href="/inform">
                        📊 Informasi
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($active ?? '') == 'alur' ? 'active-link' : '' ?>" href="/alur">
                        🔄 Alur Biogas
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($active ?? '') == 'perawatan' ? 'active-link' : '' ?>" href="/perawatan">
                        🛠 Perawatan
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($active ?? '') == 'inventory' ? 'active-link' : '' ?>" href="/inventory">
                        📦 Inventory
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($active ?? '') == 'laporan' ? 'active-link' : '' ?>" href="/laporan">
                        📑 Laporan
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($active ?? '') == 'about' ? 'active-link' : '' ?>" href="/about">
                        ℹ️ Tentang
                    </a>
                </li>
                <div class="sidebar-login mt-auto p-3">
                <a href="<?= base_url('login'); ?>" class="btn btn-primary w-100">Login</a>
                </a>
                </div>
            </ul>
        </div>
    </nav>

    <!-- MAIN CONTENT (benar) -->
    <main class="main-content flex-grow-1">
        <div class="container-fluid p-4">
            <?= $this->renderSection('content') ?>
        </div>
    </main>

</div>


<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
// Toggle Sidebar (Mobile)
document.getElementById("toggleSidebar").addEventListener("click", function() {
    document.getElementById("sidebar").classList.toggle("active");
});
</script>

</body>
</html>
