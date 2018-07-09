<!DOCTYPE html>
<html lang="en">
<?php include "layouts/header.php" ?>
<body>
    <div id="app">
        <div class="header">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <a class="navbar-brand" href="/">
                    <h2>Life System</h2>
                </a>
                <div id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link" href="/">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Expenses</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Revenues</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <div class="col-md-12" id="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2>Expenses</h2>
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
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
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
    </div>
    <?php include "layouts/footer.php" ?>
</body>
</html>
