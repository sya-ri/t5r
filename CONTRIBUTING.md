# Contribute

## 導入

```shell
# リポジトリのクローン
git clone https://github.com/sya-ri/t5r

# 環境変数の設定
cp .env.example .env

# PHPパッケージのインストール
docker run --rm \
  -v $(pwd):/opt \
  -w /opt \
  laravelsail/php80-composer:latest \
  bash -c "composer install"

# コンテナの起動
./vendor/bin/sail up

# LaravelのAPP_KEY生成
./vendor/bin/sail artisan key:generate
```

## 開発

### コミットメッセージ

```
(type): (title)
(description)
```

#### type

| 名前 | 内容 |
|-----|------|
| `feat` | 機能の追加 |
| `change` | 機能の変更・削除 |
| `fix` | バグの修正 |
| `docs` | ドキュメントの追加・変更 |
| `style` | ソースコードの見た目のみの変更。処理は変更しない |
| `refactor` | 外部に影響しないソースコードの変更 |
| `test` | テストコードの追加・変更 |
| `chore` | バージョン更新等の雑務 |

#### title

変更内容を簡潔に記述する。

#### description

変更内容に対する詳しい説明・補足事項を記述する。

### ブランチ

GitHub Flow を採用する。

- `master` は安定しており、デプロイ可能である。
- `master` に直接プッシュすることはできない。
- 作業を行う場合は、`master` からブランチを作成する。
- `master` へのマージはプルリクエストを介して行う。
