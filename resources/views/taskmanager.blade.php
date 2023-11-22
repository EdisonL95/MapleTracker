@extends("layout")

@section("content")
<div class="row">
    <div class="col-md-4">
        <input type="text" class="form-control" id="taskManagerSearch" placeholder="Search for task by name or tag"
            aria-label="Default">
    </div>
    <div class="col-md-4 ms-auto d-flex justify-content-end" id="taskColumn">
        <select class="form-select" id="taskFilter">
            <option value="None">Show All</option>
            <option value="Weekly">Weekly</option>
            <option value="Daily">Daily</option>
            <option value="High">High Priority</option>
            <option value="Normal">Normal Priority</option>
        </select>
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
                    <td class="filterterm">{{ $task->type }}</td>
                    <td class="filterterm">{{ $task->priority ? 'High' : 'Normal' }}</td>
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

@include('viewcomponents.taskmanager_modals')

<script>
    $(document).ready(function () {
        $('#taskManagerSearch').on('keyup', function () {
            var value = $('#taskManagerSearch').val().toLowerCase().trim();
            if (value === "") {
                $(".taskManagerTableRow").show();
            } else {
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
        $("#taskTypeEdit").on("change", function () {
            var selectedType = $("#taskTypeEdit").val();
            if (selectedType === 'Daily Boss' || selectedType === 'Weekly Boss') {
                $("#rewardInputEdit").show();
            } else {
                $("#rewardInputEdit").hide();
            }
        });
        $('#editTaskModal').on('show.bs.modal', function (e) {
            var taskId = $(e.relatedTarget).data('task-id');
            $(".modal-body #taskId").val(taskId);
        });
        // Onclick header sort asc/desc taken from https://stackoverflow.com/questions/3160277/jquery-table-sort
        $('th').click(function () {
            var table = $(this).parents('table').eq(0)
            var rows = table.find('tr:gt(0)').toArray().sort(comparer($(this).index()))
            this.asc = !this.asc
            if (!this.asc) {
                rows = rows.reverse()
            }
            for (var i = 0; i < rows.length; i++) {
                table.append(rows[i])
            }
        })

        function comparer(index) {
            return function (a, b) {
                var valA = getCellValue(a, index),
                    valB = getCellValue(b, index)
                return $.isNumeric(valA) && $.isNumeric(valB) ? valA - valB : valA.toString().localeCompare(
                    valB)
            }
        }

        function getCellValue(row, index) {
            return $(row).children('td').eq(index).text()
        }
        $('#taskFilter').change(function () {
            var selectedValue = $(this).val().toLowerCase();
            $('.characterTaskListRow').show();
            if (selectedValue === "none") {
                $(".taskManagerTableRow").show();
            } else {
                $(".taskManagerTableRow").each(function () {
                    var found = false;
                    $(this).find(".filterterm").each(function () {
                        var text = $(this).text().toLowerCase();
                        if (text.includes(selectedValue)) {
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
    });

</script>
@endsection
