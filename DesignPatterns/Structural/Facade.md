## 外观模式

### 意图

为子系统中的一组接口提供一个一致的界面，Facade模式定义了一个高层接口，这个接口使得这一子系统更加容易使用。

### 适用性

* 当你要为一个复杂子系统提供一个简单接口时。
* 客户程序与抽象类的实现部分之间存在着很大的依赖性。
* 当你需要构建一个层次结构的子系统时，使用Facade模式定义子系统中每层的入口点。

### 参与者

* Facade
  * 知道哪些子系统类负责处理请求。
  * 将客户的请求代理给适当的子系统对象。
  
* Subsystem Classes
  * 实现子系统的功能。
  * 处理由Facade对象指派的任务。
  * 没有Facade的任何相关信息，即没有指向Facade的指针。

### 协作

* Facade将客户的请求代理给适当的子系统对象。客户并不知道子系统对象，对于客户来说，子系统对象可能是不存在的。

### 效果

* 它对客户屏蔽了子系统组件，因而减少了客户处理的对象数目并使得子系统使用起来更加容易。
* 它实现了子系统与客户之间的松耦合关系，这使得子系统的组件变化不会影响到调用它的客户类，只需要调整Facade类即可。
* 如果应用需要，它并不限制你使用一个子系统类。
### 实现

**说明：**

当你通过电话订购一家餐馆的外卖时，你不需要知道餐馆的厨师、服务员、送餐员是谁，你只需要和餐馆的接待员打电话，告诉她你想要什么菜，她就会帮你完成订餐的过程。这里的餐馆就是一个子系统，而接待员就是外观类。

见 [Facade-demo](Facade-demo)

> Facade - 外观类 - 餐馆接待员

```php
<?php

class Facade
{
    protected Chef $chef;

    protected Waiter $waiter;

    protected Deliver $deliver;

    public function __construct()
    {
        $this->chef = new Chef();
        $this->waiter = new Waiter();
        $this->deliver = new Deliver();
    }

    public function order(string $food): void
    {
        $this->waiter->takeOrder($food);
        $this->chef->cook($food);
        $this->deliver->deliver($food);
    }

}
```

> Subsystem Classes - 子系统类 - 厨师、服务员、送餐员

```php
<?php

class Waiter
{
    public function takeOrder($food)
    {
        echo "服务员：好的，我去告诉厨师您要{$food}。\n";
    }
}

class Chef
{
    public function cook($food)
    {
        echo "厨师：好的，我去做{$food}。\n";
    }
}

class Delivery
{
    public function deliver($food)
    {
        echo "送餐员：好的，我去送{$food}。\n";
    }
}
```

> Client - 客户端 - 外卖客户

```php

<?php

$facade = new Facade();

$facade->order("满汉全席");
```

效果：

```
服务员：好的，我去告诉厨师您要满汉全席。
厨师：好的，我去做满汉全席。
服务员：好的，我去送满汉全席。
```