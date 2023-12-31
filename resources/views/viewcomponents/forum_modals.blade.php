<!-- Create Thread Modal -->
<div class="modal fade" id="forumModal" tabindex="-1" aria-labelledby="forumModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="forumModalLabel">Create a Thread</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/attempt_create_thread" method="post">
                    @csrf
                    <label for="item">Title: </label> <br />
                    <input type="text" name="title" value="" class="form-control" required /> <br />
                    <label for="item">Content: </label> <br />
                    <input type="text" name="contents" value="" class="form-control" required /> <br />
                    <input class="form-check-input" name="announcementcheck" type="checkbox" value="1" id="announcementcheck">
                    <label class="form-check-label" for="announcementcheck">
                        Set Announcement
                    </label><br /><br />
                    <input type="submit" value="Create Character" class="form-control" /> <br>
                </form>
            </div>
        </div>
    </div>
</div>
