# Sistem de Închiriere a Echipamentelor

Acest proiect implementează un sistem de gestionare a echipamentelor de închiriat folosind framework-ul Laravel. Aplicația permite utilizatorilor să adauge, să vizualizeze și să ștergă echipamentele disponibile pentru închiriere, iar administratorii pot vizualiza închirierile efectuate.

## Arhitectura Aplicației (MVC)

### Modele
1. **Equipment**: Acest model reprezintă echipamentele care pot fi închiriate. Fiecare echipament are atribute precum `name`, `description`, `price` și `available` pentru a indica disponibilitatea.
   
2. **Rental**: Acest model reprezintă închirierile efectuate de utilizatori. Fiecare închiriere conține atribute precum `equipment_id`, `rental_date`, și `return_date`, care sunt legate de echipamentele disponibile.

### Controlere
1. **EquipmentController**: Acesta este responsabil pentru operațiunile CRUD legate de echipamente, inclusiv adăugarea și ștergerea echipamentelor din baza de date.
   
2. **RentalController**: Acesta gestionează închirierile, adică adăugarea închirierilor efectuate și vizualizarea acestora.

### Vizualizări
1. **equipments/index.blade.php**: Afișează lista echipamentelor disponibile pentru închiriere.
   
2. **equipments/create.blade.php**: Formular pentru adăugarea unui echipament nou în baza de date.

3. **rentals/index.blade.php**: Afișează închirierile existente.

4. **rentals/create.blade.php**: Formular pentru crearea unei închirieri de echipamente.

## Schema Bazei de Date

### Tabelul `equipments`
- `id` (INT, auto-increment)
- `name` (VARCHAR, numele echipamentului)
- `description` (TEXT, descrierea echipamentului)
- `price` (DECIMAL, prețul pe zi al echipamentului)
- `available` (BOOLEAN, disponibilitatea echipamentului)

### Tabelul `rentals`
- `id` (INT, auto-increment)
- `equipment_id` (INT, cheie externă către `equipments`)
- `rental_date` (DATE, data închirierii)
- `return_date` (DATE, data returnării echipamentului)

## Tipuri de Stocare a Datelor

- **Baza de date**: Baza de date MySQL este utilizată pentru stocarea echipamentelor și închirierilor.
- **Fișiere**: Imaginile echipamentelor pot fi stocate în sistemul de fișiere local sau în cloud, folosind serviciile Laravel pentru gestionarea fișierelor.

## Cache-ul Datelor

Aplicația poate utiliza cache-ul pentru a stoca lista echipamentelor disponibile, pentru a reduce numărul de interogări către baza de date în cazul în care numărul acestora este mare.

## Stack Tehnologic

- **Backend**: Laravel (PHP)
- **Frontend**: Blade (templating engine), HTML
- **Baza de date**: MySQL

## Pașii Urmați pentru Crearea Proiectului

1. **Crearea proiectului**:
   - Am creat un nou proiect Laravel folosind comanda:
     ```bash
     composer create-project --prefer-dist laravel/laravel rental-system
     ```

2. **Migrarea bazei de date**:
   - Am creat migrațiile pentru tabelele `equipments` și `rentals`, utilizând comanda:
     ```bash
     php artisan make:migration create_equipments_table --create=equipments
     php artisan make:migration create_rentals_table --create=rentals
     ```
   - Am definit relațiile dintre tabele (cheia externă între `rentals` și `equipments`).

3. **Configurarea rutelor**:
   - Am definit rutele pentru operațiile CRUD, folosind resurse în `routes/web.php`:
     ```php
     Route::resource('equipments', EquipmentController::class);
     Route::resource('rentals', RentalController::class);
     ```

4. **Crearea controlerelor**:
   - Am generat controlerele `EquipmentController` și `RentalController` folosind comanda:
     ```bash
     php artisan make:controller EquipmentController --resource
     php artisan make:controller RentalController --resource
     ```

5. **Validarea datelor**:
   - Am adăugat validare pe server în metodele `store` și `update` din controlere, folosind:
     ```php
     $request->validate([
         'name' => 'required',
         'price' => 'required|numeric',
     ]);
     ```

6. **Crearea vizualizărilor**:
   - Am creat vizualizările pentru listarea echipamentelor și închirierilor, precum și formulare pentru adăugarea acestora.

7. **Generarea de date de test**:
   - Am utilizat **Seeder** pentru a popula baza de date cu echipamente de test:
     ```bash
     php artisan make:seeder EquipmentSeeder
     ```
   - Am rulat comanda:
     ```bash
     php artisan db:seed --class=EquipmentSeeder
     ```

## Metode din Controler

### `EquipmentController`
```php
public function index()
{
    $equipments = Equipment::all();
    return view('equipments.index', compact('equipments'));
}

public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required',
        'price' => 'required|numeric',
    ]);
    
    Equipment::create($validated);
    return redirect()->route('equipments.index');
}

public function destroy($id)
{
    $equipment = Equipment::findOrFail($id);
    $equipment->delete();
    return redirect()->route('equipments.index');
}
```
### RentalController

```php
public function store(Request $request) {
    $validated = $request->validate([
        'equipment_id' => 'required|exists:equipments,id',
        'rental_date' => 'required|date',
    ]);

    Rental::create($validated);
    return redirect()->route('rentals.index');
}
```

### Vizualizări HTML pentru Formularul de Adăugare a Datelor
```php
<form action="{{ route('equipments.store') }}" method="POST">
    @csrf
    <label for="name">Nume:</label>
    <input type="text" name="name" required>
    <label for="price">Preț:</label>
    <input type="number" name="price" required>
    <button type="submit">Salvează</button>
</form>
```
### Rutele Definite în Aplicație
```php
Route::resource('equipments', EquipmentController::class);
Route::resource('rentals', RentalController::class);

```

### Rutele Definite în Aplicație
```php
Route::resource('equipments', EquipmentController::class);
Route::resource('rentals', RentalController::class);

```
