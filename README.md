v 0.1.0

— Добавлен автоинкремент id в БД

TODO:

— DTO 
— Слой контроллера
— Подписать все типы данных
— Именованный конструкторы
— Поправить создание PDO и сделать его через конфиг(то где ты ругался "это совсем пиздец")
— юиды
— Вкинуть все набросы из вчерашнего тз
— 

собственно обновление это самое интересное.
лови две задачи, надо уметь обновлять тело задачи и помечать задачу как выполненную.
и если она выполнена - менять тело задачи нельзя.

а потом следующий наброс.
а еще её можно например отменить.
и соответственно выполненную нельзя отменить и наоборот.
и заменить тело у отмененной нельзя.
но можно вернуть её в работу.
и в целом хотелось бы разделять статусы на, например, new, in progress, canceled, done.

и, да, это вот прям живой кейс, так это и живёт.
приходит к тебе бизнес, говорит "надо закрывать задачи".
ты такой бодро делаешь булевое поле в базе (но вообще начинать надо не с базы, data driven development это антипаттерн), а потом оказывается что статусов может быть несколько. и ты сосешь жопу.


Удалить задачу
Обновить статус задачи
Вернуть задачу
Вернуть все задачи

Статусы задач: new, wip, canceled, done
