# フリマサイト

 ## 概要
Laravelを用いて作成したフリマサイトです。
ユーザー登録・ログイン、商品出品、購入、検索機能などを実装しています。

**主な機能**
- ユーザー登録 / ログイン
- 商品一覧表示
- 商品検索（商品名の部分一致）
- 商品出品（画像アップロード）
- 商品購入
- マイページ（プロフィール編集）
- お気に入り（いいね）機能

## 環境構築
**Dockerビルド**
1. `git clone git@github.com:miki803/flea-market.git`
2. DockerDesktopアプリを立ち上げる
3. `docker-compose up -d --build`

> *MacのM1・M2チップのPCの場合、`no matching manifest for linux/arm64/v8 in the manifest list entries`のメッセージが表示されビルドができないことがあります。
エラーが発生する場合は、docker-compose.ymlファイルの「mysql」内に「platform」の項目を追加で記載してください*
``` bash
mysql:
    platform: linux/x86_64
    image: mysql:8.0.26
    environment:
```

**Laravel環境構築**
1. `docker-compose exec php bash`
2. `composer install`
3. 「.env.example」ファイルを 「.env」ファイルに命名を変更。または、新しく.envファイルを作成
4. .envに以下の環境変数を追加
``` text
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass
```
5. アプリケーションキーの作成
``` bash
php artisan key:generate
```

6. マイグレーションの実行
``` bash
php artisan migrate
```

7. シーディングの実行
``` bash
php artisan db:seed
```

## 使用技術(実行環境)
- PHP：8.1.33
- Laravel：8.83.8
- MySQL：8.0.26
- Webサーバー：Nginx
- 環境構築：Docker / Docker Compose

## ER図


## URL
- 開発環境：http://localhost/
- phpMyAdmin:：http://localhost:8080/

## テスト

本アプリでは、各機能について
**手動による結合テスト・バリデーションテスト** を実施しています。
- テスト実行を想定し、`.env.testing` によるテスト用環境を分離しています

``` bash
ログインメール:admin@example.com
パスワード:password
```

### テスト実施機能
- 会員登録機能（必須入力・パスワード条件）
- ログイン / ログアウト機能
- 商品一覧・マイリスト表示
- 商品検索機能
- 商品詳細表示
- いいね機能
- コメント送信機能
- 商品購入機能
- 支払い方法選択・配送先変更
- ユーザー情報取得・変更
- 商品出品機能