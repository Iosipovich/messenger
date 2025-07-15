# Laravel Messenger (Reverb + Blade)

Простой мессенджер на Laravel 12 с поддержкой реалтайм-чата через Laravel Reverb (официальный WebSocket-сервер).

## 🚀 Возможности

- Аутентификация (Laravel Breeze)
- Чат между пользователями
- Хранение сообщений в БД
- Реалтайм-отображение сообщений (Laravel Reverb + Echo)
- Тесты: feature-тест на отправку сообщения

## 🧱 Стек технологий

- Laravel 12
- Laravel Reverb
- Laravel Echo + Alpine.js
- MySQL / MariaDB
- Blade + Tailwind CSS

## ⚙️ Установка

```bash
git clone https://github.com/ТВОЙ_ЮЗЕРНЕЙМ/laravel-messenger.git
cd laravel-messenger

composer install
npm install && npm run dev

cp .env.example .env
php artisan key:generate

php artisan migrate
php artisan serve
php artisan reverb:start
