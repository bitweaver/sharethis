{strip}
	{if $gBitSystem->getConfig('sharethis_api_key') && $gSharethisSystem->isShareable( $serviceHash )}
		{* hack because comments objects do not currently have display_url value - when they do yank the gContent reference *}
		{assign var=display_url value=$gContent->getDisplayUrl()|default:$serviceHash.display_url}
		<script language="javascript" type="text/javascript">
			var obj = SHARETHIS.addEntry({ldelim}
				title:'{$serviceHash.title|addslashes}',
				url:'{$smarty.const.BIT_BASE_URI}{$display_url|escape}'
			{rdelim}, {ldelim}button:true{rdelim} );
		</script>
	{/if}
{/strip}
