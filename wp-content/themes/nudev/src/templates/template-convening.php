<?php /* Template Name: Form */ get_header(); ?>

<main id="location" role="main" aria-label="Content">
	<div style="width:100vw;background:#000;height:180px;">


	</div>
	<div class="nu__hero-header"><a name="convening"></a>
		<h2><span style="color:rgba(204, 0, 0, 1.0);">KRI</span> provides a <span>private</span> and as-needed <span>secure convening venue</span> for researchers, industry practitioners, and government agencies.</h2>
		<div style="text-align:center;margin-bottom:2vw;"><a class="nu-button " href="<?=home_url()?>/form" >hold your meeting at kri</a></div>
	</div>

	<section id="convening" >

		<div class="flexbox">
			<div class="nu__col nu__col-left">
				<ul style="position:absolute;">
					<li style="font-weight:700;">Convening Examples</li>
					<!-- <li><a href="#request" title="Click here to view the request space section" data-id="1">Request Space</a></li> -->
				</ul>
			</div>
			<div class="nu__col nu__col-right">
				<div class="nu__section-break" id="section-0"></div>
				<div style="clear:both;"></div>
				<div class="nu__col-copy">
					<h4>Government Agencies</h4>
					<ul>
						<li>Materials Genome Initiative, White House Office of Security and Technology Policy</li>
						<li>Army Research Laboratory</li>
						<li>Naval Postgraduate School Homeland Security & Defense Education Summit</li>
						<li>FBI Joint Terrorism Task Force and Counterintelligence Working Group</li>
					  <li>U.S. Attorney Counter-Proliferation and Espionage Workshop</li>
						<li>DHS NPPD Energy Resilience Workshop</li>
						<li>Fort Bragg Deputy Commanding General Roundtable</li>
						<li>U.S. Coast Guard Commandant Admiral Paul Zukunft Roundtable</li>
					  <li>U.S. Secret Service Electronic Crimes Task Force</li>
						<li>FEMA Regional Catastrophic Preparedness Grant Program</li>
						<li>U.S. Northern Command, Support of Civil Authorities</li>
						<li>Hanscom Air Force Base Education Partnership Agreement</li>
						<li>Defense Security Service, Center for Development of Security Excellence</li>
					</ul>
					<h4>Industry and Academia</h4>
					<ul>
						<li>Raytheon Integrated Defense Systems</li>
						<li>MITRE</li>
						<li>Sumitomo Chemical Research Meeting</li>
						<li>Rogers Corporation and Dow Chemical</li>
						<li>Nanomanufacturing Symposium</li>
						<li>NSF Center for Advanced Research in Forensic Science</li>
						<li>ALERT (Department of Homeland Security Center of Excellence)</li>
						<li>D’Amore-McKim School of Business</li>
						<li>Graduate Homeland Security Program</li>
					</ul>
					<h4>Regional Associations</h4>
					<ul>
						<li>Collaborative Research and Development Matching Grant Program, Massachusetts Technology Collaborative, Administration of Governor Charlie Baker</li>
						<li>Startup Day Across America Roundtable, Congressman Seth Moulton</li>
						<li>Massachusetts Emergency Management Agency</li>
						<li>Massachusetts State Police Training</li>
						<li>National Network for Manufacturing Innovation</li>
						<li>Boston Emergency Management</li>
						<li>Boston Public Health Commission</li>
						<li>Red Cross Regional Mass Care</li>
						<li>Advanced Cyber Security Consortium</li>
						<li>New England Council and Deloitte Advanced Manufacturing Summit</li>
						<li>NIST Sustainable Manufacturing</li>
						<li>National Defense Industrial Association</li>
					</ul>
				</div>
			</div>
		</div>
	</section>

	<section id="collage">
		<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/kri_convening_gallery.jpg" alt="Kostas Institute collage">
	</section>

	<section id="contact" style="margin-top:40px;">
		<div class="flexbox">
			<div class="nu__col nu__col-left">
				<ul>
					<li class="active"><a href="#contact">Contact</a></li>
					<li><a href="#directions">Directions</a></li>
					<li><a href="#shuttle">Shuttle</a></li>
				</ul>
			</div>
			<div class="nu__col nu__col-right nu__garb" style="border-top:none">
				<div class="nu__section-break" id="section-1"><a name="request"></a></div>
				<div style="clear:both;"></div>
				<div class="nu__col-copy">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/kri_exterior.png" alt="Kostas Institute Exterior" style="float:right;">
					<p>We are located at 141 South Bedford Street, Burlington, Massachusetts 01803.</p>
					<p>Call or email us for information and to reserve a meeting space.</p>
					<a href="tel:7812388440" title="Click here to give us a call">781.238.8440</a><br><br>
					<a href="mailto:kostasinstitute@northeastern.edu" title="Click here to send us an email">kostasinstitute@northeastern.edu</a><br><br>
					<p>Or submit a form and we'll get back to you shortly</p><br>
					<a class="nu-button " href="<?=home_url()?>/form" >engage with kri</a>
				</div>
			</div>
		</div>
	</section>



</main>
<?php get_footer(); ?>
