<style>
   .page-item{
    text-decoration: none;
    color: #000;
    display: inline-block;
    min-width: 43px;
    padding: 0 3px;
    vertical-align: top;
    text-align: center;
    font-size: 14px;
    font-weight: 500;
    position: relative;
    line-height: 42px;
    height: 43px;
    border: 1px solid #f4f4f4;
    background-color: #f4f4f4;
    margin: 0 6px 6px 0;
    border-radius: 50%;
    
   }
</style>
<div id="pagination">
    <?php
    if ($current_page > 3) {
        $first_page = 1;
        ?>
        <a class="page-item" href="?per_page=<?= $item_per_page ?>&page=<?= $first_page ?>">First</a>
    <?php
    }
    if ($current_page > 1) {
        $prev_page = $current_page - 1;
        ?>
        <a class="page-item" href="?per_page=<?= $item_per_page ?>&page=<?= $prev_page ?>">Prev</a>
    <?php }
    for ($num = 1; $num <= $totalPages; $num++) {
        ?>
        <?php if ($num != $current_page) { ?>
            <?php if ($num > $current_page - 3 && $num < $current_page + 3) { ?>
                <a class="page-item" href="?per_page=<?= $item_per_page ?>&page=<?= $num ?>"><?= $num ?></a>
            <?php } ?>
        <?php } else { ?>
            <strong class="current-page page-item"><?= $num ?></strong>
        <?php } ?>
    <?php
    }
    if ($current_page < $totalPages) {
        $next_page = $current_page + 1;
        ?>
        <a class="page-item" href="?per_page=<?= $item_per_page ?>&page=<?= $next_page ?>">Next</a>
        
    <?php
    }
    if ($current_page < $totalPages - 3) {
        $end_page = $totalPages;
        ?>
        <a class="page-item" href="?per_page=<?= $item_per_page ?>&page=<?= $end_page ?>">Last</a>
    <?php
}
?>
</div>