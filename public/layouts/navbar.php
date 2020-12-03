<div class="header">
    <nav class="header__navbar navbar navbar-expand-sm">
        <a class="navbar-brand" href="<?php echo url('/') ?>">
            <h2><?php echo getConfig('APP_NAME', 'Life System') ?></h2>
        </a>

<!-- Toggler/collapsibe Button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
<!-- Navbar links -->
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <?php $activeItem = $activeItem ?? 'home'; ?>
                <li class="nav-item <?php if ( $activeItem === 'home' ) echo "active"; ?>">
                    <a class="nav-link" href="<?php echo url('/') ?>">Home</a>
                </li>
                <li class="nav-item <?php if ( $activeItem === 'expenses' ) echo "active"; ?>">
                    <a class="nav-link" href="<?php echo url('expenses') ?>">Expenses</a>
                </li>
            </ul>
        </div>
    </nav>
</div>
