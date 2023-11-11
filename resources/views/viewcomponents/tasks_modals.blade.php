<!-- Add Character Task Modal -->
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

<!-- Remove Character Task Modal -->
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