# backend

## Project Setup
<p> 
    docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs
</p>

<br>

## Putting Alias
<p>
    alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'
</p>

<br>

## Start sail command
<p>
    sail up
</p>

<br>

## Run
<p>
    http://localhost
</p>