mogitate（商品管理システム）
商品の登録、編集、一覧表示、および検索が可能な商品管理システムです。

1. 環境構築
Dockerビルド
リポジトリのクローン

Bash
git clone https://github.com/sakamoto242/mogitate.git
Dockerコンテナの起動

Bash
docker-compose up -d --build
Laravel環境構築
コンテナ内へログイン

Bash
docker-compose exec php bash
プロジェクトディレクトリ（src）内での操作

Bash
cd src
composer install
環境設定ファイルの準備 .env.example をコピーして .env を作成し、データベース情報を設定します。

各種コマンドの実行

Bash
php artisan key:generate
php artisan migrate
php artisan db:seed
2. 使用技術
PHP: 8.3.0 / Laravel: 8.83.27 / MySQL: 8.0.26

3. URL
開発環境: http://localhost/

phpMyAdmin: http://localhost:8080/
