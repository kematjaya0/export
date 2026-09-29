# export
Branch `6.4`: Symfony 6.4, PHP >= 8.1.

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

$data = '<table><tr><td>test excel</td></tr></table>';
$manager = new ExportManager();
$excel = $manager->render($data, new HtmlToExcel('doc.xlsx'));
```
4. render array to excel
```
use Kematjaya\Export\Manager\ExportManager;
use Kematjaya\Export\Processor\Excel\SpreadsheetFromArrayProcessor;
....

$data = [
    ['a', 'b', 'c']
];
$manager = new ExportManager();
$excel = $manager->render($data, new SpreadsheetFromArrayProcessor('data.xlsx'));
```

## Test
```
sh docker/test.sh all
EXTRA_REQUIRE="phpoffice/phpspreadsheet:^1.29 ticketpark/htmlphpexcel:^1.1" sh docker/test.sh 8.1 6.4
```
