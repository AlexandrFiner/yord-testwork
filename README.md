# Чат в реальном времени на сокетах

Реализовано:
1. docker-compose
2. чат в реальном времени с использованием сокетов
3. API регистрации, авторизации и профиля
4. Страница регистрации, авторизации и чата
5. Авторизация по токену

Сайт доступен по адресу: ```localhost:8000```

Реализован паттерн репозиторий для работы с пользователями (из-за повторяющегося кода в контроллерах)

В проекте приложен дамп для Postman

# Инструкция
1. ``cp .env.example .env``
2. ``docker-compose build``
3. ``docker-compose up -d``
4. ``docker-compose exec app bash``
5. ``php artisan key:generate``
6. ``php artisan migrate``