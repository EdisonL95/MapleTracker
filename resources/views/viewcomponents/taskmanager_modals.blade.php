<!-- Create Task Modal -->
<div class="modal fade" id="taskModal" tabindex="-1" aria-labelledby="taskModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="taskModalLabel">Create a Task</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/attempt_create_task" method="post">
                    @csrf
                    <label for="item">Name: </label> <br />
                    <input type="text" name="task_name" value="" class="form-control" required /> <br />
                    <label for="item">Type of Task: </label> <br />
                    <select class="form-select" name="type" id="taskType" required>
                        <option value="Daily Boss">Daily Boss</option>
                        <option value="Daily Quest">Daily Quest</option>
                        <option value="Weekly Boss">Weekly Boss</option>
                        <option value="Weekly Quest">Weekly Quest</option>
                    </select> <br />
                    <div id="rewardInput">
                        <label for="item">Reward: </label><br />
                        <input type="number" name="reward" value="" class="form-control" maxlength="12" /> <br />
                    </div>
                    <label for="item">Tags: </label> <br />
                    <input type="text" name="tags" value="" class="form-control" maxlength="90" required /> <br />
                    <input class="form-check-input" name="priority" type="checkbox" value="" id="prioritycheck">
                    <label class="form-check-label" for="prioritycheck">
                        Set High Priority
                    </label><br /><br />
                    <input type="submit" value="Create Character" class="form-control" /> <br>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Task Modal -->
<div class="modal fade" id="editTaskModal" tabindex="-1" aria-labelledby="editTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editTaskModalLabel">Edit Character</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/attempt_edit_task" method="post">
                    @csrf
                    <input type="hidden" id="taskId" name="taskId" value="" />
                    <label for="item">Name: </label> <br />
                    <input type="text" name="task_name" value="" class="form-control" required /> <br />
                    <label for="item">Type of Task: </label> <br />
                    <select class="form-select" name="type" id="taskTypeEdit" required>
                        <option value="Daily Boss">Daily Boss</option>
                        <option value="Daily Quest">Daily Quest</option>
                        <option value="Weekly Boss">Weekly Boss</option>
                        <option value="Weekly Quest">Weekly Quest</option>
                    </select> <br />
                    <div id="rewardInputEdit">
                        <label for="item">Reward: </label><br />
                        <input type="number" name="reward" value="" class="form-control" maxlength="12" /> <br />
                    </div>
                    <label for="item">Tags: </label> <br />
                    <input type="text" name="tags" value="" class="form-control" maxlength="90" required /> <br />
                    <input class="form-check-input" name="priority" type="checkbox" value="" id="prioritycheck">
                    <label class="form-check-label" for="prioritycheck">
                        Set High Priority
                    </label><br /><br />
                    <input type="submit" value="Create Character" class="form-control" /> <br>
                </form>
            </div>
        </div>
    </div>
</div>
