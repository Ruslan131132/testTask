## Тестовое задание

Страница создания заказа должна содержать форму с 4-мя полями: ФИО, Комментарий клиента, Артикул товара, Бренд товара. При отправке формы должен создаваться заказ в RetailCRM (описание API и ключ ниже), можно написать своё решение, можно использовать сторонние пакеты.
Заказ должен создаваться со следующими полями:
Статус заказа: trouble
Тип заказа: fizik
Магазин: test
Способ оформления: test
Номер заказа: дата вашего рождения, например 8051987
ФИО: ваши фио
Товар:
артикул AZ105W
бренд Azalita
Название Маникюрный набор Solingen, 3 пр., белый футляр


## Описание выполненного задания

Сверстал страницу /order. Для создания заказа написал контроллер OrderController, привязанный к этой странице. В контроллере два метода - create и query. query - метод для формирования GET/POST запросов. 
