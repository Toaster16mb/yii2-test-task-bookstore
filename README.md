**Первый запуск в dev-коружении:** 

`chmod +x init.sh && ./init.sh` (подождать пока отработает composer)

Миграция:

`chmod +x migrate.sh && ./migrate.sh`

Создание юзера:

`chmod +x create_admin.sh && ./create_admin.sh`

Запуск:

`chmod +x start_dev.sh && ./start_dev.sh`


Dev-стенд доступен по адресу http://localhost:8080

Отправка SMS по крону: `chmod +x send_sms.sh && ./send_sms.sh`

Чтобы подробнее понять что и как работает, достаточно посмотреть содержимое .sh-файлов :)
