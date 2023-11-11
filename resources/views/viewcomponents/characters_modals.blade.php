<!-- Create Character Modal -->
<div class="modal fade" id="characterModal" tabindex="-1" aria-labelledby="characterModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="characterModalLabel">Create Character</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/attempt_create_character" method="post">
                    @csrf
                    <label for="item">Name: </label> <br />
                    <input type="text" name="character_name" value="" class="form-control" maxlength="12" required /> <br />
                    <label for="item">Class: </label> <br />
                    <select class="form-select" name="class" required>
                        <option value="warrior">Warrior</option>
                        <option value="mage">Mage</option>
                        <option value="thief">Thief</option>
                        <option value="archer">Archer</option>
                        <option value="pirate">Pirate</option>
                    </select> <br />
                    <label for="item">Level: </label><br />
                    <input type="number" name="level" value="" class="form-control" required /> <br />
                    <input type="submit" value="Create Character" class="form-control" /> <br>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Character Modal -->
<div class="modal fade" id="editCharacterModal" tabindex="-1" aria-labelledby="editCharacterModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCharacterModalLabel">Edit Character</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/attempt_edit_character" method="post">
                    @csrf
                    <input type="hidden" id="charId" name="charId" value="" />
                    <label for="item">Name: </label> <br />
                    <input type="text" name="character_name" value="" class="form-control" maxlength="12" required /> <br />
                    <label for="item">Class: </label> <br />
                    <select class="form-select" name="class" required>
                        <option value="warrior">Warrior</option>
                        <option value="mage">Mage</option>
                        <option value="thief">Thief</option>
                        <option value="archer">Archer</option>
                        <option value="pirate">Pirate</option>
                    </select> <br />
                    <label for="item">Level: </label><br />
                    <input type="number" name="level" value="" class="form-control" required /> <br />
                    <input type="submit" value="Edit Character" class="form-control" /> <br>
                </form>
            </div>
        </div>
    </div>
</div>

