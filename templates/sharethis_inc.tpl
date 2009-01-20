{strip}
	{if $gBitSystem->getConfig('sharethis_api_key') && $gSharethisSystem->isShareable( $gContent )}
		{assign var=title value=$gContent->getTitle()|default:$serviceHash.title}
		{assign var=display_url value=$gContent->getDisplayUrl()|default:$serviceHash.display_url}
		<script language="javascript" type="text/javascript">
			SHARETHIS.addEntry({ldelim}
				title:'{$title|addslashes}',
				url:'{$smarty.const.BIT_BASE_URI}{$display_url|escape}'
			{rdelim}, {ldelim}button:true{rdelim} );
		</script>
	{/if}
{/strip}
