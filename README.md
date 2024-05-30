Please follow the steps

git clone https://github.com/jenifa-p/sparkout.git
cd sparkout
git checkout master
git pull origin master

Go To Root Dorectory
composer install
npm install
php artisan config:cache
php artisan migrate
php artisan db:seed
php artisan serve
For admin login - mailID : admin@gmail.com
PW: Welcome@123
Create project manager and member using register form


