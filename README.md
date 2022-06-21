# Rese（リーズ）

某企業のグループ会社の飲食店予約サービス

## 機能一覧

-   利用者の機能
    -   会員登録、ログイン
    -   会員登録時のメール認証
    -   飲食店一覧表示
    -   飲食店詳細表示
    -   飲食店予約登録
    -   飲食店予約削除
    -   飲食店予約変更
    -   お気に入り追加・削除
    -   検索
        -   エリア検索
        -   ジャンル検索
        -   店名検索
    -   ユーザー情報取得
        -   お気に入り一覧取得
        -   予約情報取得
        -   評価済情報取得
    -   QRコード照合後の飲食店評価
    -   カード決済
-   管理者の機能
    -   店舗代表者の登録
    -   予約登録、予約変更及び予約削除時の利用者へのメールを送信
    -   予約当日の 9:00 にリマインダーメールを送信
-   店舗代表者の機能
    -   新規登録時のメール認証
    -   店舗情報の登録、更新
    -   店舗画像の保存
    -   予約情報の確認
    -   評価の確認
-   ユーザー及び店舗代表者のメール未認証通知
-   飲食店予約登録時のQRコード発行

## 環境構築に関する機能

-   Dockerを使用した環境を構築
-   Herokuに開発環境を構築
    -   ストレージ：Cloudinary
    -   サーバー：JawsDB
    -   スケジューラー：Heroku Scheduler
-   AWSに本番環境を構築
    -   ストレージ：S3
    -   サーバー：EC2
    -   データベース：RDS
-   CircleCIを使用しデプロイとテストを自動化

## ページ一覧

-   飲食店一覧ページ
-   会員登録ページ
-   会員登録完了ページ
-   ユーザーログインページ
-   ユーザーマイページ
-   飲食店詳細ページ
-   予約の登録、変更及びキャンセル完了ページ
-   評価ページ
-   評価完了ページ
-   管理者ログインページ
-   管理者用管理ページ（店舗代表者登録ページ）
-   店舗代表者登録完了ページ
-   店舗代表者ログインページ
-   店舗代表者用管理ページ
-   店舗登録、変更及び削除完了ページ
-   QR コード読取完了ページ
-   メールアドレス未認証通知ページ

## 環境

-   git 最新バージョン
-   Composer 2.x.x 以上
-   Laravel 8.x
-   PHP 8.0.x
-   MySQL 5.7.x 又は 8.0.x
-   Visual Studio Code 最新バージョン

## 環境構築方法

### Windows の場合

