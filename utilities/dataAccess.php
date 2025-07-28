<?php
/**
 * Load a tilde-delimited text file from resources/
 *
 * @param  string  $filename  e.g. 'paintings.txt' or 'artists.txt'
 * @return array               Parsed rows
 */
function loadData($filename)
{
    $path = __DIR__ . '/../resources/' . $filename;
    if (!file_exists($path)) {
        die("Data file not found at: $path");
    }

    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $rows = [];
    foreach ($lines as $line) {
        $rows[] = array_map('trim', explode('~', $line));
    }
    return $rows;
}

/** @return array */
function getPaintings()
{
    return loadData('paintings.txt');
}

/** @return array */
function getArtists()
{
    return loadData('artists.txt');
}