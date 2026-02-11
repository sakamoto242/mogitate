Markdown
# mogitate（商品管理システム）

商品の登録、編集、一覧表示、および検索が可能な商品管理システムです。

## 1. 環境構築

### Dockerビルド
1. **リポジトリのクローン**
   ```bash
   git clone [https://github.com/sakamoto242/mogitate.git](https://github.com/sakamoto242/mogitate.git)
Dockerコンテナの起動

Bash
docker-compose up -d --build
Laravel環境構築
コンテナ内へログイン

Bash
docker-compose exec php bash
プロジェクトディレクトリ(src)内での操作

Bash
cd src
composer install
初期設定コマンド

Bash
php artisan key:generate
php artisan migrate
php artisan db:seed
2. 使用技術
PHP: 8.3.0

Laravel: 8.83.27

MySQL: 8.0.26

3. ER図

<img width="693" height="641" alt="スクリーンショット 2026-02-11 220008" src="https://github.com/user-attachments/assets/ad4021fd-d51a-44e9-b5c3-92b55536a0b7" />

5. URL
開発環境: http://localhost/

phpMyAdmin: http://localhost:8080/
