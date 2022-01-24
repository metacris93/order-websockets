```
composer update

php artisan vendor:publish --provider="BeyondCode\LaravelWebSockets\WebSocketsServiceProvider" --tag="migrations"
php artisan vendor:publish --provider="BeyondCode\LaravelWebSockets\WebSocketsServiceProvider" --tag="config"

php artisan make:event NewMessage
php artisan migrate

npm install

npm install laravel-echo pusher-js

npm run dev
```

In BroadcastManager.php line 211:
                                   
Class 'Pusher\Pusher' not found
Realizar composer update
