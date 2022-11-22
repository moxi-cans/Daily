## 装饰模式

### 意图

动态地给一个对象添加一些额外的职责。就增加功能来说，装饰模式相比生成子类更为灵活。

### 别名

Wrapper (包装器)

### 适用性

* 在不影响其他对象的情况下，以动态、透明的方式给单个对象添加职责。
* 处理那些可以撤消的职责。
* 当不能采用生成子类的方法进行扩充时。例如，可能存在大量独立扩充，且扩充彼此之间不可知。

### 结构

![](../images/装饰模式-结构图.png)

### 参与者

* Component

  --定义一个对象接口，以规范准备接收附加责任的对象。

* ConcreteComponent

  --定义一个对象，可以给这些对象动态地添加职责。

* Decorator

  --维持一个指向Component对象的指针，并定义一个与Component接口一致的接口。

* ConcreteDecorator

  --向组件添加职责。

### 协作

* Decorator将请求转发给它的Component对象。

### 效果

#### 优点

* 比静态继承更灵活。
* 避免在层次结构高层的类有太多的特征。

#### 缺点

* 会产生许多小对象，增加了系统的复杂性。
* 装饰模式提供了一种比继承更加灵活机动的解决方案，但同时也意味着比继承更加易于出错，排错也很困难，对于多次装饰的对象，调试时寻找错误可能需要逐级排查，较为繁琐。

### 实现

**说明：**

本例中，我们假设已经有了一个可以发送邮件的通知器，但是用户希望还能有其它通知方式，比如微信通知，QQ通知等。

此时，我们可以将通知器抽象为一个接口，然后实现一个邮件通知器，然后再实现一个装饰器，用于装饰通知器，然后再实现具体的装饰器，比如微信通知器，QQ通知器等。

这时候，我们就可以通过装饰器来装饰通知器，从而实现多种通知方式。

见 [Decorator-demo](Decorator-demo)

> Component -- 通知器

```php
<?php

interface Notifier
{
    public function send($message);
}
```

> ConcreteComponent -- 邮件通知器

```php
<?php

class MailNotifier implements NotifierInterface
{
    public function send($message): void
    {
        echo "Send mail: $message" . PHP_EOL;
    }
}
```

> Decorator -- 通知器装饰器

```php
<?php

abstract class NotifierDecorator
{
    protected NotifierInterface $notifier;

    public function __construct(NotifierInterface $notifier)
    {
        $this->notifier = $notifier;
    }
}
```

> ConcreteDecorator -- 短信通知器装饰器

```php
<?php

class SmsNotifier extends NotifierDecorator
{
    public function send($message): void
    {
        $this->notifier->send($message);
        echo "Send sms: $message" . PHP_EOL;
    }
}
```

> ConcreteDecorator -- 微信通知器装饰器

```php
<?php

class WechatNotifier extends NotifierDecorator
{
    public function send($message): void
    {
        $this->notifier->send($message);
        echo "Send wechat: $message" . PHP_EOL;
    }
}
```

> Client -- 客户端

```php
<?php

$notifier = new MailNotifier();
$notifier = new SmsNotifier($notifier);
$notifier->send('Hello World!');
```

效果：

```
Send mail: Hello world
Send sms: Hello world
```



