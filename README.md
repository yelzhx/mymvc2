# mymvc2
### фреймворк на PHP

* Скрипт для базы данных лежит в [db_mymvc.sql](https://github.com/yelzhx/mymvc2/blob/master/db_mymvc.sql)
* БД необходимо назвать db_mymvc, либо поменять настройки в файле [mymvc2/config/db.php](https://github.com/yelzhx/mymvc2/blob/master/config/db.php)
* изменить 
```php<?php
return [
    'dsn' => 'mysql:host=localhost;dbname=название БД;charset=utf8',
    'username' => 'Имя пользователя',
    'password' => 'Ваш пароль',
];
```
* файлы приложения необходимо вставить непосредственно в root директорию, либо произвести настройки в файлах C:\Windows\System32\drivers\etc\host и конфигурационном файле apache.
* в базе есть один пользователь, имя пользователя **user1**, пароль **123456**
---
### изменения за 20.11.2017:
* убрал **?>** в конце файлов
* через **composer** загрузил monolog
* использовал пространства имен
* ~~убрал возможность **увести баланс в минус**~~
* при выполнении sql запросов **использовал параметры**
* ~~использовал **session_write_close()** после записи в сессию.~~
* а также после подключения к mysql через PDO. Выходила ошибка, видимо блокировалась запись в сессию.
---
### изменения за 21.11.2017:
* удалил .idea из репозитория и в .gitignore добавил .idea и [config/db.php](https://github.com/yelzhx/mymvc2/blob/master/config/db.php)  и файл логов [tmp/app.log](https://github.com/yelzhx/mymvc2/blob/master/tmp/app.log)
* изменил скрипт для создания базы данных [db_mymvc.sql](https://github.com/yelzhx/mymvc2/blob/master/db_mymvc.sql), сделал поле **amount беззнаковым** (другая проверка на **увести баланс в минус** есть в моделе [User](https://github.com/yelzhx/mymvc2/blob/master/app/models/User.php), которая срабатывает в момент вывода денег
```php<?php
...
 $balance = $user->amount-$money;
            if($balance>=0){
...
```
)
* рядом с полем ввода суммы для вывода добавил .00 
