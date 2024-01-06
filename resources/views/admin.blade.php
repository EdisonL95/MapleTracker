@extends("layout")

@section("content")
<div class="d-flex justify-content-center">
    <h2>Admin Page</h2>
</div>
<div class="d-flex justify-content-center" id="line">
@include('viewcomponents.admin_modals')
</div>
<h2>User Stats</h2>
<div class="card text-center">
    <div class="card-body">
        <ul class="list-unstyled">
            <li>Number of Users: {{ $userCount }}</li>
            <li>Number of Characters: {{ $characterCount }}</li>
            <li>Number of Daily Tasks: {{ $dailyCount }}</li>
            <li>Number of Weekly Tasks: {{ $weeklyCount }}</li>
            <li>Number of Threads: {{ $threadCount }}</li>
            <li>Number of Posts: {{ $postCount }}</li>
        </ul>
    </div>
</div>
<div class="row mt-3">
    <div class="col-md-4">
        <input type="text" class="form-control" id="userSearch" placeholder="Search for user by name"
            aria-label="Default">
    </div>
    <div class="col-md-12">
        <table class="table table-borderless" id="taskTableManager">
            <thead>
                <tr>
                    <th>Username</th>
                    <th># Characters</th>
                    <th># Tasks</th>
                    <th># Posts</th>
                    <th># Threads</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr class="userTableRow">
                    <td class="searchterm">{{ $user['username'] }}</td>
                    <td >{{ $user['characters'] }}</td>
                    <td >{{ $user['tasks'] }}</td>
                    <td> {{ $user['posts'] }}</td>
                    <td> {{ $user['threads'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="row">
        <div class="col-12">
            <form action="/attempt_change_landing" method="post">
                @csrf

                <!-- Textarea input -->
                <div class="form-group">
                    <label for="textArea">Enter New Landing Text:</label>
                    <textarea class="form-control mt-3"id="landingText" name="landingText" rows="4" placeholder="Type your text here"></textarea>
                </div>

                <!-- Save button -->
                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<h2>Base Collection</h2>
<div class="row">
    <div class="col-md-4">
        <input type="text" class="form-control" id="baseCollectionSearch" placeholder="Search for task by name or tag"
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
            Add to base collection
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
                @foreach ($base_collection as $task)
                <tr class="baseCollectionSearchTableRow">
                    <td class="searchterm">{{ $task->description }}</td>
                    <td class="filterterm">{{ $task->type }}</td>
                    <td class="filterterm">{{ $task->priority ? 'High' : 'Normal' }}</td>
                    <td>{{ $task->reward }}</td>
                    <td class="searchterm">{{ $task->tags }}</td>
                    <td>
                        <a href="/attempt_delete_base/{{$task->id}}">Delete Task</a>
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

<script>
    $(document).ready(function () {
        $('#userSearch').on('keyup', function () {
            var value = $('#userSearch').val().toLowerCase().trim();
            if (value === "") {
                $(".userTableRow").show();
            } else {
                $(".userTableRow").each(function () {
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

        $('#baseCollectionSearch').on('keyup', function () {
            var value = $('#baseCollectionSearch').val().toLowerCase().trim();
            if (value === "") {
                $(".baseCollectionSearchTableRow").show();
            } else {
                $(".baseCollectionSearchTableRow").each(function () {
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

        $('#taskFilter').change(function () {
            var selectedValue = $(this).val().toLowerCase();
            if (selectedValue === "none") {
                $(".baseCollectionSearchTableRow").show();
            } else {
                $(".baseCollectionSearchTableRow").each(function () {
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
    });
</script>
@endsection
