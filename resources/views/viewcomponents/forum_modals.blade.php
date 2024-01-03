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
                    <input type="text" name="title" value="" class="form-control" maxlength="255" required /> <br />
                    <label for="item">Content: </label> <br />
                    <textarea name="contents" class="form-control" rows="5" cols="60" style="width: 100%;" maxlength="255" required></textarea><br />
                    @if (Auth::user()->isAdmin)
                    <input class="form-check-input" name="announcementcheck" type="checkbox" value="1" id="announcementcheck">
                        <label class="form-check-label" for="announcementcheck">
                            Set Announcement
                        </label><br /><br />
                    @endif
                    <input type="submit" value="Create Thread" class="form-control" /> <br>
                </form>
            </div>
        </div>
    </div>
</div>
