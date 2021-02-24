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
$categories = mysqli_query($connection, "SELECT * FROM `categories`");
?>
<!DOCTYPE html>
<html lang="en">
<?php
$title = 'Edit Expense';
include public_path('layouts/header.php');
?>
<body>
<div class='AEexpense' >
    <section>
        <?php
        $activeItem = 'expenses';
        include public_path('layouts/navbar.php')
        ?>
    </section>
    <section class="AEexpense__content" >
        <div class="AEexpense__content--header">
            <h2 class="AEexpense__content--header-h2">Edit Expense</h2>
            <a href="<?php echo url('expenses') ?>" class="btn btn-warning btn-sm head-btn">
                <i class="fa fa-arrow-left" aria-hidden="true"></i>
                <span class="d-none d-sm-inline-block">Back</span>
            </a>
            <hr>
        </div>
        <div class="expense__form-size">
            <form class="expense__form" action="<?php echo url('expenses/update.php?id=') . $expense->id ?>" method="POST">
                <input type="hidden" name="_method" value="PUT">
                <!-- Amount -->
                <div class='expense__form--content'>
                    <label for="amount" class='expense__form--content-header' >Amount</label>
                    <div>
                        <input id="amount"
                                name="amount"
                                type="text"
                                class='expense__form--content-input money'
                                required="required"
                                value="<?php echo htmlentities($expense->amount) ?>">
                    </div>
                </div>
                <!-- Category -->
                <div class='expense__form--content'>
                    <label for="category-id" class='expense__form--content-header' >Category</label>
                    <div>
                        <select name="category_id" id="category-id" class='expense__form--content-input'>
                            <option value="">Other</option>
                            <?php while ( $category = mysqli_fetch_object($categories) ): ?>
                                <option value="<?php echo $category->id ?>"
                                    <?php if ( $expense->category_id == $category->id ) echo 'selected' ?>>
                                    <?php echo $category->name ?>
                                </option>
                            <?php endwhile ?>
                        </select>
                    </div>
                </div>

                <!-- Comment -->
                <div class='expense__form--content'>
                    <label for="comment" class='expense__form--content-header' >Comment</label>
                    <div>
                            <textarea name="comment"
                                        id="comment"
                                        cols="30"
                                        rows="5"
                                        class='expense__form--content-input sticky-note'
                                        required="required"><?php echo htmlentities($expense->comment) ?></textarea>
                    </div>
                </div>
                <!-- Date -->
                <div class='expense__form--content'>
                    <label for="created_at" class='expense__form--content-header' >Date</label>
                    <div>
                        <input
                            id="created_at"
                            name="created_at"
                            type="date"
                            class='expense__form--content-input'
                            value="<?php echo date('Y-m-d', strtotime($expense->created_at)) ?>">
                    </div>
                </div>
                <hr>
                <!-- Submit button -->
                <div >
                    <div class="expense__form--btn-submit">
                        <button type="submit" name="submit" value="submit" class="btn btn-primary">
                            Update
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <section class='footer' >
        <?php include public_path("layouts/footer.php") ?>
    </section>
</div>

<script src="<?php echo url('assets/js/AE.js') ?>"></script>
</body>
</html>
