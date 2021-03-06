This is a premier league simulator app, built in Laravel 9.

- It is a simulation for a group of 4 teams that play for 6 weeks
- Each team faces other 3 teams twice (once as home and once as away)
- The application can simulate matches (2 matches) per week
- One can also use 'Play All' button to simulate all 6 weeks at once
- It also provides 'Predictions Of Championship' for every team (updated after every week simulation)
- There is also 'Reset All' button to reset all match scores, team standings and predictions

# Steps

1. Clone project
2. Go inside project directory
3. Run: `cp .env.example .env`
4. Run:
`docker run --rm -u "$(id -u):$(id -g)" -v $(pwd):/var/www/html -w /var/www/html laravelsail/php81-composer:latest composer install --ignore-platform-reqs`
5. Run: `alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'` (to have sail on Bash)
6. Run: `sail up`
7. Create `premier_league_db` and `premier_league_db_test` (for test) databases ( Host: 127.0.0.1, Username: root )
8. Run: `sail artisan migrate --seed` and `sail artisan migrate --seed --env=testing` (for test)
9. Run: `sail artisan key:generate`
10. To checkout the app: visit `http://0.0.0.0:80`
11. To run tests: `sail artisan test`

# Preview
![image](https://user-images.githubusercontent.com/15964741/160781654-f7a27a5e-22dc-4d11-a92b-5bfafd545c5f.png)
