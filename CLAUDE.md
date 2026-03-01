# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## 概要

PHP 8.3 + nginx + MySQL を使用した Laravel 12 プロジェクト用の Docker 環境。Laravel アプリケーションのソースコードは `src/` ディレクトリに配置する。

## よく使うコマンド

すべての PHP/Artisan/Composer コマンドは `app` コンテナ内で実行する。

```bash
# 開発環境の起動・停止
docker-compose up -d
docker-compose down
docker-compose down -v  # DBデータも含めて完全削除

# コンテナに入る
docker-compose exec app bash

# Composer
docker-compose exec app composer install
docker-compose exec app composer require <package>

# Artisan
docker-compose exec app php artisan migrate
docker-compose exec app php artisan migrate:fresh --seed
docker-compose exec app php artisan make:model <Name> -mcr

# テスト実行（SQLite インメモリDBを使用）
docker-compose exec app php artisan test
docker-compose exec app php artisan test --filter=<TestName>  # 単一テスト
docker-compose exec app php artisan test tests/Unit           # Unitのみ
docker-compose exec app php artisan test tests/Feature        # Featureのみ

# コードフォーマット (Laravel Pint)
docker-compose exec app ./vendor/bin/pint

# フロントエンド (npm は app コンテナ内で実行)
docker-compose exec app npm install
docker-compose exec app npm run build
docker-compose exec app npm run dev
```

## アーキテクチャ

### Docker 構成

```
infra/
├── php/        # PHP 8.3-fpm + Composer 2.7 + Node.js 24
├── nginx/      # nginx 1.25-alpine (ポート80、リバースプロキシ)
└── mysql/      # MySQL 8.0 (ポート3306)

src/            # Laravel アプリケーション本体
```

- `app` コンテナ (PHP-FPM) はポート 5173 (Vite HMR) を公開
- `web` コンテナ (nginx) はポート 80 を公開し、PHP処理を `app:9000` に転送
- コンテナユーザーは UID/GID=1000 (`appuser`) でホストのファイル権限と合わせている

### 環境変数

`.env.example` をコピーして `.env` を作成。DBの接続先は環境変数 `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` で制御。

- **開発環境**: `db` コンテナ（Docker内MySQL）に接続
- **本番環境**: Aurora MySQL に接続（`docker-compose.prod.yml` でオーバーライド）

### テスト環境

`phpunit.xml` の設定により、テスト時は SQLite インメモリDB (`DB_CONNECTION=sqlite`, `DB_DATABASE=:memory:`) を使用するため、テスト実行に MySQL コンテナは不要。

### フロントエンド

- Tailwind CSS v4 + Vite を使用
- Docker コンテナ外からVite開発サーバーにアクセスするには、`vite.config.js` に `server.host: "0.0.0.0"` と `server.hmr.host: "localhost"` の設定が必要（README参照）

### 本番起動

```bash
docker-compose -f docker-compose.yml -f docker-compose.prod.yml up -d
```
