<header>
<? 
$numberOfPages = $totalNumberOfFiles / $usualNumberOfThumbs;
for($_page = 0; $_page < $numberOfPages; $_page++) { ?>
	<a href="<?= indexLink($_page) ?>" <? if($page == $_page) { ?>class="current_page"<? } ?>>P<?= $_page + 1 ?> </a>
<? } ?>
<div>
<? if(!$build) { ?>
<? if(!logged()) { ?>
<label for="user">user</label>
<input type="text" id="user" />

<label for="password">password</label>
<input type="password" id="password" />

<input type="button" value="log in" onclick="log();" />
<? } else { ?>
<input type="button" value="add new" onclick="add();" />
<input type="button" value="build page" onclick="buildThumbnailPage(<?= $page ?>, false);" />
<input type="button" value="build site" onclick="buildImagePage(0, true);" />

<input type="hidden" value="" id="user" />
<input type="hidden" value="" id="password" />
<input type="button" value="log out" onclick="log();" />
<? } ?>
<? } ?> 
</div>
</header>