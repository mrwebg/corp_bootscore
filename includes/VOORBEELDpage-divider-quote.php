<?php
$page_id = 0;
if (is_archive()) {
    if (is_post_type_archive(array('mensen'))) {
        if (function_exists('pll_current_language')) {
            $lang = pll_current_language();
            $page_id = ('nl' === $lang) ? 25 : 699;
        } else {
            $page_id = 25;
        }
    }
    if (is_post_type_archive(array('deals'))) {
        if (function_exists('pll_current_language')) {
            $lang = pll_current_language();
            $page_id = ('nl' === $lang) ? 23 : 701;
        } else {
            $page_id = 23;
        }
    }
} else if (is_home()) {
    $page_id = get_option('page_for_posts');
} else {
    $page_id = get_the_ID();
}
?>
<?php $select_quote = get_post_meta($page_id, _CMB . 'select_quote', true); ?>
<?php $select_divider = get_post_meta($page_id, _CMB . 'select_divider', true); ?>
<?php $text_bron = get_post_meta($select_quote, _CMB . 'text_bron', true); ?>
<?php $url_bron = get_post_meta($select_quote, _CMB . 'url_bron', true); ?>
<?php $hasQuote = (!empty($select_quote)) ? true : false; ?>
<?php $hasBron = (!empty($text_bron)) ? true : false; ?>
<?php $hasUrl = (!empty($url_bron)) ? true : false; ?>
<?php $hasDivider = (!empty($select_divider)) ? true : false; ?>
<?php $layoutTwoColumns = ($hasQuote && $hasDivider) ? true : false; ?>
<?php if ($hasQuote || $hasDivider) { ?>
    <!-- OPTIONAL CONTENT QUOTE & DIVIDER -->
    <div class="bcw">
        <div class="height-1-em" style="border-bottom:2px dotted #525252;"></div>
        <div class="wrap">
            <div class="grid-container mobile-no-padding page-divider-quote">
                <?php if ($layoutTwoColumns) { ?>
                    <div class="grid-parent grid-50 tablet-grid-50 mobile-grid-100" style="min-height:180px;overflow:hidden;">
                        <div style="min-height:180px;overflow:hidden;padding:42px;background-color:#e6e6e6;">
                            <div class="clearfix">
                                <div class="inline floatleft" style="background-color:#525252;border-radius:50%;width:48px;height:48px;vertical-align:middle;text-align:center;padding:8px;">
                                    <svg class="icon" style="color:#e6e6e6;width:24px;height:24px;line-height:48px;"><use xlink:href="#icon-quote"></use></svg>
                                </div>
                                <div style="margin-left:64px;overflow:hidden;">
                                    <div class="fcd fwl mb0 ttuc h4" style="line-height:1.5;"><?php print get_the_title(intval($select_quote)); ?></div>
                                    <?php if ($hasBron) { ?>
                                        <cite class="pad-top">
                                            <?php if ($hasUrl) { ?>
                                                <div class="quote-bron"><a href="<?php print $url_bron; ?>" target="_blank"><?php print $text_bron; ?></a></div>
                                            <?php } else { ?>
                                                <div class="quote-bron"><?php print $text_bron; ?></div>
                                            <?php } ?>
                                        </cite>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="grid-parent grid-50 tablet-grid-50 mobile-grid-100" style="min-height:180px;overflow:hidden;background-image:url('<?php print get_the_post_thumbnail_url(intval($select_divider), 'full'); ?>');background-position:center center;background-size:cover;background-repeat:no-repeat;"></div>
                <?php } else { ?>
                    <?php if ($hasQuote) { ?>
                        <div class="grid-parent prefix-10 grid-80 suffix-10 tablet-grid-100 mobile-grid-100" style="min-height:180px;">
                            <div style="min-height:180px;overflow:hidden;padding:42px;background-color:#e6e6e6;">
                                <div class="clearfix">
                                    <div class="inline floatleft" style="background-color:#525252;border-radius:50%;width:48px;height:48px;vertical-align:middle;text-align:center;padding:8px;">
                                        <svg class="icon" style="color:#e6e6e6;width:24px;height:24px;line-height:48px;"><use xlink:href="#icon-quote"></use></svg>
                                    </div>
                                    <div style="margin-left:64px;overflow:hidden;">
                                        <div class="fcd fwl mb0 ttuc h4" style="line-height:1.5;"><?php print get_the_title(intval($select_quote)); ?></div>
                                        <?php if ($hasBron) { ?>
                                            <cite class="pad-top">
                                                <?php if ($hasUrl) { ?>
                                                    <div class="quote-bron"><a href="<?php print $url_bron; ?>" target="_blank"><?php print $text_bron; ?></a></div>
                                                <?php } else { ?>
                                                    <div class="quote-bron"><?php print $text_bron; ?></div>
                                                <?php } ?>
                                            </cite>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="grid-parent prefix-10 grid-80 suffix-10 tablet-grid-100 mobile-grid-100" style="min-height:180px;background-image:url('<?php print get_the_post_thumbnail_url(intval($select_divider), 'full'); ?>');background-position:center center;background-size:cover;background-repeat:no-repeat;"></div>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
        <div class="height-1-em" style="border-top:2px dotted #525252;margin-bottom:1em;"></div>
    </div>
    <?php
}
