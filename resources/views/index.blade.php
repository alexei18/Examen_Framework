<h1>Lista echipamentelor</h1>
<a href="{{ route('equipments.create') }}">Adaugă echipament</a>
<ul>
  @foreach ($equipments as $equipment)
    <li>{{ $equipment->name }} - {{ $equipment->price }} <form action="{{ route('equipments.destroy', $equipment->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Șterge</button>
      </form></li>
  @endforeach
</ul>
