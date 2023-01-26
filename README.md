# ECC-NAKAMA

・	２０２３年度チーム制作授業でコディネートと販売サイトを作りました。
・	ホームページの方はチームの人がCSSをやりましたが、私はadminサイトのCSSに全部作っておりました。PHPとHTMLとDBを全て担当しました。 時間がなかったので、javascriptもけやりました。

★	DBを代入値に関して最初にdatabase.sqlを実行してから、（もう一つだけがあります。）
★	ログイン画面に最初にadminとしてログインして、( http://localhost/...../ECC-NAKAMA-main/admin/ )
★	次の画面に商品管理をクリックし、右側にすべて画像追加ボタンをクリックしてから、画像をDBに代入します。
★	次にupdate_product.sqlを 実行します。
★	注意：アカウント登録の方がlocalhostがsendmailサーバーに接続できませんので、databaseに追加しておきました。(自分作成のフリーサーバーで登録しておきました。)
①	TESTユーザー: name: test と　パスワード：test
②	Adminユーザーは　name: admin, パスワード: admin.
★	Adminをログアウトして、ログイン画面にtestユーザーでログインします。
または、adminでログインしたら、直接にadminサイトに移動します。あるいは、　URLに末尾に/admin入力すると入れます。
★	今から使ってみましょう。
・	開発環境：
	言語：html, css, php, javascript, mysql
	DB: mysql Ver 8.0.21
	Php version: 7.4.23
