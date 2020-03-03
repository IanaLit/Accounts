<?php
/*Нужно реализовать интерфейс для создания аккаунтов клиентов. 
 
Необходимый функционал:
1) Добавление аккаунта
2) Редактирование аккаунта
3) Удаление аккаунта
4) Список аккаунтов. 
Выводить по 10 аккаунтов на странице, с постраничной навигацией (pagination) 
5) У аккаунта должны быть поля: first name, last name, email, company name, position, 3 поля для добавления телефона. 
6) First name, last name, email - обязательные поля для заполнения. Остальные поля не обязательные. 
 
 Тестовое задание должно быть реализовано на php + html + css (javascript на Ваше усмотрение). База данных - MySQL. В папке с тестовым заданием должен быть .sql файл со схемой базы данных. 
При выполнении тестового задания хочется увидеть ваши знания ООП. При оценке тестового задания будут учитываться не только ваши знания php, но и оформление кода (форматирование кода, комментарии). 
 
 Тестовое задание надо выполнить в течении 5-ти дней. Результат отправить на эту почту. Если у вас возникнут какие-то вопросы, или вы по какой-то причине не будете/не успеваете выполнить тестовое задание - пожалуйста сообщите мне.
*/

// Фронт-контроллер

//автозагрузка классов
spl_autoload_register(function (string $className) {
    require_once __DIR__  .'/'. $className . '.php';
});

//настройка маршрутизации

$route = $_GET['route'] ?? '';
$routes = require __DIR__ . '/Account/routes.php';

$isRouteFound = false;
foreach ($routes as $pattern => $controllerAndAction) {
    preg_match($pattern, $route, $matches);
    if (!empty($matches)) {
        $isRouteFound = true;
        break;
    }
}

if (!$isRouteFound) {
    echo 'Страница не найдена!';
    return;
}

unset($matches[0]);

$controllerName = $controllerAndAction[0];
$actionName = $controllerAndAction[1];

$controller = new $controllerName();
$controller->$actionName(...$matches);



            
                
        

