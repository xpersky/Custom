# Custom Magento 2.3.5 Module

Uses https://openweathermap.org/api to provide weather information in Lublin  
Cron runs its schedule every 10 minutes to fetch actual weather information  
Weather information is displayed in the footer  
Historical weather data can be accessed from Magento admin backend  

To initialize:  
git clone this repo into app/code  

php bin/magento setup:upgrade  
php bin/magento setup:di:compile  
php bin/magento cron:run  
php bin/magento cache:clean  
php bin/magento cache:flush  
