{strip}
{if $gBitSystem->isPackageActive( 'sharethis' )}
	{assign var=styles value=$gSharethisSystem->getStyles()}
	{if $gBitSystem->getConfig('sharethis_api_key')}
		<script type="text/javascript" src="http://w.sharethis.com/button/sharethis.js
			#tabs=
			{foreach from=$styles.tabs key=key item=tab name=tabs}
				{$key|regex_replace:"/sharethis_style_tab_/":""}{if !$smarty.foreach.tabs.last}%2C{/if}
			{/foreach}
			{foreach from=$styles.colors key=key item=color name=colors}
				&amp;{$key|regex_replace:"/sharethis_style_color_/":""}={$color|regex_replace:"/#/":"%23"}
			{/foreach}
			&amp;style={$gBitSystem->getConfig('sharethis_style_button')}
			&amp;publisher={$gBitSystem->getConfig('sharethis_api_key')}
			&amp;charset=utf-8
			"></script>
	{/if}
{/if}
{/strip}
