# VUT_FIT_IIS_projekt
 zadanie: Studentské turnaje

Instalace

softwarové požiadavky (Laravel 9, PHP 8.1, Composer) - knižnice totožné zo serverom eva.fit.vutbr.cz

postup:
 - vložiť súbory do cieľového priečinka
 - v priečinku iis_studentske_turnaje - príkaz "php artisan install"
 - nastaviť skrytý súbor ".env" - nastaviť adresu stránky a databázu
 - presunutie priečinka public do verejného priečinku
 - nastavenie public/index.php - pridať cestu k spustitelným súborom
 - v priečinku iis_studentske_turnaje - príkaz "php artisan migrate --seed" - vytvorí a naplní tabulky v databáze