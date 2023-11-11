<div class="row" id="characterList">
    @foreach ($characters as $character)
    @php
        $daily_bosses = 0;
        $daily_quests = 0;
        $weekly_bosses = 0;
        $weekly_quests = 0;
        $daily_bosses_complete = 0;
        $daily_quests_complete = 0;
        $weekly_bosses_complete = 0;
        $weekly_quests_complete = 0;
        $tasks_list  = $character_tasks->where('character_id', $character->id);
        foreach ($tasks_list as $task) {
            $task_details = $tasks->where('id', $task->task_id)->first();
            if ($task_details) {
                switch ($task_details->type) {
                    case 'Daily Boss':
                        $daily_bosses++;
                        if($task->task_status){
                            $daily_bosses_complete++;
                        }
                        break;
                    case 'Daily Quest':
                        $daily_quests++;
                        if($task->task_status){
                            $daily_quests_complete++;
                        }
                        break;
                    case 'Weekly Boss':
                        $weekly_bosses++;
                        if($task->task_status){
                            $weekly_bosses_complete++;
                        }
                        break;
                    case 'Weekly Quest':
                        $weekly_quests++;
                        if($task->task_status){
                            $weekly_quests_complete++;
                        }
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
                    <div class="text-area">Daily Quests {{$daily_quests_complete}}/{{ $daily_quests }}</div>
                </div>
                <div class="col-6">
                    <div class="text-area">Daily Bosses {{$daily_bosses_complete}}/{{ $daily_bosses }}</div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="text-area">Weekly Quests {{$weekly_quests_complete}}/{{ $weekly_quests }}</div>
                </div>
                <div class="col-6">
                    <div class="text-area">Weekly Bosses {{$weekly_bosses_complete}}/{{ $weekly_bosses }}</div>
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
