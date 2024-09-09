# coachtechフリマ

フリマアプリ<br>
シンプルな画面・機能のフリマアプリを作成しました  
<br>
＜トップページ＞  <br>
　商品の一覧が表示されます。マイリストタブでお気に入りに登録した商品の一覧が見られます。<br>
  ヘッダーにある検索窓から商品を検索できます。<br>
  <img src="https://github.com/user-attachments/assets/f58a7d02-6103-43bd-a2b9-9d998ba910ad" width=60%><br><br>


＜商品詳細ページ＞<br>
　各商品の詳細説明を見ることができます。この画面から購入へと進めます。<br>
  お気に入り登録とコメントの送信ができます。<br>
  <img src="https://github.com/user-attachments/assets/50c5fb17-dce8-457a-a63f-3da0f2240fd2" width=60%><br><br>

＜マイページ＞ <br>
　ユーザー個別の出品した商品と購入した商品の一覧が表示されます。プロフィールの設定が行えます。<br>
  <img src="https://github.com/user-attachments/assets/ffb30f28-f1cf-4c24-b52c-367146223faa" width=60%><br><br>

＜プロフィール設定ページ＞ <br>
　ユーザーのプロフィールをここから設定できます。<br>
  <img src="https://github.com/user-attachments/assets/b1dd4555-346a-4084-8911-05e05cc5ec51" width=60%><br><br>

＜購入ページ＞ <br>
　支払金額および支払い方法が表示されるので、このページで確認できます。<br>
　支払い方法および配送先の変更ができます。<br>
  <img src="https://github.com/user-attachments/assets/f16be252-2997-40eb-b118-989d52f2fc89" width=60%><br><br>

＜管理者用ページ＞ <br>
　管理者専用の画面です。管理者用のユーザー名とパスワードでログインすると遷移します。
  メールの送信、ユーザーの削除、コメントの削除ができます。<br>
  <img src="https://github.com/user-attachments/assets/083e4d0f-5ad1-448d-9167-52967e074a5e" width=60%><br><br>


## URL

- 本番環境：http://3.26.230.133/
  （URL でログイン後にトップページに遷移します)
- 開発環境：http://localhost/
- phpMyAdmin：http://localhost:8080/
  <br><br>

## 関連レポジトリ

https://github.com/MiyokoNakada/20240806_Flea_Market
<br><br>

## 機能一覧

- 会員登録・ログイン・ログアウト機能
- 商品一覧（検索機能）
- 商品詳細表示
- お気に入り登録・削除
- コメント送信・削除
- マイページ（ユーザー個別の出品・購入商品)
- 配送先変更機能
- 決済機能
- 支払い方法変更機能
- 管理者用画面（メール送信機能、ユーザー・コメント削除機能）
<br><br>

## 使用技術(実行環境)

- PHP 8.2.12
- Laravel 11.20.0
- MySQL 8.0.36
<br><br>

## テーブル設計
<img src="https://github.com/user-attachments/assets/d133592e-3d1a-48ff-9978-1b22232955e0" width=60%><br>
<img src="https://github.com/user-attachments/assets/6edef6d3-e7e4-4ba0-a62b-2ad01717fcd6" width=60%><br>
<img src="https://github.com/user-attachments/assets/a993593a-99e8-45fc-a457-a7536978de46" width=60%><br>
<br><br>

## ER 図
<img src="https://github.com/user-attachments/assets/012cb51d-0c57-4e14-a703-a95fc117f58f" width=60%><br><br>
<br><br>

## 環境構築

- 開発環境はローカル、本番環境はAWSを使用しています。<br>

- メールの確認にはmailtrapを使用しています。<br>
  https://mailtrap.io/email-sandbox/

- 決済にはstripeを使用しています。<br>
  https://stripe.com/jp

- テスト用のユーザー<br>
  管理者<br>
  　Email: admin@email.com <br>
  　Password: admin_pass <br>
  一般ユーザー<br>
  　Email: test@email.com <br>
  　Password: test_pass <br>

### (1)開発環境のセットアップ

#### 前提条件

- Docker
- Docker Compose

#### 手順

1. リポジトリをクローン
   ```sh
   git clone git@github.com:MiyokoNakada/20240806_Flea_Market.git
   cd 20240806_Flea_Market
   ```
2. Docker コンテナをビルドして起動
   ```sh
   docker-compose -f docker-compose.dev.yml up --build -d
   ```
