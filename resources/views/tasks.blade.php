@extends("layout")

@section("content")
<div class="row">
    <div class="col-md-4">
        <input type="text" class="form-control" id="characterTaskListSearch" placeholder="Search for character by name"
            aria-label="Default">
    </div>
    <div class="col-md-4 ms-auto d-flex justify-content-end">
        Timer 1
    </div>
</div>
<div class="row" id="taskList">
    <div class="col-md-4">
        Current Weekly Income: {{ $income }} mesos
    </div>
    <div class="col-md-4 ms-auto d-flex justify-content-end">
        Timer 2
    </div>
</div>
@include('viewcomponents.tasklist')

@include('viewcomponents.tasks_modals')

<script>
    $(document).ready(function () {
        var charId = 0;
        $('#characterTaskListSearch').on('keyup', function () {
            var value = $('#characterTaskListSearch').val().toLowerCase().trim();
            if (value === "") {
                $(".characterTaskMenu").show();
            }
            else {
                $(".characterTaskMenu").each(function () {
                var id = $(this).attr("id").toLowerCase();
                if (id.search(value) === -1) {
                    $(this).hide();
                } else {
                    $(this).show();
                }
            });
            }
        });
        $(".characterTaskModalRow").click(function () {
            var taskId = $(this).attr("id")
            var url = `/add_character_task/${charId}/${taskId}`;
            window.location = url;
        });
        $(".characterTaskListRow").click(function () {
            var taskId = $(this).attr("id")
            var url = `/set_task_status/${taskId}`;
            window.location = url;
        });
        $('#addTaskModal').on('show.bs.modal', function (e) {
            charId = $(e.relatedTarget).data('char-id');
        });
        $('.characterTaskMenu').click(function (e) {
            e.stopPropagation();
        });
        $('#removeTaskModal').on('show.bs.modal', function (e) {
            charId = $(e.relatedTarget).data('char-id');
            $(".characterTaskDelRow").each(function () {
                var id = $(this).attr("id");
                if (id == charId) {
                    $(this).show();
                    $(this).off('click').on('click', function () {
                        var taskId = $(this).attr("task_id")
                        var url = `/delete_character_task/${taskId}`;
                        window.location = url;
                    });
                } else {
                    $(this).hide().off('click');
                }
            });
        })
    });

</script>
@endsection
