{"aaData":[
<?php for ($i = 0; $i < count($this->data["user_lnk"]); $i++) { $user_lnk = $this->data["user_lnk"][$i] ?>
["<a href=\"profile.php?uid=<?php echo $user_lnk["user"]->uid ?>\"><?php echo $user_lnk["user"]->username ?></a>",
<?php echo isset($user_lnk["player_rates"]) ? $user_lnk["player_rates"] : "\"\"" ?>,
<?php echo isset($user_lnk["organizer_rates"]) ? $user_lnk["organizer_rates"] : "\"\""?>]
<?php echo $i == count($this->data["user_lnk"]) - 1 ? "" : "," ?>
<?php } ?>
]}