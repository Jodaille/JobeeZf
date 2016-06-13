# JobeeZf
Jobee with Zend Framework:
process and display datas from hive sensors and log files

## Import temperatures values from CSV
```sh
php public/index.php readcsv ~/LyceeDesAndaines/JOURNAL_Ruche_essaimage.CSV
```

## Import voltage, temperature from log file

```sh
php public/index.php readlog arduino.log
```
## Display temperatures

Using http://www.chartjs.org/


http://jobeezf.local/temperature
