<div class="container-fluid">
  <div class="row-fluid">

<div class="span2">
  <ul class="nav nav-pills nav-stacked">
<li>
  <a href="new_game.php"> Create New Game </a>
</li>
<li class="active">
  <a href="list_games.php">Browse Existing Games</a>
</li>
<li>
  <a href="#"> View Users </a>
</li>
  </ul>
</div>

<div class="span10" >
<table>
  
<thead>
  <tr>
<th>Name</th>
<th>Sport</th>
<th>Description</th>
<th>Organizer</th>
<th>Created On</th>
  </tr>
</thead>

<tbody>
  <?php foreach ($this->page["games"] as $game) { ?>
  <tr>
    <td><a href="view_game.php?gid=<?php echo $game->gid; ?>"><?php echo $game -> name; ?></a></td>
    <td><?php echo $game -> sport -> name; ?></td>
    <td><?php echo $game -> desc; ?></td>
    <td><?php echo $game -> organizer -> username; ?></td>
    <td><?php echo $game -> creation; ?></td>
  </tr>
  <?php } ?>
</tbody>

</table>
</div>

</div>
</div>
