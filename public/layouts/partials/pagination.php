<?php
/**
 * Creates a pagination template with the given
 * @var int $total total number of resource records
 * @var int $perPage per-page number of records
 * @var int $currentPage selected page index
 *
 * Tech notes:
 * We generate a range based on the current page and total pages,
 * and this should be the current range pages with -2 pages
 * before the current and +2 after the current page.
 */
?>

<?php
$totalPages = ceil($total / $perPage);
$pagesInfo = paginationIndexes($currentPage, $totalPages);
$prev = $pagesInfo['prev'];
$next = $pagesInfo['next'];
$indexes = $pagesInfo['indexes'];
$fPageInfo = $pagesInfo['firstPage'];
$lPageInfo = $pagesInfo['lastPage'];
$lastPage = $totalPages;
?>

<?php if ( $total ): ?>
    <nav aria-label="...">
        <ul class="pagination">
            <!--Previous-->
            <li class="page-item <?php if ( $prev['disability'] ) echo 'disabled'; ?>">
                <a class="page-link"
                   href="<?php echo $prev['URL'] ?>">
                    Previous
                </a>
            </li>
            <!--End previous-->
            <!--First page-->
            <?php if ( $fPageInfo['display'] ): ?>
                <li class="page-item <?php if ( $fPageInfo['active'] ) echo 'active'; ?>">
                    <?php if ( $fPageInfo['active'] ): ?>
                        <span class="page-link">1<span class="sr-only">(current)</span></span>
                    <?php else: ?>
                        <a class="page-link" href="<?php echo $fPageInfo['URL'] ?>">1</a>
                    <?php endif ?>
                </li>
                <li class="page-item"><a class="page-link">...</a></li>
            <?php endif ?>
            <!--End first page-->
            <?php for ( $i = 0; $i < count($indexes) && $i < $lastPage; $i++ ): ?>
                <li class="page-item <?php if ( $indexes[$i] == $currentPage ) echo 'active'; ?>">
                    <?php if ( $indexes[$i] == $currentPage ): ?>
                        <span class="page-link">
                            <?php echo $indexes[$i] ?>
                            <span class="sr-only">(current)</span>
                        </span>
                    <?php else: ?>
                        <a class="page-link"
                           href="<?php echo url('expenses/?page=') . $indexes[$i] ?>">
                            <?php echo $indexes[$i] ?>
                        </a>
                    <?php endif ?>
                </li>
            <?php endfor ?>
            <!--Last page-->
            <?php if ( $lPageInfo['display'] ): ?>
                <li class="page-item"><a class="page-link">...</a></li>
                <li class="page-item" <?php if ( $lPageInfo['active'] ) echo 'active'; ?>">
                <?php if ( $lPageInfo['active'] ): ?>
                    <span class="page-link">
                        <?php echo $lastPage ?>
                        <span class="sr-only">(current)</span>
                    </span>
                <?php else: ?>
                    <a class="page-link"
                       href="<?php echo $lPageInfo['URL'] ?>">
                        <?php echo $lastPage ?>
                    </a>
                <?php endif ?>
                </li>
            <?php endif ?>
            <!--End last page-->
            <!--Next-->
            <li class="page-item <?php if ( $next['disability'] ) echo 'disabled'; ?>">
                <a class="page-link"
                   href="<?php echo $next['URL'] ?>">Next</a>
            </li>
            <!--End next-->
        </ul>
    </nav>
<?php endif ?>