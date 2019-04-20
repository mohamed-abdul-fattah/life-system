<footer>
    <small>&copy; Mohamed Abdul-Fattah</small>
</footer>

<?php

if ( isset($connection) ) {
    mysqli_close($connection);
}