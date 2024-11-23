<div class="pagination">
    <?php if (isset($_GET['o'])) {
		$o = $_GET['o'];
	} else {
		$o = "0";
	} ?>
    <div class="pagination">
        <div class="pagination">
            <?php
			echo $total;
			echo $o;
			echo "INFO";
			if ($total == 0) {
			} elseif ($total < 13) { ?>
            <a style="background:none;background-color: #c4c;border-color: #f7f;color: #89a;"
                class="page_button page_next">next &raquo;</a>
            <span class="page_button"
                title="<?php echo $currentpage ?>?o=<?php echo $o + 0 ?>&game=<?php echo $_GET['game'] ?>"><?php echo ($o + 12) / 12 ?></span>
            <span class="page_button x`"
                href="<?php echo $currentpage ?>?o=<?php echo $o - 12 ?>&game=<?php echo $_GET['game'] ?>">&laquo;</span>
        </div>
        <?php } elseif ($total < 26) { ?>
        <?php if ($o < 12) { ?>
        <a class="page_button page_next"
            href="<?php echo $currentpage ?>?o=<?php echo $o + 12 ?>&game=<?php echo $_GET['game'] ?>">next &raquo;</a>
        <a class="page_button"
            href="<?php echo $currentpage ?>?o=<?php echo $o + 12 ?>&game=<?php echo $_GET['game'] ?>"><?php echo ($o + 24) / 12 ?></a>

        <span class="page_button"
            title="<?php echo $currentpage ?>?o=<?php echo $o + 0 ?>&game=<?php echo $_GET['game'] ?>"><?php echo ($o + 12) / 12 ?></span>
        <span class="page_button page_button_inactive"
            href="<?php echo $currentpage ?>?o=<?php echo $o - 12 ?>&game=<?php echo $_GET['game'] ?>">&laquo;</span>
    </div>
    <?php } else { ?>
    <a style="background:none;background-color: #c4c;border-color: #f7f;color: #89a;" class="page_button page_next">next
        &raquo;</a>
    <span class="page_button"
        href="<?php echo $currentpage ?>?o=<?php echo $o + 0 ?>&game=<?php echo $_GET['game'] ?>"><?php echo ($o + 12) / 12 ?></span>

    <a class="page_button"
        href="<?php echo $currentpage ?>?o=<?php echo $o - 12 ?>&game=<?php echo $_GET['game'] ?>"><?php echo ($o + 0) / 12 ?></a>
    <a class="page_button page_button_inactive"
        href="<?php echo $currentpage ?>?o=<?php echo $o - 12 ?>&game=<?php echo $_GET['game'] ?>">&laquo;</a>
</div>

<?php
				}
			} elseif (($o + 12) / 12 == 1) { ?>
<a class="page_button page_next"
    href="<?php echo $currentpage ?>?o=<?php echo $o + 12 ?>&game=<?php echo $_GET['game'] ?>">next &raquo;</a>
<a class="page_button"
    href="<?php echo $currentpage ?>?o=<?php echo $o + 72 ?>&game=<?php echo $_GET['game'] ?>"><?php echo ($o + 84) / 12 ?></a>
<a class="page_button"
    href="<?php echo $currentpage ?>?o=<?php echo $o + 60 ?>&game=<?php echo $_GET['game'] ?>"><?php echo ($o + 72) / 12 ?></a>
<a class="page_button"
    href="<?php echo $currentpage ?>?o=<?php echo $o + 48 ?>&game=<?php echo $_GET['game'] ?>"><?php echo ($o + 60) / 12 ?></a>
<a class="page_button"
    href="<?php echo $currentpage ?>?o=<?php echo $o + 36 ?>&game=<?php echo $_GET['game'] ?>"><?php echo ($o + 48) / 12 ?></a>
<a class="page_button"
    href="<?php echo $currentpage ?>?o=<?php echo $o + 24 ?>&game=<?php echo $_GET['game'] ?>"><?php echo ($o + 36) / 12 ?></a>
<a class="page_button"
    href="<?php echo $currentpage ?>?o=<?php echo $o + 12 ?>&game=<?php echo $_GET['game'] ?>"><?php echo ($o + 24) / 12 ?></a>
<span class="page_button"
    title="<?php echo $currentpage ?>?o=<?php echo $o ?>&game=<?php echo $_GET['game'] ?>"><?php echo ($o + 12) / 12 ?></span><span
    class="page_button page_button_inactive">&laquo;</span></div>
<?php } elseif ($o / 12 == 1) { ?>
<a class="page_button page_next"
    href="<?php echo $currentpage ?>?o=<?php echo $o + 12 ?>&game=<?php echo $_GET['game'] ?>">next &raquo;</a>
<a class="page_button"
    href="<?php echo $currentpage ?>?o=<?php echo $o + 60 ?>&game=<?php echo $_GET['game'] ?>"><?php echo ($o + 72) / 12 ?></a>
<a class="page_button"
    href="<?php echo $currentpage ?>?o=<?php echo $o + 48 ?>&game=<?php echo $_GET['game'] ?>"><?php echo ($o + 60) / 12 ?></a>
<a class="page_button"
    href="<?php echo $currentpage ?>?o=<?php echo $o + 36 ?>&game=<?php echo $_GET['game'] ?>"><?php echo ($o + 48) / 12 ?></a>
<a class="page_button"
    href="<?php echo $currentpage ?>?o=<?php echo $o + 24 ?>&game=<?php echo $_GET['game'] ?>"><?php echo ($o + 36) / 12 ?></a>
<a class="page_button"
    href="<?php echo $currentpage ?>?o=<?php echo $o + 12 ?>&game=<?php echo $_GET['game'] ?>"><?php echo ($o + 24) / 12 ?></a>
<span class="page_button"
    title="<?php echo $currentpage ?>?o=<?php echo $o ?>&game=<?php echo $_GET['game'] ?>"><?php echo ($o + 12) / 12 ?></span>
<a class="page_button"
    href="<?php echo $currentpage ?>?o=<?php echo $o - 12 ?>&game=<?php echo $_GET['game'] ?>"><?php echo ($o) / 12 ?></a>
<a class="page_button page_button_inactive"
    href="<?php echo $currentpage ?>?o=<?php echo $o - 12 ?>&game=<?php echo $_GET['game'] ?>">&laquo;</a></div>


<?php } elseif ($o / 12 == 2) { ?>
<a class="page_button page_next"
    href="<?php echo $currentpage ?>?o=<?php echo $o + 12 ?>&game=<?php echo $_GET['game'] ?>">next &raquo;</a>
<a class="page_button"
    href="<?php echo $currentpage ?>?o=<?php echo $o + 48 ?>&game=<?php echo $_GET['game'] ?>"><?php echo ($o + 60) / 12 ?></a>
<a class="page_button"
    href="<?php echo $currentpage ?>?o=<?php echo $o + 36 ?>&game=<?php echo $_GET['game'] ?>"><?php echo ($o + 48) / 12 ?></a>
<a class="page_button"
    href="<?php echo $currentpage ?>?o=<?php echo $o + 24 ?>&game=<?php echo $_GET['game'] ?>"><?php echo ($o + 36) / 12 ?></a>
<a class="page_button"
    href="<?php echo $currentpage ?>?o=<?php echo $o + 12 ?>&game=<?php echo $_GET['game'] ?>"><?php echo ($o + 24) / 12 ?></a>
<span class="page_button"
    title="<?php echo $currentpage ?>?o=<?php echo $o + 0 ?>&game=<?php echo $_GET['game'] ?>"><?php echo ($o + 12) / 12 ?></span>
<a class="page_button"
    href="<?php echo $currentpage ?>?o=<?php echo $o - 12 ?>&game=<?php echo $_GET['game'] ?>"><?php echo ($o + 0) / 12 ?></a>
<a class="page_button"
    href="<?php echo $currentpage ?>?o=<?php echo $o - 24 ?>&game=<?php echo $_GET['game'] ?>"><?php echo ($o - 12) / 12 ?></a>
<a class="page_button page_button_inactive"
    href="<?php echo $currentpage ?>?o=<?php echo $o - 12 ?>&game=<?php echo $_GET['game'] ?>">&laquo;</a></div>
<?php } elseif ($total - $o < 13) { ?>
<a style="background:none;background-color: #c4c;border-color: #f7f;color: #89a;" class="page_button page_next">next
    &raquo;</a>
<span class="page_button"
    title="<?php echo $currentpage ?>?o=<?php echo $o + 0 ?>&game=<?php echo $_GET['game'] ?>"><?php echo ($o + 12) / 12 ?></span>
<a class="page_button"
    href="<?php echo $currentpage ?>?o=<?php echo $o - 12 ?>&game=<?php echo $_GET['game'] ?>"><?php echo ($o + 0) / 12 ?></a>
<a class="page_button"
    href="<?php echo $currentpage ?>?o=<?php echo $o - 24 ?>&game=<?php echo $_GET['game'] ?>"><?php echo ($o - 12) / 12 ?></a>
<a class="page_button"
    href="<?php echo $currentpage ?>?o=<?php echo $o - 36 ?>&game=<?php echo $_GET['game'] ?>"><?php echo ($o - 24) / 12 ?></a>
<a class="page_button"
    href="<?php echo $currentpage ?>?o=<?php echo $o - 48 ?>&game=<?php echo $_GET['game'] ?>"><?php echo ($o - 36) / 12 ?></a>
<a class="page_button"
    href="<?php echo $currentpage ?>?o=<?php echo $o - 60 ?>&game=<?php echo $_GET['game'] ?>"><?php echo ($o - 48) / 12 ?></a>
<a class="page_button"
    href="<?php echo $currentpage ?>?o=<?php echo $o - 72 ?>&game=<?php echo $_GET['game'] ?>"><?php echo ($o - 60) / 12 ?></a>

<a class="page_button page_button_inactive"
    href="<?php echo $currentpage ?>?o=<?php echo $o - 12 ?>&game=<?php echo $_GET['game'] ?>">&laquo;</a></div>
<?php } elseif ($total - $o < 26) { ?>
<a class="page_button page_next"
    href="<?php echo $currentpage ?>?o=<?php echo $o + 12 ?>&game=<?php echo $_GET['game'] ?>">next &raquo;</a>
<a class="page_button"
    href="<?php echo $currentpage ?>?o=<?php echo $o + 12 ?>&game=<?php echo $_GET['game'] ?>"><?php echo ($o + 24) / 12 ?></a>

<span class="page_button"
    title="<?php echo $currentpage ?>?o=<?php echo $o + 0 ?>&game=<?php echo $_GET['game'] ?>"><?php echo ($o + 12) / 12 ?></span>
<a class="page_button"
    href="<?php echo $currentpage ?>?o=<?php echo $o - 12 ?>&game=<?php echo $_GET['game'] ?>"><?php echo ($o + 0) / 12 ?></a>
<a class="page_button"
    href="<?php echo $currentpage ?>?o=<?php echo $o - 24 ?>&game=<?php echo $_GET['game'] ?>"><?php echo ($o - 12) / 12 ?></a>
<a class="page_button"
    href="<?php echo $currentpage ?>?o=<?php echo $o - 36 ?>&game=<?php echo $_GET['game'] ?>"><?php echo ($o - 24) / 12 ?></a>
<a class="page_button"
    href="<?php echo $currentpage ?>?o=<?php echo $o - 48 ?>&game=<?php echo $_GET['game'] ?>"><?php echo ($o - 36) / 12 ?></a>
<a class="page_button"
    href="<?php echo $currentpage ?>?o=<?php echo $o - 60 ?>&game=<?php echo $_GET['game'] ?>"><?php echo ($o - 48) / 12 ?></a>

<a class="page_button page_button_inactive"
    href="<?php echo $currentpage ?>?o=<?php echo $o - 12 ?>&game=<?php echo $_GET['game'] ?>">&laquo;</a></div>
<?php } elseif ($total - $o < 39) { ?>
<a class="page_button page_next"
    href="<?php echo $currentpage ?>?o=<?php echo $o + 12 ?>&game=<?php echo $_GET['game'] ?>">next &raquo;</a>
<a class="page_button"
    href="<?php echo $currentpage ?>?o=<?php echo $o + 24 ?>&game=<?php echo $_GET['game'] ?>"><?php echo ($o + 36) / 12 ?></a>
<a class="page_button"
    href="<?php echo $currentpage ?>?o=<?php echo $o + 12 ?>&game=<?php echo $_GET['game'] ?>"><?php echo ($o + 24) / 12 ?></a>

<span class="page_button"
    title="<?php echo $currentpage ?>?o=<?php echo $o + 0 ?>&game=<?php echo $_GET['game'] ?>"><?php echo ($o + 12) / 12 ?></span>
<a class="page_button"
    href="<?php echo $currentpage ?>?o=<?php echo $o - 12 ?>&game=<?php echo $_GET['game'] ?>"><?php echo ($o + 0) / 12 ?></a>
<a class="page_button"
    href="<?php echo $currentpage ?>?o=<?php echo $o - 24 ?>&game=<?php echo $_GET['game'] ?>"><?php echo ($o - 12) / 12 ?></a>
<a class="page_button"
    href="<?php echo $currentpage ?>?o=<?php echo $o - 36 ?>&game=<?php echo $_GET['game'] ?>"><?php echo ($o - 24) / 12 ?></a>
<a class="page_button"
    href="<?php echo $currentpage ?>?o=<?php echo $o - 48 ?>&game=<?php echo $_GET['game'] ?>"><?php echo ($o - 36) / 12 ?></a>

<a class="page_button page_button_inactive"
    href="<?php echo $currentpage ?>?o=<?php echo $o - 12 ?>&game=<?php echo $_GET['game'] ?>">&laquo;</a></div>

<?php } else { ?>
<a class="page_button page_next"
    href="<?php echo $currentpage ?>?o=<?php echo $o + 12 ?>&game=<?php echo $_GET['game'] ?>">next &raquo;</a>
<a class="page_button"
    href="<?php echo $currentpage ?>?o=<?php echo $o + 36 ?>&game=<?php echo $_GET['game'] ?>"><?php echo ($o + 48) / 12 ?></a>
<a class="page_button"
    href="<?php echo $currentpage ?>?o=<?php echo $o + 24 ?>&game=<?php echo $_GET['game'] ?>"><?php echo ($o + 36) / 12 ?></a>
<a class="page_button"
    href="<?php echo $currentpage ?>?o=<?php echo $o + 12 ?>&game=<?php echo $_GET['game'] ?>"><?php echo ($o + 24) / 12 ?></a>
<span class="page_button"
    title="<?php echo $currentpage ?>?o=<?php echo $o ?>&game=<?php echo $_GET['game'] ?>"><?php echo ($o + 12) / 12 ?></span>

<a class="page_button"
    href="<?php echo $currentpage ?>?o=<?php echo $o - 12 ?>&game=<?php echo $_GET['game'] ?>"><?php echo ($o + 0) / 12 ?></a>
<a class="page_button"
    href="<?php echo $currentpage ?>?o=<?php echo $o - 24 ?>&game=<?php echo $_GET['game'] ?>"><?php echo ($o - 12) / 12 ?></a>
<a class="page_button"
    href="<?php echo $currentpage ?>?o=<?php echo $o - 36 ?>&game=<?php echo $_GET['game'] ?>"><?php echo ($o - 24) / 12 ?></a>
<a class="page_button page_button_inactive"
    href="<?php echo $currentpage ?>?o=<?php echo $o - 12 ?>&game=<?php echo $_GET['game'] ?>">&laquo;</a></div>
<?php } ?>
<div class="spacer">&nbsp;</div>
</div>