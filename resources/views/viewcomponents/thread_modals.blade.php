<!-- Create Post Modal -->
<div class="modal fade" id="postModal" tabindex="-1" aria-labelledby="postModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="postModalLabel">Create a Post</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/attempt_create_post/{{$thread->id}}" method="post">
                    @csrf
                    <textarea name="contents" class="form-control" rows="5" cols="60" style="width: 100%;" maxlength="255" required></textarea><br />
                    <input type="submit" value="Create Post" class="form-control" /> <br>
                </form>
            </div>
        </div>
    </div>
</div>