@foreach($agents as $agent)
ID: {{$agent->id}}          Имя: {{$agent->name}}
@endforeach
<b>Для выбора агента используйте /rand_agent и ID агента.</b>
Пример /rand_agent 1 2 3
