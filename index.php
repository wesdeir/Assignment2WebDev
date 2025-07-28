<?php
// 1) Include the data loader
require_once __DIR__ . '/utilities/dataAccess.php';

// 2) Load data
$paintings = getPaintings();
$artists = getArtists();

// 3) Build artist-name -> id map
$nameToId = array();
foreach ($artists as $a) {
	$nameToId[$a[1]] = $a[0];
}

// 4) Build & sort genres manually
$genres = array();
foreach ($paintings as $p) {
	$genres[] = $p[9];  // genre is at index 9
}
$genres = array_unique($genres);
sort($genres);

// 5) Determine current genre filter
$currentGenre = isset($_GET['genre']) ? $_GET['genre'] : '';
?>
<!DOCTYPE html
	PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>Assign2-Home Page of Art Gallery</title>
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
			<div class="grid_9">
				<div class="container_12">

					<div class="grid_12">
						<h1>
							<?php
							if ($currentGenre) {
								echo htmlspecialchars($currentGenre);
							} else {
								echo 'All Paintings';
							}
							?>
						</h1>
					</div>

					<?php foreach ($paintings as $p):
						list($id, $artistName, $title, $year, $w, $h, $price, $desc, $wiki, $genre) = $p;
						if ($currentGenre && $genre !== $currentGenre)
							continue;
						?>

						<!-- Thumbnail column -->
						<div class="grid_3">
							<a href="singlePainting.php?id=<?php echo $id; ?>">
								<img src="resources/paintings/square-small/<?php echo $id; ?>.jpg"
									alt="<?php echo htmlspecialchars($title); ?>" />
							</a>
						</div>
						
						<!-- Title column -->
						<div class="grid_6">
							<h3>
								<a href="singlePainting.php?id=<?php echo $id; ?>">
									<?php echo htmlspecialchars($title); ?>
								</a>
							</h3>
						</div>

						<!-- Artist column -->
						<div class="grid_3">
							<p>
								by
								<a href="singleArtist.php?id=<?php echo $nameToId[$artistName]; ?>">
									<?php echo htmlspecialchars($artistName); ?>
								</a>
							</p>
						</div>

						<div class="clear"></div>
					<?php endforeach; ?>

				</div>
			</div>