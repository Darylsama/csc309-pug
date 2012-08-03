<div class="container-fluid">
  <div class="row-fluid content-wrapper">

    <?php
    include "view/sidebar.php"
    ?>

    <div class="span9 content">
    
      <table id="game_table" >
        <thead>
          <tr>
            <th>Name</th>
            <th>Sport</th>
            <th>Organizer</th>
            <th>Start Time</th>
            <th>Length</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($this->page["games"] as $game) { ?>
          <tr>
            <td><a href="view_game.php?gid=<?php echo $game->gid; ?>"><?php echo $game -> name; ?></a></td>
            <td><?php echo $game -> sport -> name; ?></td>
            <td><?php echo $game -> organizer -> username; ?></td>
            <td><?php echo date("M j, Y G:00", $game -> start_time); ?></td>
            <td><?php echo $game -> duration; ?></td>
          </tr>
          <?php } ?>
        </tbody>

      </table>
    </div>
  </div>
</div>
