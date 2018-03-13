# Systém pro evidenci projektů
Jednoduchý systém pro evidenci projektů, který je implementovaný ve frameworku Laravel.

# Technické údaje

## Běhové prostředí pro Laravel 5.5
+ PHP >= 7.0.0
+ OpenSSL PHP Extension
+ PDO PHP Extension
+ Mbstring PHP Extension
+ Tokenizer PHP Extension
+ XML PHP Extension


## Instalace na server

1. Naklonování GIT repozitáře nebo stažení releasu aplikace

2. Inicializace projektu
Je potřeba stáhnout balíčky třetích stran nutné pro chod systému pomocí nástroje composer, který musí být na serveru nainstalován.
Pokud instalujete na produkční server, přidejte flag **--no-dev**

V příkazové řádce spusťte příkaz:
```
composer install
```

3. Konfigurace virtualhostu
```
<VirtualHost *:80>
    ServerName projekty.localhost
    DocumentRoot  "{CESTA_K_PROJEKTU}/public"

    <Directory "{CESTA_K_PROJEKTU}/public">
        Options Indexes Multiviews FollowSymLinks
        RewriteEngine On

        RewriteCond %{REQUEST_FILENAME} !-d
        RewriteCond %{REQUEST_FILENAME} !-f
        RewriteRule ^ index.php [L]

        Require all granted
        Order allow,deny
        Allow from all
    </Directory>
</VirtualHost>
```

4. Kontrola konfigurace apache a jeho restart
Na Debian-like distribucích lze využít následujících příkazů:
```
apache2ctl -t
service apache2 restart
```
V případě, že první příkaz odhalí chyby nepokračujte, dokud tyto chyby nebudou vyřešeny.

5. Přejmenování .evn.example na .env a vyplnění potřebných konfiguračních položek

6. Vygenerování aplikačního klíče pro Laravel
```
php artisan key:generate
```

7. Založení databáze
Pro správný běh aplikace je třeba založit databázi v phpMyAdminu nebo jiném srovnatelném nástroji, která má porovnání utf8mb4_unicode_ci.

8. Výchozí inicializace databáze
```
php artisan migrate
php artisan db:seed
```