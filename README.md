# У нас предусмотрено небольшое тестовое задание, результат необходимо разместить в репозитории на GitHub (лучше открытом) и прислать ссылку.

### Задание:
### Реализуйте на PHP (Laravel, php>=7.2) сервер с базой данных PostgreSQL и следующими API:
#### ⁃ Запрос регистрации по email и паролю - возвращает accessToken и refreshToken с ограниченным сроком действия;
#### ⁃ Запрос авторизации по email и паролю - также возвращает accessToken и refreshToken;
#### ⁃ Запрос продления действия токена авторизации - возвращает accessToken и refreshToken;
#### ⁃ Запрос сохранения текущих координат пользователя. При этом в очередь добавляется задача на получение адреса по координатам с последующей записью адреса в БД. В ответ возвращается статус постановки задачи в очередь (задача поставлена/ошибка). Адрес запрашивать через API геокодинга от Yandex.
#### ⁃ Запрос получения маршрута пользователя за заданный промежуток времени с пагинацией (в ответе список точек с координатами и адресами)
#### Учесть, что маршрут запрашивается за длительный промежуток времени с большим лимитом записей. Если будет время, можно усложнить задание условием: если ранее были запрошены близкие координаты < 5 метров, то заново адрес не запрашивать, а использовать полученный ранее. Выполнить документацию API в формате Swagger.
