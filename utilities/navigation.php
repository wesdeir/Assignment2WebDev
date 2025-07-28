<?php
// utilities/navigation.php
require_once __DIR__ . '/dataAccess.php';

// Load data
$paintings = getPaintings();
$artists = getArtists();

// Build & sort unique genre list
$genres = array();
foreach ($paintings as $p) {
	$genres[] = $p[9];  // genre at index 9
}
$genres = array_unique($genres);
sort($genres);
?>
<div id="genreListing">
	<h2>Genres</h2>
	<ul class="secondaryList">
		<?php foreach ($genres as $g): ?>
			<li>
				<a href="index.php?genre=<?php echo urlencode($g) ?>">
					<?php echo htmlspecialchars($g) ?>
				</a>
			</li>
		<?php endforeach; ?>
	</ul>
</div>

<div id="artistListing">
	<h2>Artists</h2>
	<ul class="secondaryList">
		<?php foreach ($artists as $a): ?>
			<li>
				<a href="singleArtist.php?id=<?php echo $a[0] ?>">
					<?php echo htmlspecialchars($a[1]) ?>
				</a>
			</li>
		<?php endforeach; ?>
	</ul>
</div>