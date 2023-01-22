
<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
        <li class="page-item ">
            <?php if ($current_page > 2) {  $first_page = 1;?>
                <a class="page-link"  href="?per_page=<?= $item_per_page ?>&page=<?= $first_page ?>">
                    <i class="fa fa-angle-double-left" aria-hidden="true"></i>
                </a>
            <?php } ?>
        </li>
        <li class="page-item ">
            <?php if ($current_page > 1) { $prev_page = $current_page - 1;?>
                <a class="page-link"  href="?per_page=<?= $item_per_page ?>&page=<?= $prev_page ?>">
                    <i class="fa fa-angle-left" aria-hidden="true"></i>
                </a>
            <?php } ?>
        </li>
        <li class="page-item">
            <?php for ($num = 1; $num <= $totalPages; $num++) { ?>
                    <?php if ($num != $current_page) { ?>
                        <?php if ($num > $current_page - 3 && $num < $current_page + 3) { ?>
                            <li class="page-item"><a class="page-link" href="?per_page=<?= $item_per_page ?>&page=<?= $num ?>"><?= $num ?></a></li>
                        <?php } ?>
                    <?php } else { ?>
                            <strong class="current-page page-link" style="color: black;"><?= $num ?></strong>
                            
                <?php } ?>
            <?php } ?>
        </li>
        <li class="page-item">
            <?php if ($current_page < $totalPages ) { $next_page = $current_page + 1;?>
                <a class="page-link" href="?per_page=<?= $item_per_page ?>&page=<?= $next_page ?>">
                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                </a>
            <?php } ?>
        </li>
        <li class="page-item">
            <?php if ($current_page < $totalPages - 1) { $end_page = $totalPages;?>
                <a class="page-link" href="?per_page=<?= $item_per_page ?>&page=<?= $end_page ?>">
                    <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                </a>
            <?php } ?>
        </li>
    </ul>
</nav>