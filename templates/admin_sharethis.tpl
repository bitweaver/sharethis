{strip}
{form}	
	{jstabs}
		{jstab title="Service Settings"}
			<input type="hidden" name="page" value="{$page}" />
			{legend legend="Service Settings"}
				<div class="control-group">
					{formlabel label="ShareThis publisher api key" for="sharethis_api_key"}
					{forminput}
						<input type="text" name="sharethis_api_key" size="50" value="{if $gBitSystem->getConfig('sharethis_api_key')}{$gBitSystem->getConfig('sharethis_api_key')}{/if}" />
						{if !$gBitSystem->getConfig('sharethis_api_key')}
							{formfeedback warning="You must get a key from Sharethis.com!"}
							{formhelp note='You can get a key at <a class="external" href="http://sharethis.com/publishers/getcode/">http://sharethis.com/publishers/getcode/</a> (you must already have an account). On the get code page you will see a block of javascript, look for the "publisher" value and copy the number after it, this is your api key.'}
						{/if}
					{/forminput}
				</div>
				{if $gBitSystem->getConfig('sharethis_api_key')}
					<div class="control-group">
						{if $gBitSystem->getConfig('sharethis_api_key')}<li><a class="external" href="http://sharethis.com/account/">ShareThis Dashboard</a> (requires account login)</li>{/if}
					</div>
				{/if}
			{/legend}
			{legend legend="Display Locations"}
				{foreach from=$formServiceOptions key=item item=output}
					<div class="control-group">
						{formlabel label=$output.label for=$item}
						{forminput}
							{if $output.type == 'numeric'}
								<input size="5" type='text' name="{$item}" id="{$item}" value="{$gBitSystem->getConfig($item,$output.default)}" />
							{elseif $output.type == 'input'}
								<input type='text' name="{$item}" id="{$item}" value="{$gBitSystem->getConfig($item,$output.default)}" />
							{else}
								{html_checkboxes name="$item" values="y" checked=$gBitSystem->getConfig($item) labels=false id=$item}
							{/if}
							{formhelp note=$output.note page=$output.page}
						{/forminput}
					</div>
				{/foreach}
			{/legend}
			{legend legend="Shareable Content"}
				<div class="control-group">
					{formlabel label="Shareable Content Types"}
					{forminput}
						{html_checkboxes options=$formContentTypes.guids name=sharethis_content separator="<br />" checked=$formContentTypes.checked}
						{formhelp note="Here you can select what content type pages will display the ShareThis box."}
					{/forminput}
				</div>
			{/legend}
		{/jstab}
		{jstab title="Styles"}
			{if $gBitSystem->getConfig('sharethis_api_key')}
				{legend legend="Preview"}
					{formlabel label="Current Styles"}
					{include file="bitpackage:sharethis/html_head_inc.tpl"}
				{/legend}
			{/if}
			{legend legend="Choose Your Button:"}
				<div class="control-group">
					{html_radios options=$formButtonStylesOptions values=$formButtonStylesOptions id=sharethis_style_button name=sharethis_style_button checked=$gBitSystem->getConfig('sharethis_style_button', 'default') separator="<br />"}
					{formhelp note="Select the icon which will be displayed."}
				</div>
			{/legend}
			{legend legend="Choose Your Tabs:"}
				<div class="control-group">
					{forminput}
						{foreach from=$formTabStylesOptions key=item item=output}
							<label>
								<input type="checkbox" name="{$item}" value="y" {if $gBitSystem->getConfig($item) eq 'y'}checked{/if} />{$output.label}<br />
							</label>
						{/foreach}
						{formhelp note="Select which sharing optionsShareThis box."}
					{/forminput}
				</div>
			{/legend}
			{legend legend="Choose Your Colors:"}
				{foreach from=$formColorStylesOptions key=item item=output}
					<div class="control-group">
						{formlabel label=$output.label for=$item}
						{forminput}
							{if $output.type == 'numeric'}
								<input size="5" type='text' name="{$item}" id="{$item}" value="{$gBitSystem->getConfig($item,$output.default)}" />
							{elseif $output.type == 'input'}
								<input type='text' name="{$item}" id="{$item}" value="{$gBitSystem->getConfig($item,$output.default)}" />
							{else}
								{html_checkboxes name="$item" values="y" checked=$gBitSystem->getConfig($item) labels=false id=$item}
							{/if}
							{formhelp note=$output.note page=$output.page}
						{/forminput}
					</div>
				{/foreach}
			{/legend}
		{/jstab}
	{/jstabs}
	<div class="buttonHolder row submit">
		<input type="submit" class="btn btn-default" name="sharethis_preferences" value="{tr}Change preferences{/tr}" />
	</div>
{/form}
{/strip}
