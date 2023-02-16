# 前言

相信小伙伴都接到过一些小需求： “把xxx导出到excel表”。为了一劳永逸，不再为了这类小需求抠脑袋，我决定专门建个脚本库。

这是第一个小脚本，利用PHP将数据保存为excel表。

# 小试牛刀

首先，我们肯定选了github上面，star 最多的excel轮子：“PHPOffice/PhpSpreadsheet”

先来个简单的小需求，小试牛刀：

（怎么创建一个项目、composer 初始化、安装小轮子我们就不讲了哈，可百度）

> 需求： 将数据的key作表头，逐行逐列的导出到excel表里面。

```php
<?php

/**
* 生成excel
*/
<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class excelUtil
{
    public static function generateExcel(array $data, string $filePath): string
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        // 设置表头
        $keys = array_keys($data[0]);
        foreach ($keys as $column => $key) {
            $sheet->setCellValueByColumnAndRow($column + 1, 1, $key);
        }
        // 填充数据，从第二行开始
        $row = 2;
        foreach ($data as $item => $v) {
            // 从第一列开始填充数据
            $col = 1;
            foreach ($v as $a => $value) {
                // value的类型若为数组，则转为json
                if(is_array($value)) {
                    $value = json_encode($value);
                }
                $sheet->getCellByColumnAndRow($col++, $row)->setValue($value);
            }
            $row++;
        }

        // 保存到文件中
        $writer = new Xlsx($spreadsheet);
        $writer->save($filePath);
        return $filePath;
    }
}
```

调用上面写的方法，造一点数据去测试：

```php
<?php

require __DIR__.'/vendor/autoload.php';
require 'excelUtil.php';

$array = []; // 数据可以自己伪造哈，一个简单的二元数组即可

excelUtil::generateExcel($array, '2022届1班.xls');
```

效果：

![image](https://github.com/moxi-xi/cans/blob/main/Experience/exportTest1.png)

# 难度+1

在上面，我们直接把数据全部导出了，加点难度。

> 需求： 从数据中筛选出几列数据导出到excel表，并且自定义表头。

Ps: 表头与数据有关联关系，且数据的顺序是乱的。


