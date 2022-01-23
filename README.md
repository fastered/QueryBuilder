# QueryBuilder
Инструмент для работы с базой данных
## Использование: 
Подключаем класс, и передаем ему объект PDO, с нужными данными для подключение к вашей базе
```php
require 'QueryBuilder.php';

$pdo = new PDO('mysql:host=127.0.0.1;dbname=university', $login, $password);

$db = new QueryBuilder($pdo);
```
## Для работы с инструментом доступны 5 методов:
### Create:
Создает новую строку, передавать ему нужно имя таблицы, и массив с данными, 
ключи которые совпадает с именами столбцов, вернет id созданной строки
```php
$id_created_user = $db->create('users', [    
      'name' => 'Константин',
      'email' => 'admin@gmail.com',
      ]);

```

### Update:
Обновляет строку таблицы, передавать ему нужно имя таблицы, массив с данными, 
ключи которые совпадает с именами столбцов, в массиве должен быть ключ id, по которому определяется какую строку нужно обновить
```php
 $db->update('users', [    
      'id' => 11,
      'name' => 'Константин',
      'email' => 'admin@gmail.com',
      ]);

```
### Delete:
Удаляет строку таблицы, передавать ему нужно имя таблицы, и  id, по которому определяется какую строку нужно удалить
```php
$db->delete('users', 11);

```

### GetAll:
Возвращает все записи из таблицы, передавать ему нужно имя таблицы
```php
$data = $db->getAll('users');

```
### GetAll:
Возвращает одну запись из таблицы, передавать ему нужно имя таблицы, id нужной нам строки
```php
$data = $db->getAll('users');
```