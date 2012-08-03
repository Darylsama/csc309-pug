<div class="container-fluid">
  <div class="row-fluid">

    <!-- sidebar -->
    <?php include "view/sidebar.php"?>

    <!-- register form -->
    <div class="span9">
    
      <!-- padding space  -->
      <div class="span1"></div>
    
    
      <div class="span6">
      <form method="post" action="new_game.php" name="create_game"
        class="form-horizontal">
        <fieldset>

          <legend> Please submit the following information: </legend>
          <!-- title -->

          <div class="control-group">
            <label class="control-label" for="gamename-input">Game</label>
            <div class="controls">
              <input id="gamename-input" class="input-xlarge"
                name="gamename" type="text">
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
            <label class="control-label" for="startdate-input">Start Time</label>
            <div class="controls">
              <input id="startdate-input" class="input-medium" name="start_date" type="text">
              <select name="start_time" class="input-small">
              <?php for ($i = 6; $i <= 21; $i++) {?>
                <option value="<?php echo $i ?>">
                <?php echo $i . ":00&nbsp" . ($i >= 12 ? "PM" : "AM") ?>
                </option>
              <?php }?>
              </select>
            </div>
          </div>
          <!-- start time -->
          
          
          
          <div class="control-group">
            <label class="control-label" for="duration">Duration</label>
            <div class="controls">
              <select name="duration" id="duration-select" class="input-small">
              <?php for ($i = 1; $i <= 8; $i++) {?>
                <option value="<?php echo $i ?>"><?php echo $i?></option>
              <?php }?>
              </select>
            </div>
          </div>
          <!-- Duration -->

          <div class="control-group">
            <label class="control-label" for="description-input">Description</label>
            <div class="controls">
              <textarea id="description-input" name="description" rows="10" style="width:100%;"></textarea>
            </div>
          </div>
          <!-- Description -->


          <div class="control-group">
            <input type="submit" class="btn btn-primary"
              value="Create" />
          </div>
          <!-- submit -->
        </fieldset>

      </form>
      </div>
      
    </div>

  </div>
</div>

