<?php
require __DIR__ . '/../../vendor/autoload.php';
require_auth();

$perPage = 15;
$currentPage = $_GET['page'] ?? 1;
$offset = ($currentPage - 1) * $perPage;

$connection = open_connection();
$query = "SELECT `transactions`.*, `c`.`name` as category FROM `transactions`
            LEFT JOIN categories c on transactions.category_id = c.id
            ORDER By `transactions`.`created_at` DESC
            LIMIT {$perPage} 
            OFFSET {$offset}";
$countQuery = "SELECT COUNT(*) as total FROM `transactions`";
$expenses = mysqli_query($connection, $query);
$count = mysqli_query($connection, $countQuery);
$total = mysqli_fetch_object($count)->total;
?>

<!DOCTYPE html>
<html lang="en">
<?php
$title = 'Expenses';
include public_path('layouts/header.php');
?>
<body>
    <div class="expenses">
        <section>
            <?php
            $activeItem = 'expenses';
            include public_path('layouts/navbar.php')
            ?>            
        </section>

        <section>
            <?php if ( session_has('message') ): ?>
                        <div class="alert alert-<?php echo session_pull('alert') ?> mt-3">
                            <?php echo session_pull('message') ?>
                        </div>
            <?php endif ?>
        </section>

        <section>
                    <div class="expenses__add ">
                        <h2>Expenses</h2>
                        <a href="<?php echo url('expenses/create.php') ?>" class="btn btn--add">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                            <span>Add Expense</span>
                        </a>
                    </div>
        </section>

        <section class="expenses__table">
                <div class='expenses__table--head'>
                    <div>Amount</div>
                    <div>Category</div>
                    <div>Date</div>
                    <div class="comment-display-none">Comment</div>
            
                </div>

                <?php while ( $expense = mysqli_fetch_object($expenses) ): ?>
                    <div class="expenses__table--row">
                       <div class="expenses__table--row-amount"> <?php echo htmlentities($expense->amount) ?> <i class="fa fa-money" aria-hidden="true"></i> </div>
                       <div class="expenses__table--row-category"> <?php echo ($expense->category) ? htmlentities($expense->category) : 'Other' ?> </div>
                       <div class="expenses__table--row-date"> <?php echo date('d-M-Y', strtotime($expense->created_at)) ?></div>
                       <div class="comment-none expenses__table--row-comment"> <?php echo nl2br(htmlentities($expense->comment)) ?> </div>
                       <div class="btn-none expenses__table--row-btn">
                                    <div>
                                        <a class="btn  btn-edit" href="<?php echo url('expenses/edit.php?id=') . $expense->id; ?>">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                    <div>
                                        <form action="<?php echo url('expenses/delete.php') ?>" method="POST">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="expenseId"
                                                    value="<?php echo $expense->id ?>">
                                            <button class="btn btn-delete delete-expense"
                                                    title="Delete"
                                                    type="submit">
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                            </button>
                                        </form>
                                    </div>
                         </div>

                    

                       <label class="container-none container">
                            <input type="checkbox" >
                            <div class="container__arrow-box"><span class="arrow">&#9660;</span></div>
                            <div class="note-box">
                                <div class="expenses__table--row-comment"> <?php echo nl2br(htmlentities($expense->comment)) ?> </div>
                                <div class="expenses__table--row-btn">
                                            <div>
                                                <a class="btn  btn-edit" href="<?php echo url('expenses/edit.php?id=') . $expense->id; ?>">
                                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                                </a>
                                            </div>
                                            <div>
                                                <form action="<?php echo url('expenses/delete.php') ?>" method="POST">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="expenseId"
                                                            value="<?php echo $expense->id ?>">
                                                    <button class="btn btn-delete delete-expense"
                                                            title="Delete"
                                                            type="submit">
                                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>

                    
                            </div>
                        </label>

                    </div>
                <?php endwhile ?>
                <section class="pagnition">
                    <!-- Pagination -->
                    <?php inject('layouts/partials/pagination.php', [
                            'total' => $total,
                            'perPage' => $perPage,
                            'currentPage' => $currentPage
                    ]) ?>
                </section>

        </section>
        <!-- <section class="expenses__table">
                    <table class="table table-striped table-hover ">
                        <thead>
                        <tr>
                            <th>Amount</th>
                            <th>Category</th>
                            <th>Comment</th>
                            <th >Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php while ( $expense = mysqli_fetch_object($expenses) ): ?>
                            <tr>
                                <td><?php echo htmlentities($expense->amount) ?></td>
                                <td><?php echo ($expense->category) ? htmlentities($expense->category) : 'Other' ?></td>
                                <td><?php echo nl2br(htmlentities($expense->comment)) ?></td>
                                <td><?php echo date('d-M-Y', strtotime($expense->created_at)) ?></td>
                                <td>
                                    <div class="row">
                                        <div class="btn-action">
                                            <a href="<?php echo url('expenses/edit.php?id=') . $expense->id; ?>" class="btn btn-sm btn-warning">
                                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                        <div class="btn-action">
                                            <form action="<?php echo url('expenses/delete.php') ?>" method="POST">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="expenseId"
                                                        value="<?php echo $expense->id ?>">
                                                <button class="btn btn-sm btn-danger delete-expense"
                                                        title="Delete"
                                                        type="submit">
                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endwhile ?>
                        </tbody>
                    </table>                    
        </section> -->



        <section class='footer'>
            <?php include public_path("layouts/footer.php") ?>
        </section>
    </div>

<script>
    let forms = document.querySelectorAll('form');

    Array.from(forms).forEach((form) => {
        form.addEventListener('submit', function (evt) {
            evt.preventDefault();
            let conf = confirm('Are you sure you want to delete this record?');

            if (conf) {
                form.submit();
            }
        }, true);
    });

</script>
</body>
</html>
