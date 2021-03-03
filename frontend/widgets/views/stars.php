<?php
/**
 * @var $rating float
 */
?>
<? for ($i = 0; $i < 5; $i++):
    if (floor($rating) > $i) { ?>
        <span></span>
    <? } else { ?>
        <span class="star-disabled"></span>
    <? }
endfor; ?>
<b><?= $rating; ?></b>

