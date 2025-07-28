<?php
// 1) Include data loader
require_once __DIR__ . '/utilities/dataAccess.php';

// 2) Load data
$paintings = getPaintings();
$artists = getArtists();

// 3) Build artist-name -> id map for linking
$nameToId = [];
foreach ($artists as $a) {
	$nameToId[$a[1]] = $a[0];
}

// 4) Get the requested painting ID
$id = isset($_GET['id']) ? $_GET['id'] : '';

// 5) Find that painting
$sel = null;
foreach ($paintings as $p) {
	if ($p[0] === $id) {
		$sel = $p;
		break;
	}
}
if (!$sel) {
	die("Painting not found.");
}

// 6) Unpack painting fields
list($pid, $artistName, $title, $year, $w, $h, $price, $desc, $wiki, $genre) = $sel;
?>
<!DOCTYPE html
	PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>Assign2 - Single Painting</title>
	<link rel="stylesheet" href="css/reset.css" />
	<link rel="stylesheet" href="css/text.css" />
	<link rel="stylesheet" href="css/960.css" />
	<link rel="stylesheet" href="css/assign2.css" />
</head>

<body>

	<div class="container_12">
		<?php require_once("utilities/header.php"); ?>
	</div>

	<div class="container_12 contentWhite">
		<div class="grid_3">
			<?php require_once("utilities/navigation.php"); ?>
		</div>

		<div class="grid_9">
			<p><a href="index.php"><- Back to Gallery</a></p>

			<h1><?php echo htmlspecialchars($title); ?></h1>
			<img src="resources/paintings/large/<?php echo $pid; ?>.jpg"
				alt="<?php echo htmlspecialchars($title); ?>" />
			<ul>
				<li>Artist:
					<a href="singleArtist.php?id=<?php echo $nameToId[$artistName]; ?>">
						<?php echo htmlspecialchars($artistName); ?>
					</a>
				</li>
				<li>Year: <?php echo htmlspecialchars($year); ?></li>
				<li>Size: <?php echo htmlspecialchars($w); ?>&times;<?php echo htmlspecialchars($h); ?></li>
				<li>Genre: <?php echo htmlspecialchars($genre); ?></li>
				<li>Price: <?php echo htmlspecialchars($price); ?></li>
			</ul>

			<p><?php echo htmlspecialchars(strip_tags($desc)); ?></p>
			<p>
				<a href="<?php echo htmlspecialchars($wiki); ?>" target="_blank">
					Learn more on Wikipedia
				</a>
			</p>
		</div>
	</div>
	</div>

</body>

</html>