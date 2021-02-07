<?php
require __DIR__ . '/../../vendor/autoload.php';
require_auth();
$connection = open_connection();
$categories = mysqli_query($connection, "SELECT * FROM `categories`");

?>
<!DOCTYPE html>
<html lang="en">
<?php
$title = 'Add Expense';
include public_path('layouts/header.php');
?>
<body>
<div class='AEexpense'>
    <section>
        <?php
        $activeItem = 'expenses';
        include public_path('layouts/navbar.php')
        ?>            
    </section>
    <section class="AEexpense__content">
        <div class="AEexpense__content--header">
            <h2 class="AEexpense__content--header-h2">Add Expense</h2>
            <a href="<?php echo url('expenses') ?>" class="btn btn-warning btn-sm head-btn">
                <i class="fa fa-arrow-left" aria-hidden="true"></i>
                <span>Back</span>
            </a>
            <hr>
        </div>
        <div class="expense__form-size">
            <form class="expense__form" action="<?php echo url('expenses/store.php') ?>" method="POST">
                <!-- Amount -->
                <div class='expense__form--content' >
                    <label class='expense__form--content-header' for="amount">Amount</label>
                    <div >
                        <input class='expense__form--content-input money' id="amount" name="amount" type="text"  required>
                    </div>
                </div>
                <!-- Category -->
                <div class='expense__form--content' >
                    <label class='expense__form--content-header' for="category-id">Category</label>
                    <div >
                        <select class='expense__form--content-input' name="category_id" id="category-id" >
                            <option value="">Other</option>
                            <?php while ( $category = mysqli_fetch_object($categories) ): ?>
                            <option value="<?php echo $category->id ?>"><?php echo $category->name ?></option>
                            <?php endwhile ?>
                        </select>
                    </div>
                </div>
                <!-- Comment -->
                <div class='expense__form--content' >
                    <label class='expense__form--content-header' for="comment">Comment</label>
                    <div >
                        <textarea 
                                class=' sticky-note expense__form--content-input'
                                name="comment"
                                id="comment"
                                cols="30"
                                rows="5"
                                required>
                        </textarea>
                    </div>
                </div>
                <!-- Date -->
                <div class='expense__form--content' >
                    <label class='expense__form--content-header' for="created_at">Date</label>
                    <div >
                        <input class='expense__form--content-input' id="created_at" name="created_at" type="date" >
                    </div>
                </div>
                <hr>
                <!-- Submit button -->
                <div >
                    <div class="expense__form--btn-submit">
                        <button type="submit" name="submit" value="submit" class="btn btn-primary">
                            Submit
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <section class='footer'>
        <?php include public_path("layouts/footer.php") ?>
    </section>
</div>
</body>
<script>
    let labelLetter = document.querySelector(".expense__form--content-header");
    let inputs = document.querySelectorAll('.expense__form--content-input');
    console.log(inputs);
    inputs.forEach(input=>{
        input.addEventListener("mouseover", function(e){
          e.target.parentElement.parentElement.firstElementChild.style.letterSpacing = ".8rem";
        })
        input.addEventListener("mouseout", function(e){
          e.target.parentElement.parentElement.firstElementChild.style.letterSpacing = ".3rem";
        })
    })
</script>
</html>
