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
@include('viewcomponents.characters_modals')

<script>
    $(document).ready(function () {
        $('#characterSearch').on('keyup', function () {
            var value = $('#characterSearch').val().toLowerCase().trim();
            console.log(value)
            if (value === "") {
                $(".characterCard").show();
            }
            else{
                $(".characterCard").each(function () {
                var id = $(this).attr("id").toLowerCase();
                if (id.search(value) === -1) {
                    $(this).hide();
                } else {
                    $(this).show();
                }
            });
            }
        });
        $('#editCharacterModal').on('show.bs.modal', function (e) {
            var charId = $(e.relatedTarget).data('char-id');
            $(".modal-body #charId").val( charId );
        });
        
    });

</script>
@endsection
