# File Comparision Service
Prosta usługa w postaci aplikacji konsolowej pozwalająca na tworzenie raportów z porównań plików.

## Uruchamianie
Aby uruchomić aplikację należy pobrać wymagane zależności oraz wywołać polecenie komendą *make*.

### Instalacja zależności
Instalacja zależności odbywa się za pomocą wywołania komendy narzędzia Composer, która została opisana poniżej.

```
    composer install
```

### Polecenie uruchamiające
Komenda, która finalnie uruchamia aplikację została opisana poniżej.
```
    make run MAIN_FILE_PATH=<ścieżka do pliku> COMPARING_FILES_PATHS=<ścieżki do pliku oddzielone przecinkiem>
```

## Testowanie
W celu przetestowania aplikacji, do repozytorium zostały wgrane dwa pliki, które można dopisać do polecenia uruchamiającego.
```
    make run MAIN_FILE_PATH=testFile.txt COMPARING_FILES_PATHS=testCompareFile.txt
```

lub

```
    make run MAIN_FILE_PATH=testFile.txt COMPARING_FILES_PATHS=testCompareFile.txt,testCompareFile2.txt
```

## Logi raportów
Wszystkie logi raportów zapisywane są do pliku diff.txt, który generuje się automatycznie w głównym folderze aplikacji.