# export
1. instalation
```
composer require kematjaya/export
```
2. render HTML to PDF
```
use Kematjaya\Export\Manager\ExportManager;
use Kematjaya\Export\Processor\PDF\DOMPDFProcessor;
....

$data = '<h1>test pdf</h1>';
$manager = new ExportManager();
$doc = $manager->render($data, new DOMPDFProcessor('doc.pdf'));
```

3. render HTML to Excel
```
use Kematjaya\Export\Manager\ExportManager;
use Kematjaya\Export\Processor\Excel\HtmlToExcel;
....

$data = '<h1>test pdf</h1>';
$manager = new ExportManager();
$excel = $manager->render($data, new HtmlToExcel('doc.xls'));
```
4. render array to excel
```
use Kematjaya\Export\Manager\ExportManager;
use Kematjaya\Export\Processor\Excel\PHPSpreadsheetProcessor;
....

$data = [
    ['a', 'b', 'c']
];
$manager = new ExportManager();
$excel = $manager->render($data, new PHPSpreadsheetProcessor());
```