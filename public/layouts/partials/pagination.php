<?php
/**
 * Creates a pagination template with the given
 * Tech notes:
 * We generate a range based on the current page and total pages,
 * and this should be the current range pages with -2 pages
 * before the current and +2 after the current page.
 *
 * @var int $total total number of resource records
 * @var int $perPage per-page number of records
 * @var int $currentPage selected page index
 */
?>

<?php
$totalPages = ceil($total / $perPage);
$range = getPaginationRange($currentPage, $totalPages);
$lastPage = $totalPages;
?>

<?php if ( $total ): ?>
    <nav aria-label="...">
        <ul class="pagination">
            <!--Previous-->
            <li class="page-item <?php if ( $currentPage == 1 )
                echo 'disabled'; ?>">
                <a class="page-link"
                   href="<?php echo url('expenses/?page=') . ($currentPage - 1) ?>">
                    Previous
                </a>
            </li>
            <!--End previous-->
            <!--First page-->
            <?php if ( $range[0] != 1 ): ?>
                <li class="page-item <?php if ( 1 == $currentPage )
                    echo 'active'; ?>">
                    <?php if ( 1 == $currentPage ): ?>
                        <span class="page-link">1<span class="sr-only">(current)</span></span>
                    <?php else: ?>
                        <a class="page-link" href="<?php echo url('/expenses/') ?>">1</a>
                    <?php endif ?>
                </li>
                <li class="page-item"><a class="page-link">...</a></li>
            <?php endif ?>
            <!--End first page-->
            <?php for ( $i = 0; $i < count($range) && $i < $lastPage; $i++ ): ?>
                <li class="page-item <?php if ( $range[$i] == $currentPage ) echo 'active'; ?>">
                    <?php if ( $range[$i] == $currentPage ): ?>
                        <span class="page-link">
                            <?php echo $range[$i] ?>
                            <span class="sr-only">(current)</span>
                        </span>
                    <?php else: ?>
                        <a class="page-link"
                           href="<?php echo url('expenses/?page=') . $range[$i] ?>">
                            <?php echo $range[$i] ?>
                        </a>
                    <?php endif ?>
                </li>
            <?php endfor ?>
            <!--Last page-->
            <?php if ( $range[count($range) - 1] < $lastPage ): ?>
                <li class="page-item"><a class="page-link">...</a></li>
                <li class="page-item" <?php if ( $lastPage == $currentPage ) echo 'active'; ?>">
                <?php if ( $lastPage == $currentPage ): ?>
                    <span class="page-link">
                        <?php echo $lastPage ?>
                        <span class="sr-only">(current)</span>
                    </span>
                <?php else: ?>
                    <a class="page-link"
                       href="<?php echo url('expenses/?page=') . $lastPage ?>">
                        <?php echo $lastPage ?>
                    </a>
                <?php endif ?>
                </li>
            <?php endif ?>
            <!--End last page-->
            <!--Next-->
            <li class="page-item <?php if ( $currentPage == $lastPage ) echo 'disabled'; ?>">
                <a class="page-link"
                   href="<?php echo url('expenses/?page=') . ($currentPage + 1) ?>">Next</a>
            </li>
            <!--End next-->
        </ul>
    </nav>
<?php endif ?>