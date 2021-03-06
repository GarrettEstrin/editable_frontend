<?php 
  global $redis;
  $redis = new Redis();
  $redis->connect('sqlstage01', 6379);
  $redis->select(13);
  $page = $redis->hgetall('offer_sprint_com:pages:iphone');
  var_dump($page);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--[if lt IE 7]><html class="ie6" lang="en-GB" xmlns="https://www.w3.org/1999/xhtml"><![endif]-->
<!--[if IE 7]><html class="ie7" lang="en-GB" xmlns="https://www.w3.org/1999/xhtml"><![endif]-->
<!--[if IE 8]><html class="ie8" lang="en-GB" xmlns="https://www.w3.org/1999/xhtml"><![endif]-->
<!--[if IE 9]><html class="ie9" lang="en-GB" xmlns="https://www.w3.org/1999/xhtml"><![endif]-->
<!--[if IE 10]><html class="ie10" lang="en-GB" xmlns="https://www.w3.org/1999/xhtml"><![endif]-->
<!--[if gt IE 8]><!--><html lang="en-GB" xmlns="https://www.w3.org/1999/xhtml"><!--<![endif]-->
	<head>
		<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="ROBOTS" content="NOINDEX, NOFOLLOW">		
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<title>Cell Phones, Mobile Phones &amp; Wireless Calling Plans from Sprint</title>
    	<meta name="description" content="Shop for cell phones &amp; wireless calling plans from Sprint. Switch to Sprint today and find great deals on unlimited data plans for the whole family.">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<link href="style.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800,900" rel="stylesheet">
		<style>
		.top_section.nintyStyle .container .body_section_list .howlist li {
			list-style-image: none;
			list-style: none;
			margin: 0 0 0 -10px;
		}
			
		</style>
		<style>
			.offHoursDisplayNone {
				display: none !important;
			}
			.phonenumber.bolder {
				font-family: "SprintSans-Bold", 'Open Sans', sans-serif;
				font-weight: 800;
			}
		</style>
	</head>

	<body  x-ms-format-detection="none"	class="rel">
	 	<input id="customfield1" name="customfield1" type="hidden" value="69355" />
		

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" ></script>

<!-- transfer number script -->
<script type="text/javascript">
//append hidden field to from with default transfer number from offerbuilder
$(document).ready(function(){
	$('form').append('<input type="hidden" id="transfer_number" name="transfer_number" value="8555895865">');
	$('form').append("<input type='hidden' name='cpid' value='69355'>");
	setNewCookie('transfer_number','',0);
	setNewCookie('transfer_number', '8555895865', 14);

	if(typeof QD_Settings !== "undefined"){
		if($('#customfield1').val() !== '') {QD_Settings.cpid = $('#customfield1').val();}
	}
})
// function def to set transfer cookie
function setNewCookie(cname, cvalue, exdays) {
		var d = new Date();
		d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
		var expires = "expires=" + d.toGMTString();
		document.cookie = cname + "=" + cvalue + "; path=/; " + expires;
}
</script>

