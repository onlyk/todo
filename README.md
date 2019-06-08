Чеклист: 
1. Git
2. Composer
3. OOP
4. UID
5. DTO 
6. Controller 
7. Data Hinting
8. Named Constructors
9. Router->Controller->Service(->entity)->Repository->DB
10. Обработка ошибок 

TODO:
1. Отрефакторить текущий код для правильной передачи ошибок и ответов
2. Добавить сервис Validator
3. Тайпхинты
+4. Добавить директории

task.php

Валидация
DTO между слоями
Обработка ошибок
Тайпхинты 1/2
переписать entity.
директорий не хватает.

собсно у тебя целиком ответ от сервера неоч.
почему даже с ошибкой статус всегда будет 200?
почему часть ошибок вообще неадекватна? (запроси таску с несуществующим юидом)
п

Валидатор
Обработка ошибок

1. Entity на всех этапах отдает DTO? 


8-10 vegetable
grain 8 
milk 2
meat 3


https://github.com/LeCockk/ToDoList/blob/master/src/Connect/Config.php#L27

не парсь конфиг на каждый запрос. сделай это в конструкторе один раз и схорони в свойство объекта.

https://github.com/LeCockk/ToDoList/blob/master/src/Connect/Connect.php#L11

посмотри на тему DI (Dependency Injection), не стоит хардкодить использование одних классов внутри других. и не только здесь, касательно всех зависимостей. в т.ч. у репы, сервиса и контроллера.

https://github.com/LeCockk/ToDoList/blob/master/src/Validation/Validator.php#L28

константы спасут мир

https://github.com/LeCockk/ToDoList/blob/master/src/ResultConst.php

просто дичь.
класс слишком о многом знает, о него слишком много причин для изменения. гугли букву S из SOLID.
решение: распихать ошибки по тем местам, где ты это дергаешь.

https://github.com/LeCockk/ToDoList/blob/master/src/Task.php

зачем константы публичные?
и прекратите скаляры с большой буквы писать (String => string). гуглить PSR по поводу кодстайла.

https://github.com/LeCockk/ToDoList/blob/master/src/TaskService.php#L171

сервис не должен знать про http коды.

в остальном норм, жить можно.