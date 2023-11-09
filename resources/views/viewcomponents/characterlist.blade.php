<div class="row" id="characterList">
    @foreach ($characters as $character)
    <div class="col-md-4 characterCard" id="{{$character->character_name}}">
        <div class="p-3 border bg-light" id="characterCard">
            <p id="characterCardText">{{ $character->character_name }} LV. {{ $character->level }}
                {{ $character->class }} </p>
            <div class="row d-flex justify-content-end">
                <div class="col-6">
                    <div class="text-area">Daily Quests 0/10</div>
                </div>
                <div class="col-6">
                    <div class="text-area">Daily Bosses 0/10</div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="text-area">Weekly Quests 0/10</div>
                </div>
                <div class="col-6">
                    <div class="text-area">Weekly Bosses 0/10</div>
                </div>
            </div>
            <div class="dropdown  d-flex justify-content-end">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Adjust Character</button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editModal" href="" data-char-id="{{$character->id}}">Edit Character</a>
                    <a class="dropdown-item" href="/attempt_delete/{{$character->id}}">Delete Character</a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>