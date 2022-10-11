# Clone repository
git clone https://github.com/Dheerajzxx/create-pages.git

# Composer install
composer install

# Create env file and generate key
cp .env.example .env
php artisan key:generate

# Create new database in phpMyadmin
create_pages

# Run migration
php artisan migrate

# Run laravel code at port 8000
php artisan serve --port=8000 

# Open new terminal and Open vue directory
cd vue

# Install npm
npm install

npm run dev

