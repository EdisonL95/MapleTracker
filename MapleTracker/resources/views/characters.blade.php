@extends("layout")

@section("content")
<div class="row">
    <div class="col-md-4">
        <input type="text" class="form-control" id="characterSearch" placeholder="Search for character by name"
            aria-label="Default">
    </div>
    <div class="col-md-4 ms-auto d-flex justify-content-end">
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#characterModal">
            Add a new character
        </button>
    </div>
</div>

<div class="row" id="characterList">
    @foreach ($characters as $character)
    <div class="col-md-4">
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
            <div><button type="button" class="btn btn-dark ms-auto d-flex justify-content-end">Adjust Character</button>
            </div>
        </div>
    </div>
    @endforeach
</div>
<!-- Modal -->
<div class="modal fade" id="characterModal" tabindex="-1" aria-labelledby="characterModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="characterModalLabel">Create Character</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/attempt_create" method="post">
                    @csrf
                    <label for="item">Name: </label> <br />
                    <input type="text" name="character_name" value="" class="form-control" required /> <br />
                    <label for="item">Class: </label> <br />
                    <input type="text" name="class" value="" class="form-control" required /> <br />
                    <label for="item">Level: </label><br />
                    <input type="number" name="level" value="" class="form-control" required /> <br />
                    <input type="submit" value="Create Character" class="form-control" /> <br>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#characterSearch').on('keyup', function () {
            var value = $('#characterSearch').val();
            $.ajax({
                type: "post",
                url: "/search_character",
                data: {
                    searchTerm: value,
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    var characterDiv = $("#characterList");
                    characterDiv.empty();
                    $.each(response, function (index, character) {
                        console.log(response)
                        var searchedCharacter = '<div class="col-md-4">' +
                            '<div class="p-3 border bg-light" id="characterCard">' +
                            '<p id="characterCardText">' + character
                            .character_name + ' LV. ' + character.level + ' ' +
                            character.class + '</p>' +
                            '<div class="row d-flex justify-content-end">' +
                            '<div class="col-6">' +
                            '<div class="text-area">Daily Quests 0/10</div>' +
                            '</div>' +
                            '<div class="col-6">' +
                            '<div class="text-area">Daily Bosses 0/10</div>' +
                            '</div>' +
                            '</div>' +
                            '<div class="row">' +
                            '<div class="col-6">' +
                            '<div class="text-area">Weekly Quests 0/10</div>' +
                            '</div>' +
                            '<div class="col-6">' +
                            '<div class="text-area">Weekly Bosses 0/10</div>' +
                            '</div>' +
                            '</div>' +
                            '<div><button type="button" class="btn btn-dark ms-auto d-flex justify-content-end">Adjust Character</button></div>' +
                            '</div>' +
                            '</div>';
                        characterDiv.append(searchedCharacter)
                    });
                }
            });
        })
    });

</script>
@endsection
