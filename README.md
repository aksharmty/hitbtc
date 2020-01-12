# hitbtc Auto Trading bot
Auto trading bot for hitbtc in php
This is auto trading bot for hitbtc.com using api in php.
For this bot you need hitbtc api key and sercet key with php and 3 cron job.

I am creating This bot for DOGEBTC PAIR.  
Bot automatic fetch BTC balance and calculate doge quantity for order then place buy order on bid place and store data in trade table in database.
Bot also fetch DOGE balance and place sell order if data available in trade table. 

you can run this hitbtc auto trading bot on cpanel sharing hosting
This is a <b>DOGEBTC</b> hitbtc auto trading bot. 
Istallation :
1.Download all file and upload all file on your server. 
2.edit connect.php  with your database details.
3.change api_key and secret_key in all file (balance.php , dogebtcorder.php , dogeusdorder.php , orderlist.php ).
4.upload hitbtc.sql in your database
5.create 3 cron job
 a. first cron job for balance.php set every minute ( This cron job update your balance in your database ).
 b. second cron job for dogebtcorder.php set every 2 minutes ( This cron job place order ).
 c. Third cron job for orderlist.php set every minute ( This cron job update all oderslist table in database. No need this cron job 
    if you not want to show all order list on your bot )
 you )

 Requirement :

<a href="https://shop.sakhihosting.in/web-hosting/index.php"> hosting account I used hosting from sakhihosting </a> or localhost xamp server ( if possible you can run your computer 24 hours ) php and cron job hitbtc apikey and secret key

buy order place on bid price and sell order place on bid +0.3% .

<b>I am not a finacial advisorise , I have created this bot for my personal use.You can use this bot at own risk</b>
