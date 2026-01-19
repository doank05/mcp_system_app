<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= $title ?? 'Dashboard MCP' ?></title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<style>
/* ===== LAYOUT ===== */
body {
    background: #f5f6fa;
    overflow-x: hidden;
}

/* ===== SIDEBAR ===== */
.sidebar {
    width: 260px;
    background: #1e1e2f;
    color: #fff;
    position: fixed;
    top: 0;
    left: 0;
    height: 100vh;
    padding: 20px;
    z-index: 1050;
    transition: transform .3s ease;
}

.sidebar a {
    display: block;
    padding: 10px 12px;
    color: #dcdcdc !important;
    text-decoration: none !important;
    border-radius: 6px;
    font-size: 15px;
}

.sidebar a:hover {
    background: #2f2f46;
    color: #fff !important;
}

.sidebar a.active {
    background: #4b7bec;
    color: #fff !important;
    font-weight: 600;
}

.submenu a {
    padding-left: 30px;
    font-size: 14px;
}

/* ===== CONTENT ===== */
.main-content {
    margin-left: 260px;
    padding: 25px;
    transition: margin .3s ease;
}

/* ===== OVERLAY ===== */
.overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,.5);
    z-index: 1040;
    display: none;
}

/* ===== MOBILE ===== */
@media (max-width: 768px) {
    .sidebar {
        transform: translateX(-100%);
    }
    .sidebar.show {
        transform: translateX(0);
    }
    .main-content {
        margin-left: 0;
    }
    .overlay.show {
        display: block;
    }
}
</style>
</head>

<body>

<!-- MOBILE NAVBAR -->
<nav class="navbar navbar-light bg-light d-md-none">
  <div class="container-fluid">
    <button class="btn btn-outline-secondary" onclick="toggleSidebar()">
      ☰
    </button>
    <span class="navbar-brand mb-0 fw-bold">MCP Dashboard</span>
  </div>
</nav>

<!-- OVERLAY -->
<div class="overlay" onclick="toggleSidebar()"></div>

<!-- SIDEBAR -->
<div class="sidebar">
<?php use Config\Menu; ?>

<h5 class="text-uppercase mb-3">MCP Menu</h5>
<hr class="border-secondary">

<?php foreach (Menu::get() as $menu): ?>
    <?php if (! canAccess($menu['level'])) continue; ?>

    <?php if (($menu['type'] ?? '') === 'group'): ?>
        <?php $open = isGroupOpen($menu['children']); ?>

        <a data-bs-toggle="collapse"
           href="#menu<?= md5($menu['label']) ?>"
           class="<?= $open ? '' : 'collapsed' ?>">
            <?= $menu['icon'] ?> <?= $menu['label'] ?> ▾
        </a>

        <div class="collapse submenu <?= $open ? 'show' : '' ?>"
             id="menu<?= md5($menu['label']) ?>">
            <?php foreach ($menu['children'] as $child): ?>
                <?php if (canAccess($child['level'])): ?>
                    <a href="<?= base_url($child['url']) ?>"
                       class="<?= isActive($child['url']) ?>">
                        <?= $child['label'] ?>
                    </a>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>

    <?php else: ?>
        <a href="<?= base_url($menu['url']) ?>"
           class="<?= isActive($menu['url']) ?>">
            <?= $menu['icon'] ?> <?= $menu['label'] ?>
        </a>
    <?php endif; ?>
<?php endforeach; ?>

<hr class="border-secondary mt-4">
<a href="/logout" class="text-danger">🚪 Logout</a>

</div>

<!-- CONTENT -->
<div class="main-content">
  <?= $this->renderSection('content') ?>
</div>

<script>
function toggleSidebar() {
  document.querySelector('.sidebar').classList.toggle('show');
  document.querySelector('.overlay').classList.toggle('show');
}
</script>

</body>
</html>