<noscript>
<img src="http://api.trustedform.com/ns.gif" />
</noscript>

		<div class="header">
			<div class="container cf">
				<div class="new-logo left"></div>

									<div class="right">
						<a href="https://www.sprint.com/en/login.html" target="_blank" class="signinlink right mobileonly">
							<div class="signin">
								Sign In v
							</div>
						</a>
						<div class="yellowcallbutton">
							<span class="call bolder jsEdit" data-point="phone-text"><?php echo $page['phone-text']; ?></span>
							<div class="blackphone left"></div>
							<div class="phonenum left bolder">
								<a href="tel:855-589-5865" placeholder="855-589-5865" ringpoolid="3097" class="anumber dp_phone_container_open cfnumber"><span class="bolder phonenumber">855-589-5865</span></a>	
							</div>
						</div>
					</div>
				
				<a href="https://www.sprint.com/en/login.html" target="_blank" class="signinlink right notShownOnMobile">
					<div class="signin">
						Sign In v
					</div>
				</a>
			</div>
		</div>
	
		<div class="purple_bar desktoponly notShownOnMobile">
			<div class="container cf">
				<div class="purpletag"></div>
				<div class="tagtext"></div>
			</div>
		</div>

		<div class="purple_bar tabletonly notShownOnMobile">
			<div class="container cf">
				<div class="tabpurpletag"></div>
				<div class="tabtagtext"></div>
			</div>
		</div>

		<div class="middlesection notShownOnMobile">
			<div class="container yellowarrowsection">
				<div class="middlecontent cf">
					<div class="phoneholder left">
													<img src="http://d33xc9jnluyfqe.cloudfront.net/cdn_asset/133/wp-content/themes/offer.sprint-sem-1.0/v8/images/iPhone.png" alt="iphone" class="mainphone" />
											</div>

					<div class="writing left">
						<div class="blackbarwriting bolder">
							<span class="jsEdit"data-point="hero-title"><?php echo $page['hero-title']; ?></span>
							<span class="unl">Unlimited for $20/mo per line</span>
							<span>when you add 5 lines.</span>
							<span class="skinny">That’s 5 lines of Unlimited for $100/mo.!</span>

							<div class="blackdownarrow"></div>
						</div>	
						
						<div class="belowbar">
							<div class="callorclick bolder">
								<span class="jsEdit" data-point="middle-title">Call & Get This <br>Limited-Time Offer</span>
							</div>

							<div class="blackshape">
								<span class="hdtext bolder">HD streaming video and 10 GB<br>Mobile Hotspot included  </span>
							</div>

							<div class="orangeoutline">
								<div class="innercontent">
									<span class="hereshow bolder jsEdit" data-point="list-title"><?php echo $page['list-title']; ?></span>
									<ol class="blacknumbers">
										<li>Your first line is just $60/mo.</li>
										<li>Need a second line? It’s just another $40/mo.</li>
										<li>And you will get your 3rd, 4th, and 5th lines for FREE!</li>
										<li>That's right - Get 5 lines for $100/mo!</li>
									</ol>
								</div>
							</div>
						</div>

						<!-- position absolute right stuff starts -->
													<img src="http://d33xc9jnluyfqe.cloudfront.net/cdn_asset/133/wp-content/themes/offer.sprint-sem-1.0/v8/images/circle-save-call.png" alt="" class="rightbubble" />
						

						<div class="desktoponly">					
							<div class="positionpurpleholder">
																	<div class="purplephonebar bolder"  style="display: none;">
										<a href="tel:855-589-5865" placeholder="855-589-5865" ringpoolid="3097" class="anumber dp_phone_container_open cfnumber"><span class="bolder phonenumber">855-589-5865</span></a>									</div>
									<a href="/go-to.php?a=100016&c=103281&s1=33443&s3=12638e6bb84de2d8e7133a46c8c4d168" ringpoolid="3097" placeholder="12638e6bb84de2d8e7133a46c8c4d168" target="_blank">
										<span class="orshoponline">Or Shop Online</span>
									</a>
															</div>
						</div>	
						<div class="tabletonly">
							<div class="positionpurpleholder">
																	<div class="tabpurplephonebar bolder">
										<a href="tel:855-589-5865" placeholder="855-589-5865" ringpoolid="3097" class="anumber dp_phone_container_open cfnumber"><span class="bolder phonenumber">855-589-5865</span></a>									</div>
									<a href="/go-to.php?a=100016&c=103281&s1=33443&s3=12638e6bb84de2d8e7133a46c8c4d168" ringpoolid="3097" placeholder="12638e6bb84de2d8e7133a46c8c4d168" target="_blank">
										<span class="orshoponline">Or Shop Online</span>
									</a>
															</div>	
						</div>
						<!-- position absolute right stuff ends -->
					</div>
					<div class="bottomlegal cf">
						<span class="legaltext jsEdit" data-point="above-fold-disc"><?php echo $page['above-fold-disc']; ?></span>
					</div>
				</div>
			</div>
		</div>

		<div class="whitepanel notShownOnMobile">
			<div class="container cf">
				<div class="grayleftbox left onHours">
				
											<span class="calltoorder">Call to Order Today!</span>
						<div class="bottomyellowblock cf">
							<div class="bbphone left"></div>
							<div class="phonenum left bolder">
								<a href="tel:855-589-5865" placeholder="855-589-5865" ringpoolid="3097" class="anumber dp_phone_container_open cfnumber"><span class="bolder phonenumber">855-589-5865</span></a>							</div>
						</div>
									</div>
				<img src="http://d33xc9jnluyfqe.cloudfront.net/cdn_asset/133/wp-content/themes/offer.sprint-sem-1.0/v8/images/bestprice.png" alt="" class="bestpricearrow right onHours" />
			</div>
		</div>

		<!-- MOBILE SECTION STARTS HERE -->
		<div class="mobonly">
			<div class="toppurplebar">
				<div class="container">
					<div class="mobtoppurpline"></div>
				</div>
			</div>
			<div class="lightpurple cf">
				<div class="container">
					<div class="tinytag left"></div>
					<div class="whenyoutext left">When you call or order online!</div>
				</div>
			</div>
			<div class="black">
				<div class="container">
					<span class="bolder">Switch to Sprint and get</span>
					<span class="unl bolder">Unlimited for $20/mo per line</span>
					<span class="bolder">when you add 5 lines.</span>
					<span class="skinny">That’s 5 lines of Unlimited for $100/mo.!</span>
				</div>
			</div>
			<div class="yellow">
				<div class="container">
											<div class="tabpurplephonebar bolder">
							<a href="tel:855-589-5865" placeholder="855-589-5865" ringpoolid="3097" class="anumber dp_phone_container_open cfnumber"><span class="bolder phonenumber">855-589-5865</span></a>						</div>
						<a href="/go-to.php?a=100016&c=103281&s1=33443&s3=12638e6bb84de2d8e7133a46c8c4d168" ringpoolid="3097" placeholder="12638e6bb84de2d8e7133a46c8c4d168" target="_blank">
							<span class="orshoponline">Or Shop Online</span>
						</a>
									</div>
			</div>
			<div class="darkyellow">
				<div class="container">
					<div class="innercontent">
						<span class="hereshow bolder">Here's how it works!</span>
						<ol class="blacknumbers">
							<li>Your first line is just $60/mo.</li>
							<li>Need a second line? It’s just another $40/mo.</li>
							<li>And you will get your 3rd, 4th, and 5th lines for FREE!</li>
							<li>That's right - Get 5 lines for $100/mo!</li>
						</ol>
						<span class="thebest bolder">The BEST Price for Unlimited</span>
					</div>
				</div>
			</div>
			<div class="yellow">
				<div class="container">
					<span class="legal">Limited time offer.  Savings until 1/31/19; then $60/mo. for line 1, $40/mo. for line 2 and $30/mo./line for lines 3-5. With AutoPay discount applied w/in 2 inv. Includes unlimited talk, text and data. Streams video at up to HD 1080p, music at up to 1.5mbps, gaming at up to 8mbps. Data deprioritization during congestion. MHS, P2P and VPN reduced to 2G speeds after 10GB/mo. Compared to similar unlimited plans from national carriers.  Carrier features differ. Other monthly charges apply.**</span>

											<div class="tabpurplephonebar bolder">
							<a href="tel:855-589-5865" placeholder="855-589-5865" ringpoolid="3097" class="anumber dp_phone_container_open cfnumber"><span class="bolder phonenumber">855-589-5865</span></a>						</div>
					

					<div class="phoneandtext cf">
						<div class="leftmobphoneholder left">
															<img src="http://d33xc9jnluyfqe.cloudfront.net/cdn_asset/133/wp-content/themes/offer.sprint-sem-1.0/v8/images/iPhone.png" alt="iphone" class="mainphone" />
													</div>
						<div class="leftmobtext left">
							<div class="callorclick bolder">
								<div class="uparrow"></div>
								<span>Call & get this <br>limited-time offer</span>
							</div>
							<a href="/go-to.php?a=100016&c=103281&s1=33443&s3=12638e6bb84de2d8e7133a46c8c4d168" ringpoolid="3097" placeholder="12638e6bb84de2d8e7133a46c8c4d168" target="_blank">
								<div>
									<span class="shoponline">Shop Online</span>
								</div>
							</a>
						</div>
					</div>
				</div>
			</div>

		</div>
		<!-- MOBILE SECTION ENDS HERE -->
		<div class="bottomgray">
			<div class="container">
				<span class="bottomlegal">
					** Mo. charges excl. taxes & Sprint Surcharges [incl. USF charge of up to 18.8% (varies quarterly), up to $2.50 Admin. & 40¢ Reg. /line/mo.) & fees by area (approx. 5 -20%)].  Surcharges are not taxes. See sprint.com/taxesandfees. <br><br>

					Activ. Fee: Up to $30/line. Credit approval req. Req. eBill & new acct. activ. Sprint Unlimited Freedom Plan: Incl. unlimited domestic calling, texting & data. Third-party content/downloads are add'l. charge. Sel. int'l. svc. incl. See sprint.com/globalroaming. Plan not avail. for tablets/MBB devices. AutoPay: $5/mo. discount may not reflect on 1st bill. Quality of Svc. (QoS): Customers who use more than 23GB of data during a billing cycle will be deprioritized during times & places where the Sprint network is constrained. See sprint.com/networkmanagement for details. Usage Limitations: To improve data experience for the majority of users, throughput may be limited, varied or reduced on the network. Sprint may terminate svc. if off-network roaming usage in a mo. exceeds: (1) 800 min. or a majority of min.; or (2) 100MB or a majority of KB. Prohibited network use rules apply --see sprint.com/termsandconditions. Other Terms: Offer/coverage not avail. everywhere or for all phones/networks. Restrictions apply. See store or sprint.com for details. <br><br>

					© 2017 Sprint. All rights reserved. Sprint & logo are trademarks of Sprint. Other marks are property of their respective owners.<br><br>

				</span>

				<div class="footer-nav right">
					<a href="https://www.sprint.com/legal?INTNAV=Footer%3ALegal" target="_blank">Legal</a>
					<a href="http://goodworks.sprint.com/people/customers/privacy?INTNAV=Footer:Privacy" target="_blank">Privacy</a>
					<a href="https://www.sprint.com/legal/ctia_checklist.html?INTNAV=Footer:Regulatory" target="_blank">CITA/Regulatory</a>
					<a href="https://shop2.sprint.com/en/legal/os_general_terms_conditions_popup.shtml?INTNAV=Footer:TermsandConditions" target="_blank">Terms &amp; conditions</a>
				</div>
			</div>
		</div>



 <script>
 (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
 (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
 m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
 })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

 ga('create', 'UA-37149855-3', 'auto');
 ga('send', 'pageview');

</script>



<script>if (typeof(_satellite) !== 'undefined') { _satellite.pageBottom();}</script>
<style>
  .input-cont {
    border: solid black 1px;
    padding: 10px;
    position: absolute;
    text-align: center;
    background-color: white;
  }
  .input-cont input {
    margin: 5px auto;
  }
</style>
<?php if($_GET['editable'] == 'true'){include './edit.php';} ?>
</body>

</html>
<!-- Performance optimized by W3 Total Cache. Learn more: https://www.w3-edge.com/products/

Content Delivery Network via Amazon Web Services: CloudFront: d33xc9jnluyfqe.cloudfront.net

 Served from: offer.sprint.com @ 2018-04-28 17:20:42 by W3 Total Cache -->