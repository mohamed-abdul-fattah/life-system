<!DOCTYPE html>
<html lang="en">
<?php
    $title      = 'Expenses';
    include "layouts/header.php";

    $perPage    = 30;
    $currentPage= $_GET['page'] ?? 1;
    $offset     = ($currentPage - 1) * $perPage;

    $connection = mysqli_connect('localhost', 'root', 'toor', 'abdul_fattah');
    $query      =  "SELECT * FROM `transactions` 
                    LIMIT {$perPage} 
                    OFFSET {$offset}";
    $countQuery = "SELECT COUNT(*) as total FROM `transactions`";
    $expenses   = mysqli_query($connection, $query);
    $count      = mysqli_query($connection, $countQuery);
    $total      = mysqli_fetch_object($count)->total;

    $firstPage  = 1;
    $lastPage   = ceil($total / $perPage);
?>
<body>
<div id="app">
    <?php include "layouts/navbar.php" ?>
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2>Expenses</h2>
                </div>
                <div class="panel-body">
                    <div class="table">
                        <table class="table table-responsive table-striped table-hover">
                            <thead>
                            <tr>
                                <th>Amount</th>
                                <th>Comment</th>
                                <th>Date</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php while ($expense = mysqli_fetch_object($expenses)): ?>
                                <tr>
                                    <td><?php echo $expense->amount ?></td>
                                    <td><?php echo $expense->comment ?></td>
                                    <td><?php echo date('d-M-Y', strtotime($expense->created_at)) ?></td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>

                        <!-- Pagination -->
                        <?php if ($total): ?>
                            <nav aria-label="...">
                                <ul class="pagination">
                                    <li class="page-item <?php if ($currentPage == $firstPage) echo 'disabled'; ?>">
                                        <a class="page-link" href="/expenses.php?page=<?php echo $currentPage - 1 ?>">
                                            Previous
                                        </a>
                                    </li>
                                    <?php for ($page = 1; $page <= ceil($total / $perPage); $page++): ?>
                                        <li class="page-item <?php if ($page == $currentPage) echo 'active'; ?>">
                                            <?php if ($page == $currentPage): ?>
                                                <span class="page-link">
                                                    <?php echo $page ?>
                                                    <span class="sr-only">(current)</span>
                                                </span>
                                            <?php else: ?>
                                                <a class="page-link" href="/expenses.php?page=<?php echo $page ?>">
                                                    <?php echo $page ?>
                                                </a>
                                            <?php endif; ?>
                                        </li>
                                    <?php endfor ?>
                                    <li class="page-item <?php if ($currentPage == $lastPage) echo 'disabled'; ?>">
                                        <a class="page-link" href="/expenses.php?page=<?php echo $currentPage + 1 ?>">Next</a>
                                    </li>
                                </ul>
                            </nav>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include "layouts/footer.php" ?>
</body>
</html>
