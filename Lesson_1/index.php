<?php
//1. Придумать класс, который описывает любую сущность из предметной области интернет-магазинов:
//продукт, ценник, посылка и т.п.
//2. Описать свойства класса из п.1 (состояние).
//3. Описать поведение класса из п.1 (методы).
//4. Придумать наследников класса из п.1. Чем они будут отличаться?

class Item {
    private $id;
    private $name; // наименование
    private $price; // цена
    private $info; // описание

    function getId () {
        return $this->id;
    }
    function setId ($id) {
        $this->id = $id;
    }
    function getName () {
        return $this->name;
    }
    function setName ($name) {
        $this->name = $name;
    }
    function getPrice () {
        return $this->price;
    }
    function setPrice ($price) {
        $this->price = $price;
    }
    function getInfo () {
        return $this->info;
    }
    function setInfo ($info) {
        $this->info = $info;
    }

    function __construct($id, $name, $price, $info) {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->info = $info;
    }

    function show() {
        echo "<h2>$this->name</h2><div class=\"id\"> Артикул: $this->id</div><p>Информация о товаре: $this->info</p><div class=\"price\">Цена: $this->price руб.</div>";
    }
}

$item1 = new Item(1, "T-short", 333, "T-short with logo");
$item1->show();



//5. Дан код:
//class A {
//    public function foo() {
//        static $x = 0;
//        echo ++$x;
//    }
//}
//$a1 = new A();    создается объект
//$a2 = new A();    создается объект
//$a1->foo();   =1 выполняется метод первого объекта
//$a2->foo(); =2 так как переменная $x статична для всего класса / выполняется метод во втором объекте
//$a1->foo(); =3 еще раз выполняется метод в первом объекте
//$a2->foo(); = 4 еще раз выполняется метод во втором объекте
//Что он выведет на каждом шаге? Почему?
//    Немного изменим п.5:
//class A {
//    public function foo() {
//        static $x = 0;
//        echo ++$x;
//    }
//}
// создается класс B наследующий от класса А
//class B extends A {
//}
//$a1 = new A();
//$b1 = new B();
//$a1->foo(); =1 выполняется метод класса A
//$b1->foo(); =1 у кадлого класса своя статическая переменна, выполняется метод класса B
//$a1->foo(); =2 еще раз выполняется метод А
//$b1->foo(); =2 еще раз выполняется метод В