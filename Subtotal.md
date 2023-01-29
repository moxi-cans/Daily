# 踩坑记录

## PHP-CS-Fixer

* 版本2不允许添加类注解

## 查询条件

page_size的条件必须是“整形、大于等于0”的

page的验证条件必须是“整形、大于等于1”的，不能等于0，因为offset的计算方程是($current_page - 1) * $pageSize，如果传入0，经过计算是个负数，但是mysql查询时，offset是不允许为负的，我们使用模型方法offset()时，这个方法会自动对该参数进行修复：

```php
/**
     * Set the "offset" value of the query.
     *
     * @param int $value
     * @return $this
     */
    public function offset($value)
    {
        $property = $this->unions ? 'unionOffset' : 'offset';

        $this->{$property} = max(0, $value);

        return $this;
    }
```

所以虽然也可以传0进去，但是传0和传1得到的数据是一致的，未免会造成一定程度上的误导，所以我们规定page的最小值为1.

## 验证器

有关于数据库的验证器，如果有批量，最好是不要在验证器进行验证，批量查询验证即可

## 验证数组中是否没有某个值

方法很多，可以用array_diff

## 返回的数据格式

返回的数据字段必须是统一的。

举个例子，当你传入a字段时，该字段才会被查询出来，不传的话，你必须也返回该字段，可以把该字段的值设置为"".