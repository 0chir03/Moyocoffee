# Задание для соискателя

## Описание

Реализация web-формы регистрации и аутентификации пользователя. Установка изображения своего аватара после аутентификации. Web-форма осуществляет взаимодействие с backend-ом по средствам запросов формата JSON (REST API).

## Что было реализовано:

- **Набор Rest-методов**:
    - Регистрация пользователя.
    - Аутентификация пользователя.
    - Загрузка изображения для аватара.
- **Код по принципу MVC**.
- **Валидация входных данных**.
- **документация API**.
- **Docker контейнеризация**:
    - Использование Docker для развертывания приложения и базы данных (nginx, php-fpm, postgresql).

### Структура реализации:

- **AuthController** — Контроллер для обработки регистрации и аутентификации пользователей.
- **ProfileController** — Контроллер для обработки аватара.
- **RegisterRequest** — Запрос register, валидация данных регистрации.
- **LoginRequest** — Запрос login, валидация данных аутетификации.
- **ProfileUploadAvatarRequest** — Запрос upload, валидация данных изображения.
- **Models** — Модели для работы с данными.
- **Service** — Логика работы.
- **Migrations** — Миграции для создания таблиц.
- **js** - JavaScript для отправки AJAX-запросов.
- **api.php** — Определения маршрутов для API.
- **Dockerfile** — Конфигурация для создания контейнера Docker.
- **docker-compose.yml** — Настройки для запуска контейнеров с помощью Docker Compose.
- **.env** — Файл с переменными окружения для настройки конфигураций.
- **README.md** — Описание проекта, инструкция по установке и запуску.

## Запуск приложения

1. Убедитесь, что у вас установлен Docker и Docker Compose.
2. Клонируйте репозиторий:

   ```bash
   git clone git@github.com:Adlerprogr/TestMicroCRM.git
   ```

3. Настройте файл `.env`:

   ```bash
DB_CONNECTION=pgsql
DB_HOST=db
DB_PORT=5432
DB_DATABASE=postgresdb
DB_USERNAME=user
DB_PASSWORD=pass
   ```

4. Запустите сервер:

   ```bash
   docker-compose up --build
   ```

5. Установитe необходимые пакеты:

   ```bash
   composer require laravel/sanctum
   composer require intervention/image
   ```

6. Из контейнера php-fpm включите маршрутизацию API :

   ```bash
   docker-compose exec -it php-fpm bash 
   php artisan install:api 
   ```

7. Из контейнера php-fpm запустите миграции:

   ```bash
   php artisan migrate
   ```

8. Из контейнера php-fpm cоздайте символическую ссылку для public storage:

   ```bash
   php artisan storage:link
   ```

9. Создайте директорию и выставите права по необходимости:

    ```bash
    mkdir -p storage/app/public/avatars
    chmod 777 storage/app/public/avatars
    ```

10. После запуска сервера вы можете работать с API через такие сервисы как Postman.

Автор: [Oshir]
# 

## Эндпоинты


### 1. регистрация нового пользователя

- **POST** `http://localhost:8082/api/register`

  **Ответ**:

- **Статус:** `201 OK`
  ```json
{
    "user": {
    "name": "ricardo",
    "email": "kaka@mail.ru",
    "updated_at": "2025-01-09T18:34:08.000000Z",
    "created_at": "2025-01-09T18:34:08.000000Z",
    "id": 6
    },
    "token": "30|xwJrFVSWnQl2KpNmzQpZSOPr1kURawfNWsaXetW873c15062"
}
  ```

  **Коды состояния**:
    - 201 Created. A new resource was created successfully.

### 2. аутентификация пользователя

- **POST** `http://localhost:8082/api/login`

  **Ответ**:

- **Статус:** `200 OK`
  ```json
 {
    "user": {
        "id": 6,
        "name": "ricardo",
        "email": "kaka@mail.ru",
        "avatar": null,
        "created_at": "2025-01-09T18:34:08.000000Z",
        "updated_at": "2025-01-09T18:34:08.000000Z"
    },
    "token": "31|u0PPjRwZCH7Y7CinQh85VdSoWRjIv2NDO5OS2fCC2c5b2f75"
}
  ```

**Коды состояния**:
- `200 OK' Request successful. The server has responded as required.

### 3. Загрузка изображения и сохранение в локальном хранилище

- **POST** `http://localhost:8082/api/avatar`

  **Ответ**:

- **Статус:** `200 OK`
  ```json
