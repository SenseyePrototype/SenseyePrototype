# SenseyePrototype

[![Build Status](https://travis-ci.org/SenseyePrototype/SenseyePrototype.svg)](https://travis-ci.org/SenseyePrototype/SenseyePrototype)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/SenseyePrototype/SenseyePrototype/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/SenseyePrototype/SenseyePrototype/?branch=master)
[![Code Climate](https://codeclimate.com/github/SenseyePrototype/SenseyePrototype/badges/gpa.svg)](https://codeclimate.com/github/SenseyePrototype/SenseyePrototype)

##### PageSpeed Insights
* [/](https://developers.google.com/speed/pagespeed/insights/?url=senseye.com.ua)
* [/developers](https://developers.google.com/speed/pagespeed/insights/?url=senseye.com.ua/developers)

##### Development
Для создания сущностей в БД:
```bash
php bin/console doctrine:schema:update --force
```

Для создания сущностей в PHP:
```bash
php bin/console doctrine:generate:entities AppBundle --no-backup
```