3. .env ファイルを作成し、必要な環境変数を設定

   ```sh
   cp src/.env.example src/.env
   ```

   ```env
   APP_ENV=local
   APP_DEBUG=true
   APP_URL=http://localhost

   DB_HOST=mysql
   DB_DATABASE=laravel_db
   DB_USERNAME=laravel_user
   DB_PASSWORD=laravel_pass

   MAIL_MAILER=smtp
   MAIL_HOST=your_email_host
   MAIL_PORT=2525
   MAIL_USERNAME=your_username
   MAIL_PASSWORD=your_password
   MAIL_ENCRYPTION=
   MAIL_FROM_ADDRESS="coachtech_flea_market@example.com"
   MAIL_FROM_NAME="${APP_NAME}"

   STRIPE_KEY=pk_test_51xxxx(your_stripe_key)
   STRIPE_SECRET=sk_test_51xxxx(your_stripe_secret_key)
   ```

4. PHP コンテナにログイン後、composer のインストール
   ```sh
   docker-compose -f docker-compose.dev.yml exec php bash
   ```
   ```php
   composer install
   ```
5. アプリケーションキーの作成
   ```php
   php artisan key:generate
   ```
6. マイグレーションの実行
   ```php
   php artisan migrate
   ```
7. シンボリックリンクの作成
   ```php
   php artisan storage:link
   ```
8. Seederデータの挿入
   ```php
   php artisan db:seed
   ```

### (2)本番環境のセットアップ

#### 前提条件

- AWS EC2 インスタンス
- AWS RDS データベース
- AWS S3 ストレージ

#### 手順

1. EC2 インスタンスを作成し、必要なソフトウェアをインストール

- Docker
- Docker-compose
- Git

2. RDS データーベース、S3バケットを作成し、作成した EC2 に接続
3. リポジトリをクローン
   ```sh
   git clone git@github.com:MiyokoNakada/20240806_Flea_Market.git
   cd 20240806_Flea_Market
   ```
4. `docker/nginx/default.conf` ファイルを編集
   ```
   server_name your_ec2_instance_public_ip;
   ```
5. Docker コンテナをビルドして起動
   ```sh
   docker-compose -f docker-compose.prod.yml up --build -d
   ```
6. .env ファイルを作成し、必要な環境変数を設定

   ```sh
   cp src/.env.example src/.env
   ```

   ```env
   APP_ENV=production
   APP_DEBUG=false
   APP_URL=http://your_ec2_instance_public_ip/

   DB_HOST=your_rds_endpoint
   DB_DATABASE=your_production_db
   DB_USERNAME=your_db_user
   DB_PASSWORD=your_db_password

   FILESYSTEM_DISK=s3

   MAIL_MAILER=smtp
   MAIL_HOST=your_email_host
   MAIL_PORT=2525
   MAIL_USERNAME=your_username
   MAIL_PASSWORD=your_password
   MAIL_ENCRYPTION=
   MAIL_FROM_ADDRESS="coachtech_flea_market@example.com"
   MAIL_FROM_NAME="${APP_NAME}"

   AWS_ACCESS_KEY_ID=IAM_user_access_key
   AWS_SECRET_ACCESS_KEY=IAM_user_secret_access_key
   AWS_DEFAULT_REGION=aws_region
   AWS_BUCKET=your_s3_bucket_name
   AWS_URL=https://your_s3_bucket_name.s3.amazonaws.com
   AWS_USE_PATH_STYLE_ENDPOINT=false
   
   STRIPE_KEY=pk_test_51xxxx(your_stripe_key)
   STRIPE_SECRET=sk_test_51xxxx(your_stripe_secret_key)
   ```

7. PHP コンテナにログイン後、composer のインストール
   ```sh
   docker-compose -f docker-compose.prod.yml exec php bash
   ```
   ```php
   composer install
   ```   
8. S3ファイルシステムのインストール
   ```php
   composer require league/flysystem-aws-s3-v3 "^3.0" --with-all-dependencies
   ```
9. アプリケーションキーの作成
    ```php
    php artisan key:generate
    ```
10. マイグレーションの実行  
    ```php
    php artisan migrate
    ```
11. シンボリックリンクの作成
    ```php
    php artisan storage:link
    ```
13. Seederデータの挿入
    ```php
    php artisan db:seed
    ```
   

