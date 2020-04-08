<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Yii 2 Basic Project Template</h1>
    <br>
</p>

Yii 2 Basic Project Template is a skeleton [Yii 2](http://www.yiiframework.com/) application best for
rapidly creating small projects.

## Info

* Yii 2.0.34
* PHP >= 7.3
* MariaDB >= 10.3.22 or MySQL >= 5.7
* Nginx >= 1.14 (PHP-FPM)
* Vagrant

## Установка

##### Вариант 1
```
$ git clone https://github.com/DenisKaNik/yii2-billing.git
$ cd yii2-billing
$ composer install
```

* Создать БД `yii2_billing_db`
* Скопировать `.env.example` в `.env` и прописать нужные реквизиты для подключения к БД

Запустить миграции
```
$ ./yii migrate
```

Наполнить БД первичными данными
```
$ ./yii fixture/load '*' --namespace='fixtures'
```

Конфигурационный файл для Nginx взять из `vagrant/nginx/app.conf`

##### Вариант 2
Предварительно установить VirtualBox, vagrant
```
$ git clone https://github.com/DenisKaNik/yii2-billing.git
$ cd yii2-billing
$ vagrant up
```

Либо предварительно перед `vagrant up` скопировать `vagrant/config/vagrant-local.example.yml` 
в `vagrant/config/vagrant-local.yml` и указать персональный GitHub token, либо после вывода сообщения
*You must place REAL GitHub token into configuration* прописать персональный GitHub token
в `vagrant/config/vagrant-local.yml` и повторно запустить команду:
```
$ vagrant up
```

И после открыть в браузере http://yii2-billing.loc

##### Особенность

Странца отчёта показывается после нажатия на кнопку "Submit" в форме "Search".