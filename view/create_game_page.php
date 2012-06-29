<div class="container-fluid">
    <div class="row-fluid">

        <!-- sidebar -->
        <div class="span2">
            <ul class="nav nav-pills nav-stacked">
                <li class="active">
                    <a href="new_game.php"> Create New Game </a>
                </li>
                <li>
                    <a href="list_games.php">Browse Existing Games</a>
                </li>
                <li>
                    <a href="#"> View Users </a>
                </li>
            </ul>
        </div>

        <!-- register form -->
        <div class="span4 hero-unit">
            <form method="post" action="new_game.php" name="create_game" class="form-horizontal">
                <fieldset>

                    <legend>
                        Please submit the following information:
                    </legend>
                    <!-- title -->

                    <div class="control-group">
                        <label class="control-label" for="username-input">Game</label>
                        <div class="controls">
                            <input id="gamename-input" class="input-xlarge" name="gamename" type="text">
                        </div>
                    </div>
                    <!-- gamename -->

                    <div class="control-group">
                        <label class="control-label" for="sport-select">Sport</label>
                        <div class="controls">
                            <select id="sport-select" name="sport">
                            <?php foreach ($this->page["sports"] as $sport) { ?>
                                <option value="<?php echo $sport->sid; ?>"><?php echo $sport->name; ?></option>
                            <?php } ?>
                            </select>
                        </div>
                    </div>
                    <!-- sports -->

                    <div class="control-group">
                        <label class="control-label" for="description-input">Description</label>
                        <div class="controls">
                            <textarea name="description" rows="10"></textarea>
                        </div>
                    </div>
                    <!-- Description -->


                    <div class="control-group">
                        <input type="submit" class="btn btn-primary pull-right" value="Create" />
                    </div>
                    <!-- submit -->
                </fieldset>

            </form>
        </div>

    </div>
</div>

