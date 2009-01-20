{strip}
	{if $gBitSystem->getConfig('sharethis_api_key') && $gSharethisSystem->isShareable( $serviceHash )}
		<script language="javascript" type="text/javascript">
			var obj = SHARETHIS.addEntry({ldelim}
				title:'{$serviceHash.title|addslashes}',
				url:'{$smarty.const.BIT_BASE_URI}{$serviceHash.display_url|escape}'
			{rdelim}, {ldelim}button:true{rdelim} );
		</script>
	{/if}
{/strip}
