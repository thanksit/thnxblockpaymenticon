<div class="thnxblockpaymenticon block footer_payment_block {if isset($thnxblockpayment_column)}col-sm-{$thnxblockpayment_column}{/if} {$thnxblockpayment_float}">
	<div class="footer_payment_logo clearfix">
		<ul>
			{if $thnx_PAYPAL_URL != ''}
				<li><a href="{$thnx_PAYPAL_URL}" target="_blank">
					<img src="{$pi_path}paypal.png" alt="paypal" /></a>
				</li>
			{/if}
			{if $thnx_VISA_URL != ''}
				<li><a href="{$thnx_VISA_URL}" target="_blank">
					<img src="{$pi_path}visa.png" alt="visa" /></a>
				</li>
			{/if}
			{if $thnx_DISCOVER_URL != ''}
				<li><a href="{$thnx_DISCOVER_URL}" target="_blank">
					<img src="{$pi_path}discover.png" alt="discover" /></a>
				</li>
			{/if}
			{if $thnx_MASTERCART_URL != ''}
				<li><a href="{$thnx_MASTERCART_URL}" target="_blank">
					<img src="{$pi_path}mastercard.png" alt="mastercard" /></a>
				</li>
			{/if}
			{if $thnx_AMERICANEXPRESS_URL != ''}
				<li><a href="{$thnx_AMERICANEXPRESS_URL}" target="_blank">
					<img src="{$pi_path}american-express.png" alt="american-express" /></a>
				</li>
			{/if}
			{if $thnx_MAESTRO_URL != ''}
				<li><a href="{$thnx_MAESTRO_URL}" target="_blank">
					<img src="{$pi_path}maestro.png" alt="maestro" /></a>
				</li>
			{/if}
			{if $thnx_VISAELECTRON_URL != ''}
				<li><a href="{$thnx_VISAELECTRON_URL}" target="_blank">
					<img src="{$pi_path}visa-electron.png" alt="visa-electron" /></a>
				</li>
			{/if}
			{if $thnx_CIRRUS_URL != ''}
				<li><a href="{$thnx_CIRRUS_URL}" target="_blank">
					<img src="{$pi_path}cirrus.png" alt="cirrus" /></a>
				</li>
			{/if}
		</ul>
	</div>
</div>