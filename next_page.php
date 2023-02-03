<?php
$index_page = file_get_contents("index.html");

$text_to_change = "On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains";


$index_page = preg_replace('|(<div class="content">).+(</div>)|isU', "$1".$text_to_change."$2",$index_page);
$textpage_to_change = '<a class="pages" href="index.html">Previous Page</a>...<a class="pages" href="next_page.php">Next Page</a>';
$index_page = preg_replace('|(<div class="pages">).+(</div>)|isU', "$1".$textpage_to_change."$2",$index_page);

$textref_to_change = "'exit_sess.php?page=next_page'";

$index_page = preg_replace('|(<a class="exit" href=).+(>)|isU', "$1".$textref_to_change."$2",$index_page);


echo $index_page;

?>