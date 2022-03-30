This is a premier league simulator app, built in Laravel 9.

- It is a simulation for a group of 4 teams that play for 6 weeks
- Each team faces other 3 teams twice (once as home and once as away)
- The application can simulate matches (2 matches) per week
- One can also use 'Play All' button to simulate all 6 weeks at once
- It also provides 'Predictions Of Championship' for every team (updated after every week simulation)
- There is also 'Reset All' button to reset all match scores, team standings and predictions

# Steps

1. clone project
2. Run: `cp .env.example .env`
3. Run:
`docker run --rm -u "$(id -u):$(id -g)" -v $(pwd):/var/www/html -w /var/www/html laravelsail/php81-composer:latest composer install --ignore-platform-reqs`
4. Run: `alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'` (to have sail on Bash)
5. Run: `sail up`
6. Create `premier_league_db` and `premier_league_db_test` (for test) databases ( Host: 127.0.0.1, Username: root )
7. Run: `sail artisan migrate --seed` and `sail artisan migrate --seed --env=testing` (for test)
8. To checkout the app: visit `http://0.0.0.0:80`
9. To run tests: `sail artisan test`
