@extends("layout")

@section("content")
<div class="row">
    <div class="col-md-4">
        <input type="text" class="form-control" id="taskManagerSearch" placeholder="Search for task by name or tag"
            aria-label="Default">
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#taskModal">
            Add a new task
        </button>
    </div>
</div>
<div class="row">
    <div class="col-md-12" id="taskColumn">
        <table class="table table-borderless" id="taskTableManager">
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Type</th>
                    <th>Priority</th>
                    <th>Reward</th>
                    <th>Tags</th>
                    <th>Delete or Edit Task </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                <tr class="taskManagerTableRow">
                    <td class="searchterm">{{ $task->description }}</td>
                    <td>{{ $task->type }}</td>
                    <td>{{ $task->priority ? 'High' : 'Normal' }}</td>
                    <td>{{ $task->reward }}</td>
                    <td class="searchterm">{{ $task->tags }}</td>
                    <td>
                        <a href="/attempt_delete_task/{{$task->id}}">Delete Task</a>
                        <a data-bs-toggle="modal" data-bs-target="#editTaskModal" data-task-id="{{$task->id}}"
                            href="">Edit Task</a>
                    </td>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@include('viewcomponents.modals')

<script>
    $(document).ready(function () {
        $('#taskManagerSearch').on('keyup', function () {
            var value = $('#taskManagerSearch').val().toLowerCase().trim();
            if (value === "") {
                $(".taskManagerTableRow").show();
            }
            else {
                $(".taskManagerTableRow").each(function () {
                var found = false;
                $(this).find(".searchterm").each(function () {
                    var text = $(this).text().toLowerCase();
                    if (text.includes(value)) {
                        found = true;
                    }
                });

                if (found) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
            }
        });
        $("#taskType").on("change", function () {
            var selectedType = $("#taskType").val();
            if (selectedType === 'Daily Boss' || selectedType === 'Weekly Boss') {
                $("#rewardInput").show();
            } else {
                $("#rewardInput").hide();
            }
        });
        $('#editTaskModal').on('show.bs.modal', function (e) {
            var taskId = $(e.relatedTarget).data('task-id');
            console.log(taskId)
            $(".modal-body #taskId").val(taskId);
        });
    });

</script>
@endsection
