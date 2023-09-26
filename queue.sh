echo "chay nen queue"
echo "huy queue"
pkill -f "php artisan queue:work"
echo "chay queue"
php artisan queue:restart
nohup php artisan queue:work --queue=high,default &
echo "hoan thanh chay queen"
echo " huy queue : pkill -f "php artisan queue:work"
echo " xem trang thai: ps aux | grep "php artisan queue:work"