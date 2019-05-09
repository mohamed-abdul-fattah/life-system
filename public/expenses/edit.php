<?php
require_once __DIR__ . '/../../helpers.php';
require_auth();

$id = $_GET['id'];

if ( empty($id) ) {
    redirect('/expenses');
}

$connection = mysqli_connect(
    getConfig('DB_HOST'),
    getConfig('DB_USER'),
    getConfig('DB_PASS'),
    getConfig('DB_NAME')
);

if ( mysqli_connect_errno() ) {
    printf("Connection failed: %s\n", mysqli_connect_error());
    exit();
}

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
    <?php include public_path('layouts/navbar.php') ?>
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
                    <form action="<?php echo url('expenses/update.php') ?>" method="POST">
                        <!-- Amount -->
                        <div class="panel-body">
                            <div class="form-group row">
                                <label for="amount" class="col-sm-2 col-form-label">Amount</label>
                                <div class="col-sm-10">
                                    <input id="amount"
                                           name="amount"
                                           type="text"
                                           class="form-control"
                                           required="required"
                                           value="<?php echo htmlentities($expense->amount) ?>"
                                    >
                                </div>
                            </div>
                        </div>
                        <!-- Comment -->
                        <div class="panel-body">
                            <div class="form-group row">
                                <label for="comment" class="col-sm-2 col-form-label">Comment</label>
                                <div class="col-sm-10">
                                    <textarea name="comment"
                                              id="comment"
                                              cols="30"
                                              rows="5"
                                              class="form-control"
                                              required="required">
                                        <?php echo nl2br(htmlentities($expense->comment)) ?>
                                    </textarea>
                                </div>
                            </div>
                        </div>
                        <!-- Date -->
                        <div class="panel-body">
                            <div class="form-group row">
                                <label for="created_at" class="col-sm-2 col-form-label">Date</label>
                                <div class="col-sm-10">
                                    <input
                                        id="created_at"
                                        name="created_at"
                                        type="date"
                                        class="form-control"
                                        value="<?php echo date('Y-m-d', strtotime($expense->created_at)) ?>"
                                    >
                                </div>
                            </div>
                        </div>
                        <hr>
                        <!-- Submit button -->
                        <div class="panel-body">
                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <button type="submit" name="submit" value="submit" class="btn btn-primary">
                                        Update
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include public_path("layouts/footer.php") ?>
</body>
</html>
