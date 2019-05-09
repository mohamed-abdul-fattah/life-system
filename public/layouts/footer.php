<footer>
    <small>&copy; Mohamed Abdul-Fattah</small>
</footer>

<?php

if ( isset($connection) ) {
    close_connection($connection);
}