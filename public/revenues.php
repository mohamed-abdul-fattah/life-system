<!DOCTYPE html>
<html lang="en">
<?php
    include __DIR__. "/../helpers.php";
    $title = 'Revenues';
    include public_path("layouts/header.php");
?>
<body>
<div id="app">
    <?php include public_path("layouts/navbar.php") ?>
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2>Revenues</h2>
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
                            <tr>
                                <td>Laravel framework</td>
                                <td>2018-07-08</td>
                                <td>2018-07-08</td>
                            </tr>
                            <tr>
                                <td>VueJs framework</td>
                                <td>2018-07-08</td>
                                <td>2018-07-08</td>
                            </tr>
                            <tr>
                                <td>VueJs framework</td>
                                <td>2018-07-08</td>
                                <td>2018-07-08</td>
                            </tr>
                            <tr>
                                <td>VueJs framework</td>
                                <td>2018-07-08</td>
                                <td>2018-07-08</td>
                            </tr>
                            <tr>
                                <td>VueJs framework</td>
                                <td>2018-07-08</td>
                                <td>2018-07-08</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include public_path("layouts/footer.php") ?>
</body>
</html>
