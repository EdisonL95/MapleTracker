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
        Current Weekly Income
    </div>
    <div class="col-md-4 ms-auto d-flex justify-content-end">
        Timer 2
    </div>
</div>
@include('viewcomponents.tasklist')

<div class="modal fade" id="addTaskModal" tabindex="-1" aria-labelledby="addTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addTaskModalLabel">Add a Task</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-borderless" id="taskTableManager">
                    <thead>
                        <tr>
                            <th>Description</th>
                            <th>Type</th>
                            <th>Priority</th>
                            <th>Reward</th>
                            <th>Tags</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tasks as $task)
                        <tr class="characterTaskModalRow" id="{{$task->id}}">
                            <td class="searchterm">{{ $task->description }}</td>
                            <td>{{ $task->type }}</td>
                            <td>{{ $task->priority ? 'High' : 'Normal' }}</td>
                            <td>{{ $task->reward }}</td>
                            <td class="searchterm">{{ $task->tags }}</td>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="removeTaskModal" tabindex="-1" aria-labelledby="removeTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="removeTaskModalLabel">Remove a Task</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-borderless" id="taskTableManager">
                    <thead>
                        <tr>
                            <th>Description</th>
                            <th>Type</th>
                            <th>Priority</th>
                            <th>Reward</th>
                            <th>Tags</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($characters as $character)
                        @foreach ($character_tasks as $character_task)
                        @if ($character_task->character_id == $character->id)
                        @php
                        $task = $tasks->where('id', $character_task->task_id)->first();
                        @endphp
                        <tr class="characterTaskDelRow" id="{{ $character_task->character_id }}"
                            task_id="{{ $character_task->id }}">
                            <td>{{ $task->description }}</td>
                            <td>{{ $task->type }}</td>
                            <td>{{ $task->priority }}</td>
                            <td>{{ $task->reward }}</td>
                            <td>{{ $task->tags }}</td>
                        </tr>
                        @endif
                        @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        var charId = 0;
        $('#characterTaskListSearch').on('keyup', function () {
            var value = $('#characterTaskListSearch').val().toLowerCase();
            $(".characterTaskMenu").each(function () {
                var id = $(this).attr("id").toLowerCase();
                if (id.search(value) === -1) {
                    $(this).hide();
                } else {
                    $(this).show();
                }
            });
        });
        $(".characterTaskModalRow").click(function () {
            var taskId = $(this).attr("id")
            var url = `/add_character_task/${charId}/${taskId}`;
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
                    $(this).click(function () {
                        var taskId = $(this).attr("task_id")
                        var url = `/delete_character_task/${taskId}`;
                        window.location = url;
                    });
                } else {
                    $(this).hide();
                }
            });
        })
    });
</script>
@endsection
