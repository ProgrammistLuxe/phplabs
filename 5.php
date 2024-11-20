<?php
class Collection implements IteratorAggregate
{
    private $items = [];

    public function __construct(array $items = [])
    {
        $this->items = $items;
    }

    public function add($item)
    {
        $this->items[] = $item;
    }

    public function getItems()
    {
        return $this->items;
    }

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->items);
    }
}


$collection = new Collection();
$collection->add('Первый элемент');
$collection->add('Второй элемент');
$collection->add('Третий элемент');

?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вывод элементов коллекции</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 0;
            background-color: #f5f5f5;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            background: #ffffff;
            margin: 5px 0;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
    </style>
</head>

<body>

    <h1>Элементы коллекции</h1>
    <ul>
        <?php foreach ($collection as $item): ?>
            <li><?php echo htmlspecialchars($item); ?></li>
        <?php endforeach; ?>
    </ul>

</body>

</html>