Clone the repository project

Copy and paste the `env.example` file and rename it to `.env`

Run this command
```
docker run --rm \
-u "$(id -u):$(id -g)" \
-v "$(pwd):/var/www/html" \
-w /var/www/html \
laravelsail/php84-composer:latest \
composer install --ignore-platform-reqs
```

Run this command
``` 
sail artisan key:generate 
```

Run this command
``` 
sail artisan migrate:fresh --seed
```

Run this command
``` 
sail npm install
```

Run this command
``` 
sail npm run dev
```

Default user
```
user: john.doe@example.com
pass: password
```

