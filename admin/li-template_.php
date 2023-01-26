<li>
    <div class="listing-prop listing-name" style="width: 301px;"><?= str_repeat("---", $num - 1).$row['name'] ?></div>
    <div class="listing-prop listing-button">
        <a href="./<?= $config_name ?>_delete.php?id=<?= $row['id'] ?>">削除</a>
    </div>
    <div class="listing-prop listing-button">
        <a href="./<?= $config_name ?>_editing.php?id=<?= $row['id'] ?>">編集</a>
    </div>
    <div class="listing-prop listing-button">
        <a href="./<?= $config_name ?>_editing.php?id=<?= $row['id'] ?>&task=copy">コピー</a>
    </div>
    <div class="listing-prop listing-time"><?= date('Y/m/d H:i', $row['created_time']) ?></div>
    <div class="listing-prop listing-time"><?= date('Y/m/d H:i', $row['last_updated']) ?></div>
    <div class="clear-both"></div>
</li>