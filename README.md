Here is how you can run the project locally:
1. Clone this repo
    ```sh
    git clone https://github.com/ChaitraHM/Banking-System.git
    ```

1. Go into the project root directory
    ```sh
    cd Banking-System
    ```

1. Copy .env.example file to .env file
    ```sh
    cp .env.example .env
    ```
1. Create database `banking_system`

1. Go to `.env` file 
    - set database credentials (`DB_DATABASE=banking_system`, `DB_USERNAME=root`, `DB_PASSWORD=`)
    > Make sure to follow your database username and password

1. Install PHP dependencies 
    ```sh
    composer install
    ```

1. Generate key 
    ```sh
    php artisan key:generate
    ```

1. install front-end dependencies
    ```sh
    npm install && npm run build
    ```

1. Run migration
    ```
    php artisan migrate
    ```

1. Run server
    ```sh
    php artisan serve
    ```  

1. Visit `localhost:8000` in your favorite browser.     

    > Make sure to follow your Laravel local Development Environment.