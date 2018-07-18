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
            <div class="col-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2 class="title">Add Expense</h2>
                        <a href="<?php echo url('expenses') ?>" class="btn btn-warning btn-sm float-right">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i>
                            Back
                        </a>
                        <hr>
                    </div>
                    <form action="<?php echo url('expenses') ?>" method="POST">
                        <!-- Amount -->
                        <div class="panel-body">
                            <div class="form-group row">
                                <label for="amount" class="col-sm-2 col-form-label">Amount</label>
                                <div class="col-sm-10">
                                    <input id="amount" name="amount" type="number" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <!-- Comment -->
                        <div class="panel-body">
                            <div class="form-group row">
                                <label for="comment" class="col-sm-2 col-form-label">Comment</label>
                                <div class="col-sm-10">
                                    <textarea name="Comment" id="comment" cols="30" rows="5" class="form-control" required></textarea>
                                </div>
                            </div>
                        </div>
                        <!-- Date -->
                        <div class="panel-body">
                            <div class="form-group row">
                                <label for="created_at" class="col-sm-2 col-form-label">Date</label>
                                <div class="col-sm-10">
                                    <input id="created_at" name="created_at" type="date" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <!-- Submit button -->
                        <div class="panel-body">
                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Submit</button>
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
