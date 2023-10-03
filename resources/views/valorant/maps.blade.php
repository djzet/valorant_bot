@foreach($maps as $map)
ID: {{$map->id}}          Имя: {{$map->name}}
@endforeach
<b>Для выбора карты используйте /rand_map и ID карты.</b>
Пример /rand_map 1 2 3
