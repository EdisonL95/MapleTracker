@extends("layout")

@section("content")
<div class="row">
    <div class="col-md-4">
        <input type="text" class="form-control" id="characterTaskListSearch" placeholder="Search for character by name"
            aria-label="Default">
    </div>
    <div class="col-md-4 ms-auto d-flex justify-content-end">

    </div>
</div>
<div class="row" id="taskList">
    <div class="col-md-4">
        Current Weekly Income: {{ $income }} mesos
    </div>
    <div class="col-md-4 ms-auto d-flex justify-content-end">
    </div>
</div>
@include('viewcomponents.tasklist')

@include('viewcomponents.tasks_modals')

<script>
    $(document).ready(function () {
        var charId = 0;
        // Method used to search a characters tasks by name or tag
        $('#characterTaskListSearch').on('keyup', function () {
            var value = $('#characterTaskListSearch').val().toLowerCase().trim();
            if (value === "") {
                $(".characterTaskMenu").show();
            } else {
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

        // Method used to add a task to a character on click, gets both the ids of the character and the task then runs
        $(".characterTaskModalRow").click(function () {
            var taskId = $(this).attr("id")
            var url = `/add_character_task/${charId}/${taskId}`;
            window.location = url;
        });

        // Method used on click of a character task to change the status between complete/incomplete
        $(".characterTaskListRow").click(function () {
            var taskId = $(this).attr("id")
            var url = `/set_task_status/${taskId}`;
            window.location = url;
        });

        // Method used to get the current opened characters id to be used to adding tasks
        $('#addTaskModal').on('show.bs.modal', function (e) {
            charId = $(e.relatedTarget).data('char-id');
        });

        // Method used to make it so that only one drop down can be opened at once
        $('.characterTaskMenu').on('show.bs.dropdown', function (e) {
            $('.characterTaskMenu').not(this).find('.dropdown-menu').removeClass('show');
            console.log("click")
            $('.characterTaskSearch').val('');
            $('.taskFilter').val('None');
            $('.characterTaskSearch').trigger('keyup');
        });
        
        // Method used to make it so that only one drop down can be opened at once
        $('.characterTaskMenu').click(function (e) {
            e.stopPropagation();
        });

        // Filter used to get the id for the delete character task route when removing a task from a character
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

        // Function used to search a characters tasks by tag or name
        $('.characterTaskSearch').on('keyup', function () {
            var value = $('.characterTaskSearch').val().toLowerCase().trim();
            if (value === "") {
                $(".characterTaskListRow").show();
            } else {
                $(".characterTaskListRow").each(function () {
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

        // Function used to filter a characters tasks by the filter term
        $('.taskFilter').change(function () {
            var selectedValue = $(this).val().toLowerCase();
            $('.characterTaskListRow').show();
            if (selectedValue === "none") {
                $(".characterTaskListRow").show();
            } else {
                $(".characterTaskListRow").each(function () {
                    var found = false;
                    $(this).find(".filterterm").each(function () {
                        var text = $(this).text().toLowerCase().trim();
                        if (selectedValue === "complete"){
                            console.log(text)
                            if (text === "complete") {
                            found = true;
                            }
                        }
                        else if (text.includes(selectedValue)) {
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
