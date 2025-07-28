<?php
// singleArtist.php

// 1) Include our data loader
require_once __DIR__ . '/utilities/dataAccess.php';

// 2) Load data
$paintings = getPaintings();
$artists = getArtists();

// 3) Get the requested artist ID
$aid = isset($_GET['id']) ? $_GET['id'] : '';

// 4) Find that artist
$art = null;
foreach ($artists as $a) {
	if ($a[0] === $aid) {
		$art = $a;
		break;
	}
}
if (!$art) {
	die("Artist not found.");
}

// 5) Unpack artist fields
list($id, $name, $nation, $birth, $death, $adesc, $awiki) = $art;
?>
<!DOCTYPE html
	PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>Assign2 - Single Artist</title>
	<link rel="stylesheet" href="css/reset.css" />
	<link rel="stylesheet" href="css/text.css" />
	<link rel="stylesheet" href="css/960.css" />
	<link rel="stylesheet" href="css/assign2.css" />
</head>

<body>

	<div class="container_12">
		<?php require_once("utilities/header.php"); ?>
		<div class="grid_3">
			<?php require_once("utilities/navigation.php"); ?>
		</div>
		<div class="grid_9">
			<!-- Back link -->
			<p><a href="index.php">← Back to Gallery</a></p>

			<!-- Artist info -->
			<h1><?php echo htmlspecialchars($name); ?></h1>
			<img src="resources/artists/medium/<?php echo $id; ?>.jpg" alt="<?php echo htmlspecialchars($name); ?>" />
			<ul>
				<li>Nationality: <?php echo htmlspecialchars($nation); ?></li>
				<li>Born: <?php echo htmlspecialchars($birth); ?></li>
				<li>Died: <?php echo htmlspecialchars($death); ?></li>
			</ul>
			<p><?php echo htmlspecialchars($adesc); ?></p>
			<p>
				<a href="<?php echo htmlspecialchars($awiki); ?>" target="_blank">
					Learn more on Wikipedia
				</a>
			</p>

			<!-- Artist's paintings -->
			<h2>Paintings by <?php echo htmlspecialchars($name); ?></h2>
			<ul>
				<?php foreach ($paintings as $p):
					list($pid, $artistName, $ptitle) = $p;
					if ($artistName === $name): ?>
						<li>
							<a href="singlePainting.php?id=<?php echo $pid; ?>">
								<?php echo htmlspecialchars($ptitle); ?>
							</a>
						</li>
					<?php endif; endforeach; ?>
			</ul>
		</div>
		<div class="clear"> </div>
	</div>

</body>

</html>