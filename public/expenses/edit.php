<?php
require __DIR__ . '/../../vendor/autoload.php';
require_auth();

$id = $_GET['id'];

if ( empty($id) ) {
    redirect('/expenses');
}

$connection = open_connection();
$query = "SELECT * FROM `transactions` WHERE `transactions`.`id`={$id}";
$expense = mysqli_fetch_object(mysqli_query($connection, $query));
?>
<!DOCTYPE html>
<html lang="en">
<?php
$title = 'Edit Expense';
include public_path('layouts/header.php');
?>
<body>
<div id="app">
    <?php
    $activeItem = 'expenses';
    include public_path('layouts/navbar.php')
    ?>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2 class="title">Edit Expense</h2>
                        <a href="<?php echo url('expenses') ?>" class="btn btn-warning btn-sm float-right">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i>
                            Back
                        </a>
                        <hr>
                    </div>
                    <div class="panel-body">
                        <form action="<?php echo url('expenses/update.php?id=') . $expense->id ?>" method="POST">
                            <input type="hidden" name="_method" value="PUT">
                            <!-- Amount -->
                            <div class="form-group row">
                                <label for="amount" class="col-sm-2 col-form-label">Amount</label>
                                <div class="col-sm-10">
                                    <input id="amount"
                                           name="amount"
                                           type="text"
                                           class="form-control"
                                           required="required"
                                           value="<?php echo htmlentities($expense->amount) ?>">
                                </div>
                            </div>
                            <!-- Comment -->
                            <div class="form-group row">
                                <label for="comment" class="col-sm-2 col-form-label">Comment</label>
                                <div class="col-sm-10">
                                        <textarea name="comment"
                                                  id="comment"
                                                  cols="30"
                                                  rows="5"
                                                  class="form-control"
                                                  required="required"><?php echo htmlentities($expense->comment) ?></textarea>
                                </div>
                            </div>
                            <!-- Date -->
                            <div class="form-group row">
                                <label for="created_at" class="col-sm-2 col-form-label">Date</label>
                                <div class="col-sm-10">
                                    <input
                                        id="created_at"
                                        name="created_at"
                                        type="date"
                                        class="form-control"
                                        value="<?php echo date('Y-m-d', strtotime($expense->created_at)) ?>">
                                </div>
                            </div>
                            <hr>
                            <!-- Submit button -->
                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <button type="submit" name="submit" value="submit" class="btn btn-primary">
                                        Update
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include public_path("layouts/footer.php") ?>
</body>
</html>
