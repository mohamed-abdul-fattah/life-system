<!DOCTYPE html>
<html lang="en">
<?php
    include __DIR__. "/../../helpers.php";
    $title = 'Add Expense';
    include public_path("layouts/header.php");
?>
<body>
<div id="app">
    <?php include public_path("layouts/navbar.php") ?>
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2 class="title">Expenses</h2>
                    <a href="/expenses/create.php" class="btn btn-primary btn-sm float-right">Add Expense</a>
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
<?php include public_path("layouts/footer.php") ?>
</body>
</html>
