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
    <div class="overlay"></div>
    <div id="deleteCard" class="deleteCard">
        <div class="deleteCard__content">
            <p>Do you want to delete ? </p> 
            <div>
                <button class="yesBtn btn btn-danger"> YES </button>
                <button class="noBtn btn btn-success"> NO </button>
            </div>
        </div>
    </div>
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
    'use strict'
    let forms = document.querySelectorAll('form');
    let deleteCard = document.querySelector('.deleteCard');
    let deleteCardContent =document.querySelector('.deleteCard__content')
    let yesBtn = document.querySelector('.yesBtn') ;
    let noBtn = document.querySelector('.noBtn') ;
    let sections = document.querySelectorAll('section');
    let overlay = document.querySelector('.overlay');

    //OVERLAY function animation
    let animeoverlay = function(opacity,display,blur,direction){
        return new Promise(resolve=>{
                overlay.style.display = `${display}` ;
                overlay.style.opacity = `${opacity}`;
                overlay.style.animationDirection =`${direction}`;
                sections.forEach(s=>s.style.filter = `blur(${blur}px)`);
                resolve(1);
    })} 
    //CARD function animation
    let animeCard = function(direction , display , waitSeconds ){
        return new Promise(resolve=>{
            setTimeout(() => {
                deleteCard.style.display = `${display}`;
                deleteCard.style.animationDirection =`${direction}`;
                resolve(2);
            }, waitSeconds *1000);
    })}
    //CARD CONTENT function animation 
    let animeCardContent = function(display , waitSeconds){
        return new Promise(resolve=>{
            setTimeout(() => {
                deleteCardContent.style.opacity = '1';
                deleteCardContent.style.display = `${display}`
                resolve(3);
            }, waitSeconds *1000);
    })}

    // FORWARD ANIMATION 
    let anime = async function(){
        let first = await animeoverlay(1,'block',3,'normal');
        let second = await animeCard('normal','block',.6);
        let third = await animeCardContent('flex',.7);        
    }

    // RESET function 
    let reset = async function(name1 , name2){
        // NOTE 
        // css animation can not be used after the first lunch , unless reset 
        name1.classList.remove(`${name2}`);
        name1.offsetWidth;
        name1.classList.add(`${name2}`);
    }
    // REVERSE ANIMATION
    let animeRevese =  async function(){
        // CARD CONTENT 
        let one = await animeCardContent('none',0);        
        // CARD 
        let two = await reset(deleteCard,'deleteCard');
        let three =  await animeCard('reverse','block',0);       

        // OVERLAY
        let four = await reset(overlay,'overlay');
        let five =  await animeoverlay(0,'block ',0,'reverse'); 
        setTimeout(() => {
            deleteCard.style.display = `none`;
            overlay.style.display = `none`;           
            }, 700);      
    }

    Array.from(forms).forEach((form) => {
        form.addEventListener('submit', function (evt) {
            evt.preventDefault();
            anime();

            yesBtn.addEventListener('click',()=> {
                form.submit();                          
                animeRevese();
                } );
            noBtn.addEventListener('click',()=> {
                animeRevese();
                } )
        }, true);
    });

    overlay.addEventListener("click", ()=>{
        animeRevese();
    })

</script>
</body>
</html>
