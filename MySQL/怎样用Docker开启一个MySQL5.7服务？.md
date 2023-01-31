> 默认Docker已经安装好

## 拉取镜像

`docker pull mysql:5.7`

其中 `mysql`代表镜像名，`5.7`代表版本号（tag）

## 查看拉取的镜像

`docker images`

```bash
REPOSITORY      TAG         IMAGE ID       CREATED         SIZE
mysql           5.7         9ec14ca3fec4   3 days ago      455MB
```

## 启动容器

[启动命令文档](https://docs.docker.com/engine/reference/commandline/run/)

```bash
docker run --name mysql5.7 -e MYSQL_ROOT_PASSWORD=123456 -d -i -p 3306:3306 mysql:5.7

# -e 指定容器内的环境变量KEY的值为 value
# --name 给容器起个名
# -d 在后台运行容器并打印容器 ID
# -i 即使未连接，也保持 STDIN 打开
# -p 将容器的端口映射到主机 左外右内
```

## 查看容器

```bash
# 查看所有状态的容器
docker ps -a

# 查看运行状态的容器
docker ps
```

## 进入容器

```bash
docker exec -it mysql5.7 bash
# -it -i和-t 的简写

#-t 用于将 bash 进程附加到我们的终端

#-i 用于能够通过 STDIN 发送输入，例如使用键盘发送到容器中的 bash

# 没有 -i 可以用于不需要输入的命令。如果您不想将 docker 容器进程附加到您的 shell，则可以不使用 -t 和 bash。

```

## 登录

```bash
mysql -u root -p
# 然后输入密码 123456 即可登录成功
```

## 挂载

如果不小心删除了容器，数据信息会被丢失掉，没关系，使用挂载。

## 删除容器

`docker rm 容器id`

## 删除镜像

`docker rmi 镜像id`