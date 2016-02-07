{if $packageMenuTitle}<a href="#"> {tr}{$packageMenuTitle|capitalize}{/tr}</a>{/if}
<ul class="{$packageMenuClass}">
	<li><a class="item" href="{$smarty.const.KERNEL_PKG_URL}admin/index.php?page=sharethis">{tr}ShareThis{/tr}</a></li>
		{if $gBitSystem->getConfig('sharethis_api_key')}<li><a class="item" href="http://sharethis.com/account/">ShareThis Dashboard</a></li>{/if}
</ul>
