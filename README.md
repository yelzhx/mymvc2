# mymvc2
фреймворк на PHP
-----------------------------------
Скрипт для базы данных лежит в db_mymvc.sql
БД необходимо назвать db_mymvc,
либо поменять настройки в файле mymvc/config/config.php:
изменить Config::set('db.db_name','здесь название БД');
файлы приложения необходимо вставить непосредственно в root директорию,
либо произвести настройки в файлах C:\Windows\System32\drivers\etc\host и
конфигурационном файле apache.
в базе есть 1 пользователь, имя пользователя user1, пароль 123456
---
изменения:
-----------------------------------
убрал ?> в конце файлов
через composer загрузил monolog
использовал пространства имен
убрал возможность увести баланс в минус
при выполнении sql запросов использовал параметры
использовал session_write_close() после записи в сессию. 
а также после подключения к mysql через PDO. Выходила ошибка, видимо 
блокировалась запись в сессию.
