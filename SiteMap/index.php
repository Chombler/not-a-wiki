<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<?php include "../scripts/header.html"; ?>
<h5>Site Map</h5>
<ul>
<?php
$root = realpath(__DIR__ . "/..");
$pages = array();
$iterator = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($root, FilesystemIterator::SKIP_DOTS)
);
foreach ($iterator as $file) {
    if ($file->isFile() && $file->getFilename() === "index.php") {
        $relative = str_replace("\\", "/", substr($file->getPath(), strlen($root)));
        $relative = trim($relative, "/");
        $name = $relative === "" ? "Home" : preg_replace('/(?<=[a-z])[A-Z]/', ' $0', $relative);
        $href = "/realm/" . ($relative === "" ? "" : $relative . "/");
        $pages[$name] = $href;
    }
}
uksort($pages, "strnatcasecmp");
foreach ($pages as $name => $href) {
    echo '<li><a href="' . htmlspecialchars($href, ENT_QUOTES) . '">' . htmlspecialchars($name) . '</a></li>';
}
?>
</ul>
<?php include "../scripts/footer.html"; ?>
