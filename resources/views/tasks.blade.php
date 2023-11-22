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

        $('.characterTaskMenu').on('show.bs.dropdown', function (e) {
            $('.characterTaskMenu').not(this).find('.dropdown-menu').removeClass('show');
            console.log("click")
            $('.characterTaskSearch').val('');
            $('.taskFilter').val('None');
            $('.characterTaskSearch').trigger('keyup');
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
        /////////////
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
