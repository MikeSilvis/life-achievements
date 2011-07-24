<h1>List of Achievements</h1>
<?php foreach($query->result() as $row): ?>
<h2><?=$row->title?></h2>
<p><?=$row->description?></p>
<?php endforeach; ?>