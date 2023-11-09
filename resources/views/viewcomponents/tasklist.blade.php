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
                                data-bs-target="#addTaskModal" id="taskButton">
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
                                data-bs-target="#characterModal" id="taskButton">
                                Remove task
                            </button>
                        </div>
                        <div class="col-md-4 ms-auto d-flex justify-content-end" id="taskColumn">
                            <input type="text" class="form-control" id="taskFilter" placeholder="Test Filter"
                                aria-label="Default">
                        </div>
                        <div class="col-md-4 ms-auto d-flex justify-content-end" id="taskColumn">
                            <input type="text" class="form-control" id="taskSearch" placeholder="Test Search"
                                aria-label="Default">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" id="taskColumn">
                            <table class="table table-borderless" id="taskTable">
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
                                    <tr>
                                    </tr>
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
