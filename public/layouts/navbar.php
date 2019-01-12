<div class="header">
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <a class="navbar-brand" href="/">
            <h2>Life System</h2>
        </a>
        <div id="navbarNav">
            <ul class="navbar-nav">
                <?php $activeItem = $activeItem ?? 'home'; ?>
                <li class="nav-item <?php if ( $activeItem === 'home' ) echo "active"; ?>">
                    <a class="nav-link" href="/">Home</a>
                </li>
                <li class="nav-item <?php if ( $activeItem === 'expenses' ) echo "active"; ?>">
                    <a class="nav-link" href="<?php echo url('expenses') ?>">Expenses</a>
                </li>
            </ul>
        </div>
    </nav>
</div>