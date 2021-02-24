
for date in 1 2 3 4 5 6 7 8 9 10 11 12 13 14 15 16 17 18 19 20 21 22 23 24 25 26 27 28
do
  echo "${date}/02/2021"
  php artisan daily_report:calculate --date="${date}/02/2021"
done