-   [Git のインストール](https://gitforwindows.org/)

    -   上記リンクからダウンロードボタンをクリック
    -   ファイルを実行すると、「このアプリがデバイスに変更を加えることを許可しますか？」という画面が表示されるので、「はい」を押下
    -   ダウンロード完了後、ファイルを展開するとインストール画面が表示される
    -   インストーラーでは、「Next」ボタンを押下し続け、最後の画面で Install ボタンを押下
        （全てデフォルトの設定で問題ない）
    -   インストールが終了後、「Launch Git Bash」と「View Release Notes」が出てくるので、「View Release Notes」を選択して、「Next」を押下
    -   CLI を開き、以下のコマンドを入力

    ```
    git --version
    ```

    -   「git version ○○」のようにバージョン情報が表示されればインストール完了

-   Git の初期設定

    -   Git にユーザー名を登録するコマンドを実行（ユーザー名は自分のものを利用）

    ```
    git config --global user.name "ユーザー名"
    ```

    -   Git にメールアドレスを登録するコマンド（メールアドレスはは自分のものを利用）

    ```
    git config --global user.email "メールアドレス"

    ```

-   [GitHub のアカウント作成](https://github.com/)

        -   上記リンクで「Sign up」ボタンを押下
        -   ユーザー名、メールアドレス、パスワードを登録
        -   指示に従い進めていき、プランの選択画面で無料プランを選択し、「Continue」をクリック
        -   入力したメールアドレス宛にメールが届くので、メール内のURLをクリックして認証を行う

-   [XAMPP のインストール](https://www.apachefriends.org/jp/index.html)

    -   Windows 向け XAMPP を選択し、インストール

-   XAMPP の起動

    -   Windows のスタートメニューから「XAMPP」＞「XAMPP Control Panel」を選択
    -   「Apache」と「MySQL」それぞれの Start をクリック

-   MySQL にパスを通す

    -   「コントロールパネル」→「システムとセキュリティ」→「システムの詳細設定」→「環境変数」の順に移動

    -   ユーザー環境変数の Path を選択し、「編集」を押下

    -   「新規」を押下し、「C:\xampp\mysql\bin」と入力し、「OK」ボタンを押下

    -   CLI を開き、以下のコマンドを入力

    ```
    mysql -u root -p
    ```

    -   「Enter Password:」と表示されたら何も入力せず Enter を押下
    -   以下のようなログイン情報が表示されたら成功

    ```
    Welcome to the MariaDB monitor.  Commands end with ; or \g.
    Your MariaDB connection id is 16
    Server version: 10.4.22-MariaDB mariadb.org binary distribution

    Copyright (c) 2000, 2018, Oracle, MariaDB Corporation Ab and others.

    Type 'help;' or '\h' for help. Type '\c' to clear the current input statement.
    ```

    -   ログインした状態のままにしておく

-   データベースの作成

    -   CLI で以下のコマンドを実行

    ```
    create database resedb;
    ```

    -   以下のように表示されれば成功

    ```
    Query OK, 1 row affected (0.01 sec)
    ```

-   [Composer のインストール](https://getcomposer.org/doc/00-intro.md#installation-windows)

    -   「Installation – Windows の Using the Installer」の文章中に「Composer-Setup.exe」というリンクがあるのでインストーラをダウンロード
    -   インストールができたら、コマンドプロンプトで以下のコマンドを実行

    ```
    composer -v
    ```

    -   以下のように Composer のバージョンが返ってくれば成功

    ```
    Composer version 2.2.1 2021-12-22 22:21:31
    ```

    -   もし、composer のバージョンが 2 未満の場合は以下のコマンドを実行し、最新のものにアップデート

    ```
    composer self-update
    ```

-   Composer にパスを通す

    -   「コントロールパネル」→「システムとセキュリティ」→「システムの詳細設定」→「環境変数」の順に移動
    -   ユーザー環境変数の Path を選択し、「編集」を押下
    -   「新規」を押下し、「C:\ProgramData\ComposerSetup\bin」と入力し、「OK」ボタンを押下

-   Github からリポジトリをクローン

    -   保存したいディレクトリに「cd」コマンドで移動後、以下のコマンドを入力

    ```
    git clone https://github.com/aquarius1905/resepj
    ```

    -   コピーしたディレクトリ内を確認した時、README.md だけがディレクトリ内に存在する場合、「cd」コマンドでコピーしたディレクトリに移動後、以下のようにコマンドを入力

    ```
    git checkout main
    ```

    -   デフォルトブランチが mastar のときは main の部分を master とする

-   クローンしたリポジトリを Visual Studio Code で開く
-   マイグレーションの実行
    -   ターミナル を開き、以下のコマンドで、マイグレーションを実施
    ```
    php artisan migrate
    ```
    -   データベース「resedb」に必要なテーブル用意される
-   シーディングの実行
    -   以下のコマンドで、シーディングを実施する
    ```
    php artisan db:seed
    ```
    -   テーブルに初期データが挿入される
-   サーバーを立ち上げる

    -   以下のコマンドを実行

    ```
    php artisan serv
    ```

### Mac の場合

-   Git のインストール

    -   ターミナルを開き、以下のコマンドを入力

    ```
    git --version
    ```

    -   既に使用できる場合は「git version 〇〇」のようなバージョン情報が返ってくる

    -   git を使用できない場合は、「ツールを今すぐインストールしますか？」というメッセージが出てくるのでインストールをクリック

    -   インストールが完了したら、ターミナルを開き、以下のコマンドを入力

    ```
    git --version
    ```

    -   「git version 〇〇」のようなバージョン情報が表示されればインストール完了

-   Git の初期設定　 → 　 Windows の場合を参照

-   GitHub のアカウント作成　 → 　 Windows の場合を参照

-   [MAMP のインストール](https://www.mamp.info/en/downloads/)

    -   MAMP&MAMP Pro を選択

    -   ファイルがダウンロードされるので、インストーラーのウィザードに従ってインストールを進める（基本的に全て「続ける」をクリック）

-   MAMP の起動

    -   インストールが完了すると MAMP フォルダと MAMP PRO が追加される

    -   MAMP PRO が無くても MAMP は使用できるため、削除して構わない

    -   MAMP フォルダを開き、MAMP.app をダブルクリック

    -   右上の Start ボタンを押下すると、ローカルサーバーが起動する

-   MAMP の初期設定

    -   右上の Preferences ボタンを押下

    -   Preferences ボタンを押下後、Ports を開く

    -   「80 ＆ 3306」ボタンを押下し、OK ボタンを押下

-   MySQL にパスを通す

    -   ホームディレクトリに移動

    ```
    cd ~
    ```

    -   デフォルトシェルを確認

    ```
    echo $SHELL
    ```

    -   /bin/bash と表示された場合

        -   パスは通常「.bash_profile」と言うファイルに記載するため vi でファイルを開く

        ```
        vi .bash_profile
        ```

        -   vim を起動すると、.bash_profile のファイルが存在している場合は既に記載されているソースが表示される。新規作成された、.bash_profile ファイルの場合は O（オー）を入力してから下記の文を記載

        ```
        export PATH=$PATH:/Applications/MAMP/Library/bin
        ```

        -   ファイルを保存する（esc → 　:　 → 　 wq）

        -   パスを反映させるために以下のコマンドを入力

        ```
        source .bash_profile
        ```

    -   /bin/zsh と表示された場合

        -   パスは通常「.zshrc」と言うファイルに記載するため vi でファイルを開く

        ```
        vi .zshrc
        ```

        -   .zshrc のファイルが存在している場合は、vim を起動すると既に記載されているソースが表示される。新規作成された.zshrc の場合は O（オー）を入力してから下記の文を記載する。

        ```
        export PATH=$PATH:/Applications/MAMP/Library/bin
        ```

        -   ファイルを保存する（esc → 　:　 → 　 wq）

        -   パスを反映させるために以下のコマンドを入力

        ```
        source .zshrc
        ```

    -   bash と zsh 共通の操作

        -   実際にパスが通っているか確認

        ```
        mysql -u root -p
        ```

        -   パスワードが求められるため「root」と入力

        ```
        Enter password: root
        ```

        -   ログイン情報が出力されたら成功

-   [Composer のインストール](https://getcomposer.org/download/)
    -   Composer の Web サイトに移動し、ページの下部にある Manual Download から 2.〇.〇の最新バージョンのリンクをクリック
    -   ダウンロード」フォルダに「composer.phar」というファイルがダウンロードされる
    -   ターミナルを起動し、以下のコマンドを実行
    ```
    cd Downloads
    sudo mv composer.phar /usr/local/bin/composer
    chmod a+x /usr/local/bin/composer
    ```
    -   以下のコマンドでバージョンを確認
    ```
    composer -v
    ```
    -   以下のように Composer のバージョンが返ってくれば成功
    ```
    Composer version 2.2.1 2021-12-22 22:21:31
    ```
-   Composer にパスを通す

-   Github からリポジトリをクローン　 → 　 Windows の場合を参照

-   クローンしたリポジトリを Visual Studio Code で開く

-   マイグレーションの実行　 → 　 Windows の場合を参照

-   シーディングの実行　 → 　 Windows の場合を参照

-   サーバーを立ち上げる　 → 　 Windows の場合を参照

## Dockerの環境構築方法

### 前提

-   [Gitのインストール](https://git-scm.com/)
-   [GitHubのSSH接続設定](https://qiita.com/ucan-lab/items/e02f2d3a35f266631f24)
-   [Docker for Mac/Windows のインストール (v3.4.0以上)](https://www.docker.com/products/docker-desktop/)

-   以下のコマンドを実行し、インストールされていることを確認する
    ```
    $ git --version
    git version 2.34.1.windows.1
    $ docker --version
    Docker version 20.10.14, build a224086
    $ docker compose version
    Docker Compose version v2.5.1
    ```
    -   ※Docker Composeのバージョンについて、Compose V2がインストールされていない場合は、
        公式に沿ってインストール方法を確認する
    -   https://docs.docker.com/compose/cli-command/#installing-compose-v2

### Docker Content Trust（DCT）を有効にする

-   ~/.bashrc や ~/.zshrc に以下を追記する

    ```
    export DOCKER_CONTENT_TRUST=1
    ```
-   DCTは、Dockerイメージを「なりすまし」と「改ざん」から保護するセキュリティ機能
    -   Docker イメージへ発行者のデジタル署名を付ける
    -   イメージの利用時(pull など)に「発行者」と「イメージが改ざんされていないこと」を検証する
    -   push, build, create, pull, run のコマンド実行時に自動で機能する

### resepjリポジトリをクローンする

    $ git clone git@github.com:aquarius1905/resepj.git

### コンテナ構成

-   下記の4つのコンテナで構成する
    ```
    ┣ app
    ┣ web
    ┣ db
    ┗ mailhog
    ```
-   appコンテナ

    -   アプリケーションサーバーのコンテナ
    -   PHPのバージョンは8.0系を利用する
    -   Laravel8.xサーバー要件を満たす
        -   PHP7.3以上
        -   BCMath PHP 拡張
        -   Ctype PHP 拡張
        -   Fileinfo PHP 拡張
        -   JSON PHP 拡張
        -   Mbstring PHP 拡張
        -   OpenSSL PHP 拡張
        -   PDO PHP 拡張
        -   Tokenizer PHP 拡張
        -   XML PHP 拡張
    -   [php](https://hub.docker.com/_/php), [composer](https://hub.docker.com/_/composer) のベースイメージを利用する

-   webコンテナ

    -   ウェブサーバーのコンテナ
    -   HTTPリクエストを受けて、HTTPレスポンスを返す
    -   phpファイルへのアクセスはappコンテナに投げる
    -   [nginx](https://hub.docker.com/_/nginx), [node](https://hub.docker.com/_/node) のベースイメージを利用する

-   dbコンテナ

    -   データベースサーバーのコンテナ
    -   MySQLのバージョンは8.0系を利用する
    -   [mysql/mysql-server](https://hub.docker.com/r/mysql/mysql-server) のベースイメージを利用する

-   mailhogコンテナ

    -   メールサーバーのコンテナ
    -   MailHogを利用する

### ディレクトリ構成

    ┣ src #Laravelプロジェクトのルートディレクトリ
    ┣ infra
    ┃   ┗ docker
    ┃       ┣ mysql
    ┃       ┃   ┣ Dockerfile
    ┃       ┃   ┗ my.cnf
    ┃       ┣ nginx
    ┃       ┃   ┣ Dockerfile
    ┃       ┃   ┗ default.conf
    ┃       ┗ php
    ┃           ┣ Dockerfile
    ┃           ┣ php.deploy.ini
    ┃           ┗ php.development.ini
    ┣ Makefile
    ┗ docker-compose.yml

###  resepjディレクトリ直下で以下のコマンドを実行

    $ make init

### .envの設定

-   メールに関して「.env」を以下のように設定する
-   カード決済に必要なSTRIPE_KEYとSTRIPE_SECRETは各自のものを設定する（Stripeの導入に関しては後述）

    ```
    MAIL_MAILER=smtp
    MAIL_HOST=コンテナ名
    MAIL_PORT=1025
    MAIL_USERNAME=null
    MAIL_PASSWORD=null
    MAIL_ENCRYPTION=null
    MAIL_FROM_ADDRESS="管理者のメールアドレス"
    MAIL_FROM_NAME="${APP_NAME}"

    ～～省略～～

    STRIPE_KEY=
    STRIPE_SECRET=
    ```

### APP_KEYの設定

-   「make init」を行っても「.env」の「APP_KEY」が空欄の場合は、
    ローカルの「src」ディレクトリ直下で以下のコマンドを実行する

    ```
    $ composer install
    $ php artisan key:generate
    ```

### 推奨開発パッケージのインストール

-   Laravelによってはバージョンによっては対応していないパッケージもある可能性があるため、
    「make init」でエラーがでた場合はインストール要件等を確認する

    ```
    $ make install-recommend-packages
    ```

### Stripeの導入

-   [Stripe](https://stripe.com/jp) のアカウントを取得
-   Stripeの開発者用のダッシュボードからAPIキー（公開可能キーとシークレットキー）を取得
-   .envの「STRIPE_KEY」に「公開可能キー」、「STRIPE_SECRET」に「シークレットキー」を貼り付ける

## ER 図

![erd-image](/src/public/images/erd.png)

## 文責

井口　令子