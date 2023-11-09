@extends("layout")

@section("content")
<div class="row">
    <div class="col-md-4">
        <input type="text" class="form-control" id="characterSearch" placeholder="Search for character by name"
            aria-label="Default">
    </div>
    <div class="col-md-4 ms-auto d-flex justify-content-end">
        Timer 1
    </div>
</div>
<div class="row" id="taskList">
    <div class="col-md-4">
        Current Weekly Income
    </div>
    <div class="col-md-4 ms-auto d-flex justify-content-end">
        Timer 2
    </div>
</div>
@include('viewcomponents.tasklist')
<script>
    $(document).ready(function () {
        $('#characterSearch').on('keyup', function () {
            var value = $('#characterSearch').val().toLowerCase();
            $(".characterTaskMenu").each(function () {
                var id = $(this).attr("id").toLowerCase();
                if (id.search(value) === -1) {
                    $(this).hide();
                } else {
                    $(this).show();
                }
            });
        });
    });

</script>
@endsection
