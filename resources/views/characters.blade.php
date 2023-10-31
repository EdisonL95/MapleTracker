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

@include('viewcomponents.characterlist')

<!-- Create Character Modal -->
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
                    <select class="form-select" name="class" required>
                        <option value="warrior">Warrior</option>
                        <option value="mage">Mage</option>
                        <option value="thief">Thief</option>
                        <option value="archer">Archer</option>
                        <option value="pirate">Pirate</option>
                    </select> <br />
                    <label for="item">Level: </label><br />
                    <input type="number" name="level" value="" class="form-control" required /> <br />
                    <input type="submit" value="Create Character" class="form-control" /> <br>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Character Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Character</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/attempt_edit" method="post">
                    @csrf
                    <label for="item">Name: </label> <br />
                    <input type="text" name="character_name" value="" class="form-control" required /> <br />
                    <label for="item">Class: </label> <br />
                    <select class="form-select" name="class" required>
                        <option value="warrior">Warrior</option>
                        <option value="mage">Mage</option>
                        <option value="thief">Thief</option>
                        <option value="archer">Archer</option>
                        <option value="pirate">Pirate</option>
                    </select> <br />
                    <label for="item">Level: </label><br />
                    <input type="number" name="level" value="" class="form-control" required /> <br />
                    <input type="submit" value="Edit Character" class="form-control" /> <br>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#characterSearch').on('keyup', function () {
            var value = $('#characterSearch').val().toLowerCase();
            $(".characterCard").each(function () {
                var id = $(this).attr("id").toLowerCase();
                if (id.search(value) === -1){
                    $(this).hide();
                }
                else {
                    $(this).show();
                }
            });
        });
    });
</script>
@endsection
