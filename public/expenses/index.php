<?php
require __DIR__ . '/../../vendor/autoload.php';
require_auth();

$perPage = 15;
$currentPage = $_GET['page'] ?? 1;
$offset = ($currentPage - 1) * $perPage;

$connection = open_connection();
$query = "SELECT `transactions`.*, `c`.`name` as category FROM `transactions`
            LEFT JOIN categories c on transactions.category_id = c.id
            ORDER By `transactions`.`created_at`, `transactions`.`id` DESC
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
        <div class="modall">
            <div class="modall__overlay"></div>
            <div class="modall__tvEffect">
                <div class="modall__tvEffect--content">
                    <p>Do you want to delete ? </p> 
                    <div>
                        <button class="cofirm btn btn-danger"> YES </button>
                        <button class="ignore btn btn-success"> NO </button>
                    </div>
                </div>
            </div>
        </div>
        
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
                <a href="<?php echo url('expenses/create.php') ?>" class="btn btn__addexpenses">
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
                <div class="pagnition">
                    <!-- Pagination -->
                    <?php inject('layouts/partials/pagination.php', [
                            'total' => $total,
                            'perPage' => $perPage,
                            'currentPage' => $currentPage
                    ]) ?>
                </div>
        </section>
        <section class='footer'>
            <?php include public_path("layouts/footer.php") ?>
        </section>
    </div>

<script>
    'use strict'
    let forms = document.querySelectorAll('form');
    let sections = document.querySelectorAll('section');
    let cofirmBtn = document.querySelector('.cofirm') ;
    let ignoreBtn = document.querySelector('.ignore') ;

    Array.from(forms).forEach((form) => {
        form.addEventListener('submit', function (evt) {
            evt.preventDefault();
            modalActive();

            cofirmBtn.addEventListener('click',()=> {
                form.submit();                          
                modalReverse();
                } );
            ignoreBtn.addEventListener('click',()=> {
                modalReverse();
                } )
        }, true);
    });
</script>
</body>
</html>
