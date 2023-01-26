<?php if (!empty($_SESSION['current_user'])) { ?>
    <div class="clear-both"></div>
    </div>
    </div>
    <div id="admin-footer">
        <div class="container">
            <div class="left-panel">
                © Copyright 2023 - nakama-ECC
            </div>
            <div class="right-panel">
                <a target="_blank" href="https://www.facebook.com/Thangchik2906/" title="DO-VAN-THANG"><img height="48" src="../admin/images/facebook.png" /></a>
                <a target="_blank" href="https://www.youtube.com/watch?v=SqyiMbMvds0"><img height="48" src="../admin/images/youtube.png" /></a>
            </div>
            <div class="clear-both"></div>
        </div>
    </div>
<?php } else { ?>
    <div class="container">
        <div class="box-content">
        ログインしていません。管理者ログインに戻ってください!! <a href="index.html" style="color: red;">こちら</a>
        </div>
    </div>
<?php } ?>
</body>
</html>