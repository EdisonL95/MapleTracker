<div class="row" id="characterList">
    @foreach ($characters as $character)
    @php
    $daily_bosses = 0;
    $daily_quests = 0;
    $weekly_bosses = 0;
    $weekly_quests = 0;
    $character_tasks = $character_tasks->where('character_id', $character->id);
    foreach ($character_tasks as &$character_task) {
        $task = $tasks->where('id', $character_task->task_id)->first();
        if ($task) {
            switch ($task->type) {
                case 'Daily Boss':
                    $daily_bosses++;
                    break;
                case 'Daily Quest':
                    $daily_quests++;
                    break;
                case 'Weekly Boss':
                    $weekly_bosses++;
                    break;
                case 'Weekly Quest':
                    $weekly_quests++;
                    break;
            }
        }
    }

    @endphp
    <div class="col-md-4 characterCard" id="{{$character->character_name}}">
        <div class="p-3 border bg-light" id="characterCard">
            <p id="characterCardText">{{ $character->character_name }} LV. {{ $character->level }}
                {{ $character->class }} </p>
            <div class="row d-flex justify-content-end">
                <div class="col-6">
                    <div class="text-area">Daily Quests 0/{{ $daily_quests }}</div>
                </div>
                <div class="col-6">
                    <div class="text-area">Daily Bosses 0/{{ $daily_bosses }}</div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="text-area">Weekly Quests 0/{{ $weekly_quests }}</div>
                </div>
                <div class="col-6">
                    <div class="text-area">Weekly Bosses 0/{{ $weekly_bosses }}</div>
                </div>
            </div>
            <div class="dropdown  d-flex justify-content-end">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Adjust Character</button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editCharacterModal" href=""
                        data-char-id="{{$character->id}}">Edit Character</a>
                    <a class="dropdown-item" href="/attempt_delete_character/{{$character->id}}">Delete Character</a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
