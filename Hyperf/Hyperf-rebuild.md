## 从零构建一个Hyperf框架

### 背景

参加了公司大佬组织的“超级码力”课堂，在大佬的带领下从头构建了一次Hyperf，并对“框架是什么”这个问题进行了思考和探讨，于是有了这一次复盘。

### 小思考

#### 什么是框架
提供解决某个领域问题的基础能力

#### 什么是好的框架
- 有丰富的文档
- 有繁荣的社区
- 有良好的可扩展性
- 有良好的性能
- 有良好的稳定性
- 有良好的可维护性
- 有良好的可测试性
- 易于上手
- ...
#### 什么是好的框架的必备功能
...

### 构建过程

#### 1. 项目初始化

```bash
composer init
```

#### 2. 入口文件

所谓的入口文件，就是项目启动的入口。运行这个文件，就可以初始化项目、开启一个服务，然后等待请求等等。

此处我们使用`Swow`作为我们的网络引擎，因此首先引入他的composer包。

`composer require swow/swow:dev-develop`

在入口文件中，我们需要做以下几件事：
+ 引入`vendor/autoload.php`，自动加载我们的类
+ 开启一个服务，监听一个端口
+ 等待请求
+ 处理请求
+ 返回响应

```php
<?php

require "vendor/autoload.php";

// 开启一个swow服务

$port = 9777;
$host = '0.0.0.0';

$server = new \Swow\Http\Server();

$server->bind($host, $port);
$server->listen();

// 当接收到连接时
while ($connection = $server->acceptConnection()) {
    $request = $connection->recvHttpRequest();
    var_dump($request);
    // 返回一条信息
    $connection->respond("哈喽，收到喽\n");
}
```

#### 3. 启动命令

在日常开发中，启动项目的命令是`php bin/hyperf.php start`，构建它。

通过了解，命令是通过 [Symfony](https://symfony.com/doc/4.2/components/console.html)  的`Console`组件实现的，因此我们需要引入`symfony/console`的composer包。

`composer require symfony/console`

##### 3.1 创建命令

在`src/Command`目录下创建`StartServer.php`文件，内容如下：

```php
<?php

declare(strict_types=1);

namespace Rebuild\Command;

use Symfony\Component\Console\Command\Command;

class StartServer extends Command
{
    protected function configure()
    {
        $this->setName('start');
    }

    protected function execute($input, $output)
    {
        // 开启一个swow服务

        $port = 9777;
        $host = '0.0.0.0';

        $server = new \Swow\Http\Server();

        $server->bind($host, $port);
        $server->listen();
        $output->writeln('服务启动成功');

        // 当接收到连接时
        while ($connection = $server->acceptConnection()) {
            $request = $connection->recvHttpRequest();
            var_dump($request);
            // 返回一条信息
            $connection->respond("哈喽，收到喽\n");
        }
    }
}
```

##### 3.2 在入口文件中注册命令

```php
<?php

use Rebuild\Command\StartServer;
use Symfony\Component\Console\Application;

// 定义BASE_PATH，根目录
! defined('BASE_PATH') && define('BASE_PATH', dirname(__DIR__, 1));

// 实现自动加载
require BASE_PATH . "vendor/autoload.php";

$application = new Application();
// 注册命令
$application->add(new StartServer());
// 运行命令
$application->run();
```

此时，我们可以通过`php bin/hyperf.php start`启动我们的项目了。

#### 4. 配置文件

在上面的例子中，我们直接在代码中写死了`port`等信息，如果我们需要修改这些信息，就需要修改代码，这样就不太好了。

因此，我们需要将这些信息放到配置文件中，然后在代码中读取配置文件。

##### 4.1 创建配置文件

在`config`目录下创建`config.php`文件，内容如下：

```php
<?php

return [
  'server' => [
    'port' => 9777,
  ]
];
```

##### 4.2 读取配置文件

在`StartServer.php`中，我们需要读取配置文件，然后使用配置文件中的信息。

```php
// 读取配置文件
$config = require BASE_PATH . '/config/config.php';

// 开启一个swow服务
$port = $config['server']['port'];

```

#### 5. 路由

