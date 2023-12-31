<div class="row" id="taskList">
    @foreach ($characters as $character)
    <div class="col-12">
        <div class="dropdown w-100 characterTaskMenu" id="{{$character->character_name}}">
            <button class="btn w-100" id="taskdropdown" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <p id="taskCardText">{{ $character->character_name }}</p>
            </button>
            <div class="dropdown-menu w-100" id="taskdropdown" aria-labelledby="dropdownMenuButton">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4" id="taskColumn">
                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                data-bs-target="#addTaskModal" id="taskButton" data-char-id="{{$character->id}}">
                                Add task
                            </button>
                        </div>
                        <div class="col-md-4" id="taskColumn">
                            <p id="taskDropDownTitle">Tasks</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4" id="taskColumn">
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#removeTaskModal" id="taskButton" data-char-id="{{$character->id}}">
                                Remove task
                            </button>
                        </div>
                        <div class="col-md-4 ms-auto d-flex justify-content-end" id="taskColumn">
                            <select class="form-select taskFilter">
                                <option value="None">Show All</option>
                                <option value="Weekly">Weekly</option>
                                <option value="Daily">Daily</option>
                                <option value="High">High Priority</option>
                                <option value="Normal">Normal Priority</option>
                                <option value="Complete">Complete</option>
                                <option value="Incomplete">Incomplete</option>
                            </select>
                        </div>
                        <div class="col-md-4 ms-auto d-flex justify-content-end" id="taskColumn">
                            <input type="text" class="form-control characterTaskSearch" placeholder="Test Search"
                                aria-label="Default">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" id="taskColumn">
                            <table class="table table-borderless" id="taskTable" data-char-id="{{$character->id}}">
                                <thead>
                                    <tr>
                                        <th>Description</th>
                                        <th>Type</th>
                                        <th>Priority</th>
                                        <th>Reward</th>
                                        <th>Tags</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($character_tasks as $character_task)
                                    @if ($character_task->character_id == $character->id)
                                    @php
                                    $task = $tasks->where('id', $character_task->task_id)->first();
                                    @endphp
                                    <tr class="characterTaskListRow" id="{{$character_task->id}}">
                                        <td class="searchterm">{{ $task->description }}</td>
                                        <td class="filterterm">{{ $task->type }}</td>
                                        <td class="filterterm" >{{ $task->priority ? 'High' : 'Normal' }}</td>
                                        <td >{{ $task->reward }}</td>
                                        <td class="searchterm">{{ $task->tags }}</td>
                                        <td class="filterterm"style="color: {{ $character_task->task_status == 1 ? '#A8FA9B' : '#FA9B9B' }}">
                                            @if ($character_task->task_status == 1)
                                            Complete
                                            @else
                                            Incomplete
                                            @endif</td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
