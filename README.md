# Specyfikacja

Zadanie rekrutacyjne dla GOG. Z ważnych informacji: 
- Korzystam z Laravela plus json-api 
- URL aplikacji: localhost:80
- Do uruchomienia aplikacji (za pierwszym razem): wchodzimy do folderu z apką i uruchamiamy: ```docker run --rm
  -u "$(id -u):$(id -g)"
  -v $(pwd):/var/www/html
  -w /var/www/html
  laravelsail/php81-composer:latest
  composer install --ignore-platform-reqs```, następnie kopiujemy zawartość pliku .env.example do pliku .env (należy go utworzyć w głównym folderze projektu, proszę ustawić hasło dla bazy danych obojętnie jakie), następnie ```./vendor/bin/sail up -d``` a na końcu ```./vendor/bin/sail composer local-install```
- W celu kolejnego uruchomienia apki wystarczy ```./vendor/bin/sail up -d``` a jak chcemy wycziśćić bazę ```./vendor/bin/sail composer pre-commit```
- W celu uruchomienia testów: wchodzimy do folderu z apką i po jej uruchomieniu odpalamy ```./vendor/bin/sail test```

## API

Dokumentacja: https://documenter.getpostman.com/view/5327712/VUqrPHWa
## Użyteczne dane

Predefiniowani użytkownicy:

| Typ    | Email              | Hasło       |
|--------|--------------------|-------------|
| Worker | worker@example.com | `Example1%` |
| User   | user@example.com   | `Example1%` |

## Uwagi
- Produkty powinny być widoczne dopiero po dodaniu do nich ceny. Obecnie jest zrobione takie obejście, że walidator przy dodawaniu rzeczy do karty sprawdza, czy przedmiot ma cenę czy nie - niestety aby to działało tak jak powinno trzeba zrobić obejście do biblioteki json api, a ze względu na czas, wakacje po prostu tego nie dam rady zrobić. 
- W związku z powyższym prawidłowy flow w przeklikaniu to: logowanie, utworzenie produktu, dodanie ceny, dodanie do koszyka. Podstawowe produkty jakie były w zadaniu mają cenę seedowaną przy uruchomieniu więc je można od razu dodać do koszyka.
- Waluta powinna być osobną tabelą w której przy okazji byłaby zdefiniowana defaultowa walatua jak waluta usera nie jest dostępna dla danego przedmiotu. Niestety ze względu na czas i rozbudowane zagadnienie nie zrobiłem tego w ten sposób (niemniej dodanie produktu wymusza aby zawsze była waluta USD zdefiniowana)
- Ta biblioteka json-api ogarnia sama w sobie proste operację CRUD, jednak dla modelu Products napdpisałem te metody, aby pokazać korzystanie z serwisu. 
