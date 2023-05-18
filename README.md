## Wordpressを用いたポートフォリオ用のサイトです

### ローカル開発
```
docker-compose build
docker-compose up
```

### 使用プラグイン
- admin-menu-editor
- custom-post-type-ui
- smart-slider-3
- wordpress-popular-posts
- wp-pagenavi
- wpfront-scroll-top

### 留意点
- ブログ、商品紹介、お知らせの３つの投稿機能
- トップページのヘッダーには動画を乗せる
- FileZillaを使って開発可能だが、コンテナ内で以下の操作をする
```
docker ps
docker exec -it コンテナID /bin/bash
chmod -R 755 wp-content/themes/
chown -R ftpuser wp-content/themes/
```
FileZilla側の設定
```
プロトコル FTP
localhost
ポートなし
ユーザー ftpuser
パスワード ftpuser
```
