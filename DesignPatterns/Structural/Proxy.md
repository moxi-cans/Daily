## 代理模式

### 意图

> 为其他对象提供一种代理以控制对这个对象的访问。

### 适用性

* 远程代理（Remote Proxy）
    * 为一个对象在不同的地址空间提供局部代表。
* 虚拟代理（Virtual Proxy）
    * 根据需要创建开销很大的对象。
* 保护代理（Protection Proxy）
    * 控制对原始对象的访问。保护代理用于对象应该有不同的访问权限的时候。
* 智能指引（Smart Reference）
    * 取代了简单的指针，它在访问对象时执行一些附加操作。

### 参与者

* Proxy
    * 保存一个引用使得代理可以访问实体。
    * 提供一个与Subject的接口相同的接口，这样代理就可以用来代替实体。
    * 控制对实体的存取，并可能负责创建和删除它。
    * 其他功能依赖于代理的类型：
        * 远程代理（Remote Proxy）负责编码一个请求，并向不同地址空间中的实体发送已编码的请求。
        * 虚拟代理（Virtual Proxy）可以缓存实体的附加信息，以便延迟对它的访问。
        * 保护代理（Protection Proxy）检查调用者是否具有实现一个请求所必须的访问权限。
* Subject
    * 定义Proxy和RealSubject的共用接口，这样就在任何使用RealSubject的地方都可以使用Proxy。
* RealSubject
    * 定义Proxy所代表的实体。

### 效果

* Remote Proxy 可以隐藏一个对象存在于不同地址空间的事实。
* Virtual Proxy 可以进行资源消耗较大的对象的延迟加载。
* Protection Proxy 允许对一个对象的访问进行更细粒度的控制。

### 实现

#### 远程代理

**说明：**

电脑桌面的快捷方式就是一个远程代理，它指向一个远程的文件或者程序。

见[RemoteProxy-demo](Proxy/RemoteProxy-demo)

**代码：**

> AbstractDesktopFile (抽象主题角色)

```php
<?php

abstract class AbstractDesktopFile
{
    abstract public function execute();
}
```

> RealDesktopFile (真实主题角色)

```php
<?php

declare(strict_types=1);

require_once "AbstractDesktopFile.php";

class RealDesktopFile extends AbstractDesktopFile
{
    protected string $fileName;

    public function __construct(string $fileName)
    {
        $this->fileName = $fileName;
    }

    public function execute(): void
    {
        echo "Executing {$this->fileName} file" . PHP_EOL;
    }
}
```

> DesktopFileProxy (代理主题角色)

```php
<?php

declare(strict_types=1);

require_once "AbstractDesktopFile.php";

require_once "RealDesktopFile.php";

class DesktopFileProxy
{
    protected AbstractDesktopFile $desktopFile;

    protected string $fileName;

    public function __construct(string $fileName)
    {
        $this->fileName = $fileName;
    }

    public function execute(): void
    {
        if (!isset($this->desktopFile)) {
            $this->desktopFile = new RealDesktopFile($this->fileName);
        }
        $this->desktopFile->execute();
    }
}
```

> Client (客户端)

```php
<?php

require_once "DesktopFileProxy.php";

$desktopFileProxy = new DesktopFileProxy('QQ.exe');
$desktopFileProxy->execute();
```


