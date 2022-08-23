# Specyfikacja

Zadanie rekrutacyjne dla GOG. Z ważnych informacji: 
- Korzystam z Laravela plus json-api 
- URL aplikacji: localhost:80
- Do uruchomienia aplikacji: wchodzimy do folderu z apką i uruchamiamy: ```./vendor/bin/sail up -d``` a następnie ```./vendor/bin/sail composer pre-commit```
- W celu uruchomienia testów: wchodzimy do folderu z apką i po jej uruchomieniu odpalamy ```./vendor/bin/sail test```

## API

Dokumentację endpointów API wraz z przykładowymi żądaniami/odpowiedziami znajdziesz tutaj:  
@todo

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
