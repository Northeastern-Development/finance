<?php /* Template Name: Location */ get_header(); ?>

	<main id="location" role="main" aria-label="Content">
		<div style="width:100vw;background:#000;height:180px;">


		</div>
		<div class="nu__hero-header"><a name="contact"></a>
			<h2><span class="nu__red-span">KRI</span> is <span>more than a location,</span> it is a place where <span>innovative tech-transfer</span> happens.</h2>
		</div>

		<section id="contact">
			<a name="contact">&nbsp;</a>
			<div class="flexbox" >

			  <div class="nu__col nu__col-left">
			  	<ul>
						<li class="active"><a href="#contact"  title="Click here to view the contact section" data-id="0">Contact</a></li>
						<li><a href="#directions" title="Click here to view the directions section"  data-id="1">Directions</a></li>
						<li><a href="#shuttle" title="Click here to view the shuttle section" data-id="2">Shuttle to KRI</a></li>
					</ul>
			  </div>
			  <div class="nu__col nu__col-right">
					<div class="nu__section-break" id="section-0"></div>
				 	<div style="clear:both;"></div>
					<div class="nu__col-copy">
						<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/kri_exterior.png" alt="Kostas Institute Exterior" style="float:right;">
						<p>We are located on the Northeastern University Innovation Campus at Burlington, 141 South Bedford Street, Burlington, Massachusetts 01803. </p>
						<p>Call or email us for information and to reserve a meeting space.</p>
						<a href="tel:7812388440" title="Click here to give us a call">781.238.8440</a><br><br>
						<a href="mailto:kostasinstitute@northeastern.edu" title="Click here to send us an email">kostasinstitute@northeastern.edu</a><br><br>
						<a class="nu-button " href="<?=home_url()?>/form">engage with kri</a>
					</div>
			  </div>
			</div>
		</section>

		<section id="directions">
			<a name="directions">&nbsp;</a>
			<div class="flexbox">

			  <div class="nu__col nu__col-left">
			  </div>
			  <div class="nu__col nu__col-right">
					<div class="nu__section-break" id="section-1"><a name="directions"></a></div>
					<div style="clear:both;"></div>
					<div class="nu__col-copy">
						<div id="map"></div>
						<h2>Directions from Boston</h2>
						<p>Take I-93 North to exit 37B onto I-95 South (also Rt. 128 South). From I-95/Rt. 128, take exit 33A in Burlington. Go straight for approximately ½ mile, then turn right at the lights onto South Bedford Street. Proceed about ¼ mile, then turn left at the red sign for Kostas Research Institute.</p>
						<h2>Directions from the West</h2>
						<p>From the Mass Pike (I-90), take exit 14 onto I-95 North (also Rt.128 North). From I-95/Rt. 128, take exit 33A in Burlington. Go straight for approximately ½ mile, then turn right at the lights onto South Bedford Street. Proceed about ¼ mile, then turn left at the red sign for Kostas Research Institute.</p>
						<h2>Directions from the North</h2>
						<p>From I-93 South, take exit 37B onto I-95 South (also Rt. 128 South); or, from Rt. 3 South, go to the end of Rt. 3 and exit onto I-95 North (also Rt. 128 North); or, from I-95 South, continue on I-95/Rt. 128 South to Burlington. From I-95/Rt. 128, take exit 33A in Burlington. Go straight for approximately ½ mile, then turn right at the lights onto South Bedford Street. Proceed about ¼ mile, then turn left at the red sign for Kostas Research Institute. The Kostas Institute is the three-story building on the right, at the top of the hill. There is ample parking to the left of the building.</p>
					</div>
				</div>

			</div>
		</section>

		<section id="shuttle">
			<a name="shuttle">&nbsp;</a>
			<div class="flexbox">

			  <div class="nu__col nu__col-left">

			  </div>
			  <div class="nu__col nu__col-right">
					<div class="nu__section-break" id="section-2"><a name="shuttle"></a></div>
				 <div style="clear:both;"></div>

				 <div class="nu__col-copy nu__list">
					 <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/kri_shuttle.jpg" alt="Kostas Institute Shuttle Bus" style="float:right;">
					 <p>The shuttle is a red 10-passenger Northeastern University van.</p>
					 <h2>From Boston</h2>
					 <p>The Wi-Fi-equipped red shuttle van departs Northeastern University’s main campus at the Bank of America ATM kiosk on Forsyth Street, Boston, Massachusetts 02155, at the following times:</p>
					 <ul>
						 <li>7:30 a.m.</li>
						 <li>11:45 a.m.</li>
						 <li>3:30 p.m.</li>
					 </ul>
					 <h2>From KRI in Burlington</h2>
					 <p>The shuttle van will pick up passengers from KRI and depart for the main campus at the following times:</p>
					 <ul>
						 <li>8:45 a.m.</li>
						 <li>12:45 p.m.</li>
						 <li>4:45 p.m.</li>
					 </ul>
				 </div>

						<!-- <p class="nu__col-copy">The shuttle is a red 10-passenger Northeastern University van.</p>

						<div class="nu__col-list" >
							<h2>From Boston</h2>
							<p>The Wi-Fi-equipped red shuttle van departs Northeastern University’s main campus at the Bank of America ATM kiosk on Forsyth Street, Boston, Massachusetts 02155, at the following times:</p>
							<ul>
								<li>7:30 a.m.</li>
								<li>11:45 a.m.</li>
								<li>3:30 p.m.</li>
							</ul>
							<h2>From KRI in Burlington</h2>
							<p>The shuttle van will pick up passengers from KRI and depart for the main campus at the following times:</p>
							<ul>
								<li>8:45 a.m.</li>
								<li>12:45 p.m.</li>
								<li>4:45 p.m.</li>
							</ul>
						</div>

						<div class="nu__col-list" >
							<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/kri_shuttle.jpg" alt="Kostas Institute Shuttle Bus" style="float:right;">

						</div> -->

					<p class="nu__col-copy" style="clear:both;">For questions regarding the shuttle, please contact the KRI Administrative Coordinator at <a href="tel:7812388440" title="Click here to give us a call">781-238-8440</a>.</p>
					</div>

			</div>
		</section>

	</main>
<?php get_footer(); ?>
