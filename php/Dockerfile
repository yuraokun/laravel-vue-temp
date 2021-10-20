FROM php:8.0-fpm-alpine

RUN docker-php-ext-install pdo pdo_mysql && \
  apk add --update nodejs npm 

COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN docker-php-ext-install pdo pdo_mysql && \
  apk add --update nodejs npm 

COPY --from=composer /usr/bin/composer /usr/bin/composer

# WORKDIR /var/www/html
# RUN cd /var/www/html
# RUN composer require laravel/ui --dev
# RUN php artisan key:generate
# RUN php artisan ui vue
# RUN npm install
# RUN npm install vue-router
# RUN npm install vuex
# example.envをコピーして.envファイルを作成
# npm installの後にnode_modulesとpakage.lockを削除後もう一回npm installしないとエラーが出る

# /var/www/html # php artisan tinker
# Psy Shell v0.10.8 (PHP 8.0.11 — cli) by Justin Hileman
# >>> $category = App\Models\Category::factory()->make();


# php artisan route:list
# 現在登録されているルーティングを確認

# php artisan make:controller testController --api
# api 用のcontrollerを作成



#### ここからsanctumのhow to use a api authentication
# composer require laravel/sanctum
# api用のpackageをcomposerからインストール

# php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
# 上記の処理でCreatePersonalAccessTokensTableとゆうmigrationファイルが作成される

# php artisan migrateしてapi authentication用のテーブルを作成

# あとはKarnel.phpに以下をたす
#  \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
#             'throttle:api',
#             \Illuminate\Routing\Middleware\SubstituteBindings::class,

# routes folder のapi.phpにauthenticateしたいapiルートに以下のように記述
# Route::group(['middleware' => ['auth:sanctum']], function() {
#         Route::get('/products/search/{name}', [ProductController::class,'search']);

#         Route::post('/logout', [AuthController::class, 'logout']);
# });
############



# 特定のmigrationファイルをdropしたいとき
# php artisan migrate:refresh  --step=1 --path=/database/migrations/ファイル名




###### 決済系のライブラリ cachier stripeなどを使用する際
# composer require laravel/cachier 
# でlaravelの決済ライブラリを追加
# php artisan migrate
# cashierのテーブルを作成
# .envにstripeのSTRIPE_KEYとSTRIPE_SECRETをたす
# user modelにBillableを追加
# npm install --save-dev @stripe/stripe-js
#でstripeのライブラリをnpmでインストトール