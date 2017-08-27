## Система «вопрос – ответ»

Система «Вопрос – ответ», помогает пользователям узнать то, что они не знают. <br>
Любой пользователь может задать вопрос в системе, после проверки администратором системы или же администратором, вопрос будет опубликован на сайте, после чего любой зарегистрированный пользователь может ответить на вопрос.<br>
Система разделяет 3 типа пользователей:<br>
1.	Администратор имеет полный доступ к системе.<br>
•	Редактировать тему<br>
•	Добавлять новую тему<br>
•	Просматривать кол-во вопросов в теме, опубликованных на сайте, вопросов без ответов<br>
•	Удалять пользователей<br>
•	Изменять имя пользователей<br>
•	Менять пароль пользователей<br>
•	Редактировать права доступа пользователей<br>
•	Удалять тему со всеми вопросами и ответами относящимися к ней<br>
•	Редактировать вопросы пользователей (автора / тему /  заголовок вопроса / описание вопроса)<br>
•	Переносить вопросы в другую тему<br>
•	Отвечать на вопросы<br>
•	Модерировать вопросы (одобрять / отклонять / возвращать на модерацию)<br>
•	Добавлять новые вопросы<br>
•	Изменить свой пароль<br>
2.	Модератор имеет меньший список прав доступа, чем Администратор.
•	Отвечать на вопросы<br>
•	Добавлять новые вопросы<br>
•	Редактировать вопросы (тему /  заголовок вопроса / описание вопроса)<br>
•	Модерировать вопросы (одобрять / отклонять / возвращать на модерацию)<br>
•	Переносить вопросы в другую тему<br>
•	Изменить свой пароль<br>
3.	Пользователь имеет ограниченный список прав доступа.
•	Добавлять новые вопросы<br>
•	Отвечать на вопросы<br>
•	Редактировать свои вопросы<br>
•	Изменить свой пароль<br>


----------


## Принцип работы системы «Вопрос – ответ».

Заходя на сайт, пользователь видит список вопросов, отсортированный по группам и дате добавления (сначала новые), пользователь может «пролистнуть» список до определенной темы, кликнув на соответствующую группу с лева.<br>
Кликнув по заголовку вопроса, можно посмотреть описание вопроса, а так же ответы на этот вопрос, там же можно ответить на этот вопрос, кликнув по кнопке «Ответить».<br>
Пользователь может ответить на вопрос, авторизовавшись или зарегистрировавшись на сайте.<br>
Пользователь может добавить новый вопрос, который попадет на модерацию к администратору / модератору системы, после подтверждения, вопрос будет опубликован на главной странице системы, так же пользователь сможет просмотреть список своих вопросов и ответов по ним в личном кабинете, там же пользователь может посмотреть состояние всех своих вопросов (подтвержден, отклонен, на модерации).<br>
По умолчанию сортировка вопросов в личном кабинете идет от более поздних к ранним.<br>
Если пользователь не зарегистрирован в системе, ему будет предложено дополнительно ввести имя и email, по которым пользователь будет зарегистрирован и будет сгенерирован пароль, который можно сменить в личном кабинете, кликнув на свое имя с права и выбрать пункт «Изменить пароль».

Так же, если пользователь забыл свой пароль, он может его сбросит, для этого необходимо зайти на форму «авторизации» и нажать на ссылку «забыли пароль» (для корректной работы данной функции, на сервере должна быть настроена работа с почтой), после чего пользователь попадает на форму восстановления пароль, где необходимо ввести свой email. <br>
После чего на email будет выслана инструкция по смене пароля.


Статус вопросов делется на цвета:<br>
<strong>• Зеленый цвет текста </strong> означает что вопрос удачно прошел модерацию и опубликован на сайте.<br>
<strong>• Оранжевый цвет текста </strong> означает что вопрос находится на модерации и еще не проверен администратором / модератором системы.<br>
<strong>• Красный цвет тексты </strong> означает что вопрос не прошел модерацию, был отклонен и не будет опубликован на сайте.<br>

При отклонении вопроса, пользователь может отредактировать вопрос, тему и текст, после чего вопрос повторно попадет на модерацию.<br>
Даже если вопрос ранее был опубликован и пользователь захотел его изменить, вопрос повторно попадет на модерацию.


----------


## Установка системы
Для установки системы сначала необходимо установить PHP Composer<br>
1)	Загрузить установочный пакет:<br>
•	php -r "readfile('https://getcomposer.org/installer');" | php
2)	Загрузить сам Composer<br>
•	php composer.phar require silex/silex ~1.1<br>
После установки Composer необходимо установить зависимости Laravel<br>
•	composer install

После установки всех зависимостей, composer сгенерирует уникальный APP_KEY, который вы можете просмотреть в файле .env (если файл отсутствует его необходимо создать, скопировав .env.example) в корне проекта, если ключ не был сгенерирован, необходимо запустить генерацию ключа в ручную при помощи помощника Artisan.<br>
•	php artisan key:generate <br>
После необходимо создать базу данных. <br>
Для настройки системы необходимо изменить файл .env в корне проекта и отредактировать строки:<br>
•	DB_CONNECTION=mysql    -   тип подключения к БД<br>
•	DB_HOST=127.0.0.1   -   IP-адрес сервера базы данных<br>
•	DB_PORT=3306   -   Порт работы SQL сервера (по умолчанию 3306)<br>
•	DB_DATABASE=dbname    -   Имя базы данных<br>
•	DB_USERNAME=root   -   Имя пользователя БД<br>
•	DB_PASSWORD=root   -   Пароль пользователя БД<br>

После создания БД и настройки файла конфигурации, необходимо запустить миграции, для создания таблиц в базе данных. Для этого используем Laravel помощника Artisan.<br>
•	php artisan migrate <br>
После того как миграции были сделаны, в базе данных должны появиться таблица users, questions, themes, answers. Таблицы migrations, password_resets являются системными.<br>
Для добавления системного пользователя по умолчанию, необходимо запустить «Сиды», делает это так же при помощи помощника Artisan.<br>
•	php artisan db:seed <br>
После выполнения скрипта в базе данных появится пользователь с ролью Администратор с логином admin@local.ru и паролем admin.<br>

При необходимости наполнения тестовыми записями данных, необходимо зайти в phpMyAdmin и импортировать файл faq.sql.<br>
В проект будут загруженные тестовые данные вопросов, ответов, пользователей.

По умолчанию в системе логируется ключевые действия системы (Модерация вопросов, модерация тем, модерация пользователей).
