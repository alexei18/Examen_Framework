<h1>Adaugă echipament</h1>
<form action="{{ route('equipments.store') }}" method="POST">
  @csrf
  <label for="name">Nume:</label>
  <input type="text" name="name" required>
  <label for="price">Preț:</label>
  <input type="number" name="price" required>
  <button type="submit">Salvează</button>
</form>
